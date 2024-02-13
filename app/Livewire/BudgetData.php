<?php

namespace app\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\ClientBudget;
use App\Models\ClientCapital;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;




class BudgetData extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $budget;
    public $expanse;
    public $Category;
    public $vendorCategory;
    public $estimateCost;
    public $finalCost;
    public $advancePaid;
    public $advancePaidDate;
    // public $amounttoPaid;
    public $paymentDueDate;
    public $paidPersonName;
    // public $budgetlist;

    public bool $hasPaid;
    public $budget_id;
    public $budgetNo;

    public $totEstimatedCost, $totFinalCost, $totAdvancePaid, $totAmountToPaid, $client, $capital, $updateBudgetLine;

    protected $listeners = ['budgetAdd','budgetUpdated','budgetDeleted', 'capitalUpdated'];
    // protected function rules()
    // {
    //     return [
    //         'expanse' => 'required',
    //         'category' => 'required',
    //         'estimateCost' => 'required|numeric|integer',
    //         'finalCost' => 'required|numeric|integer',
    //     ];
    // }

    // public function updated($field){
    //     $this->validateOnly($field);
    // }


    //     public function updateBudget(){

    //         $validatedData = $this->validate();

    //         ClientBudget::where('id', $this->budget_id)->update([
    //             'exp_name' => $validatedData['expanse'],
    //             'exp_category' => $validatedData['Category'],
    //             'estimated_cost' => $validatedData['estimateCost'],
    //             'final_cost' => $validatedData['finalCost'],
    //             'advance_paid' => $this->advancePaid,
    //             'advance_paid_date' => $this->advancePaidDate,
    //             'final_cost_paid_date' => $this->paymentDueDate,
    //             'paid_person_name' => $this->paidPersonName,
    //             'has_paid' => $this->hasPaid,
    //         ]);
    //         session()->flash('message', 'Item Updated Sucessfully');
    //         $this->resetInput();
    //         $this->dispatch('close-modal');

    //     }

    public function mount(){
        $this->totEstimatedCost = ClientBudget::where('c_id', '=', AUTH::id())->sum('estimated_cost');
        $this->totFinalCost = ClientBudget::where('c_id', '=', AUTH::id())->sum('final_cost');
        $this->totAdvancePaid = ClientBudget::where('c_id', '=', AUTH::id())->sum('advance_paid');
        $this->totAmountToPaid = ClientBudget::where('c_id', '=', AUTH::id())->sum('amount_to_be_paid');
        $this->client = AUTH::id();
        $this->capital = DB::scalar("select budget from client_capitals where c_id = $this->client");
    }

    public function budgetAdd(){
        $this->totEstimatedCost = ClientBudget::where('c_id', '=', AUTH::id())->sum('estimated_cost');
        $this->totFinalCost = ClientBudget::where('c_id', '=', AUTH::id())->sum('final_cost');
        $this->totAdvancePaid = ClientBudget::where('c_id', '=', AUTH::id())->sum('advance_paid');
        $this->totAmountToPaid = ClientBudget::where('c_id', '=', AUTH::id())->sum('amount_to_be_paid');
        $this->client = AUTH::id();
        $this->capital = DB::scalar("select budget from client_capitals where c_id = $this->client");
    }

    public function budgetUpdated(){
        $this->totEstimatedCost = ClientBudget::where('c_id', '=', AUTH::id())->sum('estimated_cost');
        $this->totFinalCost = ClientBudget::where('c_id', '=', AUTH::id())->sum('final_cost');
        $this->totAdvancePaid = ClientBudget::where('c_id', '=', AUTH::id())->sum('advance_paid');
        $this->totAmountToPaid = ClientBudget::where('c_id', '=', AUTH::id())->sum('amount_to_be_paid');
        $this->client = AUTH::id();
        $this->capital = DB::scalar("select budget from client_capitals where c_id = $this->client");
    }

    public function budgetDeleted(){
        $this->totEstimatedCost = ClientBudget::where('c_id', '=', AUTH::id())->sum('estimated_cost');
        $this->totFinalCost = ClientBudget::where('c_id', '=', AUTH::id())->sum('final_cost');
        $this->totAdvancePaid = ClientBudget::where('c_id', '=', AUTH::id())->sum('advance_paid');
        $this->totAmountToPaid = ClientBudget::where('c_id', '=', AUTH::id())->sum('amount_to_be_paid');
        $this->client = AUTH::id();
        $this->capital = DB::scalar("select budget from client_capitals where c_id = $this->client");
    }

    public function updated($field){
        $this->validateOnly($field,[
            'expanse' => 'required',
            'estimateCost' => 'required|numeric|integer',
            'finalCost' => 'required|numeric|integer',
        ]);
    }

    public function updateBudget(){
        $create_date_time = Carbon::now()->toDateTimeString();
        $this->validate([
            'expanse' => 'required',
            'estimateCost' => 'required',
            'finalCost' => 'required',
        ]);

        ClientBudget::where('id', $this->budget_id)->update([
            'exp_name' =>$this->expanse,
            'exp_category' =>$this->Category,
            'estimated_cost' =>$this->estimateCost,
            'final_cost' =>$this->finalCost,
            'advance_paid'=>$this->advancePaid,
            'advance_paid_date' =>$this->advancePaidDate,
            'amount_to_be_paid' =>$this->finalCost - $this->advancePaid,
            'final_cost_paid_date' =>$this->paymentDueDate,
            'paid_person_name'=>$this->paidPersonName,
            'has_paid' =>$this->hasPaid,
            'updated_at' => $create_date_time,
        ]);

        // session()->flash('message', 'Item Updated Sucessfully');
        $this->dispatch('toastr:info', [
            'message' => 'Item Updated Successfully',
        ]);

        $this->resetInput();
        $this->dispatch('close-modal');

        $this->dispatch('budgetUpdated');
    }



        public function editBudget(int $id) {
        $budget = ClientBudget::find($id);

        if($budget){
            $this->budget_id = $budget->id;
            $this->expanse = $budget->exp_name;
            $this->Category = $budget->exp_category;
            $this->estimateCost = $budget->estimated_cost;
            $this->finalCost = $budget->final_cost;
            $this->advancePaid = $budget->advance_paid;
            $this->advancePaidDate = $budget->advance_paid_date;
            $this->paymentDueDate = $budget->final_cost_paid_date;
            $this->paidPersonName = $budget->paid_person_name;
            $this->hasPaid = $budget->has_paid;
        }else{
            return redirect()->to('/dashboard');
        }
    }


    public function capitalUpdated(){
        $this->client = AUTH::id();
        $this->capital = DB::scalar("select budget from client_capitals where c_id = $this->client");
        $this->updateBudgetLine = $this->capital;
    }





    public function deleteBudget(int $budgetNo)
    {
            $this->budget = $budgetNo;
    }

    public function destroyBudget()
    {
        ClientBudget::find($this->budget)->delete();
        // session()->flash('message', 'Item Deleted Successfully');

        $this->dispatch('toastr:info', [
            'message' => 'Item Deleted Successfully',
        ]);

        $this->dispatch('budgetDeleted');

        $this->dispatch('close-modal');

    }





    public function closeModal(){
        $this->resetInput();
    }


    public function resetInput()
    {
    $this->expanse = '';
    $this->Category = '';
    $this->estimateCost = '';
    $this->finalCost = '';
    $this->advancePaid = '';
    $this->advancePaidDate = '';
    $this->paymentDueDate = '';
    $this->paidPersonName = '';
    $this->hasPaid = '';
    }


    public function render()
    {
        $budgets = ClientBudget::where('c_id', '=', AUTH::id())->orderBy('id','DESC')->paginate(5);
        return view('livewire.budget-data', ['budgets' => $budgets]);
    }
}
