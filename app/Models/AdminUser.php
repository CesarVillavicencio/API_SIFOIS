<?php

namespace App\Models;

use App\Notifications\ResetPasswordAdminNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class AdminUser extends Authenticatable {
    use HasApiTokens, HasFactory, SoftDeletes, Notifiable;

    protected $table = 'admin_users';

    protected $fillable = ['name', 'lastname', 'email', 'type', 'avatar', 'password', 'blocked_at'];

    protected $hidden = [
        'password', 'remember_token', 'deleted_at',
    ];

    protected $appends = ['full_name'];

    public function isBlocked() {
        return $this->blocked_at != null;
    }

    // =========================
    // Relations ===============
    // =========================
    public function posts() {
        return $this->hasMany('App\Models\Blog\Post', 'id_admin_user');
    }

    public function photos() {
        return $this->hasMany('App\Models\Gallery\Photo', 'id_admin_user');
    }

    /*==========================*/
    /*=======  Appends  ========*/
    /*==========================*/
    public function getFullNameAttribute() {
        return $this->name.' '.$this->lastname;
    }

    /* Notifications */
    public function sendPasswordResetNotification($token) {
        // .../admin#/auth/reset?token=443.dfie...&email=admin@admin.com
        $url = url('/').'/admin#/auth/reset?token='.$token.'&email='.$this->email;
        $this->notify(new ResetPasswordAdminNotification($url));
    }
}
