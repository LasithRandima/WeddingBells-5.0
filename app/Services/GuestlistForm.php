<?php

namespace App\Services;

use App\Models\GuestList;

use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;
use Livewire\Component;
use Filament\Tables;
use Filament\Forms;
use Filament\Forms\Components\CheckboxList;
use Filament\Tables\Actions;

use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\DB;



final class GuestlistForm extends Component implements HasTable, HasForms
{
    use InteractsWithTable, InteractsWithForms;

    // public GuestList $guestList;

    public static function schema(): array
    {
        if (Auth::id()) {
            $c_id = DB::table('clients')->select('id')->where('user_id', '=', Auth::id())->value('id');
        }




        return [

            Forms\Components\Section::make()
                ->schema([
                    Forms\Components\Grid::make(3)
                        ->schema([
                            Hidden::make('c_id')
                                ->default(Auth::id()),
                            TextInput::make('g_first_name')
                                ->label('First Name')
                                ->required(),
                            TextInput::make('g_last_name')
                                ->label('Last Name'),

                            Repeater::make('guestCompanions')
                                ->relationship()
                                // ->model(GuestList::class)
                                ->defaultItems(1)
                                ->schema([
                                    Forms\Components\Grid::make(3)
                                    ->schema([

                                    Hidden::make('c_id')
                                        ->default(Auth::id()),
                                    Hidden::make('is_companion')
                                        ->default(1),
                                    TextInput::make('g_first_name')
                                        ->label('First Name')
                                        ->required(),
                                    TextInput::make('g_last_name')
                                        ->label('Last Name'),
                                    TextInput::make('email')
                                        ->email()
                                        ->label('Email'),
                                    Select::make('invited_to')
                                        ->multiple()
                                        ->options([
                                            'ceremony' => 'Ceremony',
                                            'evening_reception' => 'Evening Reception',
                                            'wedding_breakfast' => 'Wedding Breakfast',
                                            'other' => 'other',
                                        ]),
                                    ]),
                                ])->columnSpanFull(),
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
                ]),

            Forms\Components\Section::make()
                ->schema([
                    Forms\Components\Grid::make(3)
                        ->schema([
                            Select::make('ceremony')
                                ->default('Pending')
                                ->options([
                                    'Pending' => 'Pending',
                                    'Accept' => 'Accept',
                                    'Reject' => "Reject",
                                ]),
                            Select::make('evening_reception')
                                ->default('Pending')
                                ->options([
                                    'Pending' => 'Pending',
                                    'Accept' => 'Accept',
                                    'Reject' => "Reject",
                                ]),
                            Select::make('wedding_breakfast')
                                ->default('Pending')
                                ->options([
                                    'Pending' => 'Pending',
                                    'Accept' => 'Accept',
                                    'Reject' => "Reject",
                                ]),
                            Select::make('other')
                                ->default('Pending')
                                ->options([
                                    'Pending' => 'Pending',
                                    'Accept' => 'Accept',
                                    'Reject' => "Reject",
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
                        ]),
                ]),

            Forms\Components\RichEditor::make('notes')
                ->maxLength(500)
                ->columnSpanFull(),
        ];
    }
}
