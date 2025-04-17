<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Round;

class Rounds extends Component
{

    public $rounds;

    public function mount($competition)
    {
        $this->competition = $competition;
        $this->rounds = Round::where('competition_id', $this->competition->id)->get();
    }

    public function render()
    {
        return view('livewire.rounds');
    }
}
