<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            // 1. Удаляем старый неисправный внешний ключ
            // Laravel по умолчанию назвал его 'books_category_id_foreign'
            $table->dropForeign(['category_id']);
            
            // 2. Создаем НОВЫЙ, правильный внешний ключ на таблицу categories
            $table->foreign('category_id')
                  ->references('id')
                  ->on('categories') // 👈 Теперь строго во множественном числе!
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            // В случае отката просто возвращаем как было (на всякий случай)
            $table->dropForeign(['category_id']);
            $table->foreign('category_id')
                  ->references('id')
                  ->on('category')
                  ->onDelete('cascade');
        });
    }
};
