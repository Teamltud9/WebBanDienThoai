<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasUuids; 
    
    protected $table = 'orders';
    protected $primaryKey = 'orderId';
    public $timestamps = true;
    protected $keyType = 'string';
    
    protected $fillable = ['totalPrice', 'userId'];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_details', 'orderId', 'productId')
                    ->withPivot('quantity', 'price');
    }
}
