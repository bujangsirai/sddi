<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\ProgressDesaChart;
use App\Filament\Widgets\ProgressKecamatanChart;
use App\Filament\Widgets\ProgressPerDesa;
use App\Filament\Widgets\StatsOverview;
use App\Filament\Widgets\TestChart;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static string $view = 'filament.pages.dashboard';


    protected function getHeaderWidgets(): array
    {

        $widgets = [];

        if (Auth::user()?->hasAnyRole(['Super Admin', 'Admin', 'Kabupaten', 'Kecamatan'])) {
            $widgets = [
                StatsOverview::class,
            ];

            if (Auth::user()?->hasAnyRole(['Super Admin', 'Admin', 'Kabupaten'])) {
                $widgets[] = ProgressKecamatanChart::class;
            }

            if (Auth::user()?->hasAnyRole(['Super Admin', 'Admin', 'Kecamatan'])) {
                $widgets[] =
                    ProgressDesaChart::make([
                        'kecamatanId' => '5207010',
                        'kecamatanNama' => 'Sekongkang',
                        'aspectRatio' => 1
                    ]);
            }




            //     ProgressDesaChart::make([
            //         'kecamatanId' => '5207020',
            //         'kecamatanNama' => 'Jereweh',
            //         'aspectRatio' => 1.4
            //     ]),

            //     ProgressDesaChart::make([
            //         'kecamatanId' => '5207021',
            //         'kecamatanNama' => 'Maluk',
            //         'aspectRatio' => 1.2
            //     ]),

            //     ProgressDesaChart::make([
            //         'kecamatanId' => '5207030',
            //         'kecamatanNama' => 'Taliwang',
            //         'aspectRatio' => 0.5
            //     ]),

            //     ProgressDesaChart::make([
            //         'kecamatanId' => '5207031',
            //         'kecamatanNama' => 'Brang Ene',
            //         'aspectRatio' => 1
            //     ]),

            //     ProgressDesaChart::make([
            //         'kecamatanId' => '5207040',
            //         'kecamatanNama' => 'Brang Rea',
            //         'aspectRatio' => 0.8
            //     ]),

            //     ProgressDesaChart::make([
            //         'kecamatanId' => '5207050',
            //         'kecamatanNama' => 'Seteluk',
            //         'aspectRatio' => 0.8
            //     ]),

            //     ProgressDesaChart::make([
            //         'kecamatanId' => '5207051',
            //         'kecamatanNama' => 'Poto Tano',
            //         'aspectRatio' => 0.8
            //     ]),


        }





        return $widgets;
    }
}
