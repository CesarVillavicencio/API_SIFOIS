<?php

namespace App\Http\Controllers\Admin\Gallery;

use App\Http\Controllers\Controller;
use App\Models\Gallery\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller {
    public function getCategories(Request $request) {
        $query = Category::query();

        if ($request->selected == 'name') {
            $query->where('name', 'like', '%'.$request->search.'%');
        }

        $categories = $query->orderBy('created_at', 'desc')->paginate(20);

        return response()->json($categories);
    }

    public function getCategory(Request $request) {
        $category = Category::findOrFail($request->id);

        return response()->json($category);
    }

    public function createCategory(Request $request) {
        $category = Category::create([
            'name' => strtolower($request->name),
            'count_posts' => 0,
        ]);

        return response()->json($category);
    }

    public function updateCategory(Request $request) {
        $category = Category::findOrFail($request->id_category);
        $category->fill([
            'name' => strtolower($request->name),
        ]);
        $category->save();

        return response()->json($category);
    }

    public function deleteCategory(Request $request) {
        $category = Category::findOrFail($request->id);
        $category->delete();

        return response()->json($category);
    }
}
