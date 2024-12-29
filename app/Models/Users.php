<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Users extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;



    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id', // Nếu bạn cần cho phép gán giá trị cho id, thêm nó vào đây
        'name',
        'email',
        'password',
        'remember_token',
        'status',
        'role_id',
        'google_id', // Nếu bạn đang dùng trường role_id
        // Các trường khác cần được cho phép
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
    ];
    public function roles()
    {
        return $this->belongsTo(Roles::class, 'role_id', 'id');
    }
    public function company()
    {
        return $this->hasOne(Companies::class, 'user_id');
    }

    public function rating()
    {
        return $this->hasMany(Ratings::class, 'user_id');
    }
}
