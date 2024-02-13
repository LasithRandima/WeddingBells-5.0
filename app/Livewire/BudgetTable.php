<?php

namespace app\Livewire;

use App\Models\ClientBudget;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Livewire\Component;

class BudgetTable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';


    public bool $hasPaid;

    public $estimated_cost;
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
    public $listBudget;
    public $listBudgets;
    public $listpages;


    // public $hasPaids, $expanses, $Categorys, $vendorCategorys, $estimateCosts, $finalCosts, $advancePaids, $advancePaidDates, $amounttoPaids, $paymentDueDates, $paidPersonNames;

        // protected $listeners = ['budgetAdded'];




        // public function budgetAdded(){
        //     $this->listBudgets = DB::table('client_budgets')->where('c_id', '=', AUTH::id())->orderBy('id','DESC')->get();
        // }


    // public function updated($field){
    //     $this->validateOnly($field,[
    //         'budgetLine' => 'required|numeric|integer',
    //         'expanse' => 'required',
    //         'estimateCost' => 'required|numeric|integer',
    //         'finalCost' => 'required|numeric|integer',
    //     ]);
    // }




    // public function editBudget(int $id) {
    //     $budget = ClientBudget::find($id);

    //     if($budget){

    //         $this->expanse = $budget->expanse;
    //         $this->Category = $budget->exp_category;
    //         $this->estimated_cost = $budget->estimated_cost;
    //         $this->finalCost = $budget->final_cost;
    //         $this->advancePaid = $budget->advance_paid;
    //         $this->advancePaidDate = $budget->advance_paid_date;
    //         $this->paymentDueDate = $budget->final_cost_paid_date;
    //         $this->paidPersonName = $budget->paid_person_name;
    //         $this->hasPaid = $budget->has_paid;
    //     }else{
    //         return redirect()->to('/dashboard');
    //     }
    // }



    public function render()
    {
        $listBudgets = ClientBudget::where('c_id', '=', AUTH::id())->orderBy('id','DESC')->paginate(5);
        return view('livewire.budget-table', compact('listBudgets'));
    }
}
