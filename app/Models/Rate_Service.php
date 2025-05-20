<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate_Services extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'star',
        'comments'
    ];
    protected $casts = [
        'user_id' => 'integer',
        'star' => 'integer',
        'comments' => 'string'
    ];
    public function User(): object
    {
        return $this->belongsTo(User::class);
    }
}
