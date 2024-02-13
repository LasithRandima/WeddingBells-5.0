<?php

namespace App\Filament\Merchants\Resources;

use App\Filament\Merchants\Resources\VendorFaqResource\Pages;
use App\Filament\Merchants\Resources\VendorFaqResource\RelationManagers;
use App\Models\VendorFaq;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Hidden;

class VendorFaqResource extends Resource
{
    protected static ?string $model = VendorFaq::class;
    protected static ?string $navigationGroup = 'Other';
    protected static ?string $label = 'Vendor FAQ';
    protected static ?string $navigationLabel = 'Vendor FAQ';

    protected static ?string $navigationIcon = 'fas-clipboard-question';
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
                Forms\Components\MarkdownEditor::make('Question')
                ->required()
                ->maxLength(1000)
                ->columnSpan([
                    'sm' => 2,
            ]),
                Forms\Components\MarkdownEditor::make('Answer')
                ->required()
                ->maxLength(2000)
                ->columnSpan([
                    'sm' => 2,
            ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('Question'),
                Tables\Columns\TextColumn::make('Answer'),
                Tables\Columns\TextColumn::make('created_at')
                ->datetime()
                ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListVendorFaqs::route('/'),
            'create' => Pages\CreateVendorFaq::route('/create'),
            'edit' => Pages\EditVendorFaq::route('/{record}/edit'),
        ];
    }
}
