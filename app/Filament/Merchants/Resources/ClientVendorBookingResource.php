<?php

namespace App\Filament\Merchants\Resources;

use App\Filament\Merchants\Resources\ClientVendorBookingResource\Pages;
use App\Filament\Merchants\Resources\ClientVendorBookingResource\RelationManagers;
use App\Models\ClientVendorBooking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use App\Models\VendorCategory;
use App\Models\Vendor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TagsColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Forms\Components\Select;
use Filament\Tables\Filters\Filter;
use Illuminate\Support\Carbon;

use  App\Filament\Merchants\Resources\ClientVendorBookingResource\Widgets\BookingStats;

class ClientVendorBookingResource extends Resource
{
    protected static ?string $model = ClientVendorBooking::class;

    protected static ?string $navigationGroup = 'Bookings';
    protected static ?string $label = 'Client Bookings';
    protected static ?string $navigationLabel = 'Client Bookings';

    protected static ?string $navigationIcon = 'fas-bookmark';

    public static function getNavigationBadge(): ?string
    {
        $vendorId = Vendor::select('id')->where('user_id', Auth::id())->value('id');
        return static::$model::where('v_id', $vendorId )->where('booking_status', 'pending')->count();
    }

    protected static ?string $advertisementsVendorId = null;



    public static function getEloquentQuery(): Builder
    {
        if (static::$advertisementsVendorId === null) {
            static::$advertisementsVendorId = DB::table('advertisements')
                ->select('actual_v_id')
                ->where('v_id', '=', Auth::id())
                ->value('actual_v_id');
        }

        return static::getModel()::query()->where('v_id', static::$advertisementsVendorId);
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('c_name')
                    ->required()
                    ->maxLength(255)
                    ->disabled(true),
                Forms\Components\TextInput::make('c_email')
                    ->email()
                    ->required()
                    ->disabled(true)
                    ->maxLength(255),
                Forms\Components\TextInput::make('c_tpno')
                    ->required()
                    ->disabled(true)
                    ->maxLength(255),
                Forms\Components\Textarea::make('message')
                    ->disabled(true)
                    ->maxLength(65535),
                Forms\Components\DatePicker::make('event_date')
                    ->disabled(true)
                    ->required(),
                Forms\Components\TextInput::make('event_start_time')
                    ->disabled(true)
                    ->required(),
                Forms\Components\TextInput::make('event_end_time')
                ->disabled(true),
                Select::make('booking_status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Request Approved',
                        'confirmed' => 'Booking Confirmed',
                        'booked' => 'Booked',
                        'rejected' => 'Rejected',
                        'cancelled' => 'Cancel',
                    ])
                    ->disableOptionWhen(fn (string $value): bool => $value === 'booked')
                    ->in(fn (Select $component): array => array_keys($component->getEnabledOptions())),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('index')->rowIndex(),
                Tables\Columns\ImageColumn::make('advertisement.ad_image')->label('Ad Image'),
                Tables\Columns\TextColumn::make('advertisement.ad_title')->label('Ad Title'),
                Tables\Columns\TextColumn::make('event_date')
                    ->date()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('event_start_time'),
                Tables\Columns\TextColumn::make('event_end_time'),
                // Tables\Columns\TextColumn::make('booking_status'),
                Tables\Columns\BadgeColumn::make('booking_status')
                         ->colors([
                             'secondary' => 'approved',
                             'success' => 'confirmed',
                             'warning' => 'pending',
                             'danger' => 'cancelled',
                             'primary' => 'rejected',
                             'success' => 'booked',
                         ]),
                // Tables\Columns\TextColumn::make('c_id'),
                // Tables\Columns\TextColumn::make('ad_id'),
                // Tables\Columns\TextColumn::make('top_ad_id'),
                Tables\Columns\TextColumn::make('v_id'),
                // Tables\Columns\TextColumn::make('top_ad_vid'),
                Tables\Columns\TextColumn::make('c_name'),
                Tables\Columns\TextColumn::make('c_email'),
                Tables\Columns\TextColumn::make('c_tpno'),
                Tables\Columns\TextColumn::make('message'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->filters([
                SelectFilter::make('booking_status') // Enable filtering on the booking_status column
                    ->options([
                        '' => 'All', // Add an option for 'All'
                        'pending' => 'Pending',
                        'approved' => 'Request Approved',
                        'confirmed' => 'Booking Confirmed',
                        'booked' => 'Booked',
                        'rejected' => 'Rejected',
                        'cancelled' => 'Cancel',
                    ]),

                    Filter::make('event_date')
                    ->form([
                        Forms\Components\DatePicker::make('events_start_from'),
                        Forms\Components\DatePicker::make('events_until')->default(now()),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['events_start_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('event_date', '>=', $date),
                            )
                            ->when(
                                $data['events_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('event_date', '<=', $date),
                            );
                    }),
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
            RelationManagers\AdvertistmentRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClientVendorBookings::route('/'),
            'create' => Pages\CreateClientVendorBooking::route('/create'),
            'edit' => Pages\EditClientVendorBooking::route('/{record}/edit'),
        ];
    }


    public static function getWidgets(): array
    {
        return [
            ClientVendorBookingResource\Widgets\BookingCalendar::class,
            BookingStats::class,
        ];
    }


}
