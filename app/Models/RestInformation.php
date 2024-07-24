<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestInformation extends Model
{
    use HasFactory;

    protected $table = 'rest_informations';

    protected $guarded = [];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
