<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ArrestedFactory extends Factory
{

    public function definition()
    {
        return [

            'dni' => rand(10000000, 60000000),
            'last_name' => $this->faker->name(),
            'first_name' => $this->faker->name(),
            'alias' => $this->faker->name(),
            'date_birth' => $this->faker->date(),
            'sexo'=> $this->faker->randomElement(['m', 'f', 'x']),
            'incapacity'=>$this->faker->randomElement([0, 0, 1])
        ];
    }

}
