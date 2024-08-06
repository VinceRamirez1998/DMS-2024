<?php

namespace App\Filament\Resources\RequestLetterResource\Pages;

use App\Filament\Resources\RequestLetterResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRequestLetters extends ListRecords
{
    protected static string $resource = RequestLetterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
