<?php

namespace App\Http\Controllers\Admin\Gallery;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Gallery\Create;
use App\Http\Requests\Admin\Gallery\Update;
use App\Http\Requests\Admin\Image as ImageRequest;
use App\Models\Gallery\Category;
use App\Models\Gallery\Photo;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Image;

class PhotosController extends Controller {
    public function getPhotos(Request $request) {

        $selected = $request->selected;
        $search = $request->search;
        $sort_field = $request->sort_field ?? 'created_at';
        $order = $request->order ?? 'desc';

        $query = Photo::query();

        if ($selected == 'title') {
            $query->where('title', 'like', '%'.$search.'%');
        }

        if ($selected == 'admin_user') {
            $query->whereRelation('admin_user', 'name', 'like', '%'.$search.'%');
        }

        if ($selected == 'category') {
            $query->whereRelation('category', 'name', 'like', '%'.$search.'%');
        }

        if ($selected == 'created') {
            $from = Carbon::createFromFormat('Y-m-d', $search[0]);
            $to = Carbon::createFromFormat('Y-m-d', $search[1]);
            $query->whereBetween('created_at', [$from, $to]);
        }

        $photos = $query->with(['category', 'admin_user'])
            ->orderBy($sort_field, $order)
            ->paginate(20);

        return response()->json($photos);
    }

    public function getPhoto(Request $request) {
        $photo = Photo::findOrFail($request->id);
        return response()->json($photo);
    }

    public function createPhoto(Create $request) {
        $photo = Photo::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->image,
            'thumb' => $request->thumb,
            'id_category' => $request->id_category,
            'id_admin_user' => $request->user()->id
        ]);

        // Increase Posts Count on Category
        Category::where('id', $photo->id_category)->increment('count_photos', 1);

        return response()->json($photo);
    }

    public function updatePhoto(Update $request) {
        $photo = Photo::findOrFail($request->id);
        $last_id_category = $photo->id_category;
        $photo->fill([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->image,
            'thumb' => $request->thumb,
            'id_category' => $request->id_category,
            'id_admin_user' => $request->user()->id
        ]);
        $photo->save();

        // Increase Posts Count on Category if changed
        if ($last_id_category != $photo->id_category) {
            Category::where('id', $photo->id_category)->increment('count_photos', 1);
            Category::where('id', $last_id_category)->decrement('count_photos', 1);
        }

        return response()->json($photo);
    }

    public function deletePhoto(Request $request) {
        $photo = Photo::findOrFail($request->id);
        $photo->delete();
        Category::where('id', $photo->id_category)->decrement('count_photos', 1);

        return response()->json($photo);
    }

    public function uploadImage(ImageRequest $request) {
        $image = $request->file('image');
        $file_name = uniqid().'.'.$image->extension();
        $directory = 'admin/gallery';
        $directoryThumbs = 'admin/gallery/thumbs';
        $path = $image->storeAs($directory, $file_name, 'public');
        $pathThumb = $image->storeAs($directoryThumbs, $file_name, 'public');

        // Make Thumb
        $thumbnail_path = public_path('storage/admin/gallery/thumbs/'.$file_name);
        $img = Image::make($thumbnail_path)->resize(300, 300, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($thumbnail_path);

        // Paths Array
        $paths = [
            'path' => $path,
            'path_thumb' => $pathThumb,
        ];

        return response()->json($paths);
    }

    public function getCategories() {
        $categories = Category::orderBy('created_at', 'desc')->get();
        return response()->json($categories);
    }

    public function addNewCategoryForPhoto(Request $request) {
        $category = Category::create([
            'name' => strtolower($request->name),
            'count_photos' => 0,
        ]);

        return response()->json($category);
    }
}
