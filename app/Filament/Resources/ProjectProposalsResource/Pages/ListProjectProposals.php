<?php

namespace App\Filament\Resources\ProjectProposalsResource\Pages;

use App\Filament\Resources\ProjectProposalsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProjectProposals extends ListRecords
{
    protected static string $resource = ProjectProposalsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
