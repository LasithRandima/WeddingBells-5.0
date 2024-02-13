<?php

namespace app\Livewire;

use App\Models\ClientChecklist;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WeddingChecklist extends Component
{



    public $result =null;

    public $taskid;
    public $selectedtask;
    public bool $tasks_status;
    public bool $status;
    public $TentoTwelvePlus;
    public $allTasks;
    public $completedTasks;

    public $TentoTwelves = [];
    public $editedTentoTwelveIndex =null;
    public $editedTentoTwelveField =null;




    public $SeventoNines =[];
    public $editedSeventoNineIndex =null;
    public $editedSeventoNineField =null;

    public $FourtoSixs=[];
    public $editedFourtoSixIndex =null;
    public $editedFourtoSixField =null;

    public $TwotoThrees=[];
    public $editedTwotoThreeIndex =null;
    public $editedTwotoThreeField =null;

    public $LastMonths=[];
    public $editedLastMonthIndex =null;
    public $editedLastMonthField =null;

    Public $TwoWeekss=[];
    public $editedTwoWeeksIndex =null;
    public $editedTwoWeeksField =null;

    Public $LastWeeks=[];
    public $editedLastWeekIndex =null;
    public $editedLastWeekField =null;

    Public $LastDays=[];
    public $editedLastDayIndex =null;
    public $editedLastDayField =null;

    public $AfterWeddings=[];
    public $editedAfterWeddingIndex =null;
    public $editedAfterWeddingField =null;

    public $TaskList;
    public $TimePeriod;

    protected $listeners = ['taskAdded'];

public function mount(){
    // $tasklist = DB::select('SELECT * FROM client_checklists WHERE c_id = 28 ORDER by id DESC');
    // dd($tasklist);
    $this->TentoTwelves = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 10 to 12 months')->get()->toArray();
    // $this->TentoTwelvePlus = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 10 to 12 months')->get();
    $this->SeventoNines = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 7 to 9 months')->get()->toArray();
    $this->FourtoSixs = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 4 to 6 months')->get()->toArray();
    $this->TwotoThrees = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 2 to 3 months')->get()->toArray();
    $this->LastMonths = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'The last month')->get()->toArray();
    $this->TwoWeekss = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', '2 weeks')->get()->toArray();
    $this->LastWeeks = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'Last week')->get()->toArray();
    $this->LastDays = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'Last day')->get()->toArray();
    $this->AfterWeddings = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'After the wedding')->get()->toArray();
    $this->TimePeriod = DB::table('client_checklists')->select('timing_period')->where('c_id', '=', AUTH::id())->groupBy('timing_period')->get();
    $this->TaskList = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->count();
    $this->allTasks = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->count();
    $this->completedTasks = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('task_status', '=', 1)->count();


}

// public function editTentoTwelve($tenToTwelveIndex){
//     $this->editedTentoTwelveIndex = $tenToTwelveIndex;
// }

public function editTentoTwelveField($tenToTwelveIndex, $fieldName){
    $this->editedTentoTwelveField = $tenToTwelveIndex.'.'.$fieldName;
}
public function editSeventoNineField($seventoNineIndex, $fieldName){
    $this->editedSeventoNineField = $seventoNineIndex.'.'.$fieldName;
}
public function ediFourtoSixField($fourtoSixIndex, $fieldName){
    $this->editedFourtoSixField = $fourtoSixIndex.'.'.$fieldName;
}
public function editTwotoThreeField($twotoThreeIndex, $fieldName){
    $this->editedTwotoThreeField = $twotoThreeIndex.'.'.$fieldName;
}
public function editLastMonthField($lastMonthIndex, $fieldName){
    $this->editedLastMonthField = $lastMonthIndex.'.'.$fieldName;
}
public function editTwoWeeksField($twoWeeksIndex, $fieldName){
    $this->editedTwoWeeksField = $twoWeeksIndex.'.'.$fieldName;
}
public function editLastWeekField($lastWeekIndex, $fieldName){
    $this->editedLastWeekField = $lastWeekIndex.'.'.$fieldName;
}
public function editLastDayField($lastDayIndex, $fieldName){
    $this->editedLastDayField = $lastDayIndex.'.'.$fieldName;
}
public function editAfterWeddingField($afterWeddingIndex, $fieldName){
    $this->editedAfterWeddingField = $afterWeddingIndex.'.'.$fieldName;
}

