<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Categories
        $categories = [
            ['name' => 'Sets', 'slug' => 'sets', 'icon' => '🍱'],
            ['name' => 'Sushi', 'slug' => 'sushi', 'icon' => '🍣'],
            ['name' => 'Rolls', 'slug' => 'rolls', 'icon' => '🌀'],
            ['name' => 'Soups', 'slug' => 'soups', 'icon' => '🍜'],
            ['name' => 'Drinks', 'slug' => 'drinks', 'icon' => '🥤'],
        ];

        foreach ($categories as $cat) {
            \App\Models\Category::create($cat);
        }

        $sushiCat = \App\Models\Category::where('slug', 'sushi')->first();
        $rollsCat = \App\Models\Category::where('slug', 'rolls')->first();
        $setsCat = \App\Models\Category::where('slug', 'sets')->first();
        $soupsCat = \App\Models\Category::where('slug', 'soups')->first();

        // 2. Products
        $products = [
            // Rolls
            [
                'category_id' => $rollsCat->id,
                'name' => 'California Roll',
                'slug' => 'california-roll',
                'description' => 'Classic roll with crab, avocado, and cucumber.',
                'price' => 25000,
                'image' => 'images/products/california_roll.png',
                'stock' => 50,
                'rating' => 4.5,
                'rating_count' => 120,
            ],
            [
                'category_id' => $rollsCat->id,
                'name' => 'Dragon Roll',
                'slug' => 'dragon-roll',
                'description' => 'Eel and cucumber inside, topped with avocado.',
                'price' => 45000,
                'image' => 'images/products/dragon_roll.png',
                'stock' => 30,
                'rating' => 4.7,
                'rating_count' => 85,
            ],
            [
                'category_id' => $rollsCat->id,
                'name' => 'Rainbow Roll',
                'slug' => 'rainbow-roll',
                'description' => 'A California roll topped with different types of fish.',
                'price' => 50000,
                'image' => 'images/products/rainbow_roll.png',
                'stock' => 25,
                'rating' => 4.9,
                'rating_count' => 60,
            ],
            [
                'category_id' => $rollsCat->id,
                'name' => 'Spicy Tuna Roll',
                'slug' => 'spicy-tuna-roll',
                'description' => 'Spicy tuna and cucumber roll topped with sriracha mayo.',
                'price' => 38000,
                'image' => 'images/products/spicy_tuna_roll.png',
                'stock' => 40,
                'rating' => 4.6,
                'rating_count' => 95,
            ],
            [
                'category_id' => $rollsCat->id,
                'name' => 'Tempura Roll',
                'slug' => 'tempura-roll',
                'description' => 'Crispy shrimp tempura roll with spicy mayo.',
                'price' => 35000,
                'image' => 'images/products/tempura_roll.png',
                'stock' => 45,
                'rating' => 4.8,
                'rating_count' => 110,
            ],
            // Sushi/Nigiri/Sashimi
            [
                'category_id' => $sushiCat->id,
                'name' => 'Salmon Nigiri',
                'slug' => 'salmon-nigiri',
                'description' => 'Fresh salmon over pressed vinegar rice.',
                'price' => 30000,
                'image' => 'images/products/salmon_nigiri.png',
                'stock' => 60,
                'rating' => 4.8,
                'rating_count' => 150,
            ],
            [
                'category_id' => $sushiCat->id,
                'name' => 'Tuna Sashimi',
                'slug' => 'tuna-sashimi',
                'description' => 'Fresh slices of premium tuna.',
                'price' => 55000,
                'image' => 'images/products/tuna_sashimi.png',
                'stock' => 20,
                'rating' => 4.9,
                'rating_count' => 75,
            ],
            // Sets
            [
                'category_id' => $setsCat->id,
                'name' => 'Premium Sushi Platter',
                'slug' => 'premium-sushi-platter',
                'description' => 'A variety of our best nigiri and rolls.',
                'price' => 150000,
                'image' => 'images/products/sushi_platter.png',
                'stock' => 15,
                'rating' => 5.0,
                'rating_count' => 40,
            ],
            // Soups/Appetizers
            [
                'category_id' => $soupsCat->id,
                'name' => 'Miso Soup',
                'slug' => 'miso-soup',
                'description' => 'Traditional Japanese soybean paste soup.',
                'price' => 15000,
                'image' => 'images/products/miso_soup.png',
                'stock' => 100,
                'rating' => 4.4,
                'rating_count' => 200,
            ],
            [
                'category_id' => $soupsCat->id,
                'name' => 'Edamame',
                'slug' => 'edamame',
                'description' => 'Steamed green soybeans with sea salt.',
                'price' => 18000,
                'image' => 'images/products/edamame.png',
                'stock' => 100,
                'rating' => 4.3,
                'rating_count' => 180,
            ],
        ];

        foreach ($products as $prod) {
            \App\Models\Product::create($prod);
        }
    }
}
