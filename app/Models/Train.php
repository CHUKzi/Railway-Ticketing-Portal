<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Train extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "trains";

    protected $fillable = [
        'name',
        'image',
        'weight',
        'class_1',
        'class_2',
        'class_3',
        'year',
        'locomotives',
        'reporting_number',
    ];
}
