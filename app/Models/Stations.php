<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stations extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = "stations";
    protected $fillable = [
        'name',
        'phone',
        'province_id',
        'longitude',
        'latitude',
        'description',
    ];
}
