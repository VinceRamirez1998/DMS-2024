<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RequestLetterResource\Pages;
use App\Filament\Resources\RequestLetterResource\RelationManagers;
use App\Models\RequestLetter;
use Filament\Forms;
use Filament\Forms\Form;
use Illuminate\Support\Facades\Date;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RequestLetterResource extends Resource
{
    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $model = RequestLetter::class;
    public static function getNavigationBadge(): string
    {
        return static::getModel()::count();
    }
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('request_letter')
                ->label('Request Letter')
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
                Tables\Columns\TextColumn::make('request_letter')
                ->searchable()
                ->label('Request Letter'),
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
            'index' => Pages\ListRequestLetters::route('/'),
            'create' => Pages\CreateRequestLetter::route('/create'),
            'edit' => Pages\EditRequestLetter::route('/{record}/edit'),
        ];
    }
}
