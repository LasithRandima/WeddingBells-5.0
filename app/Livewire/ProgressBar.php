<?php

namespace app\Livewire;

use App\Models\ClientChecklist;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;




class ProgressBar extends Component
{

    public $allTasks;
    public $completedTasks;

    protected $listeners = ['taskUpdated','taskDelete','taskAdding'];
    // protected $listener = ['taskDelete'];
    // protected $listeners = ['taskAdding'];

    public function mount(){
    $this->allTasks = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->count();
    $this->completedTasks = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('task_status', '=', 1)->count();
    }

    public function taskUpdated(){

        $this->completedTasks = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('task_status', '=', 1)->count();
        $this->allTasks = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->count();
    }


    public function taskDelete(){

        $this->completedTasks = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('task_status', '=', 1)->count();
        $this->allTasks = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->count();
    }


    public function taskAdding(){

        $this->completedTasks = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('task_status', '=', 1)->count();
        $this->allTasks = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->count();
    }


    // public function taskAdding(){
    //     $this->allTasks = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->count();
    //     $this->completedTasks = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('task_status', '=', 1)->count();
    // }

    public function render()
    {
        return view('livewire.progress-bar');

    }
}
