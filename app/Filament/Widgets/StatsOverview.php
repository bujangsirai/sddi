<?php

namespace App\Filament\Widgets;

use App\Models\MasterDeskel;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Desa/Kelurahan Selesai', '0'),
            Stat::make('Total Desa/Kelurahan Belum', '65'),
            Stat::make('Persentase Penyelesaian', '54,65%')
        ];
    }
}
