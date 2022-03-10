<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id', 
        'insurance', 
        'shipping', 
        'status',
        'total',
        'code',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    protected $primaryKey = 'transaction_id';

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
