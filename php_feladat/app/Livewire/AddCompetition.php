<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Competition;

class AddCompetition extends Component
{
    public $newName;
    public $newYear;
    public $pointsForRight;
    public $pointsForWrong;
    public $pointsForEmpty;
    public $newLang;
    public $lang = 'hu';

    protected $rules = [
        'newName' => 'required',
        'newYear' => 'required'
    ];

    public function addCompetition() {
        $this->validate();

        Competition::create([
            'name' => $this->newName,
            'year' => $this->newYear,
            'available_languages' => $this->newLang,
            'points_for_right_answer' => $this->pointsForRight,
            'points_for_wrong_answer' => $this->pointsForWrong,
            'points_for_empty_answer' => $this-> pointsForEmpty
        ]);

        $this->reset();
        $this->dispatch('competitionAdded');
    }

    public function render()
    {
        return view('livewire.add-competition');
    }
}
