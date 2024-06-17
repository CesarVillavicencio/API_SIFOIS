<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'data',
        'new_notifications'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'data' => 'array',
    ];

    public function derechos(): HasMany {
        return $this->hasMany('App\Models\Local\ObjectoSeguridadUsuario', 'id_user');
    }

    public function rights(): HasMany {
        return $this->hasMany('App\Models\Local\UserRight', 'id_user');
    }

    // protected $touches = ['directories'];
    public function directories(): BelongsToMany {
        return $this->belongsToMany('App\Models\Local\Directory', 'cgr_directories_users', 'user_id', 'directory_id')->withPivot('id' ,'editor')->withTimestamps();
    }

    public function archivos(): BelongsToMany {
        return $this->belongsToMany('App\Models\Local\Archivo', 'cgr_archivos_users', 'user_id', 'archivo_id')->withPivot('id', 'editor',)->withTimestamps();
    }
}
