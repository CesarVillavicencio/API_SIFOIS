<?php

namespace App\Http\Controllers;

// use App\Models\User;
// use Illuminate\Http\Request;
use MetasHelper;

class SiteController extends Controller {
    public function home() {
        /*$posts = Post::published()
        ->with('category')
        ->orderBy('date', 'desc')
        ->take(4)->get();

        $photos = Photo::with('category')
        ->orderBy('created_at', 'desc')
        ->take(20)->get();

        $metas = MetasHelper::getDefaultMetas();

        return view('front.pages.home', compact('metas', 'posts', 'photos'));*/

        return view('welcome');
    }

    public function app() {
        $metas = MetasHelper::getDefaultMetas();
        return view('app', compact('metas'));
    }

    public function admin() {
        return view('admin.app');
    }

}
