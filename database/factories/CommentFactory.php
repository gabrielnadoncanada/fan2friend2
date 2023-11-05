<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Comment::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->catchPhrase(),
            'content' => $this->faker->text(),
            'is_visible' => $this->faker->boolean(),
        ];
    }
}
