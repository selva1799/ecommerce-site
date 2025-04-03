<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Products Count', '10')
                ->description('Total products in store')
                ->color('success'),

            Stat::make('Users Count', '15')
                ->description('Total registered users')
                ->color('info'),

            Stat::make('Purchased Total', '$155,000')
                ->description('Total revenue generated')
                ->color('warning'),

            Stat::make('Sales', '30')
                ->description('Total sales this month')
                ->color('primary'),
        ];
    }
}
