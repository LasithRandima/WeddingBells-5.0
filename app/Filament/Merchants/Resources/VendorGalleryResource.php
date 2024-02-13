<?php

namespace App\Filament\Merchants\Resources;

use App\Filament\Merchants\Resources\VendorGalleryResource\Pages;
use App\Filament\Merchants\Resources\VendorGalleryResource\RelationManagers;
use App\Models\VendorGallery;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Hidden;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Infolists\Infolist;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\HtmlString;



class VendorGalleryResource extends Resource
{

    protected static ?string $model = VendorGallery::class;

    protected static ?string $navigationIcon = 'fas-images';

    protected static ?string $navigationGroup = 'Advertistments';

    public static function getEloquentQuery(): Builder
    {
        return static::getModel()::query()->where('v_id', Auth::id());
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Images')
                ->schema([
                Hidden::make('v_id')
                    ->default(Auth::user()->id),
                Forms\Components\FileUpload::make('image_path')
                        ->disk('public')
                        ->directory('vendor/galleries')
                        ->image()
                        ->imageEditor()
                        ->imageEditorAspectRatios([
                            null,
                            '16:9',
                            '4:3',
                            '1:1',
                        ])
                        ->reorderable()
                        ->openable()
                        ->downloadable()
                        ->optimize('webp')
                        ->resize(50)
                        ->required(),
                ])->collapsible(),

                //     Forms\Components\TextInput::make('image_order')
                //     ->label('Image Order')
                //     ->numeric()
                //     ->minValue(1)
                //     ->maxValue(5)
                //     ->unique()
                //     ->columnSpan([
                //         'sm' => 2,
                // ]),

                Forms\Components\Select::make('image_order')
                ->columnSpanFull()
                ->hint('Photo Collage Order')
                ->hintColor('primary')
                ->helperText(new HtmlString("You can order images for your <strong>Vendor page</strong> Header section <strong>photo collage</strong> , in here. <br> <strong>1</strong> is the first image and <strong>5</strong> is the last image in the collage.<br> <strong>Other All</strong> images are remain on the <strong>Gallery Section. </strong> You don't need to order them."))
                ->options([
                    Auth::id() . '1' => '1',
                    Auth::id() . '2' => '2',
                    Auth::id() . '3' => '3',
                    Auth::id() . '4' => '4',
                    Auth::id() . '5' => '5'

                ])
                ->unique()
                ->native(false),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')->simpleLightbox(),
                Tables\Columns\TextColumn::make('image_order')
                    ->formatStateUsing(function (VendorGallery $record){
                        return substr($record->image_order, -1);
                    })
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),
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
            'index' => Pages\ListVendorGalleries::route('/'),
            'create' => Pages\CreateVendorGallery::route('/create'),
            'edit' => Pages\EditVendorGallery::route('/{record}/edit'),
        ];
    }






}
