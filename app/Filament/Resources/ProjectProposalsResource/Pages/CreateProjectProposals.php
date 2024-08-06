<?php

namespace App\Filament\Resources\ProjectProposalsResource\Pages;

use App\Filament\Resources\ProjectProposalsResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProjectProposals extends CreateRecord
{
    protected static string $resource = ProjectProposalsResource::class;
    protected function getRedirectUrl(): string
    {
    return $this->getResource()::getUrl('index');
    }
    
}
