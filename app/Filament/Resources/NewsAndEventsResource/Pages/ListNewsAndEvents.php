<?php

namespace App\Filament\Resources\NewsAndEventsResource\Pages;

use App\Filament\Resources\NewsAndEventsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNewsAndEvents extends ListRecords
{
    protected static string $resource = NewsAndEventsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
