<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\ProgressDesaChart;
use App\Filament\Widgets\ProgressKecamatanChart;
use App\Filament\Widgets\ProgressPerDesa;
use App\Filament\Widgets\StatsOverview;
use App\Filament\Widgets\TestChart;
use Filament\Pages\Page;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.dashboard';


    protected function getHeaderWidgets(): array
    {
        return [
            // StatsOverview::class,
            // ProgressPerDesa::class,
            // ProgressKecamatanChart::class,
            ProgressDesaChart::class,
        ];
    }
}
