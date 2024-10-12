<?php

namespace App\Filament\Resources\NewsAndEventsResource\Pages;

use App\Filament\Resources\NewsAndEventsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNewsAndEvents extends EditRecord
{
    protected static string $resource = NewsAndEventsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
    return $this->getResource()::getUrl('index');
    }
}
