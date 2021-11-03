<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Models\Exam;
use App\Models\Models\Subject;
use App\Models\Models\User;

class ExamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Exam::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'subject_id' => Subject::factory(),
            'user_id' => User::factory(),
            'date' => $this->faker->date(),
            'hour' => $this->faker->time(),
            'status' => $this->faker->randomElement(["Solicitado","Aprobado","Rechazado"]),
        ];
    }
}
