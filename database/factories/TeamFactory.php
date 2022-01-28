<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;


class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            ['name' => 'Fenerbahce',
            'strenght' => 80,],
            ['name' => 'Galatasaray',
            'strenght' => 78,],
            ['name' => 'Besiktas',
            'strenght' => 76,],
            ['name' => 'Trabzon',
            'strenght' => 75,]
        ];
       
    }
}
