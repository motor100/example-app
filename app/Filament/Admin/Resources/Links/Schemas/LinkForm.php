<?php

namespace App\Filament\Admin\Resources\Links\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class LinkForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('long_link')
                    // Добавляю валидацию
                    ->url() // Строка вида URL
                    ->unique(table: \App\Models\Link::class) // Уникальное значение в таблице links
                    ->rules(['min:7', 'max:255']) // Минимальное и максимальное количество символов
                    ->required(), // Обязательное поле

                // Убираю поле 'short_link' от ручного заполнения
                /*
                TextInput::make('short_link')
                    ->required(),
                */
            ]);
    }
}
