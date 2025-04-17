<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Round;

class Rounds extends Component
{
    public $rounds;
    public $newRoundName;
    public $competition;

    public function mount($competition)
    {
        $this->competition = $competition;
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

    public function render()
    {
        return view('livewire.rounds');
    }
}