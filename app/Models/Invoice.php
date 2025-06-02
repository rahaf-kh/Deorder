<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'content',
        'price',
        'total',
        'delivery_fee',
        'user_id',
        'order_id'
    ];
    protected $casts = [
        'content' => 'string',
        'price' => 'double',
        'total' => 'double',
        'delivery_fee' => 'double',
        'user_id' => 'integer',
        'order_id' => 'integer'
    ];
    public function Order(): object
    {
        return $this->belongsTo(Order::class);
    }
    // public function 

}
