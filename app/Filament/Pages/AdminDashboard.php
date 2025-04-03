<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AdminDashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-chart-bar';

    protected static string $view = 'filament.pages.admin-dashboard';

    protected static ?string $navigationLabel = 'Admin Dashboard';

    protected static ?int $navigationSort = 1;

    protected function getHeaderWidgets(): array
    {
        return [
            StatsOverviewWidget::make()
                ->stats([
                    Stat::make('Total Users', User::count())
                        ->icon('heroicon-o-users')
                        ->description('All registered users')
                        ->color('primary'),

                    Stat::make('Admins', User::role('Admin')->count())
                        ->icon('heroicon-o-shield-check')
                        ->description('Administrators')
                        ->color('success'),

                    Stat::make('Vendors', User::role('Vendor')->count())
                        ->icon('heroicon-o-shopping-bag')
                        ->description('Registered vendors')
                        ->color('warning'),

                    Stat::make('Buyers', User::role('Buyer')->count())
                        ->icon('heroicon-o-user-group')
                        ->description('Active buyers')
                        ->color('info'),
                ]),
        ];
    }

    protected function getRolesData(): array
    {
        return Role::withCount('users')->get()->map(function($role) {
            return [
                'name' => $role->name,
                'users_count' => $role->users_count,
                'color' => match($role->name) {
                    'Admin' => 'bg-primary-500',
                    'Vendor' => 'bg-warning-500',
                    'Buyer' => 'bg-info-500',
                    default => 'bg-gray-500',
                }
            ];
        })->toArray();
    }
}
