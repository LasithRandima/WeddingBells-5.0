<?php

namespace app\Livewire;

use App\Models\ClientGuestList;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Livewire\Component;



class GuestTable extends Component
{
    protected $listeners = ['guestAdd'];
    public function guestAdd(){
        $guests = ClientGuestList::where('c_id', '=', AUTH::id())->orderBy('id','DESC')->get();
        return view('class GuestTable',['guests' => $guests]);
    }
    public function render()
    {
        $guests = ClientGuestList::where('c_id', '=', AUTH::id())->orderBy('id','DESC')->get();
        return view('livewire.guest-table',['guests' => $guests]);
    }
}
