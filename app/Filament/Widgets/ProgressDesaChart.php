<?php

namespace App\Filament\Widgets;

use App\Models\MasterDeskel;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class ProgressDesaChart extends ChartWidget
{
    // CUSTOM METHOD
    protected static ?string $heading = 'Progress Desa di Kecamatan';
    protected static ?int $sort = 2;
    protected static ?string $maxHeight = '400px';
    protected static string $kecamatanId = '5207010';

    protected function getData(): array
    {
        $desas = MasterDeskel::with(['monitoring' => function ($query) {
            $query->latest()->limit(1);
        }])
            ->where('wilkerstat_kecamatan_id', static::$kecamatanId)
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
            'responsive' => true,
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
                ]
            ],
            'plugins' => [
                'tooltip' => [
                    'callbacks' => [
                        'label' => 'function(context) {
                            return "Progress: " + context.parsed.x + "%";
                        }'
                    ]
                ],
                'legend' => [
                    'display' => false
                ]
            ]
        ];
    }

    private function getProgressColor(float $progress): string
    {
        return match (true) {
            $progress < 30 => '#ef4444',
            $progress < 60 => '#f59e0b',
            $progress < 80 => '#3b82f6',
            default => '#10b981',
        };
    }
}
