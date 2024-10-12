<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\RelationManagers;


class UserResource extends Resource
{
    protected static ?string $model = User::class;
    public static function getNavigationBadge(): string
    {
        return static::getModel()::count();
    }

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('profile_picture')
                ->image(),
                Forms\Components\TextInput::make('username')
                    ->maxLength(255),
                Forms\Components\TextInput::make('firstname')
                    ->maxLength(255),
                Forms\Components\TextInput::make('lastname')
                    ->maxLength(255),
                Select::make('department')
                    ->label('Department')
                    ->options([
                        'CCS' => 'CCS',
                        'CEA' => 'CEA',
                        'CHS' => 'CHS',
                        'SHS' => 'SHS',
                        'CHTM' => 'CHTM',
                        'COE' => 'COE',
                        'CBS' => 'CBS',
                        'CSSP' => 'CSSP',
                        'LHS' => 'LHS',
                        'CSSP' => 'CSSP',
                        'CAS' => 'CAS',
                        'CIT' => 'CIT',
                        'GS' => 'GS',
                    ]),
                    Select::make('role')
                    ->label('Roles')
                    ->options([
                        'dean' => 'Dean',
                        'facultyextensionist' => 'Faculty Extensionist',
                    ]),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\DateTimePicker::make('email_verified_at'),
                // Forms\Components\TextInput::make('position')
                //     ->maxLength(255),
                Forms\Components\TextInput::make('purpose')
                    ->maxLength(255),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->unique()
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                    ->dehydrated(fn ($state) => filled($state))
                    // ->required(fn (Page $livewire) => $livewire instanceof CreateUser)
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\TextInput::make('focal_person')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
              
                Tables\Columns\ImageColumn::make('profile_picture')
                    ->searchable()
                    ->label('Image'),
                Tables\Columns\TextColumn::make('username')
                        ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('firstname')
                    ->searchable(),
                Tables\Columns\TextColumn::make('lastname')
                    ->searchable(),
                Tables\Columns\TextColumn::make('role')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('position')
                    ->searchable(),
                Tables\Columns\TextColumn::make('purpose')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('focal_person')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('role','!=', 'Admin');
    }
}
