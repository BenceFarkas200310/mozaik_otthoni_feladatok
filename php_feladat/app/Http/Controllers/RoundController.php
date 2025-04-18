<?php

namespace App\Http\Controllers;

use App\Models\Round;
use App\Models\ContestantRound;
use Illuminate\Http\Request;

class RoundController extends Controller
{
    public function showRoundDetails($roundId)
    {
        $round = Round::findOrFail($roundId);
        $contestants = ContestantRound::where('round_id', $roundId)->pluck('contestant_id');

        return view('round-details', compact('round', 'contestants'));
    }
}
