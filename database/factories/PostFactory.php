<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'body' => $this->faker->sentence(20) // Creates fake data to test with on Post Model - In Terminaluse commands(2): 1) php artisan tinker 2) App\Model\Post::factory()->times(200)->create(['user_id => 4]);
        ];
    }
}
