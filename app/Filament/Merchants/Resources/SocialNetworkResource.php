<?php

namespace App\Filament\Merchants\Resources;

use App\Filament\Merchants\Resources\SocialNetworkResource\Pages;
use App\Filament\Merchants\Resources\SocialNetworkResource\RelationManagers;
use App\Models\SocialNetwork;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Guava\FilamentIconPicker\Forms\IconPicker;
use Guava\FilamentIconPicker\Tables\IconColumn;

class SocialNetworkResource extends Resource
{
    protected static ?string $model = SocialNetwork::class;

    protected static ?string $navigationGroup = 'Other';
    protected static ?string $navigationIcon = 'fas-users-line';

    protected static ?string $label = 'Social Networks';
    protected static ?string $navigationLabel = 'Social Networks';

    public static function getEloquentQuery(): Builder
    {
        return static::getModel()::query()->where('v_id', Auth::id());
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Hidden::make('v_id')
                ->default(Auth::id()),
                Forms\Components\Select::make('name')
                ->options([
                    'whatsapp' => 'WhatsApp',
                    'facebook' => 'Facebook',
                    'instagram' => 'Instagram',
                    'twitter' => 'Twitter',
                    'youtube' => 'Youtube',
                    'pinterest' => 'Pinterest',
                    'tiktok' => 'TikTok',
                    'linkedin' => 'LinkedIn',
                    'snapchat' => 'Snapchat',
                    'telegram' => 'Telegram',
                ])
                    ->required(),

                // Forms\Components\TextInput::make('icon')
                //     ->maxLength(255),

                IconPicker::make('icon')
                ->sets(['fontawesome-brands'])
                ->columns([
                    'default' => 1,
                    'lg' => 3,
                    '2xl' => 5,
                ]),


                Forms\Components\TextInput::make('social_network')
                    ->required(),
                Forms\Components\Toggle::make('is_active')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('icon'),

                // IconColumn::make('icon'),

                Tables\Columns\TextColumn::make('social_network'),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
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
                Tables\Actions\viewAction::make(),
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
            'index' => Pages\ListSocialNetworks::route('/'),
            'create' => Pages\CreateSocialNetwork::route('/create'),
            'edit' => Pages\EditSocialNetwork::route('/{record}/edit'),
        ];
    }
}
