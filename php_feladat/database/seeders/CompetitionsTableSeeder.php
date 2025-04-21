<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Competition;

class CompetitionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Competition::create([
            'name' => 'Teszt1 Verseny',
            'year' => 2025,
            'available_languages' => 'hu',
            'points_for_right_answer' => 1,
            'points_for_wrong_answer' => 0,
            'points_for_empty_answer' => 0,
        ]);
    }
}