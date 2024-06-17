<?php

namespace App\Models\Gallery;

use Database\Factories\Gallery\CategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model {
    use HasFactory;

    protected $table = 'gallery_categories';

    protected $fillable = ['name', 'count_photos'];

    public function photos() {
        return $this->hasMany('App\Models\Gallery\Photo', 'id_category');
    }

    /*=====  Factory Instance  ======*/
    protected static function newFactory() {
        return CategoryFactory::new();
    }
}
