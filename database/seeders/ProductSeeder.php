<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();

        Product::factory(5)
            ->for($user)
            ->create();

        Product::factory()
            ->for($user)
            ->boughtBy($otherUser)
            ->create();
    }
}
