<?php

namespace App\Filament\Admin\Resources\Links\Pages;

use App\Filament\Admin\Resources\Links\LinkResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateLink extends CreateRecord
{
    protected static string $resource = LinkResource::class;

    // Добавление логики преобразования ссылки
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Создаю объект
        $object = new \App\Classes\Link($data['long_link']);

        // Получаю короткую ссылку
        $short_link = $object->long_to_short();

        // Присваиваю значение
        $data['short_link'] = $short_link;

        // User ID
        $data['user_id'] = Auth::user()->id;

        return $data;
    }

}
