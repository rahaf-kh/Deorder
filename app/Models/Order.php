<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Psy\CodeCleaner\FunctionReturnInWriteContextPass;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'order',
        'status',
        'scheduled_time',
        'esrimated_time',
        'start_delivery_time',
        'recived_time',
        'canceled',
        'canceled_text',
        'images',
    ];
    protected $casts = [
        'order' => 'string',
        'status' => 'string',
        'scheduled_time' => 'date',
        'esrimated_time' => 'date',
        'start_delivery_time' => 'date',
        'recived_time' => 'date',
        'canceled' => 'integer',
        'canceled_text' => 'string',
        'images' => 'sting',
    ];
    public function Invoice(): object
    {
        return $this->hasOne(Invoice::class);
    }
    public function User():object{
        return $this->belongsTo(User::class);
    }
    // public function Notification


}
