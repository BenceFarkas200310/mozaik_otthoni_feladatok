<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Round;

class Rounds extends Component
{
    public $rounds;
    public $newRoundName;
    public $competition;
    public $userCompetitions;

    public function mount()
    {
        $this->rounds = Round::where('competition_id', $this->competition->id)->get();
    }

    public function addRound()
    {
        $this->validate([
            'newRoundName' => 'required|string|max:255',
        ]);

        $round = Round::create([
            'name' => $this->newRoundName,
            'competition_id' => $this->competition->id,
        ]);

        $this->rounds->push($round);
        $this->newRoundName = '';
    }

    public function getUserCompetitions()
    {
        if (!Auth::user()->is_admin) {
            $this->userCompetitions = Competition::whereHas('rounds.contestants', function($query) {
                $query->where('contestant_id', Auth::id());
            })->get();
        }
    }

    public function render()
    {
        return view('livewire.rounds');
    }
}