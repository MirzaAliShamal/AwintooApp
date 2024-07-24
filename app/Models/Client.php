<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{
    use HasFactory;

    protected $guarded = [];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function restInfo()
    {
        return $this->hasOne(RestInformation::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function agent()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
