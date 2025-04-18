<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContestantRound extends Model
{
    protected $table = 'contestant_round';

    protected $fillable = [
        'contestant_id',
        'round_id'
    ];
}
