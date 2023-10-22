<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketChecker extends Model
{
    use HasFactory;
    protected $table = "ticket_checkers";
    protected $fillable = [
        'station_id',
        'name',
        'email',
        'password',
        'phone',
        'address',
    ];
}
