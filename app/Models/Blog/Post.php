<?php

namespace App\Models\Blog;

use Database\Factories\Blog\PostFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model {
    use HasFactory;

    protected $table = 'blog_posts';

    protected $fillable = [
        'title', 'date', 'id_category', 'description',
        'content', 'author', 'image', 'thumb', 'visits',
        'slugurl', 'publish', 'tags', 'id_admin_user',
    ];

    protected $casts = [
        'tags' => 'array',
        'publish' => 'boolean',
    ];

    protected $appends = ['category_name', 'admin_user_name'];

    public function category() {
        return $this->belongsTo('App\Models\Blog\Category', 'id_category');
    }

    public function admin_user() {
        return $this->belongsTo('App\Models\AdminUser', 'id_admin_user');
    }

    /*==========================*/
    /*=======  Appends  ========*/
    /*==========================*/
    public function getCategoryNameAttribute() {
        return (! empty($this->category)) ? $this->category->name : '';
    }

    public function getAdminUserNameAttribute() {
        return (! empty($this->admin_user)) ? $this->admin_user->full_name : '';
    }

    /*==========================*/
    /*=======  Scopes  =========*/
    /*==========================*/
    public function scopePublished($query) {
        return $query->where('publish', 1);
    }

    /*=====  Factory Instance  ======*/
    protected static function newFactory() {
        return PostFactory::new();
    }
}
