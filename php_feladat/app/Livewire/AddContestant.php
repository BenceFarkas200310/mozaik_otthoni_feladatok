<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\ContestantRound;

class AddContestant extends Component
{
    public $contestants;
    public $round;
    public $selectedUserId;

    public function mount()
    {
        $this->contestants = User::all();
    }

    public function addContestant()
    {
        if ($this->selectedUserId) {
            $contestantRound = ContestantRound::Create([
                'contestant_id' => $this->selectedUserId,
                'round_id' => $this->round
            ]);

            session()->flash('message', 'Contestant added successfully.');
        } else {
            session()->flash('error', 'Please select a round first.');
        }
    }
    public function render()
    {
        return view('livewire.add-contestant');
    }
}
