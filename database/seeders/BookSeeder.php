<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Перед заполнением делаю truncate чтобы очистить таблицу
        DB::table('books')->truncate();    
    
        // Создаю 5 моделей Book со случайными данными
        Book::factory()->count(5)->create();
    }
}
