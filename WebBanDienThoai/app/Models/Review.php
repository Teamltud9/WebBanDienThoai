<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasUuids;
    
    protected $table = 'previews';
    protected $primaryKey = 'previewId';
    public $timestamps = true;
    protected $keyType = 'string';
    
    protected $fillable = ['content', 'userId', 'productId', 'isDeleted'];

    protected $hidden = [
        'isDeleted',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'productId');
    }
}
