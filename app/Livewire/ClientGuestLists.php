<?php

namespace app\Livewire;

use Illuminate\Support\Carbon;
use App\Models\ClientGuestList;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns, };

final class ClientGuestLists extends PowerGridComponent
{


    public string $sortField = 'client_guest_lists.id';
    public string $sortDirection = 'desc';

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */


    protected function getListeners(): array
    {
        return array_merge(
            parent::getListeners(), [
                'edit-guest' => 'editGuest',
                'guestAdded',
                'deleteConfirm',
                'bulkDelete',
                'deleteItem',
                'guestDelete',

            ]);
    }


    public function guestAdded()
    {
        $this->dispatch('pg:eventRefresh-default'); // or dispatchTo(MyTable::class, 'pg:eventRefresh-default');
        $this->dispatch('toastr:info', [
            'message' => 'Item Updated Successfully',
        ]);
    }

    public function deleteConfirm(){
        // dd($id[0]);
        $comma_separated = implode(",", $this->checkboxValues);
        $this->dispatch('swal:confirm', [
            'type' => 'warning',
            'title' => 'Are you sure you want to delete these Records?',
            'text' => 'Record Number :'.$comma_separated,
            'ids' => $this->checkboxValues,
        ]);
    }

    public function deleteItem($id){
        $itemid = $id[0];
        $this->dispatch('swal:confirmDelete', [
            'type' => 'warning',
            'title' => 'Are you sure you want to delete?',
            'text' => 'Record No :'. $itemid,
            'id' => $itemid,
        ]);
    }

    public function bulkDelete(): void
    {
            ClientGuestList::query()->whereIn('id', $this->checkboxValues)->delete();
    }


    public function guestDelete($id): void{
        ClientGuestList::query()->find($id)->delete();
    }

//     public function onUpdatedEditable(string $id, string $field, string $value): void
// {
//     ClientGuestList::query()->find($id)->update([
//         $field => $value,
//     ]);
// }


    public $guest_name, $contact_no, $email, $no_of_family_members, $drinking_buddies_count, $group;


    public function onUpdatedToggleable(string $id, string $field, string $value): void
    {
        ClientGuestList::query()->find($id)->update([
            $field => $value,
        ]);
    }



    public function editGuest($data): void
    {
        dd('You are editing', $data);
    }




