<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Novel;

class NovelFactory extends Factory
{
    protected $model = Novel::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'author' => $this->faker->name,
            'synopsis' => $this->faker->paragraph,
            'published_at' => $this->faker->dateTimeThisYear,
        ];
    }
}
