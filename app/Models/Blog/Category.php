<?php

namespace App\Models\Blog;

use Database\Factories\Blog\CategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model {
    use HasFactory;

    protected $table = 'blog_categories';

    protected $fillable = ['name', 'count_posts'];

    public function posts() {
        return $this->hasMany('App\Models\Blog\Post', 'id_category');
    }

    /*=====  Factory Instance  ======*/
    protected static function newFactory() {
        return CategoryFactory::new();
    }
}