// public function saveTentoTwelve($tenToTwelveIndex){
//     $TentoTwelve = $this->TentoTwelves[$tenToTwelveIndex] ?? NULL;
//     if(!is_Null($TentoTwelve)){
//         optional(ClientChecklist::find($TentoTwelve['id']))->update($TentoTwelve);
//     }

//     $this->editedTentoTwelveField = null;
//     $this->editedTentoTwelveIndex = null;
// }

public function createTentoTwelve($tenToTwelveIndex){
    $TentoTwelve = $this->TentoTwelves[$tenToTwelveIndex];
    $task = ClientChecklist::find($TentoTwelve->id);
    $selectedtask = $task->task_status;
    // $tasks_status = DB::table('client_checklists')->where('id', '=', $selectedtask)->where('c_id', '=', AUTH::id())->get();
    // dd($selectedtask);

    if($selectedtask == 1){
        $status = 0;
    }elseif($selectedtask == 0){
        $status = 1;
    }

    optional(ClientChecklist::find($TentoTwelve->id)->update(['task_status' => $status ]));
    $this->TentoTwelves = ClientChecklist::where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 10 to 12 months')->get();

    $this->SeventoNines = ClientChecklist::where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 7 to 9 months')->get();
    $this->FourtoSixs = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 4 to 6 months')->get();
    $this->TwotoThrees = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 2 to 3 months')->get();
    $this->LastMonths = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'The last month')->get();
    $this->TwoWeekss = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', '2 weeks')->get();
    $this->LastWeeks = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'Last week')->get();
    $this->LastDays = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'Last day')->get();
    $this->AfterWeddings = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'After the wedding')->get();

    $this->dispatch('taskUpdated');
    $this->dispatch('itemUpdated');
}

public function deleteTentoTwelve($tenToTwelveIndex){
    $TentoTwelve = $this->TentoTwelves[$tenToTwelveIndex];
    // optional(ClientChecklist::find($TentoTwelve['id'])->delete($TentoTwelve));
    optional(ClientChecklist::find($TentoTwelve->id)->delete());

    $this->TentoTwelves = ClientChecklist::where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 10 to 12 months')->get();

    $this->SeventoNines = ClientChecklist::where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 7 to 9 months')->get();
    $this->FourtoSixs = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 4 to 6 months')->get();
    $this->TwotoThrees = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 2 to 3 months')->get();
    $this->LastMonths = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'The last month')->get();
    $this->TwoWeekss = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', '2 weeks')->get();
    $this->LastWeeks = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'Last week')->get();
    $this->LastDays = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'Last day')->get();
    $this->AfterWeddings = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'After the wedding')->get();

    $this->dispatch('taskDelete');
    $this->dispatch('itemDelete');
}


public function createSeventoNine($sevenToNineIndex){
    $SeventoNine = $this->SeventoNines[$sevenToNineIndex];
    $task = ClientChecklist::find($SeventoNine['id']);
    $selectedtask = $task->task_status;

    if($selectedtask == 1){
        $status = 0;
    }elseif($selectedtask == 0){
        $status = 1;
    }

    optional(ClientChecklist::find($SeventoNine['id'])->update(['task_status' => $status ]));
    $this->SeventoNines = ClientChecklist::where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 7 to 9 months')->get();

    $this->TentoTwelves = ClientChecklist::where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 10 to 12 months')->get();
    $this->FourtoSixs = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 4 to 6 months')->get();
    $this->TwotoThrees = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 2 to 3 months')->get();
    $this->LastMonths = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'The last month')->get();
    $this->TwoWeekss = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', '2 weeks')->get();
    $this->LastWeeks = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'Last week')->get();
    $this->LastDays = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'Last day')->get();
    $this->AfterWeddings = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'After the wedding')->get();

    $this->dispatch('taskUpdated');
    $this->dispatch('itemUpdated');

}

public function deleteSeventoNine($sevenToNineIndex){
    $SeventoNine = $this->SeventoNines[$sevenToNineIndex];
    // optional(ClientChecklist::find($SeventoNine['id'])->delete($SeventoNine));
    optional(ClientChecklist::find($SeventoNine->id)->delete());
    $this->SeventoNines = ClientChecklist::where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 7 to 9 months')->get();

   $this->TentoTwelves = ClientChecklist::where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 10 to 12 months')->get();
   $this->FourtoSixs = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 4 to 6 months')->get();
   $this->TwotoThrees = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 2 to 3 months')->get();
   $this->LastMonths = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'The last month')->get();
   $this->TwoWeekss = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', '2 weeks')->get();
   $this->LastWeeks = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'Last week')->get();
   $this->LastDays = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'Last day')->get();
   $this->AfterWeddings = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'After the wedding')->get();

    $this->dispatch('taskDelete');
    $this->dispatch('itemDelete');
}



