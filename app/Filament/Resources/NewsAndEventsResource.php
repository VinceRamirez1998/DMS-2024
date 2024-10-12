<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsAndEventsResource\Pages;
use App\Filament\Resources\NewsAndEventsResource\RelationManagers;
use App\Models\NewsAndEvents;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NewsAndEventsResource extends Resource
{
    protected static ?string $model = NewsAndEvents::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->columnSpan(2)
                    ->maxLength(255),
                Forms\Components\RichEditor::make('content')
                    ->required()
                    ->columnSpan(2),
                Forms\Components\DateTimePicker::make('created_at')
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('content')
                    ->html()
                    ->searchable()
                    ->formatStateUsing(function ($state) {
                        return \Illuminate\Support\Str::limit($state, 50); // limits to 100 characters
                    }),
                    Tables\Columns\TextColumn::make('created_at')
                ->dateTime('d-M-Y g:i A') // Format as 15-Sep-2024 5:04 PM
                ->timezone('Asia/Manila') // Set the timezone
                ->sortable(),
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
            'index' => Pages\ListNewsAndEvents::route('/'),
            'create' => Pages\CreateNewsAndEvents::route('/create'),
            'edit' => Pages\EditNewsAndEvents::route('/{record}/edit'),
        ];
    }
}
