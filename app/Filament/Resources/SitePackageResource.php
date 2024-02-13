<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SitePackageResource\Pages;
use App\Filament\Resources\SitePackageResource\RelationManagers;
use App\Models\SitePackage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;



use App\Models\VendorCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TagsColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Filters\SelectFilter;


class SitePackageResource extends Resource


{
    protected static ?string $model = SitePackage::class;

    protected static ?string $navigationIcon = 'fas-list-alt';

    protected static ?string $navigationGroup = 'Other';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

            Forms\Components\TextInput::make('pkg_name')
                ->label('Package Name')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('pkg_duration')
                ->label('Package Duration')
                ->helperText('Type Number of Months')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('pkg_price')
                ->label('Package Price')
                ->numeric()
                ->minValue(0)
                ->required(),
            Forms\Components\RichEditor::make('pkg_description')
                ->label('Package Description')
                ->required()
                ->maxLength(3000)
                ->columnSpan([
                    'sm' => 2,
            ]),
            Forms\Components\TextInput::make('image_limit')
                ->required(),
            Forms\Components\TextInput::make('ads_limit')
                ->required(),
            Forms\Components\TextInput::make('top_ad_count')
                ->required(),
            ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pkg_name')
                ->label('Package Name'),
                Tables\Columns\TextColumn::make('pkg_duration')
                ->label('Package Duration'),
                Tables\Columns\TextColumn::make('pkg_price')
                ->label('Package Price'),
                // Tables\Columns\TextColumn::make('pkg_description')
                // ->markdown()
                // ->limit(25)
                // ->label('Package Description'),
                Tables\Columns\TextColumn::make('image_limit'),
                Tables\Columns\TextColumn::make('ads_limit'),
                Tables\Columns\TextColumn::make('top_ad_count')->label('Top Ads  Limit'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d-M-Y'),
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
            'index' => Pages\ListSitePackages::route('/'),
            'create' => Pages\CreateSitePackage::route('/create'),
            'edit' => Pages\EditSitePackage::route('/{record}/edit')

        ];
    }
}
