<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $guarded = [];

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
