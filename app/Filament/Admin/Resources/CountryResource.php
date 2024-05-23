<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Country;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Admin\Resources\CountryResource\Pages;
use App\Filament\Admin\Resources\CountryResource\RelationManagers;
use App\Filament\Admin\Resources\CountryResource\RelationManagers\EmployeesRelationManager;
use App\Filament\Admin\Resources\CountryResource\RelationManagers\StatesRelationManager;

class CountryResource extends Resource
{
    protected static ?string $model = Country::class;

    protected static ?string $navigationIcon = 'heroicon-o-flag'; // Nav Icon

    protected static ?string $navigationLabel = 'Country'; // Nav Title or Label

    protected static ?string $modelLabel = 'Employees Country'; // Page Title

    protected static ?string $navigationGroup = 'System Management'; // Nav Groups

    protected static ?string $slug = 'employees-countries'; // URL slug

    protected static ?int $navigationSort = 1; // Nav Group Order or Placement

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('code')
                    ->required()
                    ->maxLength(3),
                Forms\Components\TextInput::make('phonecode')
                    ->required()
                    ->numeric()
                    ->maxLength(5),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('phonecode')
                    ->numeric()
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                //
                Section::make('Country Information')
                    ->schema([
                        TextEntry::make('code')
                            ->label('Country Code'),
                        TextEntry::make('name'),
                        TextEntry::make('phonecode')
                            ->label('Phone Code'),
                    ])->columns(3),
            ]);
    }

    public static function getRelations(): array
    {
        // Register here the created relation managers
        // Relation Managers have parent and children
        // Basically, managing the children from the parent side
        return [
            StatesRelationManager::class,
            EmployeesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCountries::route('/'),
            'create' => Pages\CreateCountry::route('/create'),
            'edit' => Pages\EditCountry::route('/{record}/edit'),
        ];
    }
}
