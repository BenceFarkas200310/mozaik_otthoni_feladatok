<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\ContestantRound;
use App\Models\Contestant;

class AddContestant extends Component
{
    public $contestants = [];
    public $users;
    public $round;
    public $selectedUserId;

    public function mount()
    {
        $this->users = User::all();
        $this->contestants = ContestantRound::where('round_id', $this->round)->get();
    }

    public function addContestant()
    {
        if ($this->selectedUserId) {
            $contestant = User::find($this->selectedUserId);
            try {
                $contestant = Contestant::Create([
                    'name' => $contestant->name,
                    'email' => $contestant->email,
                ]);
            }
            catch (\Exception $e) {
                session()->flash('error', 'Hiba a versenyző hozzáadásakor: ' . $e->getMessage());
                return;
            }
            
            $contestantRound = ContestantRound::Create([
                'contestant_id' => $contestant->id,
                'round_id' => $this->round
            ]);

            session()->flash('message', 'Versenyző sikeresen hozzáadva a fordulóhoz.');
        } else {
            session()->flash('error', 'Hiba!');
        }
    }
    public function render()
    {
        return view('livewire.add-contestant');
    }
}
