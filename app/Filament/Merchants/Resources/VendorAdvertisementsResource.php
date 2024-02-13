<?php

namespace App\Filament\Merchants\Resources;

use App\Filament\Merchants\Resources\VendorAdvertisementsResource\Pages;
use App\Filament\Merchants\Resources\VendorAdvertisementsResource\RelationManagers;
use App\Filament\Merchants\Resources\AdPackageResource\RelationManagers\AdpackagesRelationManager;
use App\Models\Advertisement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Actions;

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
use Filament\Navigation\NavigationItem;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\Summarizers\Count;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Fieldset;

use Filament\Infolists\Components;
use Filament\Infolists\Infolist;
use Filament\Notifications\Notification;
use Illuminate\Support\Str;
use Filament\Support\Enums\FontWeight;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\SpatieTagsEntry;
use AmidEsfahani\FilamentTinyEditor\TinyEditor;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Support\Htmlable;
use Filament\GlobalSearch\Actions\Action;


class VendorAdvertisementsResource extends Resource
{
    protected static ?string $model = Advertisement::class;
    protected static ?string $navigationGroup = 'Advertistments';
    protected static ?string $label = 'Advertisments';

    protected static ?string $navigationIcon = 'fas-pager';

    public static function getEloquentQuery(): Builder
    {
        return static::getModel()::query()->where('v_id', Auth::id())->where('ad_type', 0);
    }



            // -------------------Global Search methods-------------------------------------------

