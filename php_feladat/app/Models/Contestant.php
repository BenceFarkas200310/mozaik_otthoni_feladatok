<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contestant extends Model
{
    protected $table = 'contestants';

    protected $fillable = [
        'name',
        'email',
    ];
}
