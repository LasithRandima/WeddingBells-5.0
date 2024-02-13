<?php

namespace App\Livewire;

use App\Models\AllGuest;
use App\Models\GuestList;
use App\Services\GuestlistForm;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;
use Livewire\Component;
use Filament\Tables;
use Filament\Forms;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Notifications\Notification;
use Filament\Tables\Actions;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Placeholder;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Illuminate\Support\Facades\DB;
use Filament\Resources\Components\Tab;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Columns\Summarizers\Count;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Filament\Tables\Columns\Summarizers\Summarizer;


use App\Mail\GuestInfosCollectMail;


class GuestListFilament extends Component implements HasTable, HasForms
{
    use InteractsWithTable, InteractsWithForms;

    // public GuestList $guestList;



    public function render()
    {
        return view('livewire.guest-list-filament');
    }

    // public function getTabs(): array
    // {
    //     return [
    //         null => Tab::make('All'),
    //         'Ceremony' => Tab::make()->query(fn ($query) => $query->where('ceremony', 'pending_approval')),
    //         'EVENING RECEPTION' => Tab::make()->query(fn ($query) => $query->where('evening_reception', 'reviewing')),
    //         'WEDDING BREAKFAST' => Tab::make()->query(fn ($query) => $query->where('wedding_breakfast', 'published')),
    //         'Invited' => Tab::make()->query(fn ($query) => $query->where('ceremony', 'invited')->orWhere('evening_reception', 'invited')->orWhere('wedding_breakfast', 'invited')->orWhere('other', 'invited')),
    //         'Not Yet Invited' => Tab::make()->query(fn ($query) => $query->where('ceremony', 'not_invited')->orWhere('evening_reception', 'not_invited')->orWhere('wedding_breakfast', 'not_invited')->orWhere('other', 'not_invited')),
    //     ];
    // }

