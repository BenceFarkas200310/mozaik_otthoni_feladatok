<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Competition;

class AddCompetition extends Component
{
    public $newName;
    public $newYear;
    public $pointsForRight = 1;
    public $pointsForWrong = 0;
    public $pointsForEmpty = 0;
    public $newLang;

    protected $rules = [
        'newName' => 'required',
        'newYear' => 'required'
    ];

    public function addCompetition() {
        $this->validate();

        try {
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
        catch(\Exception $e) {
            session()->flash('error', 'Ez a verseny már létezik!');
        }
        
    }

    public function render()
    {
        return view('livewire.add-competition');
    }
}
