<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdvertisementResource\Pages;
use App\Filament\Resources\AdvertisementResource\RelationManagers;
use App\Models\Advertisement;
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
use Filament\Tables\Columns\Summarizers\Count;
use App\Filament\Resources\AdvertisementResource\Widgets\AdvertisementStats;


use Filament\Infolists\Components;
use Filament\Infolists\Infolist;
use Filament\Notifications\Notification;
use Illuminate\Support\Str;
use Filament\Support\Enums\FontWeight;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\SpatieTagsEntry;

use Filament\Forms\Components\Actions;
use Pboivin\FilamentPeek\Forms\Actions\InlinePreviewAction;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Support\Htmlable;
use Filament\GlobalSearch\Actions\Action;

class AdvertisementResource extends Resource
{


    protected static ?string $model = Advertisement::class;

    protected static ?string $navigationIcon = 'fas-pager';

    protected static ?string $navigationGroup = 'Advertistments';

    public $v_category;
    public $buisness_branches;

    public static function getNavigationBadge(): ?string
    {
        return static::$model::where('ad_type', 1)->where('approrval_status', 'pending_approval')->count();
    }

    public static function getEloquentQuery(): Builder
    {
        return static::getModel()::query()->where('ad_type', 0);
    }




    protected static ?string $recordTitleAttribute = 'Advertisement';

    // public static function getGlobalSearchResultTitle(Model $record): string | Htmlable
    // {
    //     return $record->ad_title;
    // }

