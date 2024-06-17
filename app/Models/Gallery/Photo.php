<?php

namespace App\Models\Gallery;

use Database\Factories\Gallery\PhotoFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model {
    use HasFactory;

    protected $table = 'gallery_photos';

    protected $fillable = ['title', 'description', 'image', 'thumb', 'id_category', 'id_admin_user'];

    protected $appends = ['category_name'];

    public function admin_user() {
        return $this->belongsTo('App\Models\AdminUser', 'id_admin_user');
    }

    public function category() {
        return $this->belongsTo('App\Models\Gallery\Category', 'id_category');
    }

    /*==========================*/
    /*=======  Appends  ========*/
    /*==========================*/
    public function getCategoryNameAttribute() {
        return (! empty($this->category)) ? $this->category->name : '';
    }

    /*=====  Factory Instance  ======*/
    protected static function newFactory() {
        return PhotoFactory::new();
    }
}
