<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        return [
            // Генерируем предложение из 4 слов, убираем точку на конце и делаем Каждое Слово С Заглавной Буквы. Это делает Метод Str::title
            'title'       => Str::title(rtrim(fake()->sentence(4), '.')),
            'author'      => fake()->name(),
            'image'       => fake()->imageUrl(),
            'description' => fake()->text(),
        ];
    }
}
