<?php

namespace App\Livewire;
use Filament\Notifications\Notification;

use Filament\Forms;
use App\Models\Vendor;
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


// if(Auth::id()){
// $vendor = DB::table('vendors')
// ->join('users', function ($join) {
//     $join->on('users.id', '=', 'vendors.user_id')
//         ->where('user_id', '=', Auth::user()->id)
//         ->where('users.role_id', '=', Auth::user()->role_id);
// })
// ->select('vendors.*', 'users.*')
// ->get();
// }else{
//     return 'You already Has Registered as a Vendor';
// }


class vendorregister extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    // public $vid;
    // public $name;
    // public $email;
    // public $buisness_name;
    // public $buisness_location;
    // public $Buisness_Description;
    // public $v_category;
    // public $buisness_branches;
    // public $website_url;
    // public $telephone_no;
    // public $Contact_no;
    // public $user_id = Auth::id();

    public $user_id;
    public $v_name;
    public $v_email;
    public $v_bus_name;
    public $v_bus_location;
    public $v_category;
    public $v_bus_branches;
    public $v_website_url;
    public $v_phone;
    public $map;
    public $v_description;
    public $slogan;
    public $logo;




    // $catagory = DB::select('select * from vendor_categories');


    public function mount(): void
    {
        $this->form->fill();
    }

    protected function getFormSchema(): array
    {
    return [
        Wizard::make()
            ->schema([
                Step::make('Details')
                // ->icon('heroicon-o-identification')
                ->description('Tell Us About Your Business')
                ->schema([
                    // Hidden::make('id')
                    // ->default(Auth::user()->id)
                    // ->disabled(),
                    Hidden::make('user_id')
                        ->default(Auth::id()),
                    TextInput::make('v_name')
                        ->default(Auth::user()->name)
                        ->autocapitalize('words')
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
                        ->default(Auth::user()->name)
                        ->label('Business Name')
                        ->placeholder('Your full name here, including any middle names.')
                        ->required(),
                    TextInput::make('slogan')
                        ->label('Slogan')
                        ->placeholder('Your Business Slogan'),
                    Forms\Components\FileUpload::make('logo')
                        ->disk('public')
                        ->directory('vendor/logos')
                        ->image()
                        ->imageEditor()
                        ->imageEditorAspectRatios([
                            null,
                            '16:9',
                            '4:3',
                            '1:1',
                        ])
                        ->openable()
                        ->downloadable(),
                    TextInput::make('v_bus_location')
                        ->label('Business Location')
                        ->placeholder('Business Location')
                        ->required(),
                    Forms\Components\RichEditor::make('v_description')
                        ->label("Business Description")
                        ->placeholder("Business Description")
                        ->maxLength(3000)
                        ->required()
                        ->columnSpan([
                            'sm' => 2,
                    ]),

                    select::make('v_category')
                        ->label('Business Catagory')
                        // ->relationship('v_category', 'Category_name')
                        ->multiple()
                        ->options(VendorCategory::all()->pluck('Category_name', 'Category_name'))
                        // ->preload()
                        ->searchable()
                        ->required(),

                //     TextInput::make('v_bus_branches')
                //         ->label('Business Branches')
                //         ->placeholder('Type as comma separated values -> ex : Colombo , Gampaha'),
                // ]),

                // Repeater::make('v_bus_branches')
                // ->label('Business Branches')
                // ->schema([
                //     TextInput::make('v_bus_branches')
                //     ->label('Business Branches')
                //     ->required(),
                //     ])
                //     ->minItems(1)
                //     ->maxItems(10)
                //     ->collapsible()
                //     ->cloneable()
                //     ->required()
                //     ->columnSpan([
                //         'sm' => 2,
                //         ]),


                Forms\Components\TagsInput::make('v_bus_branches')
                    ->label('Business Branches')
                    ->placeholder('Type your Branches one by one')
                    ->suggestions(['Colombo', 'Negombo', 'Piliyandala', 'Kandy', 'Galle', 'Jaffna', 'Trincomalee', 'Matara', 'Anuradhapura', 'Kurunegala', 'Badulla', 'Ratnapura', 'Polonnaruwa', 'Gampaha', 'Kalutara', 'Batticaloa', 'Mannar', 'Hambantota', 'Nuwara Eliya', 'Matale', 'Ampara', 'Kegalle', 'Kilinochchi', 'Mullaitivu']),


                ]),


                    Step::make('Contact Details')
                    ->icon('heroicon-o-globe-alt')
                    ->description('Where We Can Find You')

                    ->schema([
                        TextInput::make('v_website_url')
                            ->label('Website URL')
                            // ->url()
                            ->suffixIcon('heroicon-m-globe-alt')
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
                            ->telRegex('/^(\+94|0)\s?(7\d{2}|[1-9]\d{1,2})\s?\d{3}\s?\d{4}$/')
                            ->placeholder('e.g., +94701234567 or 0701234567')
                            ->required(),
                        ])
                            ->minItems(1)
                            ->maxItems(3)
                            ->collapsible()
                            ->cloneable()
                            ->required()

                        ]),

                        ])



                ->columns([
                    'sm' => 2,
                ])
                // ->submitAction(new HtmlString('<button type="submit">Submit</button>')),
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
                transition: all 0.9s ease-in-out;">Register</button>')),
    ];
    }

    public function submit()
    {

        if(Auth::user()->id){
            $vendor = DB::table('vendors')->where('user_id', Auth::user()->id)->first();
        }


        if($vendor){
            Notification::make()
            ->title('Vendor already registered')
            ->danger()
            ->send();

            return redirect()->route('dashboard')->with('error','Vendor already has registered');
        }else{
            Notification::make()
            ->title('Vendor registered successfully')
            ->success()
            ->send();
            Vendor::create($this->form->getState());

            // return redirect()->route('dashboard')->with('message','Vendor registered successfully');

            return redirect()->route('sitePackages.index')->with('message','Vendor registered successfully');

        }


    }

    // public function create(): void
    // {
    //     Vendor::create($this->form->getState());
    // }


    public function render()
    {
        return view('livewire.vendorregister');
    }
}
