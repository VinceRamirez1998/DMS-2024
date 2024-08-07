<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Models\FinancialManagement;
use Illuminate\Support\Facades\Date;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\FinancialManagementResource\Pages;
use App\Filament\Resources\FinancialManagementResource\RelationManagers;

class FinancialManagementResource extends Resource
{
    protected static ?string $model = FinancialManagement::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('budget')
                ->label('Budget'),
                Forms\Components\TextInput::make('description')
                ->label('Description'),
                Forms\Components\TextInput::make('date_created')
                ->default(Date::now()->timezone('Asia/Manila')->format('Y-m-d H:i:s'))
                ->disabled(),
                Forms\Components\TextInput::make('date_updated')
                    ->default(Date::now()->timezone('Asia/Manila')->format('Y-m-d H:i:s'))
                    ->disabled(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('budget')
                ->label('Budget'),
                Tables\Columns\TextColumn::make('description')
                ->label('Description'),
                Tables\Columns\TextColumn::make('date_created')
                ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('date_updated')
                ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListFinancialManagement::route('/'),
            'create' => Pages\CreateFinancialManagement::route('/create'),
            'edit' => Pages\EditFinancialManagement::route('/{record}/edit'),
        ];
    }
}
