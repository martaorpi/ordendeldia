<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Models\Career;

class CareerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Career::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(4),
            'short_name' => $this->faker->word,
            'amount' => $this->faker->numberBetween(-10000, 10000),
            'available_space' => $this->faker->numberBetween(-10000, 10000),
            'ws_id' => $this->faker->numberBetween(-10000, 10000),
            'duration' => $this->faker->numberBetween(-10000, 10000),
            'status' => $this->faker->randomElement(["Abierta","Cerrada"]),
            'slug' => $this->faker->slug,
        ];
    }
}
