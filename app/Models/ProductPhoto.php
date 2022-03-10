<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductPhoto extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'product_id',
    ];

    protected $hidden = [
        
    ];

    protected $primaryKey = 'photo_id';

    public function product() {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
