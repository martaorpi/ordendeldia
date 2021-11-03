<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Models\Personal;
use App\Models\Models\User;

class PersonalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Personal::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'last_name' => $this->faker->lastName,
            'first_name' => $this->faker->firstName,
            'dni' => $this->faker->numberBetween(-10000, 10000),
            'status' => $this->faker->randomElement(["Activo","Inactivo"]),
        ];
    }
}
