<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    protected $fillable = [
        'name',
        'year',
        'availavle_languages',
        'points_for_right_answer',
        'points_for_wrong_answer',
        'points_for_empty_answer'
    ];
}
