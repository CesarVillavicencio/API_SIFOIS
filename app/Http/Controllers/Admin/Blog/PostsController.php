<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Blog\Create;
use App\Http\Requests\Admin\Blog\Update;
use App\Http\Requests\Admin\Image as ImageRequest;
use App\Models\Blog\Category;
use App\Models\Blog\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;

class PostsController extends Controller {
    public function getPosts(Request $request) {

        $selected = $request->selected;
        $search = $request->search;
        $sort_field = $request->sort_field ?? 'created_at';
        $order = $request->order ?? 'desc';

        $query = Post::query();

        if ($selected == 'title') {
            $query->where('title', 'like', '%'.$search.'%');
        }

        if ($selected == 'date') {
            $from = Carbon::createFromFormat('Y-m-d', $search[0]);
            $to = Carbon::createFromFormat('Y-m-d', $search[1]);
            $query->whereBetween('date', [$from, $to]);
        }

        if ($selected == 'publish') {
            $query->where('publish', $search);
        }

        if ($selected == 'visits_max') {
            $query->where('visits', '>=', $search);
        }

        if ($selected == 'visits_min') {
            $query->where('visits', '<=', $search);
        }

        if ($selected == 'author') {
            $query->where('author', 'like', '%'.$search.'%');
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

        $posts = $query->with(['category', 'admin_user'])
            ->orderBy($sort_field, $order)
            ->paginate(20);

        return response()->json($posts);
    }

    public function getPost(Request $request) {
        $post = Post::findOrFail($request->id);

        return response()->json($post);
    }

    public function createPost(Create $request) {
        $post = Post::create([
            'title' => $request->title,
            'date' => $request->date,
            'id_category' => $request->id_category,
            'description' => $request->description,
            'content' => $request->content,
            'author' => $request->author,
            'image' => $request->image,
            'thumb' => $request->thumb,
            'visits' => 0,
            'slugurl' => $request->slugurl,
            'publish' => $request->publish,
            'tags' => $request->tags,
            'id_admin_user' => $request->user()->id,
        ]);

        // Increase Posts Count on Category
        Category::where('id', $post->id_category)->increment('count_posts', 1);

        return response()->json($post);
    }

    public function updatePost(Update $request) {
        $post = Post::findOrFail($request->id);
        $last_id_category = $post->id_category;
        $post->fill([
            'title' => $request->title,
            'date' => $request->date,
            'id_category' => $request->id_category,
            'description' => $request->description,
            'content' => $request->content,
            'author' => $request->author,
            'image' => $request->image,
            'thumb' => $request->thumb,
            'slugurl' => $request->slugurl,
            'publish' => $request->publish,
            'tags' => $request->tags,
        ]);
        $post->save();

        // Increase Posts Count on Category if changed
        if ($last_id_category != $post->id_category) {
            Category::where('id', $post->id_category)->increment('count_posts', 1);
            Category::where('id', $last_id_category)->decrement('count_posts', 1);
        }

        return response()->json($post);
    }

    public function deletePost(Request $request) {
        $post = Post::findOrFail($request->id);
        $post->delete();
        Category::where('id', $post->id_category)->decrement('count_posts', 1);

        return response()->json($post);
    }

    public function uploadImage(ImageRequest $request) {
        $image = $request->file('image');
        $file_name = uniqid().'.'.$image->extension();
        $directory = 'admin/blog';
        $directoryThumbs = 'admin/blog/thumbs';
        $path = $image->storeAs($directory, $file_name, 'public');
        $pathThumb = $image->storeAs($directoryThumbs, $file_name, 'public');

        // Make Thumb
        $thumbnail_path = public_path('storage/admin/blog/thumbs/'.$file_name);
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

    public function togglePublish(Request $request) {
        $post = Post::findOrFail($request->id);
        if ($post->publish == 0) {
            $post->publish = 1;
        } else {
            $post->publish = 0;
        }
        $post->save();

        return response()->json($post);
    }

    public function getCategories() {
        $categories = Category::orderBy('created_at', 'desc')->get();

        return response()->json($categories);
    }

    public function addNewCategoryForPost(Request $request) {
        $category = Category::create([
            'name' => strtolower($request->name),
            'count_posts' => 0,
        ]);

        return response()->json($category);
    }
}
