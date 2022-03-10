<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'user_id',
        'category_id',
        'price',
        'description',
        'slug'
    ];

    protected $hidden = [
        
    ];

    protected $primaryKey = 'product_id';

    public function photos() {
        return $this->hasMany(ProductPhoto::class, 'product_id', 'product_id');
    }

    public function user() {
        return $this->hasOne(User::class, 'user_id', 'user_id');
    }

    public function category() {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }
}
