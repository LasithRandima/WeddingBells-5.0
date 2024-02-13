<?php

namespace App\Filament\Merchants\Resources;

use App\Filament\Merchants\Resources\AdsPackageResource\Pages;
use App\Filament\Merchants\Resources\AdsPackageResource\RelationManagers;
use App\Models\Adpackage;
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
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Filters\SelectFilter;
use App\Models\Advertisement;
use Filament\Forms\Components\Fieldset;
use Filament\Actions\CreateAction;
use Filament\Forms\Set;

class AdsPackageResource extends Resource
{
    protected static ?string $model = Adpackage::class;
    protected static ?string $navigationGroup = 'Advertistments';
    protected static ?string $label = 'Ads Pacakages';
    protected static ?string $navigationLabel = 'Ads Pacakages';

    protected static ?string $navigationIcon = 'fas-table-cells-large';

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
                Hidden::make('v_bus_name')
                ->default(DB::table('vendors')
                ->select('v_bus_name')
                ->where('user_id', '=', Auth::id())
                ->value('v_bus_name')),
                Hidden::make('actual_v_id')
                ->default(DB::table('vendors')
                ->select('id')
                ->where('user_id', '=', Auth::id())
                ->value('id')),



                // Fieldset::make('Advertisement')
                // ->relationship('advertise')
                // ->schema([
                    // Forms\Components\Select::make('ad_id')
                    // ->label('Ad Id')
                    // ->options(Advertisement::where('v_id', Auth::id())->get()->pluck('ad_title', 'id')->toArray())
                    // ->reactive()
                    // ->afterStateUpdated(fn (callable $set) => $set('ad_title', null))
                    // ->searchable()
                    // ->required(),

                    // Forms\Components\Select::make('ad_title')
                    // ->label('Ad Title')
                    // ->options(function(callable $get) {
                    //     $ads_id = Advertisement::where('id', $get('ad_id'))->get();

                    //     if(! $ads_id) {
                    //         return Advertisement::where('v_id', Auth::id())->get()->pluck('ad_title', 'id');
                    //     }

                    //     return $ads_id->pluck('ad_title', 'ad_title');

                    // })
                    // ->searchable()
                    // ->required(),
                    // ]),


                    // Forms\Components\Select::make('ad_id')
                    // ->label('Advertisement')
                    // ->options(Advertisement::where('v_id', Auth::id())->get()->pluck('ad_title', 'id')->toArray())
                    // ->live()
                    // ->afterStateUpdated(function (Set $set, $state) {
                    //     $set('ad_title', Advertisement::select('ad_title')->where('id', $state)->value('ad_title'));
                    // })
                    // ->searchable()
                    // ->required(),

                    // Forms\Components\Hidden::make('ads_title'),
                    // ]),

                    Fieldset::make('Packages')
                    // ->relationship('advertise')
                    ->schema([

                    Forms\Components\TextInput::make('pkg_name')
                    ->label('Package Name')
                    ->required()
                    ->maxLength(255),
                    Forms\Components\TextInput::make('price')
                        ->label('Package Price')
                        ->numeric()
                        ->minValue(1)
                        ->required(),
                    Forms\Components\MarkdownEditor::make('pkg_description')
                        ->label('Package Description')
                        ->required()
                        ->maxLength(3000)
                        ->columnSpan([
                            'sm' => 2,
                    ]),
                ]),



            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Tables\Columns\TextColumn::make('ads_title')
                // ->limit(25)
                // ->label('Ad Title'),
                Tables\Columns\TextColumn::make('pkg_name')
                ->label('Package Name'),
                Tables\Columns\TextColumn::make('price')
                ->label('Package Price'),
                Tables\Columns\TextColumn::make('pkg_description')
                ->limit(25)
                ->label('Package Description'),
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
            'index' => Pages\ListAdsPackages::route('/'),
            'create' => Pages\CreateAdsPackage::route('/create'),
            'edit' => Pages\EditAdsPackage::route('/{record}/edit'),
        ];
    }
}
