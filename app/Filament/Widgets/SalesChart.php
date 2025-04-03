<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class SalesChart extends ChartWidget
{
    protected static ?string $heading = 'Last 6 Months Sales';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Sales',
                    'data' => [12, 17, 14, 25, 22, 30],
                    'backgroundColor' => '#4f46e5',
                    'borderColor' => '#4f46e5',
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
