<?php

namespace App\Filament\App\Widgets;

use App\Models\Department;
use App\Models\Team;
use App\Models\Employee;
use Filament\Facades\Filament;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsAppOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Users', Team::find(Filament::getTenant())->first()->members->count())
                ->description('All users from the team')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
            Stat::make('Departments', Department::query()->orWhereBelongsTo(Filament::getTenant())->count())
                ->description('All departments from the team.')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger'),
            Stat::make('Employees', Employee::query()->orWhereBelongsTo(Filament::getTenant())->count())
                ->description('All employees from the team.')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
        ];
    }
}
