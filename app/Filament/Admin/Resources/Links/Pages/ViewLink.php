<?php

namespace App\Filament\Admin\Resources\Links\Pages;

use App\Filament\Admin\Resources\Links\LinkResource;
//use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewLink extends ViewRecord
{
    protected static string $resource = LinkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Убираю редактирование
            // EditAction::make(),
        ];
    }

}
