<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'city'
    ];
    protected $casts = [
        'name' => 'string',
        'city' => 'integer'
    ];
    public function Users(): object
    {
        return $this->hasMany(User::class);
    }
    public function City(): object
    {
        return $this->belongsTo(City::class);
    // }
    // public function Supervisor(): object
    // {
    //     return $this->hasMany(Supervisor::class);
    }
}
