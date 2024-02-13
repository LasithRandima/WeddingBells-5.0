<?php

namespace App\Livewire;

use App\Models\GuestCompanion;
use Livewire\Component;
use Filament\Notifications\Notification;

use App\Models\GuestConfirm;
use App\Models\GuestList;
use Filament\Forms;
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


class GuestAttendanceConfirm extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

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
                            Select::make('guest_id')
                                ->label('Author')
                                ->options(GuestList::all()->pluck('g_first_name'. ' g_last_name', 'id'))
                                ->searchable(),

                            Select::make('companion_id')
                                ->label('Author')
                                ->options(GuestCompanion::all()->pluck('g_first_name'. ' g_last_name', 'id'))
                                ->searchable(),
                            // Hidden::make('guest_id')
                            //     ->default($guestId),
                            TextInput::make('g_first_name')
                                ->label('First Name')
                                ->required(),
                            TextInput::make('g_last_name')
                                ->label('Last Name'),




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
                            Select::make('group')
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
        return view('livewire.guest-attendance-confirm');
    }
}
