<?php

namespace App\Filament\Admin\Resources\EmployeeResource\Pages;

use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Admin\Resources\EmployeeResource;
use App\Models\Employee;

class ListEmployees extends ListRecords
{
    protected static string $resource = EmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'All' => Tab::make('All'),
            'This Week' => Tab::make('This Week')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('date_hired', '>=', now()->subWeek()))
                ->badge(Employee::query()->where('date_hired', '>=', now()->subWeek())->count()),
            'This Month' => Tab::make('This Month')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('date_hired', '>=', now()->subMonth()))
                ->badge(Employee::query()->where('date_hired', '>=', now()->subMonth())->count()),
            'This Year' => Tab::make('This Year')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('date_hired', '>=', now()->subYear()))
                ->badge(Employee::query()->where('date_hired', '>=', now()->subYear())->count()),
        ];
    }
}