    public function setUp(): array
    {
        $this->showCheckBox();
        // $this->persist(['columns', 'filters']);
        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->includeViewOnTop('components.datatable.header-top')->showToggleColumns()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
    * PowerGrid datasource.
    *
    * @return Builder<\App\Models\ClientGuestList>
    */
    public function datasource(): Builder
    {
        return ClientGuestList::query();
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    | ❗ IMPORTANT: When using closures, you must escape any value coming from
    |    the database using the `e()` Laravel Helper function.
    |
    */
    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('guest_name')

           /** Example of custom column using a closure **/
            // ->addColumn('guest_name_lower', function (ClientGuestList $model) {
            //     return strtolower(e($model->guest_name));
            // })

            ->addColumn('contact_no')
            ->addColumn('email')
            ->addColumn('no_of_family_members')
            ->addColumn('drinking_buddies_count')
            ->addColumn('group')
            ->addColumn('status', function (ClientGuestList $model) {
                return ($model->status ? 'Confirmed' : 'Not Confirmed');
              })
            ->addColumn('created_at_formatted', fn (ClientGuestList $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'))
            ->addColumn('updated_at_formatted', fn (ClientGuestList $model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s'));
    }


// --------------------------------------Validation for updating------------------------------------------------------

    public bool $showErrorBag = true;

    protected array $rules = [
        'guest_name.*' => ['required', 'min:6'],
        'contact_no.*' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10'],
        'email.*' => ['required', 'email'],
        'no_of_family_members.*' => ['required', 'max:100', 'min:0'],
        'drinking_buddies_count.*' => ['required', 'max:100', 'min:0'],
        // 'group' => ['required'],
    ];

// --------------------------------------End of Validation for updating------------------------------------------------------



    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

     /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        $canEdit = true;
        return [

            Column::make('ID', 'id'),

            Column::make('GUEST NAME', 'guest_name')
                ->headerAttribute('', 'width: 180px;')
                ->sortable()
                ->searchable()
                ->editOnClick()
                ->editOnClick($canEdit),

            // Column::add()
            //     ->title('Guest Name')
            //     ->field('guest_name')
            //     ->editOnClick($canEdit),

            Column::make('CONTACT NO', 'contact_no')
                ->headerAttribute('', 'width: 180px;')
                ->sortable()
                ->searchable()
                ->editOnClick()
                ->editOnClick($canEdit),

            Column::make('EMAIL', 'email')
                ->headerAttribute('', 'width: 200px;')
                ->sortable()
                ->searchable()
                ->editOnClick()
                ->editOnClick($canEdit),

            Column::make('NO OF FAMILY MEMBERS', 'no_of_family_members')
                ->headerAttribute('', 'width: 130px;')
                ->withSum('Total  Guests', true, true)
                // ->headerAttribute('text-center', 'color:red')
                ->bodyAttribute('text-center', 'color:red')
                ->editOnClick()
                ->editOnClick($canEdit),

            Column::make('DRINKING BUDDIES COUNT', 'drinking_buddies_count')

                ->headerAttribute('', 'width: 150px;')
                ->bodyAttribute('text-center')
                ->withSum('Total', true, true)
                ->editOnClick($canEdit),

            // Column::add()
            //     ->title('DRINKING BUDDIES COUNT')
            //     ->field('drinking_buddies_count')

            Column::add()
                ->title('group')
                ->field('group', 'group')
                ->headerAttribute('', 'width: 100px;')
                // ->editOnClick(ClientGuestList::select('group')->distinct()->get(), 'group', 'group')
                ->editOnClick($canEdit),

            Column::add()
                ->title(__('CONFIRMATION'))
                ->field('status')
                ->toggleable(true, 'Yes', 'No')
                ->headerAttribute('', 'width: 100px;')
                ->bodyAttribute('text-center')
                // ->makeBooleanFilter('status', 'yes', 'no')
                ->sortable(),

            Column::add()
                ->title(__('Status'))
                ->field('status'),


            // Column::make('CONFIRMATION', 'status')
            //     // ->makeBooleanFilter(dataField: 'status', trueLabel: 'Confirm', falseLabel: 'Not Confirm')
            //     ->toggleable(true, 'yes', 'no')
            //     ->headerAttribute('', 'width: 100px;')
            //     ->makeBooleanFilter('status', 'yes', 'no')
            //     ->sortable(),

            // Column::make('CREATED AT', 'created_at_formatted', 'created_at')
            //     ->searchable()
            //     ->sortable()
            //     ->makeInputDatePicker(),

            // Column::make('UPDATED AT', 'updated_at_formatted', 'updated_at')
            //     ->searchable()
            //     ->sortable()
            //     ->makeInputDatePicker(),

            Column::action('Action'),

        ]
;
    }

    /*
    |--------------------------------------------------------------------------
    | Header Action Buttons
    |--------------------------------------------------------------------------
    */

    public function header(): array
    {
        return [
            Button::add('bulk-delete')
                ->slot(__('Bulk delete'))
                ->class('cursor-pointer block bg-white-200 text-gray-700 border border-gray-300 rounded py-2 px-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-600 dark:border-gray-500 dark:bg-gray-500 2xl:dark:placeholder-gray-300 dark:text-gray-200 dark:text-gray-300')
                ->dispatch('deleteConfirm', [])
        ];
    }


    public function filters(): array
    {
        return [
            Filter::boolean('status')
                ->label('yes', 'no')
        ];
    }




    // public function update(array $data): bool
    // {
    // try {
    //     // Update query
    //     $updated = ClientGuestList::query()
    //             ->find($data['id'])
    //             ->update([
    //             $data['field'] => $data['value']
    //             ]);
    // } catch (QueryException $exception) {
    //     $updated = false;
    // }

    // // Reload data after a successful update
    // if ($updated) {
    //     $this->fillData();
    // }

    //   return $updated;
    // }



//-----------------------------------------Edit on click ---------------------------------------------------------------

public function onUpdatedEditable(string|int $id, string $field, string $value): void
{
    $this->validate();
    ClientGuestList::query()->find($id)->update([
        $field => $value,
    ]);
}





    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

     /**
     * PowerGrid ClientGuestList Action Buttons.
     *
     * @return array<int, Button>
     */


    public function actions(): array
    {
       return [

        Button::add('destroy')
        ->slot(__('Delete'))
        ->class('btn btn-danger')
        ->dispatch('deleteItem',['id']),


           Button::make('edit', '<i class="far fa-edit"></i>')
               ->target(target:'')
               ->class('btn btn-primary')
            //    ->route('client-guest-lists.edit', ['id']),
               ->dispatch('edit-guest', [
                'id' => 'id',
            ]),

        //    Button::make('destroy', '<i class="fas fa-trash-alt"></i>')
        //        ->target(target:'')
        //        ->class('btn btn-danger')
        //        ->dispatch('itemDeleteConfirm', ['id']),
        ];
    }



    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

     /**
     * PowerGrid ClientGuestList Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($client-guest-list) => $client-guest-list->id === 1)
                ->hide(),
        ];
    }
    */
}