public function createFourtoSix($fourToSixIndex){
    $FourtoSix = $this->FourtoSixs[$fourToSixIndex];
    // $task = ClientChecklist::find($FourtoSix['id']);
    $task = ClientChecklist::find($FourtoSix->id);

    $selectedtask = $task->task_status;

    if($selectedtask == 1){
        $status = 0;
    }elseif($selectedtask == 0){
        $status = 1;
    }

    // optional(ClientChecklist::find($FourtoSix['id'])->update(['task_status' => $status ]));
    optional(ClientChecklist::find($FourtoSix->id)->update(['task_status' => $status ]));

    $this->FourtoSixs = ClientChecklist::where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 4 to 6 months')->get();

    $this->TentoTwelves = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 10 to 12 months')->get();
    $this->SeventoNines = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 7 to 9 months')->get();
    $this->TwotoThrees = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 2 to 3 months')->get();
    $this->LastMonths = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'The last month')->get();
    $this->TwoWeekss = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', '2 weeks')->get();
    $this->LastWeeks = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'Last week')->get();
    $this->LastDays = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'Last day')->get();
    $this->AfterWeddings = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'After the wedding')->get();

    $this->dispatch('taskUpdated');
    $this->dispatch('itemUpdated');
}

public function deleteFourtoSix($fourtoSixIndex){
    $FourtoSix = $this->FourtoSixs[$fourtoSixIndex];
    // optional(ClientChecklist::find($FourtoSix['id'])->delete($FourtoSix));
    optional(ClientChecklist::find($FourtoSix->id)->delete());
    $this->FourtoSixs = ClientChecklist::where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 4 to 6 months')->get();

    $this->TentoTwelves = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 10 to 12 months')->get();
    $this->SeventoNines = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 7 to 9 months')->get();
    $this->TwotoThrees = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 2 to 3 months')->get();
    $this->LastMonths = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'The last month')->get();
    $this->TwoWeekss = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', '2 weeks')->get();
    $this->LastWeeks = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'Last week')->get();
    $this->LastDays = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'Last day')->get();
    $this->AfterWeddings = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'After the wedding')->get();


    $this->dispatch('taskDelete');
    $this->dispatch('itemDelete');
}


public function createTwotoThree($twoToThreeIndex){
    $TwotoThree = $this->TwotoThrees[$twoToThreeIndex];
    // $task = ClientChecklist::find($TwotoThree['id']);
    $task = ClientChecklist::find($TwotoThree->id);
    $selectedtask = $task->task_status;

    if($selectedtask == 1){
        $status = 0;
    }elseif($selectedtask == 0){
        $status = 1;
    }

    // optional(ClientChecklist::find($TwotoThree['id'])->update(['task_status' => $status ]));
    optional(ClientChecklist::find($TwotoThree->id)->update(['task_status' => $status ]));
    $this->TwotoThrees = ClientChecklist::where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 2 to 3 months')->get();

    $this->TentoTwelves = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 10 to 12 months')->get();
    $this->SeventoNines = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 7 to 9 months')->get();
    $this->FourtoSixs = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 4 to 6 months')->get();
    $this->LastMonths = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'The last month')->get();
    $this->TwoWeekss = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', '2 weeks')->get();
    $this->LastWeeks = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'Last week')->get();
    $this->LastDays = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'Last day')->get();
    $this->AfterWeddings = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'After the wedding')->get();

    $this->dispatch('taskUpdated');
    $this->dispatch('itemUpdated');
}

public function deleteTwotoThree($twoToThreeIndex){
    $TwotoThree = $this->TwotoThrees[$twoToThreeIndex];
    // optional(ClientChecklist::find($TwotoThree['id'])->delete($TwotoThree));
    optional(ClientChecklist::find($TwotoThree->id)->delete());
    $this->TwotoThrees = ClientChecklist::where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 2 to 3 months')->get();

    $this->TentoTwelves = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 10 to 12 months')->get();
    $this->SeventoNines = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 7 to 9 months')->get();
    $this->FourtoSixs = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 4 to 6 months')->get();
    $this->LastMonths = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'The last month')->get();
    $this->TwoWeekss = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', '2 weeks')->get();
    $this->LastWeeks = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'Last week')->get();
    $this->LastDays = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'Last day')->get();
    $this->AfterWeddings = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'After the wedding')->get();


    $this->dispatch('taskDelete');
    $this->dispatch('itemDelete');
}




