<?php

namespace App\Filament\Resources\MonitoringDeskelResource\Pages;

use App\Filament\Resources\MonitoringDeskelResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMonitoringDeskels extends ListRecords
{
    protected static string $resource = MonitoringDeskelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
