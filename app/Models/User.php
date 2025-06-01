<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;
    
    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile',
        'uuid',
        'profile_image',
        'subscription_fees',
        'address',
        'bio',
        'active',
        'expire',
        'area_id',
        'blocked',
        'type',
        'salary'
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'name' => 'string',
        'email' => 'string',
        'mobile' => 'string',
        // 'uuid'=>,
        'profile_image' => 'string',
        'subscription_fees' => 'double',
        'address' => 'string',
        'bio' => 'string',
        'active' => 'integer',
        'expire' => 'integer',
        'area_id' => 'integer',
        'blocked' => 'integer',
        'type' => 'string',
        'salary' => 'double'
    ];
    public function Area(): object
    {
        return $this->belongsTo(Area::class);
    }
    public function Bolck_list(): object
    {
        return $this->belongsTo(Block_list::class);
    }
    public function Contact_Us(): object
    {
        return $this->hasOne(Contact_Us::class);
    }
    public function Orders(): object
    {
        return $this->hasMany(Order::class);
    }
    public function Rate_Service(): object
    {
        return $this->hasOne(Rate_Services::class);
    }
    // public function Notifications

}
