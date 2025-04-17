<?php

namespace App\Http\Controllers;

use App\Models\Competition;

class CompetitionController extends Controller
{
    public function show($id)
    {
        $competition = Competition::findOrFail($id);

        return view('competition-details', compact('competition'));
    }
}