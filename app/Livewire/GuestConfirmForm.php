<?php

namespace App\Livewire;
use Filament\Notifications\Notification;

use App\Models\GuestList;

use Filament\Forms;
use Livewire\Component;
use App\Models\VendorCategory;
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
use Filament\Forms\Components\MultiSelect;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;

class GuestConfirmForm extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public $c_id;
    public $g_first_name;
    public $g_last_name;
    public $age;
    public $email;
    public $tp_no;
    public $mobile_no;
    public $address;
    public $invited_to;
    public $ceremony;
    public $evening_reception;
    public $wedding_breakfast;
    public $other;
    public $is_drink;
    public $guest_group;
    public $notes;
    public $guestCompanions;



    public function mount(): void
    {
        $this->form->fill();
    }


    // public static function getFormSchema(): array

    public function form(Form $form): Form
{

    if (Auth::id()) {
        $c_id = DB::table('clients')->select('id')->where('user_id', '=', Auth::id())->value('id');
    }


    $guestId = request()->segment(2);


    return $form
        ->schema([
           Forms\Components\Section::make()
                ->schema([
                    Forms\Components\Grid::make(3)
                        ->schema([

                            Hidden::make('c_id')
                                ->default($guestId),
                            TextInput::make('g_first_name')
                                ->label('First Name')
                                ->required(),
                            TextInput::make('g_last_name')
                                ->label('Last Name'),

                            // Repeater::make('guestCompanions')
                            //     ->relationship()
                            //     ->defaultItems(1)
                            //     ->schema([
                            //         Forms\Components\Grid::make(3)
                            //         ->schema([

                            //         Hidden::make('c_id')
                            //             ->default(Auth::id()),
                            //         TextInput::make('g_first_name')
                            //             ->label('First Name')
                            //             ->required(),
                            //         TextInput::make('g_last_name')
                            //             ->label('Last Name'),
                            //         TextInput::make('email')
                            //             ->email()
                            //             ->label('Email'),
                            //         Select::make('invited_to')
                            //             ->multiple()
                            //             ->options([
                            //                 'ceremony' => 'Ceremony',
                            //                 'evening_reception' => 'Evening Reception',
                            //                 'wedding_breakfast' => 'Wedding Breakfast',
                            //                 'other' => 'other',
                            //             ]),
                            //         ]),
                            //     ])->model(GuestList::class)->columnSpanFull(),


                            Select::make('age')
                                ->options([
                                    'Adult' => 'Adult',
                                    'Child' => 'Child',
                                    'Baby' => 'Baby',
                                ]),
                            TextInput::make('email')
                                ->email()
                                ->label('Email'),
                            TextInput::make('tp_no')
                                ->label('Telephone Number')
                                ->tel(),
                            TextInput::make('mobile_no')
                                ->label('Mobile Number')
                                ->tel(),
                            TextInput::make('address')
                                ->label('Address')
                                ->columnSpan(2),
                            Select::make('invited_to')
                                ->multiple()
                                ->options([
                                    'ceremony' => 'Ceremony',
                                    'evening_reception' => 'Evening Reception',
                                    'wedding_breakfast' => 'Wedding Breakfast',
                                    'other' => 'other',
                                ]),
                        ]),
                    // ]),

            Forms\Components\Section::make()
                ->schema([
                    Forms\Components\Grid::make(3)
                        ->schema([
                            Select::make('ceremony')
                                ->default('Pending')
                                ->options([
                                    'Pending' => 'Pending',
                                    'Accepted' => 'Accept',
                                    'Rejected' => "Reject",
                                ]),
                            Select::make('evening_reception')
                                ->default('Pending')
                                ->options([
                                    'Pending' => 'Pending',
                                    'Accepted' => 'Accept',
                                    'Rejected' => "Reject",
                                ]),
                            Select::make('wedding_breakfast')
                                ->default('Pending')
                                ->options([
                                    'Pending' => 'Pending',
                                    'Accepted' => 'Accept',
                                    'Rejected' => "Reject",
                                ]),
                            Select::make('other')
                                ->default('Pending')
                                ->options([
                                    'Pending' => 'Pending',
                                    'Accepted' => 'Accept',
                                    'Rejected' => "Reject",
                                ]),

                            Toggle::make('is_drink')
                                ->label('Is Drinking Buddy?')
                                ->inline(false)
                                ->onColor('success')
                                ->offColor('gray'),
                        ]),

                    Forms\Components\Grid::make(2)
                        ->schema([
                            Select::make('guest_group')
                                ->options([
                                    'bride_side' => 'Bride Side',
                                    'groom_side' => 'Groom Side',
                                    'bride_side_coworkers' => 'Bride Side Coworkers',
                                    'groom_side_coworkers' => 'Groom Side Coworkers',
                                    'mutual_friends' => 'Mutual Friends',
                                    'bride_friends' => 'Bride Friends',
                                    'groom_friends' => 'Groom Friends',
                                    'bride_family' => 'Bride Family',
                                    'groom_family' => 'Groom Family',
                                ]),

                                Forms\Components\RichEditor::make('notes')
                                ->maxLength(500)
                                ->columnSpanFull(),
                        ]),
                ]),
            ]),
        ]);
}


    // public static function form(Form $form): Form
    // {
    //     if (Auth::id()) {
    //         $c_id = DB::table('clients')->select('id')->where('user_id', '=', Auth::id())->value('id');
    //     }


    //     $guestId = request()->segment(2);

    //     // Alternatively, you can use the route parameter directly
    //     // $guestId = request()->route('id');


    //     return $form[
    //         Forms\Components\Section::make()
    //             ->schema([
    //                 Forms\Components\Grid::make(3)
    //                     ->schema([

    //                         Hidden::make('c_id')
    //                             ->default($guestId),
    //                         TextInput::make('g_first_name')
    //                             ->label('First Name')
    //                             ->required(),
    //                         TextInput::make('g_last_name')
    //                             ->label('Last Name'),

    //                         // Repeater::make('guestCompanions')
    //                         //     ->relationship()
    //                         //     ->defaultItems(1)
    //                         //     ->schema([
    //                         //         Forms\Components\Grid::make(3)
    //                         //         ->schema([

    //                         //         Hidden::make('c_id')
    //                         //             ->default(Auth::id()),
    //                         //         TextInput::make('g_first_name')
    //                         //             ->label('First Name')
    //                         //             ->required(),
    //                         //         TextInput::make('g_last_name')
    //                         //             ->label('Last Name'),
    //                         //         TextInput::make('email')
    //                         //             ->email()
    //                         //             ->label('Email'),
    //                         //         Select::make('invited_to')
    //                         //             ->multiple()
    //                         //             ->options([
    //                         //                 'ceremony' => 'Ceremony',
    //                         //                 'evening_reception' => 'Evening Reception',
    //                         //                 'wedding_breakfast' => 'Wedding Breakfast',
    //                         //                 'other' => 'other',
    //                         //             ]),
    //                         //         ]),
    //                         //     ])->model(GuestList::class)->columnSpanFull(),


    //                         Select::make('age')
    //                             ->options([
    //                                 'Adult' => 'Adult',
    //                                 'Child' => 'Child',
    //                                 'Baby' => 'Baby',
    //                             ]),
    //                         TextInput::make('email')
    //                             ->email()
    //                             ->label('Email'),
    //                         TextInput::make('tp_no')
    //                             ->label('Telephone Number')
    //                             ->tel(),
    //                         TextInput::make('mobile_no')
    //                             ->label('Mobile Number')
    //                             ->tel(),
    //                         TextInput::make('address')
    //                             ->label('Address')
    //                             ->columnSpan(2),
    //                         Select::make('invited_to')
    //                             ->multiple()
    //                             ->options([
    //                                 'ceremony' => 'Ceremony',
    //                                 'evening_reception' => 'Evening Reception',
    //                                 'wedding_breakfast' => 'Wedding Breakfast',
    //                                 'other' => 'other',
    //                             ]),
    //                     ]),
    //                 // ]),

    //         Forms\Components\Section::make()
    //             ->schema([
    //                 Forms\Components\Grid::make(3)
    //                     ->schema([
    //                         Select::make('ceremony')
    //                             ->default('Pending')
    //                             ->options([
    //                                 'Pending' => 'Pending',
    //                                 'Accepted' => 'Accept',
    //                                 'Rejected' => "Reject",
    //                             ]),
    //                         Select::make('evening_reception')
    //                             ->default('Pending')
    //                             ->options([
    //                                 'Pending' => 'Pending',
    //                                 'Accepted' => 'Accept',
    //                                 'Rejected' => "Reject",
    //                             ]),
    //                         Select::make('wedding_breakfast')
    //                             ->default('Pending')
    //                             ->options([
    //                                 'Pending' => 'Pending',
    //                                 'Accepted' => 'Accept',
    //                                 'Rejected' => "Reject",
    //                             ]),
    //                         Select::make('other')
    //                             ->default('Pending')
    //                             ->options([
    //                                 'Pending' => 'Pending',
    //                                 'Accepted' => 'Accept',
    //                                 'Rejected' => "Reject",
    //                             ]),

    //                         Toggle::make('is_drink')
    //                             ->label('Is Drinking Buddy?')
    //                             ->inline(false)
    //                             ->onColor('success')
    //                             ->offColor('gray'),
    //                     ]),

    //                 Forms\Components\Grid::make(2)
    //                     ->schema([
    //                         Select::make('group')
    //                             ->options([
    //                                 'bride_side' => 'Bride Side',
    //                                 'groom_side' => 'Groom Side',
    //                                 'bride_side_coworkers' => 'Bride Side Coworkers',
    //                                 'groom_side_coworkers' => 'Groom Side Coworkers',
    //                                 'mutual_friends' => 'Mutual Friends',
    //                                 'bride_friends' => 'Bride Friends',
    //                                 'groom_friends' => 'Groom Friends',
    //                                 'bride_family' => 'Bride Family',
    //                                 'groom_family' => 'Groom Family',
    //                             ]),

    //                             Forms\Components\RichEditor::make('notes')
    //                             ->maxLength(500)
    //                             ->columnSpanFull(),
    //                     ]),
    //             ]),



    //         ])

    //     ];


    // }



    // public function submit()
    // {

    //         Notification::make()
    //         ->title('Your information saved successfully')
    //         ->success()
    //         ->send();
    //         GuestList::create($this->form->getState());

    //         // return redirect()->route('dashboard')->with('message','Vendor registered successfully');

    //         return redirect()->route('sitePackages.index')->with('message','Vendor registered successfully');




    // }

    public function create(): void
    {

        Notification::make()
                ->title('Your information saved successfully')
                ->success()
                ->send();
         GuestList::create($this->form->getState());
    }


    public function render()
    {
        return view('livewire.guest-confirm-form');
    }
}
