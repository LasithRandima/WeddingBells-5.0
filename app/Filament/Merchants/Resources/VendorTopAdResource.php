<?php

namespace App\Filament\Merchants\Resources;

use App\Filament\Merchants\Resources\VendorTopAdResource\Pages;
use App\Filament\Merchants\Resources\VendorTopAdResource\RelationManagers;
use App\Models\Advertisement;
use Filament\Forms;
use Filament\Forms\Get;
use Filament\Forms\Set;
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
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Tabs;



use Filament\Infolists\Components;
use Filament\Infolists\Infolist;
use Filament\Notifications\Notification;
use Illuminate\Support\Str;
use Filament\Support\Enums\FontWeight;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\SpatieTagsEntry;
use Filament\Infolists\Components\Section;
use Filament\Forms\Components\Fieldset;

use Icetalker\FilamentTableRepeater\Forms\Components\TableRepeater;
use AmidEsfahani\FilamentTinyEditor\TinyEditor;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Support\Htmlable;
use Filament\GlobalSearch\Actions\Action;


// var_dump($lastrecord);

class VendorTopAdResource extends Resource
{

    protected static ?string $model = Advertisement::class;

    protected static ?string $navigationIcon = 'fas-pager';

    protected static ?string $navigationGroup = 'Advertistments';
    protected static ?string $label = 'Top Advertisement';
    protected static ?string $navigationLabel = 'Top Advertisement';
    // public static ?string $slug = 'topadsnew';
    // protected static ?string $navigationIcon = 'heroicon-o-collection';
    public $v_category;
    public $buisness_branches;



    public static function getEloquentQuery(): Builder
    {
        return static::getModel()::query()->where('v_id', Auth::id())->where('ad_type', 1);
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
            return VendorTopAdResource::getUrl('edit', ['record' => $record]);
        }


        // --------------------------End of Global Search methods-------------------------------------------