public function createLastMonth($lastMonthIndex){
    $LastMonth = $this->LastMonths[$lastMonthIndex];
    // $task = ClientChecklist::find($LastMonth['id']);
    $task = ClientChecklist::find($LastMonth->id);
    $selectedtask = $task->task_status;

    if($selectedtask == 1){
        $status = 0;
    }elseif($selectedtask == 0){
        $status = 1;
    }

    // optional(ClientChecklist::find($LastMonth['id'])->update(['task_status' => $status ]));
    optional(ClientChecklist::find($LastMonth->id)->update(['task_status' => $status ]));
    $this->LastMonths = ClientChecklist::where('c_id', '=', AUTH::id())->where('timing_period', '=', 'The last month')->get();

    $this->TentoTwelves = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 10 to 12 months')->get();
    $this->SeventoNines = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 7 to 9 months')->get();
    $this->FourtoSixs = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 4 to 6 months')->get();
    $this->TwotoThrees = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 2 to 3 months')->get();
    $this->TwoWeekss = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', '2 weeks')->get();
    $this->LastWeeks = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'Last week')->get();
    $this->LastDays = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'Last day')->get();
    $this->AfterWeddings = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'After the wedding')->get();

    $this->dispatch('taskUpdated');
    $this->dispatch('itemUpdated');
}

public function deleteLastMonth($lastMonthIndex){
    $LastMonth = $this->LastMonths[$lastMonthIndex];
    // optional(ClientChecklist::find($LastMonth['id'])->delete($LastMonth));
    optional(ClientChecklist::find($LastMonth->id)->delete());


    $this->LastMonths = ClientChecklist::where('c_id', '=', AUTH::id())->where('timing_period', '=', 'The last month')->get();

    $this->TentoTwelves = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 10 to 12 months')->get();
    $this->SeventoNines = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 7 to 9 months')->get();
    $this->FourtoSixs = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 4 to 6 months')->get();
    $this->TwotoThrees = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 2 to 3 months')->get();
    $this->TwoWeekss = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', '2 weeks')->get();
    $this->LastWeeks = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'Last week')->get();
    $this->LastDays = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'Last day')->get();
    $this->AfterWeddings = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'After the wedding')->get();


    $this->dispatch('taskDelete');
    $this->dispatch('itemDelete');
}





public function createTwoWeeks($twoWeeksIndex){
    $TwoWeeks = $this->TwoWeekss[$twoWeeksIndex];
    // $task = ClientChecklist::find($TwoWeeks['id']);
    $task = ClientChecklist::find($TwoWeeks->id);
    $selectedtask = $task->task_status;

    if($selectedtask == 1){
        $status = 0;
    }elseif($selectedtask == 0){
        $status = 1;
    }

    // optional(ClientChecklist::find($TwoWeeks['id'])->update(['task_status' => $status ]));
    optional(ClientChecklist::find($TwoWeeks->id)->update(['task_status' => $status ]));
    $this->TwoWeekss = ClientChecklist::where('c_id', '=', AUTH::id())->where('timing_period', '=', '2 weeks')->get();

    $this->TentoTwelves = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 10 to 12 months')->get();
    $this->SeventoNines = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 7 to 9 months')->get();
    $this->FourtoSixs = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 4 to 6 months')->get();
    $this->TwotoThrees = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 2 to 3 months')->get();
    $this->LastMonths = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'The last month')->get();
    $this->LastWeeks = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'Last week')->get();
    $this->LastDays = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'Last day')->get();
    $this->AfterWeddings = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'After the wedding')->get();

    $this->dispatch('taskUpdated');
    $this->dispatch('itemUpdated');
}

public function deleteTwoWeeks($twoWeeksIndex){
    $TwoWeeks = $this->TwoWeekss[$twoWeeksIndex];
    // optional(ClientChecklist::find($TwoWeeks['id'])->delete($TwoWeeks));
    optional(ClientChecklist::find($TwoWeeks->id)->delete());
    $this->TwoWeekss = ClientChecklist::where('c_id', '=', AUTH::id())->where('timing_period', '=', '2 weeks')->get();

    $this->TentoTwelves = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 10 to 12 months')->get();
    $this->SeventoNines = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 7 to 9 months')->get();
    $this->FourtoSixs = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 4 to 6 months')->get();
    $this->TwotoThrees = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 2 to 3 months')->get();
    $this->LastMonths = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'The last month')->get();
    $this->LastWeeks = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'Last week')->get();
    $this->LastDays = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'Last day')->get();
    $this->AfterWeddings = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'After the wedding')->get();

    $this->dispatch('taskDelete');
    $this->dispatch('itemDelete');
}




