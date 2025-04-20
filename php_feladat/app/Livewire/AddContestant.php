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
        $contestantIds = ContestantRound::where('round_id', $this->round)->pluck('contestant_id');
        $this->contestants = Contestant::whereIn('id', $contestantIds)->get();
    }

    public function addContestant()
    {
        if ($this->selectedUserId) {
            $user = User::find($this->selectedUserId);
            $contestant = Contestant::where('email', $user->email)->first();

            if (!$contestant) {
                try {
                    $contestant = Contestant::create([
                        'name' => $user->name,
                        'email' => $user->email,
                    ]);
                } catch (\Exception $e) {
                    session()->flash('error', 'Hiba a versenyző hozzáadásakor: ' . $e->getMessage());
                    return;
                }
            }

            ContestantRound::create([
                'contestant_id' => $contestant->id,
                'round_id' => $this->round
            ]);

            $this->mount();
            session()->flash('message', 'Versenyző sikeresen hozzáadva a fordulóhoz.');
        } else {
            session()->flash('error', 'Hiba!');
        }
    }

    public function removeContestant($contestantId)
    {
        try {
            ContestantRound::where('contestant_id', $contestantId)
                ->where('round_id', $this->round)
                ->delete();

            $this->mount();

            session()->flash('message', 'Versenyző sikeresen eltávolítva a fordulóból.');
        } catch (\Exception $e) {
            session()->flash('error', 'Hiba a versenyző eltávolításakor: ' . $e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.add-contestant');
    }
}
