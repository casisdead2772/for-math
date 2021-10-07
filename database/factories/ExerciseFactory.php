<?php


namespace Database\Factories;
use App\Models\Answer;
use App\Models\User;
use App\Models\Subject;
use App\Models\Exercise;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ExerciseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Exercise::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, User::count()),
            'subject_id' => $this->faker->numberBetween(1, Subject::count()),
            'name' => $this->faker->name(),
            'task' => $this->faker->text,
            'difficulty' => $this->faker->numberBetween(1, 5)
        ];
    }
}