    public function table(Table $table): Table {
        $guestId = request()->segment(2);
        $client = DB::table('clients')->where('user_id', Auth::id())->get();
        return $table

            ->query(ALLGuest::query())
            ->modifyQueryUsing(fn (Builder $query) => $query->where('c_id', Auth::id()))
            // ->modifyQueryUsing(fn (AllGuest $query) => $query->withoutGlobalScopes())
            ->columns([
                TextColumn::make('g_first_name')
                    ->label('Name')
                    ->icon('heroicon-m-user-circle')
                    ->iconColor('primary')
                    ->formatStateUsing(function (AllGuest $record){
                        return ucfirst($record->g_first_name).' '.ucfirst($record->g_last_name);
                    })
                    ->sortable()
                    ->searchable(),
                TextInputColumn::make('email')
                    ->rules(['required', 'max:255'])
                    ->searchable()
                    ->summarize(Summarizer::make()
                        ->label('Total Guests : ')
                        ->using(fn (QueryBuilder $query): string => $query->count()))
                    ->summarize(Summarizer::make()
                        ->label('Email Provided : ')
                        ->using(fn (QueryBuilder $query): string => $query->whereNotNull('email')->count()))
                    ->summarize(Summarizer::make()
                        ->label('Email Not Provided : ')
                        ->using(fn (QueryBuilder $query): string => $query->whereNull('email')->count())),



                TextColumn::make('ceremony')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Pending' => 'warning',
                        'Accept' => 'success',
                        'Reject' => 'danger',
                    })
                    ->summarize(Summarizer::make()
                        ->label('Accepted Count : ')
                        ->using(fn (QueryBuilder $query): string => $query->where('ceremony','Accept')->count()))
                    ->summarize(Summarizer::make()
                        ->label('Rejected Count : ')
                        ->using(fn (QueryBuilder $query): string => $query->where('ceremony','Reject')->count()))
                    ->summarize(Summarizer::make()
                        ->label('Pending Count : ')
                        ->using(fn (QueryBuilder $query): string => $query->where('ceremony','Pending')->count())),

                TextColumn::make('evening_reception')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Pending' => 'warning',
                        'Accept' => 'success',
                        'Reject' => 'danger',
                    })
                    ->summarize(Summarizer::make()
                        ->label('Accepted Count : ')
                        ->using(fn (QueryBuilder $query): string => $query->where('evening_reception','Accept')->count()))
                    ->summarize(Summarizer::make()
                        ->label('Rejected Count : ')
                        ->using(fn (QueryBuilder $query): string => $query->where('evening_reception','Reject')->count()))
                    ->summarize(Summarizer::make()
                        ->label('Pending Count : ')
                        ->using(fn (QueryBuilder $query): string => $query->where('evening_reception','Pending')->count())),

                TextColumn::make('wedding_breakfast')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Pending' => 'warning',
                        'Accept' => 'success',
                        'Reject' => 'danger',
                    })
                    ->summarize(Summarizer::make()
                        ->label('Accepted Count : ')
                        ->using(fn (QueryBuilder $query): string => $query->where('wedding_breakfast','Accept')->count()))
                    ->summarize(Summarizer::make()
                        ->label('Rejected Count : ')
                        ->using(fn (QueryBuilder $query): string => $query->where('wedding_breakfast','Reject')->count()))
                    ->summarize(Summarizer::make()
                        ->label('Pending Count : ')
                        ->using(fn (QueryBuilder $query): string => $query->where('wedding_breakfast','Pending')->count())),

                TextColumn::make('other')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Pending' => 'warning',
                        'Accept' => 'success',
                        'Reject' => 'danger',
                    })
                    ->summarize(Summarizer::make()
                        ->label('Accepted Count : ')
                        ->using(fn (QueryBuilder $query): string => $query->where('other','Accept')->count()))
                    ->summarize(Summarizer::make()
                        ->label('Rejected Count : ')
                        ->using(fn (QueryBuilder $query): string => $query->where('other','Reject')->count()))
                    ->summarize(Summarizer::make()
                        ->label('Pending Count : ')
                        ->using(fn (QueryBuilder $query): string => $query->where('other','Pending')->count())),

                ToggleColumn::make('is_invited')
                    ->label('Invite')
                    ->searchable()
                    ->summarize(Summarizer::make()
                        ->label('Invited : ')
                        ->using(fn (QueryBuilder $query): string => $query->where('is_invited', 1)->count()))
                    ->summarize(Summarizer::make()
                        ->label('Not Invited : ')
                        ->using(fn (QueryBuilder $query): string => $query->where('is_invited', 0)->count())),

            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
                    ->slideOver()
                    ->model(GuestList::class)
                    ->form(GuestlistForm::schema()),
                Tables\Actions\DeleteAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->headerActions([

                Tables\Actions\CreateAction::make()
                    ->label('Add New Guest')
                    ->slideOver()
                    ->model(GuestList::class)
                    ->form(GuestlistForm::schema()),

                Actions\Action::make('Request Rsvp')->label('Request RSVP')->url(function (){
                    return route('rsvpguestlist.rsvpguestlistshare', [Auth::id()]);
                    }),

                Actions\Action::make('Send a Link')
                ->label('Send Data Collect Link')
                ->form([

                    TextInput::make('share_url')
                    ->label('Link to Share')
                    ->default(env('APP_URL') . '/guestlinks/' . Auth::id() . '/confirm/')
                ])
                ->disabledForm()
                ->modalIcon('fas-share-square')
                ->modalHeading('Send a Link to my Guests')
                ->modalDescription('Collect addresses from all your guests with just one link.')
                ->extraModalFooterActions([
                    Actions\Action::make('whatsapp')
                        ->requiresConfirmation()
                        ->action(function () {
                             // Create WhatsApp shareable link using the provided $data
                            $whatsappLink = 'https://api.whatsapp.com/send?text=' . urlencode(env('APP_URL') . '/guestlinks/' . Auth::id() . '/confirm/');
                            // Redirect to WhatsApp shareable link
                            return redirect()->away($whatsappLink);

                        }),
                    Actions\Action::make('telegram')
                        ->requiresConfirmation()
                        ->action(function () {
                             // Create WhatsApp shareable link using the provided $data
                            $telegramLink = 'https://t.me/share/url?url=' . urlencode(env('APP_URL') . '/guestlinks/' . Auth::id() . '/confirm/');
                            // Redirect to telegram shareable link
                            return redirect()->away($telegramLink);

                        }),
                    Actions\Action::make('Email')

                        ->requiresConfirmation()
                        ->form([

                            TextInput::make('email_address')
                                ->label('Email')
                                ->email(),
                            Forms\Components\RichEditor::make('msg')
                                ->required()
                                ->maxLength(1000)
                                ->default("<p>Hello, As you know, on {$client[0]->wed_date} We are getting married! And you are invited, of course. We'd like you to confirm your mailing address as soon as possible through this link: </p><a target='_blank' href='" .env('APP_URL').'/guestlinks/'.Auth::id().'/confirm/' . "'>" . env('APP_URL') . '/guestlinks/' . Auth::id() . '/confirm/' . '</a><br><br><p>Thank you very much!<br><br>'. $client[0]->c_name .' & '.$client[0]->partner_name.'</p>')
                                ->columnSpan([
                                    'sm' => 2,
                                ]),
                                // Textarea::make('message')
                                // ->label('Message')
                                // ->default("Hello, As you know, on {$client[0]->wed_date} We are getting married! And you are invited, of course. We'd like you to confirm your mailing address as soon as possible through this link:  "." " . urlencode(env('APP_URL') . '/guestlinks/' . Auth::id() . '/confirm/'))
                                // ->autosize()
                        ])
                        ->modalIcon('fas-share-square')
                        ->modalHeading('Send a Link to my Guests')
                        // ->fillForm(fn (Post $record): array => [
                        //     'email_address' => $record->email_address,
                        //     'msg' => $record->msg,
                        // ])
                        ->action(function ($data) {
                            $client = DB::table('clients')->where('user_id', Auth::id())->get();
                            // $rsvprequestlink = urlencode(env('APP_URL').'/guestlinks/'.Auth::id().'/confirm/');
                            $rsvprequestlink = env('APP_URL').'/guestlinks/'.Auth::id().'/confirm/';
                            // $rsvprequestmsg = "<p>Hello, As you know, on {$client[0]->wed_date} We are getting married! And you are invited, of course. We'd like you to confirm your mailing address as soon as possible through this link: </p><a target='_blank' href='" .env('APP_URL').'/guestlinks/'.Auth::id().'/confirm/' . "'>" . env('APP_URL') . '/guestlinks/' . Auth::id() . '/confirm/' . '</a><br><br><p>Thank you very much!<br><br>'. $client[0]->c_name .' & '.$client[0]->partner_name.'</p>';
                            $rsvprequestmsg = $data['msg'];

                            // return route('rsvpguestlist.rsvpguestlistshare', [Auth::id()]);
                             Mail::to($data['email_address'])->send(new GuestInfosCollectMail($rsvprequestlink, $rsvprequestmsg));
                        })
                        ])
                // ->closeModalWithResponse(fn () => Notification('Link sent successfully'))
                ->closeModalByClickingAway(true)
                ->modalSubmitAction(false)

            ])
            ->filters([

            // TernaryFilter::make('ceremony')
            // ->baseQuery(fn (Builder $query) => $query->where('ceremony', 'invited')->orWhere('evening_reception', 'invited')->orWhere('wedding_breakfast', 'invited')->orWhere('other', 'invited')->withoutGlobalScopes([
            // ]))

            ], layout: FiltersLayout::AboveContentCollapsible);
    }




}
