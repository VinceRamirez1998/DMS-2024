<?php

namespace App\Filament\Resources\ProjectProposalsResource\Pages;

use App\Filament\Resources\ProjectProposalsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProjectProposals extends EditRecord
{
    protected static string $resource = ProjectProposalsResource::class;

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
