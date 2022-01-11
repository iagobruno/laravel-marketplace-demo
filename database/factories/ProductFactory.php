<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $price = $this->faker->numberBetween(30, 600) * 100;

        return [
            'title' => $this->faker->sentence(5),
            'description' => $this->faker->paragraph(6, false),
            'image_url' => 'https://picsum.photos/seed/' . $this->faker->word() . '/640/640',
            'price' => $price,
            'discount' => $this->faker->boolean()
                ? $this->faker->numberBetween(1_00, $price)
                : null,
            'size' => $this->faker->randomElement(['PP', 'P', 'M', 'G', 'GG', 'XG']),
            'condition' => $this->faker->randomElement(['novo', 'seminovo', 'usado']),
        ];
    }

    public function boughtBy(User $user)
    {
        return $this->state(function () use ($user) {
            return [
                'buyer_id' => $user->id,
                'bought_at' => now(),
            ];
        });
    }
}
