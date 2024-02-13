<?php

namespace app\Livewire;

use App\Models\ClientChecklist;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChecklistCurrentStatus extends Component
{

    public $allTasks;
    public $completedTasks;
    public $todoTasks;
    public $byTiming;
    public $byCategory;

    protected $listeners = ['itemUpdated','itemDelete','itemAdding'];

    public function mount(){
    $this->allTasks = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->count();
    $this->completedTasks = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('task_status', '=', 1)->count();
    $this->todoTasks = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('task_status', '=', 0)->count();
    $this->byTiming = DB::select('SELECT timing_period, COUNT(timing_period) as timingCount FROM client_checklists GROUP By timing_period');
    $this->byCategory = DB::select('SELECT category, COUNT(category) as categoryCount FROM client_checklists GROUP By category');
    }


    public function itemUpdated(){

        $this->allTasks = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->count();
        $this->completedTasks = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('task_status', '=', 1)->count();
        $this->todoTasks = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('task_status', '=', 0)->count();
        $this->byTiming = DB::select('SELECT timing_period, COUNT(timing_period) as timingCount FROM client_checklists GROUP By timing_period');
        $this->byCategory = DB::select('SELECT category, COUNT(category) as categoryCount FROM client_checklists GROUP By category');
    }


    public function itemDelete(){

        $this->allTasks = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->count();
        $this->completedTasks = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('task_status', '=', 1)->count();
        $this->todoTasks = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('task_status', '=', 0)->count();
        $this->byTiming = DB::select('SELECT timing_period, COUNT(timing_period) as timingCount FROM client_checklists GROUP By timing_period');
        $this->byCategory = DB::select('SELECT category, COUNT(category) as categoryCount FROM client_checklists GROUP By category');

    }


    public function itemAdding(){

        $this->allTasks = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->count();
        $this->completedTasks = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('task_status', '=', 1)->count();
        $this->todoTasks = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('task_status', '=', 0)->count();
        $this->byTiming = DB::select('SELECT timing_period, COUNT(timing_period) as timingCount FROM client_checklists GROUP By timing_period');
        $this->byCategory = DB::select('SELECT category, COUNT(category) as categoryCount FROM client_checklists GROUP By category');

    }





    public function render()
    {
        return view('livewire.checklist-current-status');
    }
}
