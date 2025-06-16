<?php

namespace App\Filament\Resources\MasterDeskelResource\Pages;

use App\Filament\Resources\MasterDeskelResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMasterDeskels extends ListRecords
{
    protected static string $resource = MasterDeskelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
