<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectProposalsResource\Pages;
use App\Filament\Resources\ProjectProposalsResource\RelationManagers;
use App\Models\ProjectProposals;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Illuminate\Support\Facades\Date;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProjectProposalsResource extends Resource
{
    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $model = ProjectProposals::class;
    public static function getNavigationBadge(): string
    {
        return static::getModel()::count();
    }
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('proposal')
                ->label('Proposal')
                ->downloadable()
                ->columnSpan(2),
                Forms\Components\TextInput::make('description')
                ->label('Description')
                ->columnSpan(2),
                Forms\Components\TextInput::make('username')
                ->label('Username'),
                Forms\Components\TextInput::make('user_id')
                ->label('User ID'),
                Forms\Components\TextInput::make('firstname')
                ->label('Firstname'),
                Forms\Components\TextInput::make('lastname')
                ->label('Lastname'),
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
                Tables\Columns\TextColumn::make('proposal')
                ->searchable()
                ->label('Proposal'),
                Tables\Columns\TextColumn::make('description')
                ->searchable()
                ->label('Description'),
                Tables\Columns\TextColumn::make('username')
                ->searchable()
                ->label('Username'),
                Tables\Columns\TextColumn::make('user_id')
                ->searchable()
                ->label('User ID'),
                Tables\Columns\TextColumn::make('firstname')
                ->searchable()
                ->label('First Name'),
                Tables\Columns\TextColumn::make('lastname')
                ->searchable()
                ->label('Last Name'),
                Tables\Columns\TextColumn::make('date_created')
                ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('date_updated')
                ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListProjectProposals::route('/'),
            'create' => Pages\CreateProjectProposals::route('/create'),
            'edit' => Pages\EditProjectProposals::route('/{record}/edit'),
        ];
    }
}
