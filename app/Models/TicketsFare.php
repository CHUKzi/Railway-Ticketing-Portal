<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketsFare extends Model
{
    use HasFactory;
    protected $table = "tickets_fares";
    protected $fillable = [
        'from_station_id',
        'to_station_id',
        '1_class_price',
        '2_class_price',
        '3_class_price',
    ];
}
