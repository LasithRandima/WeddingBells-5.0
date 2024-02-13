<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Filament\Resources\ClientResource\RelationManagers;
use App\Models\Client;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $navigationIcon = 'fas-user-friends';

    protected static ?string $navigationGroup = 'Profiles';
    protected static ?string $navigationParentItem = 'Users';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Forms\Components\TextInput::make('c_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('c_email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('gender')
                    ->maxLength(255),
                Forms\Components\TextInput::make('partner_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('partner_email')
                    ->email()
                    ->maxLength(255),
                Forms\Components\TextInput::make('c_location')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('c_tpno')
                    ->required(),
                Forms\Components\TextInput::make('guest_count')
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('wed_date')
                    ->required(),
                Forms\Components\TextInput::make('wed_start_time'),
                Forms\Components\TextInput::make('wed_end_time'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('c_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('c_email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('gender')
                    ->searchable(),
                Tables\Columns\TextColumn::make('partner_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('partner_email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('c_location')
                    ->searchable(),
                Tables\Columns\TextColumn::make('guest_count')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('wed_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('wed_start_time'),
                Tables\Columns\TextColumn::make('wed_end_time'),
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
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }
}
