<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasUuids; 
    
    protected $table = 'products';
    protected $primaryKey = 'productId';
    public $timestamps = false;
    protected $keyType = 'string';
    
    protected $fillable = ['productName', 'productPrice', 'description','CPU','RAM','storage','display','battery', 'brandId', 'isDeleted', 'productImage', 'productType', 'productColor', 'productWeight', 'productSize'];

    protected $hidden = [
        'isDeleted',
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class, 'productId');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brandId');
    }

    public function imageProducts()
    {
        return $this->hasMany(ImageProduct::class, 'productId');
    }

    public function likedByUsers()
    {
        return $this->belongsToMany(User::class, 'like_list', 'productId', 'userId');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_details', 'productId', 'orderId')
                    ->withPivot('quantity', 'price');;
    }
}
