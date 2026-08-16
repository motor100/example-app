<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;

/**
 * @extends Factory<Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // 1. Пытаемся найти ОДНУ случайную категорию в базе
        $randomCategory = Category::inRandomOrder()->first();

        // 2. Проверяем: если категория нашлась — берем её ID
        if ($randomCategory) {
            $categoryId = $randomCategory->id;
        } else {
            // 3. Если база пуста (категорий нет), создаем новую категорию через фабрику
            $newCategory = Category::factory()->create();
            $categoryId = $newCategory->id;
        }

        return [
            'title'       => Str::title(rtrim(fake()->sentence(4), '.')),
            'author'      => fake()->name(),
            'image'       => fake()->imageUrl(),
            'description' => fake()->text(),
            'category_id' => $categoryId,
        ];
    }
}
