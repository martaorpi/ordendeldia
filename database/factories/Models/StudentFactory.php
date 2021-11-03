<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Models\Career;
use App\Models\Models\Location;
use App\Models\Models\Nationality;
use App\Models\Models\Province;
use App\Models\Models\Student;
use App\Models\Models\User;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'career_id' => Career::factory(),
            'nationality_id' => Nationality::factory(),
            'province_id' => Province::factory(),
            'location_id' => Location::factory(),
            'location_description' => $this->faker->word,
            'last_name' => $this->faker->lastName,
            'first_name' => $this->faker->firstName,
            'dni' => $this->faker->numberBetween(-10000, 10000),
            'year_income' => $this->faker->numberBetween(-10000, 10000),
            'address_district' => $this->faker->word,
            'address_street' => $this->faker->word,
            'address_number' => $this->faker->numberBetween(-10000, 10000),
            'address_flat' => $this->faker->numberBetween(-10000, 10000),
            'address_departament' => $this->faker->word,
            'address_cp' => $this->faker->word,
            'slug' => $this->faker->slug,
        ];
    }
}
