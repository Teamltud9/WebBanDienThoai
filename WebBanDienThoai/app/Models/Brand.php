<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasUuids;
    
    protected $table = 'brands';
    protected $primaryKey = 'brandId';
    public $timestamps = false;
    protected $keyType = 'string';

    protected $fillable = ['brandName', 'logo', 'isDeleted'];

    protected $hidden = [
        'isDeleted',
    ];
    
    public function products()
    {
        return $this->hasMany(Product::class, 'brandId');
    }
}
