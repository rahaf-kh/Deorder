<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    protected $casts = ['name' => 'string'];


    public function Areas(): object
    {
        return $this->hasMany(Area::class);
    }
}
