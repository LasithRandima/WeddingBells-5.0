<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingsResource\Pages;
use App\Filament\Resources\BookingsResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


use App\Models\ClientVendorBooking;
use App\Models\Advertisement;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\FileUpload;


use App\Models\VendorCategory;
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
use Illuminate\Support\Carbon;


class BookingsResource extends Resource
{
    protected static ?string $model = ClientVendorBooking::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getEloquentQuery(): Builder
    {
        return static::getModel()::query()->where('booking_status', 'booked');
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
                    'rejected' => 'Rejected',
                    'cancelled' => 'Cancel',
                ])
                ->disablePlaceholderSelection()
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
                    'rejected' => 'Rejected',
                    'cancelled' => 'Cancel',
                ]),

                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_at')
                            ->placeholder(fn ($state): string => 'Dec 18, ' . now()->subYear()->format('Y')),
                        Forms\Components\DatePicker::make('created_until')
                            ->placeholder(fn ($state): string => now()->format('M d, Y')),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'] ?? null,
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'] ?? null,
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['created_from'] ?? null) {
                            $indicators['created_from'] = 'Order from ' . Carbon::parse($data['created_from'])->toFormattedDateString();
                        }
                        if ($data['created_until'] ?? null) {
                            $indicators['created_until'] = 'Order until ' . Carbon::parse($data['created_until'])->toFormattedDateString();
                        }

                        return $indicators;
                    }),
            ])
            ->actions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBookings::route('/create'),
            'edit' => Pages\EditBookings::route('/{record}/edit'),
        ];
    }
}
