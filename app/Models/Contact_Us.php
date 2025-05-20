<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact_Us extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'feedback'
    ];
    protected $casts = [
        'user_id' => 'integer',
        'feedback' => 'string'
    ];
    public function User(): object
    {
        return $this->belongsTo(User::class);
    }
}
