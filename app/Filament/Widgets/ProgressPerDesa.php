<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class ProgressPerDesa extends ChartWidget
{
    protected static ?string $heading = 'Progress Pengisian Kecamatan Seteluk';

    protected function getData(): array
    {
        return [

            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
            'indexAxis' => 'y',
            'datasets' => [
                [
                    'axis' => 'y',
                    'label' => 'Progress Pengisian Web Desa',
                    'data' => [65, 59, 80, 81, 56, 55, 40],
                    'fill' => false,
                    'borderWidth' => 1,


                    'barPercentage' => 1,
                    'barThickness' => 6,
                    'barThickness' => 20,

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
            'aspectRatio' => 1

        ];
    }
}
