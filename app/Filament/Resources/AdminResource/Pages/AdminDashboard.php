<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\SalesChart;
use App\Filament\Widgets\StatsOverview;
use Filament\Pages\Page;

class AdminDashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-chart-bar';

    protected static string $view = 'filament.pages.dashboard';

    protected static ?string $navigationLabel = 'Dashboard';

    protected static ?int $navigationSort = 1;

    protected function getHeaderWidgets(): array
    {
        return [
            StatsOverview::class,
            SalesChart::class,
        ];
    }
}
