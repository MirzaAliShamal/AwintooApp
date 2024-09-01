<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PracticePlace extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function restInfo()
    {
        return $this->hasMany(RestInformation::class, 'practice_places_id');
    }
}
