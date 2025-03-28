<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class ImageProduct extends Model
{
    use HasUuids; 
    
    protected $table = 'image_products';
    protected $primaryKey = 'imageId';
    public $timestamps = false;
    protected $keyType = 'string';

    protected $fillable = ['imagePath','productId'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'productId');
    }
}
