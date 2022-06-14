<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Student::class;
    public function definition()
    {
        return [
            // 'user_id' => $this->faker->numerify('###'),
            'batch_no' => '80',
            'reg_no' => $this->faker->numerify('########'),
            'applied_for' => $this->faker->name(),
            'father_name' => $this->faker->name(),
            'father_occupation' => $this->faker->name(),
            'dob' => '1990-01-01',
            'cnic' => $this->faker->numerify('#############'),
            'domicile' => $this->faker->name(),
            'student_occupation' => $this->faker->name(),
            'degree' => $this->faker->name(),
            'major_subjects' => $this->faker->name(),
            'cgpa' => $this->faker->numerify('##'),
            'board_university' => $this->faker->name(),
            'distinction' => $this->faker->name(),
            'address' => $this->faker->name(),
            'contact_res' => $this->faker->numerify('###########'),
            'cell_no' => $this->faker->numerify('###########'),
        ];
    }
}
