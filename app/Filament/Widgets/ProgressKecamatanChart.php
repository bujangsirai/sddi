<?php

namespace App\Filament\Widgets;

use App\Models\MonitoringDeskel;
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
        foreach ($data as $item) {
            $kecamatanLabels[] = $item->nama_kecamatan;
            $progressData[] = round($item->avg_progress, 2);
        }

        return [
            'labels' => $kecamatanLabels,
            'datasets' => [
                [
                    'label' => 'Rata-rata Progress (%)',
                    'data' => $progressData,
                    'backgroundColor' => '#3b82f6',
                    'borderColor' => '#1d4ed8',
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
            'aspectRatio' => 1,

            'scales' => [
                'x' => [
                    'min' => 0,
                    'max' => 100,
                    'ticks' => [
                        'stepSize' => 20
                    ]
                ]
            ]
        ];
    }
}
