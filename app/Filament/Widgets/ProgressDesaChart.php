<?php

namespace App\Filament\Widgets;

use App\Models\MasterDeskel;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class ProgressDesaChart extends ChartWidget
{

    public string $kecamatanId;
    public string $kecamatanNama;
    public string $aspectRatio;


    protected static ?int $sort = 2;
    protected static ?string $heading = "woi";


    public function getHeading(): string
    {
        return ('Progress Kecamatan ' . $this->kecamatanNama);
    }

    protected function getData(): array
    {
        $desas = MasterDeskel::with(['monitoring' => function ($query) {
            $query->latest()->limit(1);
        }])
            ->where('wilkerstat_kecamatan_id', $this->kecamatanId)
            ->orderBy('desa_kelurahan')
            ->get();

        $labels = [];
        $progressData = [];
        $colors = [];

        foreach ($desas as $desa) {
            $latestProgress = $desa->monitoring->first();
            $progress = $latestProgress ? $latestProgress->progress_persen : 0;

            $labels[] = $desa->desa_kelurahan;
            $progressData[] = $progress;
            $colors[] = $this->getProgressColor($progress);
        }

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Progress (%)',
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
            'responsive' => false,
            'maintainAspectRatio' => false,
            'aspectRatio' => $this->aspectRatio,
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
            ]

        ];
    }

    private function getProgressColor(float $progress): string
    {
        return match (true) {
            $progress < 25 => '#ef4444',
            $progress < 50 => '#f59e0b',
            $progress < 75 => '#3b82f6',
            $progress == 100 => '#10b981',
            default => '#9ca3af',
        };
    }
}