            protected static ?string $recordTitleAttribute = 'Top Advertisement';

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
                return VendorAdvertisementsResource::getUrl('edit', ['record' => $record]);
            }


            // --------------------------End of Global Search methods-------------------------------------------




    public static function form(Form $form): Form
    {
        $package_id = DB::table('payments')->select('package_id')->where('v_id', '=', Auth::id())->value('package_id');
        $package_expire_date = DB::table('payments')->select('package_expire')->where('v_id', '=', Auth::id())->value('package_expire');
        $package_name = DB::table('site_packages')->select('pkg_name')->where('id', '=', $package_id )->value('pkg_name');
        $ads_limit = DB::table('payments')->select('ads_count')->where('v_id', '=', Auth::id())->value('ads_count');
        $Ads_Count = DB::table('advertisements')->select('id')->where('v_id', '=', Auth::id())->where('ad_type', '=', 0)->count();
        $remaining_ads = $ads_limit - $Ads_Count;

        if ($Ads_Count >= $ads_limit) {
        $message = "You are on {$package_name} Plan. ";
        $message .= "You have limit of {$ads_limit} Top Ads. ";
        $message .= "You currently have {$Ads_Count} ads, and your remaining is {$remaining_ads}. ";
        $message .= 'If You Want To Display More Ads, Please Upgrade Your Package.';

        }else{
            $message = '';
        }
        return $form
            ->schema([

    Section::make('Create Advertistments')
    ->description($message)
    ->schema([
        Hidden::make('v_id')
        ->default(Auth::id()),
        Hidden::make('vBusinessName')
        ->default(DB::table('vendors')
        ->select('v_bus_name')
        ->where('user_id', '=', Auth::id())
        ->value('v_bus_name')),
        Hidden::make('actual_v_id')
        ->default(DB::table('vendors')
        ->select('id')
        ->where('user_id', '=', Auth::id())
        ->value('id')),
        Hidden::make('approrval_status')
        ->default('pending_approval')
        ->disabledOn('edit'),
        Forms\Components\TextInput::make('ad_title')
            ->required()
            ->maxLength(255)
            ->columnSpan([
                'sm' => 2,
        ]),
        Forms\Components\RichEditor::make('about')
            ->required()
            ->maxLength(2000)
            ->columnSpan([
                'sm' => 2,
            ]),
        Forms\Components\RichEditor::make('service_offered')
            ->required()
            ->maxLength(2000)
            ->columnSpan([
                'sm' => 2,
            ]),
        Forms\Components\RichEditor::make('v_package_details')
            ->required()
            ->maxLength(2000)
            ->columnSpan([
                'sm' => 2,
            ]),

        // TinyEditor::make('about')
        // ->fileAttachmentsDisk('public')
        // ->fileAttachmentsVisibility('public')
        // ->fileAttachmentsDirectory('advertisement/topAds/tiny_editor')
        // ->profile('default')
        // ->ltr()
        // ->columnSpan('full')
        // ->required(),


        // TinyEditor::make('service_offered')
        //     ->fileAttachmentsDisk('public')
        //     ->fileAttachmentsVisibility('public')
        //     ->fileAttachmentsDirectory('advertisement/topAds/tiny_editor')
        //     ->profile('default')
        //     ->ltr()
        //     ->columnSpan('full')
        //     ->required(),


        // TinyEditor::make('v_package_details')
        // ->fileAttachmentsDisk('public')
        // ->fileAttachmentsVisibility('public')
        // ->fileAttachmentsDirectory('advertisement/topAds/tiny_editor/')
        // ->profile('default')
        // ->ltr()
        // ->columnSpan('full')
        // ->required(),

        Forms\Components\FileUpload::make('ad_image')
        ->disk('public')
        ->directory('advertisement/normalAds')
        ->required(),

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
        Placeholder::make('Approrval')
            ->disabled()
            ->content(function (?Advertisement $record): string {
                return $record ? $record->approrval_status ?? 'none' : 'none';
            }),
        ]),






    Forms\Components\Section::make('Meta Information')
    ->schema([

            Forms\Components\TextInput::make('meta_title')
               ->maxLength(255),
            Forms\Components\Textarea::make('meta_des')->label('Meta Description')->rows(10),
            Forms\Components\TagsInput::make('meta_tags')
               ->placeholder('Type your Keywords one by one.'),

       ]),



    Fieldset::make('Packages')
       ->hiddenOn('edit')
       ->schema([
           CheckboxList::make('adpacks')
                ->label('Ads Packages')
               ->relationship('adpacks',
                   modifyQueryUsing: fn (Builder $query) => $query->where('v_id', AUTH::id()),
               )
               ->getOptionLabelFromRecordUsing(fn (Model $record) => "{$record->pkg_name}")
               ->bulkToggleable()
               ->searchable()
               ->hiddenOn('edit')
               ->columns(2)
               ->columnSpan('full')
               ->gridDirection('row'),

           // Select::make('adpacks')
           //     // ->relationship(name: 'adpacks', titleAttribute: 'pkg_name')
           //     ->relationship(name: 'adpacks', titleAttribute: 'pkg_name',
           //         modifyQueryUsing: fn (Builder $query) => $query->where('v_id', AUTH::id()),
           //     )
           //     ->searchable(['pkg_name'])
           //     ->multiple(true)
           //     ->preload()
           //     ->createOptionForm([
           //         Forms\Components\TextInput::make('pkg_name')
           //         ->label('Package Name')
           //         ->required()
           //         ->maxLength(255),
           //         Forms\Components\TextInput::make('order')
           //         ->label('Package Order')
           //         ->numeric()
           //         ->minValue(1)
           //         ->required()
           //         ->maxLength(255),
           //     ]),
       ])->columnSpan('full'),




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
                    ->limit(25)
                    ->searchable(),
                Tables\Columns\TextColumn::make('v_bus_location')
                    ->label('Buisness Location'),
                Tables\Columns\TextColumn::make('v_bus_branches')
                    ->label('Branches'),
                Tables\Columns\TextColumn::make('service_offered')
                    ->limit(35),
                Tables\Columns\TextColumn::make('v_package_details')
                    ->label("Package"),
                Tables\Columns\TextColumn::make('category_id'),
                Tables\Columns\TextColumn::make('discount_deal')
                    ->limit(25),
                Tables\Columns\TextColumn::make('start_price'),
            ])
            ->filters([
                SelectFilter::make('category_id')
                ->label('Category')
                ->multiple()
                ->options(VendorCategory::all()->pluck('Category_name', 'id')),
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
            // AdpackagesRelationManager::class,
            RelationManagers\AdpacksRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVendorAdvertisements::route('/'),
            'create' => Pages\CreateVendorAdvertisements::route('/create'),
            'edit' => Pages\EditVendorAdvertisements::route('/{record}/edit'),
            'view' => Pages\ViewVendorAdvertisement::route('/{record}'),
        ];
    }
}
