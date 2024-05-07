<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\StateResource\Pages;
use App\Filament\Admin\Resources\StateResource\RelationManagers;
use App\Models\State;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StateResource extends Resource
{
    protected static ?string $model = State::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-library'; // Nav Icon

    protected static ?string $navigationLabel = 'State'; // Nav Title or Label

    protected static ?string $modelLabel = 'States'; // Page Title

    protected static ?string $navigationGroup = 'System Management'; // Nav Groups

    protected static ?int $navigationSort = 2; // Nav Group Order or Placement


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('country_id')
                    ->required()
                    ->relationship(name: 'country', titleAttribute: 'name')
                    ->preload() // preload for faster search
                    ->searchable() // searchable option
                    // ->multiple() // multiple options
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('country.name') // Show the country name through dot notation
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('State')
                    ->sortable()
                    ->searchable(),
                // ->hidden(auth()->user()->email !== 'admin@admin.com') // hide column based on condition
                // ->visible(auth()->user()->email === 'admin@admin.com'), // opposite of hidden function
                // ->searchable(isIndividual: true, isGlobal: false), // searchable by itself only
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true), // hide some column by default
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('country.name') // sort states ascending by country name
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStates::route('/'),
            'create' => Pages\CreateState::route('/create'),
            'edit' => Pages\EditState::route('/{record}/edit'),
        ];
    }
}
