<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Competition;

class CompetitionsList extends Component
{
    public $competitions;

    protected $listeners = ['competitionAdded' => 'refreshCompetitions'];

    public function mount()
    {
        $this->refreshCompetitions();
    }

    public function refreshCompetitions()
    {
        $this->competitions = Competition::all();
    }

    public function render()
    {
        return view('livewire.competitions-list');
    }
}