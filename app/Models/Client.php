<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Client extends Authenticatable
{
    use HasFactory;

    protected $guarded = [];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function boot()
    {
        parent::boot();
        static::saving(function ($client) {
            if (empty($client->unique_id_number)) {
                $client->unique_id_number = self::generateUniqueClientId($client->job->job_name, $client->full_name);
            }
        });
    }

    public static function generateUniqueClientId($jobTitle, $clientName)
    {
        do {
            $namePart = Str::upper(substr($clientName, 0, 2));
            $timestamp = microtime(true) * 10000;
            $randomNumber = substr($timestamp, -6);
            $suffix = Str::upper(substr($jobTitle, 0, 2));        
            $clientId = $namePart . $randomNumber . $suffix;
            $exists = self::where('unique_id_number', $clientId)->exists();
        } while ($exists);

        return $clientId;
    }

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

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function agent()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
