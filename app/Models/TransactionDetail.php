<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id', 
        'product_id', 
        'product_price', 
        'shipping_status',
        'receipt',
        'code',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    protected $primaryKey = 'detail_id';

    public function product() {
        return $this->hasOne(Product::class, 'product_id', 'product_id');
    }

    public function transaction() {
        return $this->hasOne(Transaction::class, 'transaction_id', 'transaction_id');
    }
}
