<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    $name = $this->faker->words(2, true);
    $slug = Str::slug($name);

    // Ensure slug uniqueness
    while (Product::where('slug', $slug)->exists()) {
        $slug = Str::slug($name . '-' . Str::random(5)); // Append a random string if slug exists
    }

    return [
        'name' => $name,
        'slug' => $slug, // Use the unique slug
        'description' => $this->faker->sentence(15),
        'image' => $this->faker->imageUrl(600, 600),
        'price' => $this->faker->randomFloat(1, 1, 499),
        'quantity' => $this->faker->numberBetween(1, 10),
        'compare_price' => $this->faker->randomFloat(1, 500, 999),
        'category_id' => Category::inRandomOrder()->first()->id,
        'store_id' => Store::inRandomOrder()->first()->id,
    ];
}
}
