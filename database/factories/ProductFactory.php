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
            'price' => $price,
            'size' => $this->faker->randomElement(['PP', 'P', 'M', 'G', 'GG', 'XG']),
            'condition' => $this->faker->randomElement(['novo', 'seminovo', 'usado']),
            'image_url' => $this->faker->randomElement([
                'https://photos.enjoei.com.br/moletom-essential-grey-59171462/1200xN/czM6Ly9waG90b3MuZW5qb2VpLmNvbS5ici9wcm9kdWN0cy8yMDA4MzA5OC9kNWI1NDliYjhiNjc1NjAwZWZkZDNjZGQ5YjkzM2JkMy5qcGc',
                'https://photos.enjoei.com.br/moletom-cropped-graffiti-logo-65342338/1200xN/czM6Ly9waG90b3MuZW5qb2VpLmNvbS5ici9wcm9kdWN0cy8yMDA4MzA5OC8yNGJhODY5MzJlOWQzYjhiZmEzZmY3YWE4YTA0NjFkOC5qcGc',
                'https://photos.enjoei.com.br/calca-alfaiataria-azul-marinho-rjussa-64920926/1200xN/czM6Ly9waG90b3MuZW5qb2VpLmNvbS5ici9wcm9kdWN0cy8yMDMyMDIzMS85OTAyMTJiYjVlNTg1NGU3ZWVhNjNiZGQxZGQ2NDFmOC5qcGc',
                'https://photos.enjoei.com.br/bota-couro-marrom-rjussa-65485112/1200xN/czM6Ly9waG90b3MuZW5qb2VpLmNvbS5ici9wcm9kdWN0cy8yMDMyMDIzMS8wMTA4MDdlNTkzMDk1MzIyNzhmZjI5ZDY4MmU2OTY4Ny5qcGc',
                'https://photos.enjoei.com.br/blusa-preta-floral-bluesteel-57339780/1200xN/czM6Ly9waG90b3MuZW5qb2VpLmNvbS5ici9wcm9kdWN0cy81OTAzMjM2LzVjMWVjNTEwODMyNDg4NjYwMGJkMTQ5MzVmOGYwMjZkLmpwZw',
                'https://photos.enjoei.com.br/bucket-preto-60773150/1200xN/czM6Ly9waG90b3MuZW5qb2VpLmNvbS5ici9wcm9kdWN0cy8xMDMyOTYzMi80NjE3NjVjMjI0Njk0ZTlhMGQyNTA4NWU0YTgzMDM4MS5qcGc',
            ]),
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
