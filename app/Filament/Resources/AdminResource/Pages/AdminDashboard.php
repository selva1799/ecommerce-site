<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Filament\Widgets\ChartWidget;

class AdminDashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-chart-bar';

    protected static string $view = 'filament.pages.dashboard';

    protected static ?string $navigationLabel = 'Dashboard';

    protected static ?int $navigationSort = 1;

    protected function getHeaderWidgets(): array
    {
        return [
            StatsOverviewWidget::make()
                ->stats([
                    Stat::make('Products Count', '10')
                        ->icon('heroicon-o-cube')
                        ->description('Total products in store')
                        ->color('success'),

                    Stat::make('Users Count', '15')
                        ->icon('heroicon-o-users')
                        ->description('Total registered users')
                        ->color('primary'),

                    Stat::make('Purchased Total', '$155,000')
                        ->icon('heroicon-o-currency-dollar')
                        ->description('Total revenue generated')
                        ->color('warning'),

                    Stat::make('Sales', '30')
                        ->icon('heroicon-o-chart-bar')
                        ->description('Total sales this month')
                        ->color('info'),
                ]),
            SalesChart::class,
        ];
    }
}

class SalesChart extends ChartWidget
{
    protected static ?string $heading = 'Last 6 Months Sales';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Sales',
                    'data' => [12, 17, 14, 25, 22, 30], // Sample data for last 6 months
                    'backgroundColor' => '#4f46e5', // Indigo color
                    'borderColor' => '#4f46e5',
                    'fill' => false,
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'], // Last 6 months labels
        ];
    }

    protected function getType(): string
    {
        return 'line'; // You can change to 'bar' if you prefer
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                ],
            ],
        ];
    }
}
