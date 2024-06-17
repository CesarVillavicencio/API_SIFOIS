<?php

namespace App\Http\Controllers\Admin;

// use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Image;

class ImageController extends Controller {
    public function uploadImage(Image $request) {
        $file_name = uniqid().'.'.$request->file('image')->getClientOriginalExtension();
        $path = $request->file('image')->storeAs('admin/images', $file_name, 'public');

        return response()->json($path);
    }
}
