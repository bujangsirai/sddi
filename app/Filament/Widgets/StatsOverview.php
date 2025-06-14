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
            Stat::make('Total Desa/Kelurahan Selesai', MasterDeskel::count())

                ->color('success'),


            Stat::make('Total Desa/Kelurahan Belum', '21%')

        ];
    }
}
