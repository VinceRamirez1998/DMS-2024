<?php

namespace App\Filament\Resources\RequestLetterResource\Pages;

use App\Filament\Resources\RequestLetterResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRequestLetter extends EditRecord
{
    protected static string $resource = RequestLetterResource::class;

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
