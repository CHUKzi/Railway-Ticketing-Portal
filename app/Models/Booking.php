<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table = "bookings";
    protected $fillable = [
        'user_id',
        'from_station_id',
        'to_station_id',
        'recipe',
        'spent_points',
        'status',
        'class',
        'qr_code',
    ];
}
