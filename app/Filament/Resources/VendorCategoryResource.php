<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VendorCategoryResource\Pages;
use App\Filament\Resources\VendorCategoryResource\RelationManagers;
use App\Models\VendorCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VendorCategoryResource extends Resource
{
    protected static ?string $model = VendorCategory::class;

    protected static ?string $navigationIcon = 'fas-table-cells';

    protected static ?string $navigationGroup = 'Advertistments';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('Category_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('Category_description')
                    ->maxLength(255),
                Forms\Components\TextInput::make('Category_icon')
                    ->maxLength(255),
                Forms\Components\FileUpload::make('Category_image')
                    ->directory('categories'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\ImageColumn::make('Category_image'),
                Tables\Columns\TextColumn::make('Category_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('Category_description'),
                Tables\Columns\TextColumn::make('created_at')
                    ->datetime()
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
            'index' => Pages\ListVendorCategories::route('/'),
            'create' => Pages\CreateVendorCategory::route('/create'),
            'edit' => Pages\EditVendorCategory::route('/{record}/edit'),
        ];
    }
}
