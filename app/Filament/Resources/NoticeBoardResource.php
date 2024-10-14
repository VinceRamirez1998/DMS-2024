<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NoticeBoardResource\Pages;
use App\Filament\Resources\NoticeBoardResource\RelationManagers;
use App\Models\NoticeBoard;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NoticeBoardResource extends Resource
{
    protected static ?string $model = NoticeBoard::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('image')
                 ->columnSpanFull()
                    ->image(),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->columnSpanFull()
                    ->maxLength(255),
                Forms\Components\RichEditor::make('content')
                    ->required()
                    ->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image'),
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
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
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
            'index' => Pages\ListNoticeBoards::route('/'),
            'create' => Pages\CreateNoticeBoard::route('/create'),
            'edit' => Pages\EditNoticeBoard::route('/{record}/edit'),
        ];
    }
}
