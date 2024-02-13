<?php

namespace app\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\ClientChecklist;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AddTasks extends Component
{
    public $TaskName;
    public $TaskDescription;
    public $TaskCategory;
    public $TaskDate;
    public bool $EssentialTask;
    public $Category;



    public function mount() {
        $this->TaskName = '';
        $this->TaskDescription = '';
        $this->TaskCategory = '';
        $this->TaskDate = '';
        $this->EssentialTask = '';
        $this->Category = DB::table('vendor_categories')->get();

    }




  //  DB::unprepared('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',


public function updated($field){
    $this->validateOnly($field,[
        'TaskName' => 'required',
        'TaskDescription' => 'required',
        'TaskCategory' => 'required',
        'TaskDate' => 'required',
    ]);
}


  public function addTask() {
        $create_date_time = Carbon::now()->toDateTimeString();

        $this->validate([
            'TaskName' => 'required',
            'TaskDescription' => 'required',
            'TaskCategory' => 'required',
            'TaskDate' => 'required',
        ]);

        ClientChecklist::create([
            'c_id' => AUTH::id(),
            'created_at' => $create_date_time,
            'task_name' =>$this->TaskName,
            'description' =>$this->TaskDescription,
            'Category' =>$this->TaskCategory,
            'timing_period' =>$this->TaskDate,
            'essential'=>$this->EssentialTask,
        ]);


        $this->dispatch('toastr:info', [
            'message' => 'Task Added Successfully',
        ]);

        $this->reset('TaskName');
        $this->reset('TaskDescription');
        $this->reset('TaskCategory');
        $this->reset('TaskDate');
        $this->reset('EssentialTask');

        $this->dispatch('taskAdded');
        $this->dispatch('taskAdding');
        $this->dispatch('itemAdding');

    }

    public function render()
    {
        return view('livewire.add-tasks');
    }
}
