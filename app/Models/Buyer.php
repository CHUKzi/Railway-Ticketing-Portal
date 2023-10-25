<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    use HasFactory;
    protected $table = 'buyers_history';
    protected $fillable = [
        'user_id',
        'package_id',
        'payment_type',
    ];
}