    public static function getGloballySearchableAttributes(): array
    {
        return ['ad_title', 'vendor.v_name', 'vendor.v_bus_name'];
    }


    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Ad' => $record->ad_title,
            'Vendor' => $record->vendor->v_bus_name,
        ];
    }

    public static function getGlobalSearchEloquentQuery(): Builder
    {
        return parent::getGlobalSearchEloquentQuery()->with(['vendor']);
    }

    public static function getGlobalSearchResultUrl(Model $record): string
    {
        return AdvertisementResource::getUrl('edit', ['record' => $record]);
    }



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                 Hidden::make('v_id')
                ->default(Auth::id()),
                Hidden::make('vBusinessName')
                ->default(DB::table('vendors')
                ->select('v_bus_name')
                ->where('user_id', '=', Auth::id())
                ->value('v_bus_name'))
                ->disabled(),
                Hidden::make('actual_v_id')
                ->default(DB::table('vendors')
                ->select('id')
                ->where('user_id', '=', Auth::id())
                ->value('id'))
                ->disabled(),
                Forms\Components\TextInput::make('ad_title')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan([
                        'sm' => 2,
                ]),
                Forms\Components\RichEditor::make('about')
                    ->required()
                    ->maxLength(3000)
                    ->columnSpan([
                        'sm' => 2,
                    ]),
                Forms\Components\RichEditor::make('service_offered')
                    ->required()
                    ->maxLength(3000)
                    ->columnSpan([
                        'sm' => 2,
                    ]),
                Forms\Components\RichEditor::make('v_package_details')
                    ->required()
                    ->maxLength(3000)
                    ->columnSpan([
                        'sm' => 2,
                    ]),

                Forms\Components\FileUpload::make('ad_image')->required(),

                Forms\Components\Select::make('category_id')
                    ->label('Ad Category')
                    // ->multiple()
                    ->options(VendorCategory::all()->pluck('Category_name', 'id'))
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('discount_deal')
                    ->maxLength(255),
                Forms\Components\TextInput::make('start_price')
                    ->required()
                    ->maxLength(255)
                    ->minLength(1),
                Forms\Components\TextInput::make('v_bus_location')
                    ->label('Business Location')
                    ->placeholder('Business Location')
                    ->required(),
                TagsInput::make('v_bus_branches')
                    ->label('Business Branches')
                    ->placeholder('Type your Branches one by one'),
                Select::make('approrval_status')
                    ->options([
                        'pending_approval' => 'Pending Approval',
                        'draft' => 'Draft',
                        'reviewing' => 'Reviewing',
                        'published' => 'Published',
                        'rejected' => 'Rejected',
                    ])
                    ->native(false)
                    ->searchable(),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('index')->rowIndex(),
                Tables\Columns\ImageColumn::make('ad_image'),
                Tables\Columns\TextColumn::make('ad_title')
                    ->label("Ad Title")
                    ->limit(25)
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('about')
                    ->markdown()
                    ->limit(25)
                    ->searchable(),
                Tables\Columns\TextColumn::make('v_bus_location')
                    ->label('Buisness Location'),
                Tables\Columns\TagsColumn::make('v_bus_branches')
                    ->label('Branches'),
                Tables\Columns\TextColumn::make('service_offered')
                    ->limit(25),
                Tables\Columns\TextColumn::make('v_package_details')
                    ->label("Package")
                    ->limit(25),
                // Tables\Columns\TextColumn::make('category_id'),
                Tables\Columns\SelectColumn::make('category_id')
                ->label('Category')
                ->selectablePlaceholder(false)
                ->disabled()
                ->options(VendorCategory::all()->pluck('Category_name', 'id')),
                Tables\Columns\TextColumn::make('discount_deal')
                    ->limit(25),
                Tables\Columns\TextColumn::make('start_price'),
                TextColumn::make('approrval_status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending_approval' => 'gray',
                         'reviewing' => 'warning',
                         'published' => 'success',
                         'rejected' => 'danger',
                         'draft' => 'info',
                    }),
            ])
            ->filters([
                SelectFilter::make('category_id')
                    ->label('Category')
                    ->multiple()
                    ->options(VendorCategory::all()->pluck('Category_name', 'id')),
                SelectFilter::make('approrval_status')
                    ->label('Approval Status')
                    ->multiple()
                    ->options([
                        'pending_approval' => 'Pending Approval',
                        'draft' => 'Draft',
                        'reviewing' => 'Reviewing',
                        'published' => 'Published',
                        'rejected' => 'Rejected',
                    ]),
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






    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Components\Section::make()
                    ->schema([
                        Components\Split::make([
                            Components\Grid::make(2)
                                ->schema([
                                    Components\Group::make([
                                        Components\TextEntry::make('ad_title')->label('Advertistment Title')->weight(FontWeight::Bold),
                                        Components\TextEntry::make('v_bus_location')->label('Main Buisness Location'),
                                        Components\TextEntry::make('v_bus_branches')->label('Branches')
                                        ->badge()
                                        ->color('success'),
                                        Components\TextEntry::make('approrval_status')
                                        ->badge()
                                        ->color(fn (string $state): string => match ($state) {
                                            'pending_approval' => 'gray',
                                            'reviewing' => 'warning',
                                            'published' => 'success',
                                            'rejected' => 'danger',
                                            'draft' => 'info',
                                        }),
                                    ]),

                                     Components\Group::make([
                                        Components\TextEntry::make('category_id')
                                        ->label('Category')
                                        ->state(function (Advertisement $record): string {
                                            // return $record->Category_name;
                                            return VendorCategory::find($record->category_id)->Category_name;
                                        }),
                                        Components\TextEntry::make('start_price'),
                                        Components\TextEntry::make('discount_deal'),
                                    ]),
                                ]),
                            Components\ImageEntry::make('ad_image')
                                ->hiddenLabel()
                                ->grow(false),
                        ])->from('lg'),
                    ]),
                Components\Section::make('About')
                    ->schema([
                        Components\TextEntry::make('about')
                            ->prose()
                            ->markdown()
                            ->hiddenLabel(),
                    ])
                    ->collapsible(),

                    Components\Section::make('Service Offered')
                    ->schema([
                        Components\TextEntry::make('service_offered')
                            ->prose()
                            ->markdown()
                            ->hiddenLabel(),
                    ])
                    ->collapsible(),

                    Components\Section::make('Package Details')
                    ->schema([
                        Components\TextEntry::make('v_package_details')
                            ->prose()
                            ->markdown()
                            ->hiddenLabel(),
                    ])
                    ->collapsible(),
            ]);
    }








    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getWidgets(): array
    {
        return [
            AdvertisementStats::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAdvertisements::route('/'),
            'create' => Pages\CreateAdvertisement::route('/create'),
            'edit' => Pages\EditAdvertisement::route('/{record}/edit'),
            'view' => Pages\ViewAdvertisement::route('/{record}'),
        ];
    }
}
