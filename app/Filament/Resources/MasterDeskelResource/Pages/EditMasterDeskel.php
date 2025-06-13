<?php

namespace App\Filament\Resources\MasterDeskelResource\Pages;

use App\Filament\Resources\MasterDeskelResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMasterDeskel extends EditRecord
{
    protected static string $resource = MasterDeskelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
