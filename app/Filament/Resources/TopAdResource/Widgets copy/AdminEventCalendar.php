<?php

namespace App\Filament\Resources\ClientEventPlannerResource\Widgets;

use Illuminate\Database\Eloquent\Model;
use Filament\Forms;
use Filament\Widgets\Widget;
use Illuminate\Http\Request;
use App\Models\ClientEventPlanner;
use Doctrine\DBAL\Schema\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Hidden;
use Saade\FilamentFullCalendar\Data\EventData; // Import the EventData class
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;
use App\Filament\Resources\ClientEventPlannerResource;
use Saade\FilamentFullCalendar\Actions;
use Filament\Actions\Action;

class AdminEventCalendar extends FullCalendarWidget
{
    // protected static string $view = 'filament.merchants.resources.client-vendor-booking-resource.widgets.booking-calendar';


    public Model | string | null $model = ClientEventPlanner::class;

    public function fetchEvents(array $fetchInfo): array
    {



        if (Auth::user()->role_id == 2) {
            $bookings = ClientEventPlanner::all();
        }
        if (Auth::user()->role_id == 1) {
            $bookings = ClientEventPlanner::all();
        }

        return $bookings->map(function ($booking) {
            $title = $booking->event_title;

            // Concatenate message if it exists
            if ($booking->event_desc) {
                $title .= ' - ' . $booking->event_desc;
            }

            return [
                'id' => $booking->id,
                'title' => $title,
                'start' => $booking->event_start_date,
                'end' => $booking->event_end_date,
            ];
        })->toArray();
    }

    protected function viewAction(): Action
    {

        return Actions\ViewAction::make()
            ->record($this->post)
            ->form([
                Forms\Components\Select::make('c_id')
                ->relationship(name: 'client', titleAttribute: 'c_name')
                ->searchable()
                ->preload()
                ->label('Booking Status'),
            ]);
    }

    // protected function headerActions(): array
    // {
    //     return [
    //         Actions\CreateAction::make(),
    //         Action::make('filter')
    //         ->form([
    //             // Forms\Components\Select::make('c_id')
    //             // ->relationship(name: 'user', titleAttribute: 'c_name')
    //             // ->required()
    //             // ->searchable()
    //             // ->preload()
    //             // ->label('Client Name'),
    //             Forms\Components\TextInput::make('c_id')->required(),
    //         ])
    //         ->action(function (array $data,  array $fetchInfo) {
    //             $bookings = ClientEventPlanner::where('c_id', $data['c_id'])->get();

    //             return $bookings->map(function ($booking) {
    //                 $title = $booking->event_title;

    //                 // Concatenate message if it exists
    //                 if ($booking->event_desc) {
    //                     $title .= ' - ' . $booking->event_desc;
    //                 }

    //                 return [
    //                     'id' => $booking->id,
    //                     'title' => $title,
    //                     'start' => $booking->event_start_date,
    //                     'end' => $booking->event_end_date,
    //                 ];
    //             })->toArray();
    //             }),
    //     ];
    // }



    protected function headerActions(): array
{
    return [
        Actions\CreateAction::make(),
        Action::make('filter')
            ->form([
                Forms\Components\TextInput::make('c_id')->required(),
            ])
            ->action(function (array $data) {
                
                $bookings = ClientEventPlanner::where('c_id', $data['c_id'])->get();

                $filteredEvents = $bookings->map(function ($booking) {
                    $title = $booking->event_title;

                    if ($booking->event_desc) {
                        $title .= ' - ' . $booking->event_desc;
                    }

                    return [
                        'id' => $booking->id,
                        'title' => $title,
                        'start' => $booking->event_start_date,
                        'end' => $booking->event_end_date,
                    ];
                })->toArray();

                // dd($filteredEvents);

                // Include $fetchInfo in the result
                return [
                    'events' => $filteredEvents,
                    'fetchInfo' => $filteredEvents,
                ];
            }),
    ];
}




    protected function modalActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
            Actions\ViewAction::make()
            ->form([
                Forms\Components\Select::make('c_id')
                ->relationship(name: 'client', titleAttribute: 'c_name')
                ->searchable()
                ->preload()
                ->label('Client Name'),
            ]),
        ];
    }


    public function getFormSchema(): array
    {
        return [
            Forms\Components\Select::make('c_id')
            ->relationship(name: 'client', titleAttribute: 'c_name')
            ->searchable()
            ->preload()
            ->label('Client Name'),
        ];
    }





}
