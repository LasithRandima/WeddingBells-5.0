<?php

namespace app\Livewire;

use App\Models\ClientBudget;
use App\Models\ClientCapital;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use Livewire\Component;

class BudgetPlanner extends Component
{

public bool $hasPaid;
public $cid;
public $budgetLine;
public $expanse;
public $Category;
public $vendorCategory;
public $estimateCost;
public $finalCost;
public $advancePaid;
public $advancePaidDate;
public $amounttoPaid;
public $paymentDueDate;
public $paidPersonName;
public $budgetlist;
public $budget_id;
public $listBudgets;
public $updateBudgetLine, $capitals, $client;

protected $listeners = ['capitalUpdate'];

public function mount() {
    $this->budgetLine = '';

    $this->hasPaid = '';
    $this->expanse = '';
    $this->Category = '';
    $this->estimateCost = '';
    $this->finalCost = '';
    $this->advancePaid = 0;
    $this->advancePaidDate = '';
    $this->amounttoPaid = '';
    $this->paymentDueDate = '';
    $this->paidPersonName = '';

    $this->vendorCategory = DB::table('vendor_categories')->get();
    $this->client = AUTH::id();
    $this->capitals = DB::scalar("select budget from client_capitals where c_id = $this->client");
    $this->updateBudgetLine = $this->capitals;
    // $this->budgetlist = DB::table('client_budgets')->get();
    // $this->listbudget = DB::table('client_budgets')->where('c_id', '=', AUTH::id())->get();

}



public function updated($field){
    $this->validateOnly($field,[
        'budgetLine' => 'required|numeric|integer',
        'expanse' => 'required',
        'estimateCost' => 'required|numeric|integer',
        'finalCost' => 'required|numeric|integer',
    ]);
}

public function updateCapital(){
    $create_date_time = Carbon::now()->toDateTimeString();
    $this->validate([
        'updateBudgetLine' => 'required|numeric|integer',
    ]);


    ClientCapital::where('c_id', AUTH::id())->update([
        'budget' =>$this->updateBudgetLine,
    ]);

    $this->dispatch('toastr:info', [
        'message' => 'Capital Updated Successfully',
    ]);

    $this->reset('updateBudgetLine');
    $this->dispatch('capitalUpdated');
    $this->dispatch('capitalUpdate');
}



public function capitalUpdate(){
    $this->client = AUTH::id();
    $this->capitals = DB::scalar("select budget from client_capitals where c_id = $this->client");
    $this->updateBudgetLine = $this->capitals;
}


public function addCapital() {
    $create_date_time = Carbon::now()->toDateTimeString();

    $this->validate([
        'budgetLine' => 'required|numeric|integer',
    ]);

    ClientCapital::create([
        'c_id' => AUTH::id(),
        'created_at' => $create_date_time,
        'budget' =>$this->budgetLine,
    ]);




    $this->reset('budgetLine');



    $this->dispatch('setCapital');
    // $this->dispatch('taskAdding');
    // $this->dispatch('itemAdding');

}



  public function addBudget() {
        $create_date_time = Carbon::now()->toDateTimeString();

        $this->validate([
            'expanse' => 'required',
            'estimateCost' => 'required|numeric|integer',
            'finalCost' => 'numeric|integer',
        ]);

        ClientBudget::create([
            'has_paid' =>$this->hasPaid,
            'c_id' => AUTH::id(),
            'created_at' => $create_date_time,
            'exp_name' =>$this->expanse,
            'exp_category' =>$this->Category,
            'estimated_cost' =>$this->estimateCost,
            'final_cost' => $this->finalCost == null && $this->estimateCost != null ? 0 : $this->finalCost,
            'advance_paid'=>$this->advancePaid == null ? null : $this->advancePaid,
            'advance_paid_date' =>$this->advancePaidDate == null ? null : $this->advancePaidDate,
            'amount_to_be_paid' => $this->finalCost==null && $this->advancePaid==null ? 0 : $this->finalCost - $this->advancePaid,
            'final_cost_paid_date' =>$this->paymentDueDate == null ? null : $this->paymentDueDate,
            'paid_person_name'=>$this->paidPersonName,
        ]);




        $this->reset('expanse');
        $this->reset('estimateCost');
        $this->reset('finalCost');
        $this->reset('advancePaid');
        $this->reset('advancePaidDate');
        $this->reset('paymentDueDate');
        $this->reset('paidPersonName');
        $this->reset('Category');


        // $this->listBudgets = DB::table('client_budgets')->where('c_id', '=', AUTH::id())->orderBy('id','DESC')->get();
        // session()->flash('message', 'Budget listed successfully...');

        $this->dispatch('toastr:info', [
            'message' => 'Budget listed successfully',
        ]);

        $this->dispatch('budgetAdd');

    }


public function setCapital(){
    $this->client = AUTH::id();
    $this->capitals = DB::scalar("select budget from client_capitals where c_id = $this->client");
    $this->updateBudgetLine = $this->capitals;
}



    public function render()
    {
        return view('livewire.budget-planner');
    }
}
