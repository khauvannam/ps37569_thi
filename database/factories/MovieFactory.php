<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\FavoriteMovie;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    private const localImage = ['chichiemem2', 'connhot', 'datrung', 'nhabanu', 'trotan'];

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'view' => $this->faker->randomNumber(3),
            'category_id' => Category::factory(),
            'image' => $this->faker->randomElement(self::localImage) . '.webp'];

    }

    public function withFavoriteMovies(int $count = 5): self
    {
        return $this->afterCreating(function (Movie $movie) use ($count) {
            foreach (range(1, $count) as $index) {
                // Fetch a random existing user
                $user = User::inRandomOrder()->first();

                $exists = FavoriteMovie::where('user_id', $user->id)
                    ->where('movie_id', $movie->id)
                    ->exists();

                if (!$exists) {
                    FavoriteMovie::factory()->create([
                        'user_id' => $user->id,
                        'movie_id' => $movie->id]);
                }
            }
        });
    }
}
