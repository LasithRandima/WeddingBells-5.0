<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VendorResource\Pages;
use App\Filament\Resources\VendorResource\RelationManagers;
use App\Models\Vendor;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use App\Models\VendorCategory;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\MarkdownEditor;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Support\Htmlable;
use Filament\GlobalSearch\Actions\Action;

class VendorResource extends Resource
{
    protected static ?string $model = Vendor::class;

    protected static ?string $label = 'Vendors';
    protected static ?string $navigationLabel = 'Vendors';

    protected static ?string $navigationIcon = 'fas-users-between-lines';

    protected static ?string $navigationGroup = 'Profiles';
    protected static ?string $navigationParentItem = 'Users';

        // -------------------Global Search methods-------------------------------------------

        protected static ?string $recordTitleAttribute = 'Vendor';

        // public static function getGlobalSearchResultTitle(Model $record): string | Htmlable
        // {
        //     return $record->ad_title;
        // }

        public static function getGloballySearchableAttributes(): array
        {
            return ['v_name', 'v_website_url', 'v_email'];
        }


        public static function getGlobalSearchResultDetails(Model $record): array
        {
            return [
                'Vendor' => $record->v_name,
                'Email' => $record->v_email,
            ];
        }


        public static function getGlobalSearchResultUrl(Model $record): string
        {
            return VendorResource::getUrl('edit', ['record' => $record]);
        }


        // --------------------------End of Global Search methods-------------------------------------------

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Hidden::make('user_id')
                ->default(Auth::id())
                ->disabled(),

                TextInput::make('v_name')
                        ->default(Auth::user()->name)
                        ->helperText('Your full name here, including any middle names.')
                        ->label('Personal Name')
                        ->required(),
                    TextInput::make('v_email')
                        ->default(Auth::user()->email)
                        ->email()
                        ->label('Business Email')
                        ->unique()
                        ->required()
                        ->email(),
                    TextInput::make('v_bus_name')
                        ->label('Business Name')
                        ->placeholder('Your full name here, including any middle names.')
                        ->required(),
                    TextInput::make('v_bus_location')
                        ->label('Business Location')
                        ->placeholder('Business Location')
                        ->required(),
                    MarkdownEditor::make('v-description')
                        ->label("Business Description")
                        ->placeholder("Business Description")
                        ->required()
                        ->columnSpan([
                            'sm' => 2,
                    ]),

                    Select::make('v_category')
                        ->label('Business Catagory')
                        // ->relationship('v_category', 'Category_name')
                        ->multiple()
                        ->options(VendorCategory::all()->pluck('Category_name', 'Category_name'))
                        // ->preload()
                        ->searchable()
                        ->required(),


                    TagsInput::make('v_bus_branches')
                        ->label('Business Branches')
                        ->placeholder('Type your Branches one by one'),


                    TextInput::make('v_website_url')
                        ->label('Website URL')
                        ->url()
                        // ->prefixIcon('heroicon-s-external-link')
                        ->prefix('https://')
                        ->placeholder('Your website URL')
                        ->columnSpan([
                            'sm' => 2,
                            ]),
                    TextInput::make('map')
                        ->placeholder('Google Map URL')
                        ->columnSpan([
                            'sm' => 2,
                            ]),
                    Repeater::make('v_phone')
                        ->label('Contact Numbers')
                        ->schema([
                        TextInput::make('v_phone')
                        ->label('Contact Number')
                        ->tel()
                        ->required(),
                    ])
                        ->minItems(1)
                        ->maxItems(3)
                        ->collapsible()
                        ->cloneable()
                        ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('v_bus_name')
                    ->label('Buisness Name'),
                Tables\Columns\TagsColumn::make('v_category')
                    ->label('Catagory'),
                Tables\Columns\TextColumn::make('v_name')
                    ->label('Vendor Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('v_email')
                    ->label('Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('v-description')
                    ->label('Description'),
                Tables\Columns\TextColumn::make('v_bus_location')
                    ->label('Buisness Location'),
                Tables\Columns\TagsColumn::make('v_bus_branches')
                    ->label('Branches'),
                Tables\Columns\TextColumn::make('v_website_url')
                    ->label('Website URL'),
                // Tables\Columns\TagsColumn::make('v_phone'),
                Tables\Columns\TextColumn::make('map'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
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
            'index' => Pages\ListVendors::route('/'),
            'create' => Pages\CreateVendor::route('/create'),
            'edit' => Pages\EditVendor::route('/{record}/edit'),
        ];
    }
}
