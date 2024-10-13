<?php

namespace App\Filament\Resources\NewsAndEventsResource\Pages;

use App\Filament\Resources\NewsAndEventsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateNewsAndEvents extends CreateRecord
{
    protected static string $resource = NewsAndEventsResource::class;
    protected function getRedirectUrl(): string
    {
    return $this->getResource()::getUrl('index');
    }
}
