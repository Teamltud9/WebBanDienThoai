<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasUuids;
    
    protected $table = 'users';  
    protected $primaryKey = 'userId';
    public $timestamps = false;
    protected $keyType = 'string';

    protected $fillable = ['userName', 'email', 'password', 'phoneNumber', 'address','isDeleted', 'roleId'];

    protected $hidden = [
        'password',
        'isDeleted',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'roleId');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'userId');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'userId');
    }

    public function likedProducts()
    {
        return $this->belongsToMany(Product::class, 'like_list', 'userId', 'productId');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey(); 
    }
    
    public function getJWTCustomClaims()
    {
        return [
            'userName' => $this->userName,
            'role' => $this->role->roleName, 
        ];
    }
}
