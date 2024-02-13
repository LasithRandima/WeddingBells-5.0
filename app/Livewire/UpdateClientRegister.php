<?php

namespace App\Livewire;

use Livewire\Component;

use Filament\Notifications\Notification;

use Filament\Forms;
use App\Models\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\Card;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\MarkdownEditor;
use HusamTariq\FilamentTimePicker\Forms\Components\TimePickerField;

class UpdateClientRegister extends Component implements Forms\Contracts\HasForms
{

    use Forms\Concerns\InteractsWithForms;

    public $c_name;
    public $user_id;
    public $C_email;
    public $gender;
    public $partner_name;
    public $partner_email;
    public $c_location;
    public $c_tpno;
    public $guest_count;
    public $wed_date;
    public $wed_start_time;
    public $wed_end_time;

    // $clientuser = DB::select("select * from users where id = ?", Auth::id());

    public function mount(): void
    {
        // $this->form->fill();

        $this->form->fill([
            'user_id' => Auth::user()->id,
            'c_name' => Client::where('user_id', Auth::user()->id)->first()->c_name,
            'C_email' => Client::where('user_id', Auth::user()->id)->first()->c_email,
            'gender' => Client::where('user_id', Auth::user()->id)->first()->gender,
            'partner_name' => Client::where('user_id', Auth::user()->id)->first()->partner_name,
            'partner_email' => Client::where('user_id', Auth::user()->id)->first()->partner_email,
            'c_location' => Client::where('user_id', Auth::user()->id)->first()->c_location,
            'c_tpno' => Client::where('user_id', Auth::user()->id)->first()->c_tpno,
            'guest_count' => Client::where('user_id', Auth::user()->id)->first()->guest_count,
            'wed_date' => Client::where('user_id', Auth::user()->id)->first()->wed_date,
            'wed_start_time' => Client::where('user_id', Auth::user()->id)->first()->wed_start_time,
            'wed_end_time' => Client::where('user_id', Auth::user()->id)->first()->wed_end_time,
        ]);
    }

    protected function getFormSchema(): array
    {
        // $clientuser = DB::select("select * from users where id = ?", Auth::id());
    return [
        Wizard::make()
            ->schema([
                Step::make('Details')
                ->icon('heroicon-o-identification')
                ->description('Tell Us About You')
                ->schema([
                    // Hidden::make('id')
                    // ->default(Auth::id())
                    // ->disabled(),
                    Hidden::make('user_id')
                        ->default(Auth::id()),
                    TextInput::make('c_name')
                        ->default(Auth::user()->name)
                        ->helperText('Your full name here, including any middle names.')
                        ->label('Full Name')
                        ->required(),
                    TextInput::make('C_email')
                        ->default(Auth::user()->email)
                        ->email()
                        ->label('Email')
                        ->unique()
                        ->required()
                        ->email(),
                    Select::make('gender')
                        ->options([
                            'male' => 'Male',
                            'female' => 'Female',
                        ]),
                    TextInput::make('partner_name')
                        ->required()
                        ->label('Partner Name')
                        ->placeholder('Partner full name here, including any middle names.'),
                    TextInput::make('partner_email')
                        ->email()
                        ->label('Partner Email')
                        ->placeholder('Partner Email'),

                  TextInput::make('c_location')

                        ->required()
                        ->label('Address')
                        ->placeholder('Home Address')
                        ->columnSpan([
                            'sm' => 2,
                            ]),
                    Repeater::make('c_tpno')
                        ->label('Contact Numbers')
                        ->schema([
                        TextInput::make('c_tpno')
                        ->label('Contact Number')
                        ->tel()
                        ->telRegex('/^(\+94|0)\s?(7\d{2}|[1-9]\d{1,2})\s?\d{3}\s?\d{4}$/')
                        ->placeholder('e.g., +94701234567 or 0701234567')
                    ])
                        ->minItems(1)
                        ->maxItems(3)
                        ->collapsible()
                        ->cloneable()
                        ->required()
                        ->columnSpan([
                        'sm' => 2,
                        ]),


                ]),

                    Step::make('Wedding details')
                    ->icon('heroicon-o-globe-alt')
                    ->description('Where We Can Find You')

                    ->schema([
                        TextInput::make('guest_count')
                        ->numeric()
                        ->minValue(1)
                        ->placeholder('Guest Count'),
                        DatePicker::make('wed_date')
                            ->label('Wedding Date')
                            ->minDate(now())
                            ->weekStartsOnMonday(),

                        TimePicker::make('wed_start_time')
                            ->label('Wedding Start Time'),

                        // TimePickerField::make('wed_start_time')->label('Wedding Start Time')->okLabel("Confirm")->cancelLabel("Cancel"),
                        TimePicker::make('wed_end_time')
                            ->label('Wedding End Time'),

                        ]),



                ])

                ->columns([
                    'sm' => 2,
                ])
                ->submitAction(new HtmlString('<button type="submit" style=" background-color: #7f53ac;
                background-image: linear-gradient(315deg, #7f53ac 0%, #647dee 74%);
                color: rgb(255, 255, 255);
                outline: none;
                border: none;
                font-size: 16px;
                font-weight: 700;
                padding: 0.6em 0;
                width: 5em;
                border-radius: 12px;
                cursor: pointer;
                transition: all 0.9s ease-in-out;">Update</button>')),
    ];
    }

    // public function submit(): void
    // {
    //     Notification::make()
    //     ->title('Registration successfully')
    //     ->success()
    //     ->send();
    //     Client::create($this->form->getState());
    // }

    public function submit()
    {


            $client = Client::where('user_id', Auth::user()->id)->first();

            if ($client) {
                $client->update($this->form->getState());

                Notification::make()
                    ->title('Registration information updated successfully')
                    ->success()
                    ->send();

                    return redirect()->route('dashboard')->with('message','Registration information updated successfully');
            } else {
                // Handle the case where no Vendor record exists
            }


    }

    // public function create(): void
    // {
    //     Vendor::create($this->form->getState());
    // }



    public function render()
    {
        return view('livewire.update-client-register');
    }
}




