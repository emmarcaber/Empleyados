<?php

namespace App\Filament\Admin\Resources\DepartmentResource\Pages;

use App\Filament\Admin\Resources\DepartmentResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDepartment extends ViewRecord
{
    protected static string $resource = DepartmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
