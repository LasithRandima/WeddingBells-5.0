<?php

namespace app\Livewire;

use App\Models\ClientBudget;
use Filament\Tables;
use App\Models\ClientCapital;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class ListBudget extends Component implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected function getTableQuery(): Builder
    {
        return ClientBudget::query();
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('exp_name'),
            Tables\Columns\TextColumn::make('exp_category'),
            Tables\Columns\TextColumn::make('estimated_cost'),
            Tables\Columns\TextColumn::make('final_cost'),
            Tables\Columns\TextColumn::make('advance_paid'),
            Tables\Columns\TextColumn::make('advance_paid_date'),
            Tables\Columns\TextColumn::make('amount_to_be_paid'),
            Tables\Columns\TextColumn::make('final_cost_paid_date'),
            Tables\Columns\TextColumn::make('paid_person_name'),
            Tables\Columns\ToggleColumn::make('has_paid'),
        ];

    }

    // protected function getTableFilters(): array
    // {

    // }

    // protected function getTableActions(): array
    // {

    // }

    // protected function getTableBulkActions(): array
    // {

    // }


    public function render(): View
    {
        return view('livewire.list-budget');
    }


}
