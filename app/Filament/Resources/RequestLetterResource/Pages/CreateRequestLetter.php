<?php

namespace App\Filament\Resources\RequestLetterResource\Pages;

use App\Filament\Resources\RequestLetterResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRequestLetter extends CreateRecord
{
    protected static string $resource = RequestLetterResource::class;
    protected function getRedirectUrl(): string
    {
    return $this->getResource()::getUrl('index');
    }
}
