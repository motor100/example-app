<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Отключаем проверку внешних ключей, чтобы truncate() не ругался на связи
        Schema::disableForeignKeyConstraints();
        DB::table('categories')->truncate();
        DB::table('books')->truncate();
        Schema::enableForeignKeyConstraints();

        // 1. Сначала создаем 5 категорий
        \App\Models\Category::factory()->count(5)->create();

        // 2. Теперь создаем 5 книг (они автоматически подтянут случайные category_id)
        \App\Models\Book::factory()->count(5)->create();
    }
}