    public static function form(Form $form): Form
    {
        $lastrecord = Advertisement::latest()->get();
        return $form
            ->schema([
                Forms\Components\Group::make()
                ->schema([
                    Forms\Components\Section::make()
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
                                    ->label('Title')
                                    // ->live(onBlur: true)
                                    // ->afterStateUpdated(fn (Set $set, ?string $state) => $set('ad_title', $state))
                                    // ->afterStateUpdated(fn (Get $get) =>  $ads_topics = $get('ad_title'))
                                    // ->live(debounce: 500)
                                    ->required()
                                    ->maxLength(255)
                                    ->columnSpan([
                                        'sm' => 2,
                                ]),



                                TinyEditor::make('about')
                                    ->fileAttachmentsDisk('public')
                                    ->fileAttachmentsVisibility('public')
                                    ->fileAttachmentsDirectory('advertisement/topAds/tiny_editor')
                                    ->profile('default')
                                    ->ltr()
                                    ->columnSpan('full')
                                    ->required(),


                                TinyEditor::make('service_offered')
                                    ->fileAttachmentsDisk('public')
                                    ->fileAttachmentsVisibility('public')
                                    ->fileAttachmentsDirectory('advertisement/topAds/tiny_editor')
                                    ->profile('default')
                                    ->ltr()
                                    ->columnSpan('full')
                                    ->required(),


                                TinyEditor::make('v_package_details')
                                    ->fileAttachmentsDisk('public')
                                    ->fileAttachmentsVisibility('public')
                                    ->fileAttachmentsDirectory('advertisement/topAds/tiny_editor/')
                                    ->profile('default')
                                    ->ltr()
                                    ->columnSpan('full')
                                    ->required(),

                            ]),

                        ])
                         ->columnSpan(['lg' => 2]),




                         Forms\Components\Group::make()
                         ->schema([
                             Forms\Components\Section::make('Other Information')
                             ->schema([
                                    Forms\Components\Select::make('category_id')
                                        ->label('Ad Category')
                                        // ->multiple()
                                        ->options(VendorCategory::all()->pluck('Category_name', 'id'))
                                        ->searchable()
                                        ->required(),
                                    Forms\Components\TextInput::make('discount_deal')
                                        ->label('Discount')
                                        ->maxLength(255),
                                    Forms\Components\TextInput::make('start_price')
                                        ->label('Start Price')
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
                                    Hidden::make('ad_type')
                                        ->default(1),
                                ]),

                                Forms\Components\Section::make('Meta Information')
                                ->schema([

                                        Forms\Components\TextInput::make('meta_title')
                                           ->maxLength(255),
                                        Forms\Components\Textarea::make('meta_des')->label('Meta Description')->rows(10),
                                        Forms\Components\TagsInput::make('meta_tags')
                                           ->placeholder('Type your Keywords one by one.'),

                                   ]),
                            ])->columnSpan(['lg' => 1]),


                        Forms\Components\Section::make('Images')
                        ->schema([
                            Forms\Components\FileUpload::make('ad_image')
                                ->disk('public')
                                ->directory('advertisement/topAds/ads')
                                // ->image()
                                ->imageEditor()
                                ->imageEditorAspectRatios([
                                    null,
                                    '16:9',
                                    '4:3',
                                    '1:1',
                                ])
                                ->openable()
                                ->downloadable()
                                ->optimize('webp')
                                ->resize(50)
                                ->required(),

                            Forms\Components\FileUpload::make('logo_image')
                                ->disk('public')
                                ->directory('advertisement/topAds/logos')
                                // ->image()
                                ->imageEditor()
                                ->imageEditorAspectRatios([
                                    null,
                                    '16:9',
                                    '4:3',
                                    '1:1',
                                ])
                                ->openable()
                                ->downloadable()
                                ->optimize('webp'),


                            ])->columns(2)->collapsible(),


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


                            ])->columnSpan('full'),



                            //Some Form Elements
                            // TableRepeater::make('adpackages')
                    //         Repeater::make('adpackages')
                    //         ->relationship('adpackages')
                    //         ->schema([
                    //             Hidden::make('v_id')->default(Auth::id()),
                    //             Hidden::make('ad_id')->default($lastrecord->pluck('id')->first() + 1),

                    //             // TextInput::make('ad_title')
                    //             // ->label('Advertistment Title')
                    //             // ->required(),
                    //             // Hidden::make('ad_title')->default($lastrecord->pluck('id')->first() + 1),
                    //             // TextInput::make('ad_topic')
                    //             // ->label('Advertistment Title')
                    //             // ->default(fn (Get $get): string => $get('ad_title') ?? '1')
                    //             // ->live()
                    //             // ->required(),
                    //                 // ->required(fn (Get $get): bool => filled($get('ad_title')))
                    //                 // ->default(fn (Get $get): string => $get('ad_title'))
                    //                 // ->live(),

                    //             Hidden::make('v_bus_name')->default(DB::table('vendors')
                    //                 ->select('v_bus_name')
                    //                 ->where('user_id', '=', Auth::id())
                    //                 ->value('v_bus_name')),
                    //             Hidden::make('actual_v_id')->default(DB::table('vendors')
                    //                 ->select('id')
                    //                 ->where('user_id', '=', Auth::id())
                    //                 ->value('id')),


                    //             Forms\Components\TextInput::make('pkg_name')
                    //                 ->label('Package Name')
                    //                 ->required()
                    //                 ->maxLength(255),
                    //             Forms\Components\TextInput::make('price')
                    //                 ->label('Package Price')
                    //                 ->numeric()
                    //                 ->minValue(1)
                    //                 ->required(),
                    //             Forms\Components\MarkdownEditor::make('pkg_description')
                    //                 ->label('Package Description')
                    //                 ->required()
                    //                 ->maxLength(3000)
                    //                 ->columnSpan('full'),
                    //         ])
                    //         ->reorderable()
                    //         ->cloneable()
                    //         ->collapsible()
                    //         ->columnSpan('full')



                    ])
                    ->columns(3);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('index')->rowIndex(),
                Tables\Columns\ImageColumn::make('ad_image')->disk('public'),
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
                    ->markdown()
                    ->limit(35),
                Tables\Columns\TextColumn::make('v_package_details')
                    ->markdown()
                    ->limit(35)
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
            RelationManagers\AdpacksRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVendorTopAds::route('/'),
            'create' => Pages\CreateVendorTopAd::route('/create'),
            'edit' => Pages\EditVendorTopAd::route('/{record}/edit'),
            'view' => Pages\ViewVendorTopAd::route('/{record}'),
        ];
    }




    // public function mount(): void
    // {
    //     abort_unless(auth()->user()->canManageSettings(), 403);
    // }






}
