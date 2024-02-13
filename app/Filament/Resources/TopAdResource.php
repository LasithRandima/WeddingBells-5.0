<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TopAdResource\Pages;
use App\Filament\Resources\TopAdResource\RelationManagers;
use App\Models\TopAd;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TagsColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\SpatieTagsEntry;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Columns\Summarizers\Count;
use App\Filament\Resources\TopAdResource\Widgets\TopAdvertisementStats;

use App\Models\Advertisement;
use App\Models\VendorCategory;
use Filament\Infolists\Components;
use Filament\Infolists\Infolist;
use Filament\Notifications\Notification;
use Illuminate\Support\Str;
use Filament\Support\Enums\FontWeight;
use function Livewire\wrap;


// use FilamentTiptapEditor\TiptapEditor;
// use FilamentTiptapEditor\Enums\TiptapOutput;
use AmidEsfahani\FilamentTinyEditor\TinyEditor;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Support\Htmlable;
use Filament\GlobalSearch\Actions\Action;



class TopAdResource extends Resource
{
    protected static ?string $model = Advertisement::class;

    protected static ?string $navigationIcon = 'fas-pager';

    // protected static ?string $navigationGroup = 'Admin Dashboard';
    protected static ?string $navigationGroup = 'Advertistments';
    protected static ?string $label = 'Top Advertisement';
    protected static ?string $navigationLabel = 'Top Advertisement';
    // public static ?string $slug = 'topads';

    // protected static ?string $navigationIcon = 'heroicon-o-collection';
    public $v_category;
    public $buisness_branches;

    public static function getNavigationBadge(): ?string
    {
        return static::$model::where('ad_type', 1)->where('approrval_status', 'pending_approval')->count();
    }


    public static function getEloquentQuery(): Builder
    {
        return static::getModel()::query()->where('ad_type', 1);
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
        return TopAdResource::getUrl('edit', ['record' => $record]);
    }


    // --------------------------End of Global Search methods-------------------------------------------





    public static function form(Form $form): Form
    {
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
                                Forms\Components\TextInput::make('ad_title')
                                    ->required()
                                    ->maxLength(255)
                                    ->columnSpan([
                                        'sm' => 2,
                                ]),

                                // Forms\Components\RichEditor::make('about')
                                //     ->required()
                                //     ->maxLength(3000)
                                //     ->columnSpan([
                                //         'sm' => 2,
                                //     ]),

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
                                        Hidden::make('ad_type')
                                            ->default(1),
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
                                        ]),
                                    ])->columnSpan(['lg' => 1]),


                                    Forms\Components\Section::make('Images')
                                    ->schema([
                                    //     Forms\Components\FileUpload::make('ad_image')
                                    //     ->disk('public')
                                    //     ->directory('advertisement/topAds/ads'),

                                    // Forms\Components\FileUpload::make('logo_image')
                                    //     ->disk('public')
                                    //     ->directory('advertisement/topAds/logos'),

                                    Forms\Components\FileUpload::make('ad_image')
                                    ->disk('public')
                                    ->directory('advertisement/topAds/ads')
                                    ->image()
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
                                    ->image()
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
                // Tables\Columns\TextColumn::make('service_offered')
                //     ->markdown()
                //     ->limit(35),
                // Tables\Columns\TextColumn::make('v_package_details')
                //     ->markdown()
                //     ->limit(25)
                //     ->label("Package"),s
                Tables\Columns\TextColumn::make('category_id'),
                Tables\Columns\SelectColumn::make('category_id')
                    ->label('Category Name')
                    ->options(VendorCategory::all()->pluck('Category_name', 'id'))
                    ->selectablePlaceholder(false)
                    ->disabled(),
                Tables\Columns\TextColumn::make('discount_deal')
                    ->limit(25),
                Tables\Columns\TextColumn::make('start_price'),
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
                                        Components\ImageEntry::make('logo_image')
                                        ->label('Logo')
                                        ->height(40)
                                        ->square(),
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
            TopAdvertisementStats::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTopAds::route('/'),
            'create' => Pages\CreateTopAd::route('/create'),
            'edit' => Pages\EditTopAd::route('/{record}/edit'),
            'view' => Pages\ViewTopAd::route('/{record}'),
        ];
    }
}
