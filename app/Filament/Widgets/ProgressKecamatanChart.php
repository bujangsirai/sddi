<?php

namespace App\Filament\Widgets;

use App\Models\MonitoringDeskel;
use Doctrine\DBAL\Schema\Index;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class ProgressKecamatanChart extends ChartWidget
{
    protected static ?string $heading = 'Progress Desa/Kelurahan per Kecamatan';
    protected static ?int $sort = 1;

    protected function getData(): array
    {

        $data = MonitoringDeskel::query()
            ->join('master_deskel', 'monitoring_deskel.master_deskel_id', '=', 'master_deskel.id')
            ->join('master_kecamatan', 'master_deskel.wilkerstat_kecamatan_id', '=', 'master_kecamatan.wilkerstat_kecamatan_id')
            ->select(
                'master_kecamatan.kecamatan as nama_kecamatan',
                'master_kecamatan.wilkerstat_kecamatan_id',
                DB::raw('AVG(monitoring_deskel.progress_persen) as avg_progress')
            )
            ->groupBy('master_kecamatan.wilkerstat_kecamatan_id', 'master_kecamatan.kecamatan')
            ->orderBy('master_kecamatan.wilkerstat_kecamatan_id', 'asc')
            ->get();

        // Format data untuk chart
        $kecamatanLabels = [];
        $progressData = [];
        $colors = [];

        foreach ($data as $index => $item) {
            $kecamatanLabels[] = $item->nama_kecamatan;
            $progress = $item->avg_progress ? $item->avg_progress : 0;
            // $progress = $item->avg_progress ? ($index + 1) * 10 : 0;
            $progressData[] = round($item->avg_progress, 2);
            // $progressData[] = ($index + 1) * 10;

            $colors[] = $this->getProgressColor($progress);
        }

        return [
            'labels' => $kecamatanLabels,
            'datasets' => [
                [

                    'data' => $progressData,
                    'backgroundColor' => $colors,
                    'borderColor' => '#1f2937',

                    'borderWidth' => 1,
                    'barThickness' => 25,
                    'barPercentage' => 1,
                    'categoryPercentage' => 1,

                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {


        return [

            'indexAxis' => 'y',
            'maintainAspectRatio' => false,
            'aspectRatio' => 0.8,

            'scales' => [
                'x' => [
                    'min' => 0,
                    'max' => 100,
                    'title' => [
                        'display' => true,
                        'text' => 'Persentase Progress'
                    ],
                    'ticks' => [
                        'stepSize' => 20
                    ]
                ],
                'y' => [
                    'ticks' => [
                        'autoSkip' => false
                    ]
                ],
            ],

            'plugins' => [

                // 'datalabels' => [
                //     'anchor' => 'end',      // posisi datanya
                //     'align' => 'top',       // di atas batang
                //     'color' => '#000',      // warna angka
                //     'font' => [
                //         'weight' => 'bold'
                //     ]
                // ]

                'legend' => [
                    'display' => false,
                ],
                'datalabels' => [
                    'labels' => [
                        'title' => null
                    ]
                ]


            ]
        ];
    }

    private function getProgressColor(float $progress): string
    {
        return match (true) {
            $progress < 25 => '#ef4444',
            $progress < 50 => '#f59e0b',
            $progress < 100 => '#3b82f6',
            $progress == 100 => '#10b981',
            default => '#9ca3af',
        };
    }
}