public function createLastWeek($lastWeekIndex){
    $LastWeek = $this->LastWeeks[$lastWeekIndex];
    // $task = ClientChecklist::find($LastWeek['id']);
    $task = ClientChecklist::find($LastWeek->id);
    $selectedtask = $task->task_status;

    if($selectedtask == 1){
        $status = 0;
    }elseif($selectedtask == 0){
        $status = 1;
    }

    // optional(ClientChecklist::find($LastWeek['id'])->update(['task_status' => $status ]));
    optional(ClientChecklist::find($LastWeek->id)->update(['task_status' => $status ]));
    $this->LastDays = ClientChecklist::where('c_id', '=', AUTH::id())->where('timing_period', '=', 'Last week')->get();

    $this->TentoTwelves = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 10 to 12 months')->get();
    $this->SeventoNines = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 7 to 9 months')->get();
    $this->FourtoSixs = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 4 to 6 months')->get();
    $this->TwotoThrees = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 2 to 3 months')->get();
    $this->LastMonths = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'The last month')->get();
    $this->TwoWeekss = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', '2 weeks')->get();
    $this->LastWeeks = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'Last week')->get();
    $this->AfterWeddings = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'After the wedding')->get();

    $this->dispatch('taskUpdated');
    $this->dispatch('itemUpdated');
}

public function deleteLastWeek($lastWeekIndex){
    $LastWeek = $this->LastWeeks[$lastWeekIndex];
    // optional(ClientChecklist::find($LastWeek['id'])->delete($LastWeek));
    optional(ClientChecklist::find($LastWeek->id)->delete());
    $this->LastWeeks = ClientChecklist::where('c_id', '=', AUTH::id())->where('timing_period', '=', 'Last week')->get();

    $this->TentoTwelves = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 10 to 12 months')->get();
    $this->SeventoNines = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 7 to 9 months')->get();
    $this->FourtoSixs = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 4 to 6 months')->get();
    $this->TwotoThrees = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 2 to 3 months')->get();
    $this->LastMonths = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'The last month')->get();
    $this->TwoWeekss = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', '2 weeks')->get();
    $this->LastDays = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'Last day')->get();
    $this->AfterWeddings = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'After the wedding')->get();

    $this->dispatch('taskDelete');
    $this->dispatch('itemDelete');
}





public function createLastDay($lastDayIndex){
    $LastDay = $this->LastDays[$lastDayIndex];
    // $task = ClientChecklist::find($LastDay['id']);
    $task = ClientChecklist::find($LastDay->id);
    $selectedtask = $task->task_status;

    if($selectedtask == 1){
        $status = 0;
    }elseif($selectedtask == 0){
        $status = 1;
    }

    // optional(ClientChecklist::find($LastDay['id'])->update(['task_status' => $status ]));
    optional(ClientChecklist::find($LastDay->id)->update(['task_status' => $status ]));
    $this->LastDays = ClientChecklist::where('c_id', '=', AUTH::id())->where('timing_period', '=', 'Last day')->get();

    $this->TentoTwelves = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 10 to 12 months')->get();
    $this->SeventoNines = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 7 to 9 months')->get();
    $this->FourtoSixs = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 4 to 6 months')->get();
    $this->TwotoThrees = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 2 to 3 months')->get();
    $this->LastMonths = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'The last month')->get();
    $this->TwoWeekss = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', '2 weeks')->get();
    $this->LastWeeks = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'Last week')->get();
    $this->AfterWeddings = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'After the wedding')->get();

    $this->dispatch('taskUpdated');
    $this->dispatch('itemUpdated');
}

