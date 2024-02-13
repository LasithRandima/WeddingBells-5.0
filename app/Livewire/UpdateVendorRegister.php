<?php

namespace App\Livewire;

use Livewire\Component;

use Filament\Notifications\Notification;

use Filament\Forms;
use App\Models\Vendor;
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

class UpdateVendorRegister extends Component implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    public Vendor $vendor;

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
    // public $user_id = Auth::id();



    // $catagory = DB::select('select * from vendor_categories');


    public function mount(): void
    {
        // $this->form->fill();

        $this->form->fill([
            'user_id' => Auth::user()->id,
            'v_name' => Auth::user()->name,
            'v_email' => Auth::user()->email,
            'v_bus_name' => Vendor::where('user_id', Auth::user()->id)->first()->v_bus_name,
            'v_bus_location' => Vendor::where('user_id', Auth::user()->id)->first()->v_bus_location,
            'v-description' => Vendor::where('user_id', Auth::user()->id)->first()->v_description,
            'v_category' => Vendor::where('user_id', Auth::user()->id)->first()->v_category,
            'v_bus_branches' => Vendor::where('user_id', Auth::user()->id)->first()->v_bus_branches,
            'v_website_url' => Vendor::where('user_id', Auth::user()->id)->first()->v_website_url,
            'map' => Vendor::where('user_id', Auth::user()->id)->first()->map,
            'v_phone' => Vendor::where('user_id', Auth::user()->id)->first()->v_phone,
        ]);
    }

    protected function getFormSchema(): array
    {
    return [
        Wizard::make()
            ->schema([
                Step::make('Details')
                ->icon('heroicon-o-identification')
                ->description('Tell Us About Your Business')
                ->schema([
                    // Hidden::make('id')
                    // ->default(Auth::user()->id)
                    // ->disabled(),
                    Hidden::make('user_id')
                        ->default(Auth::id()),
                        // TextInput::make('id')
                        // ->default(Auth::id())
                        // ->helperText('Your id.'.Auth::id())
                        // ->label('Personal Id')
                        // ->required(),
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


                TagsInput::make('v_bus_branches')
                    ->label('Business Branches')
                    ->placeholder('Type your Branches one by one'),


                ]),


                    Step::make('Contact Details')
                    ->icon('heroicon-o-globe-alt')
                    ->description('Where We Can Find You')

                    ->schema([
                        TextInput::make('v_website_url')
                            ->label('Website URL')
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
                transition: all 0.9s ease-in-out;">Update</button>')),
    ];
    }

    public function submit()
    {


            $vendor = Vendor::where('user_id', Auth::user()->id)->first();

            if ($vendor) {
                $vendor->update($this->form->getState());

                Notification::make()
                    ->title('Vendor information updated successfully')
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
        return view('livewire.update-vendor-register');
    }
}
