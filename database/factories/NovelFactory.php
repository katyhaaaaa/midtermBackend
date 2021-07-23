<?php

namespace Database\Factories;

use App\Models\Novel;
use Illuminate\Database\Eloquent\Factories\Factory;

class NovelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Novel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'title' => $this->faker->title(),
            'author' => $this->faker->name(),
            'description' => $this->faker->word(),
            'genre' => $this->faker->randomElement(['Drama','Action','Romance','Comedy','Horror','Fiction']),
            'acquired_on' => $this->faker->date(),
        ];
    }
}