public function deleteLastDay($lastDayIndex){
    $LastDay = $this->LastDays[$lastDayIndex];
    // optional(ClientChecklist::find($LastDay['id'])->delete($LastDay));
    optional(ClientChecklist::find($LastDay->id)->delete());
    $this->LastDays = ClientChecklist::where('c_id', '=', AUTH::id())->where('timing_period', '=', 'Last day')->get();

    $this->TentoTwelves = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 10 to 12 months')->get();
    $this->SeventoNines = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 7 to 9 months')->get();
    $this->FourtoSixs = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 4 to 6 months')->get();
    $this->TwotoThrees = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 2 to 3 months')->get();
    $this->LastMonths = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'The last month')->get();
    $this->TwoWeekss = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', '2 weeks')->get();
    $this->LastWeeks = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'Last week')->get();
    $this->AfterWeddings = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'After the wedding')->get();


    $this->dispatch('taskDelete');
    $this->dispatch('itemDelete');
}



public function createAfterWedding($afterWeddingIndex){
    $AfterWedding = $this->AfterWeddings[$afterWeddingIndex];
    // $task = ClientChecklist::find($AfterWedding['id']);
    $task = ClientChecklist::find($AfterWedding->id);
    $selectedtask = $task->task_status;

    if($selectedtask == 1){
        $status = 0;
    }elseif($selectedtask == 0){
        $status = 1;
    }

    // optional(ClientChecklist::find($AfterWedding['id'])->update(['task_status' => $status ]));
    optional(ClientChecklist::find($AfterWedding->id)->update(['task_status' => $status ]));
    $this->AfterWeddings = ClientChecklist::where('c_id', '=', AUTH::id())->where('timing_period', '=', 'After the wedding')->get();

    $this->TentoTwelves = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 10 to 12 months')->get();
    $this->SeventoNines = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 7 to 9 months')->get();
    $this->FourtoSixs = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 4 to 6 months')->get();
    $this->TwotoThrees = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 2 to 3 months')->get();
    $this->LastMonths = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'The last month')->get();
    $this->TwoWeekss = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', '2 weeks')->get();
    $this->LastWeeks = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'Last week')->get();
    $this->LastDays = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'Last day')->get();

    $this->dispatch('taskUpdated');
    $this->dispatch('itemUpdated');

}

public function deleteAfterWedding($afterWeddingIndex){
    $AfterWedding = $this->AfterWeddings[$afterWeddingIndex];
    // optional(ClientChecklist::find($AfterWedding['id'])->delete($AfterWedding));
    optional(ClientChecklist::find($AfterWedding->id)->delete());
    $this->AfterWeddings = ClientChecklist::where('c_id', '=', AUTH::id())->where('timing_period', '=', 'After the wedding')->get();

    $this->TentoTwelves = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 10 to 12 months')->get();
    $this->SeventoNines = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 7 to 9 months')->get();
    $this->FourtoSixs = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 4 to 6 months')->get();
    $this->TwotoThrees = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 2 to 3 months')->get();
    $this->LastMonths = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'The last month')->get();
    $this->TwoWeekss = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', '2 weeks')->get();
    $this->LastWeeks = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'Last week')->get();
    $this->LastDays = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'Last day')->get();

    $this->dispatch('taskDelete');
     $this->dispatch('itemDelete');

}




public function taskAdded(){
    $this->TentoTwelves = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 10 to 12 months')->get();
    $this->SeventoNines = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 7 to 9 months')->get();
    $this->FourtoSixs = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 4 to 6 months')->get();
    $this->TwotoThrees = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'From 2 to 3 months')->get();
    $this->LastMonths = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'The last month')->get();
    $this->TwoWeekss = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', '2 weeks')->get();
    $this->LastWeeks = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'Last week')->get();
    $this->LastDays = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'Last day')->get();
    $this->AfterWeddings = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('timing_period', '=', 'After the wedding')->get();
    $this->TimePeriod = DB::table('client_checklists')->select('timing_period')->where('c_id', '=', AUTH::id())->groupBy('timing_period')->get();
    $this->TaskList = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->count();
    $this->allTasks = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->count();
    $this->completedTasks = DB::table('client_checklists')->where('c_id', '=', AUTH::id())->where('task_status', '=', 1)->count();
}

    public function render()
    {
        return view('livewire.wedding-checklist', [
            'TentoTwelves' => $this->TentoTwelves,
            'SeventoNines' => $this->SeventoNines,
            'FourtoSixs' => $this->FourtoSixs,
            'TwotoThrees' => $this->TwotoThrees,
            'LastMonths' => $this->LastMonths,
            'TwoWeekss' => $this->TwoWeekss,
            'LastWeeks' => $this->LastWeeks,
            'LastDays' => $this->LastDays,
            'AfterWeddings' => $this->AfterWeddings,
        ]);
    }
}
