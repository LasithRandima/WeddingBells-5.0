<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

$Categories = DB::table('vendor_categories')->get();
$client = AUTH::id();
$capital = DB::scalar("select budget from client_capitals where c_id = '$client'");
$budgetlist = DB::table('client_budgets')->get();
?>



<div>


    <div class="hero">
        <div class="gradient-overlay">
            <h2 class=text-center>Your Wedding Budget Planner</h2>

            <h3 class=text-center>Embrace each expense with love.</h3>
                <p class=text-center>Embark on your wedding journey by sharing your initial budget line with us,<br> allowing us to tailor your expenses seamlessly</h3>
            <br>So that We can craft your dream wedding by managing your budget effectively.<br> Fill out the details below to get started!</p>


    @if (!$capital)
    <form action="" wire:submit="addCapital">
        <div class="input-group iconwrapper">
          <input type="text" id="budget" class="events" wire:model.live="budgetLine">
          <label for="budget"><i class="fa fa-calendar" right-6 aria-hidden="true"></i> Budget Line</label>
          @error('budgetLine')
          <p class="badge badge-danger">{{$message}}</p>
          @enderror
        </div>
        <button type="submit" class="event-btn">Set Budget Line <i class="fa fa-plus" aria-hidden="true"></i></button>
    </form>
    @else
    <form action="" wire:submit="updateCapital">
        <div class="input-group iconwrapper">
          <input type="text" id="updatebudgets" class="events"  wire:model.live="updateBudgetLine">
          <label for="updatebudget"><i class="fa fa-calendar" right-6 aria-hidden="true"></i> Current Budget Line - Rs.{{ $capital }}</label>
          @error('budgetLine')
          <p class="badge badge-danger">{{$message}}</p>
          @enderror
        </div>
        <button type="submit" class="event-btn">Update Budget Line <i class="fa fa-plus" aria-hidden="true"></i></button>
    </form>
    @endif





    <h4 class="text-center mb-2" style="color: ##DAA520 !important">Let's warmly embrace <br>the joy of recording your expenses one by one.</h4>
        <form action="" wire:submit="addBudget">
            <div class="input-group iconwrapper">
              <input type="text" id="expanse" class="events" wire:model.live="expanse">
              <label for="expanse"><i class="fa fa-calendar" right-6 aria-hidden="true"></i> Expanse</label>
              @error('expanse')
              <p class="badge badge-danger">{{$message}}</p>
              @enderror
            </div>
            <div class="input-group iconwrapper select-cats">
                <select name="vendor_cat" id="category" class="events" wire:model.live="Category">
                    <option selected>Select Catagory</option>
                    @foreach ($Categories as $cat)
                    <option value="{{ $cat-> Category_name  }}">{{ $cat-> Category_name  }}</option>
                    @endforeach
                </select>
                <label for="category" class="select-cat"><i class="fa fa-calendar" right-6 aria-hidden="true"></i> category</label>
                @error('Category')
                <p class="badge badge-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="input-group iconwrapper">
                <input type="number" id="ecost" class="events" wire:model.live="estimateCost">
                <label for="ecost"><i class="fa fa-calendar" right-6 aria-hidden="true"></i> Estimate Cost</label>
                @error('estimateCost')
                <p class="badge badge-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="input-group iconwrapper">
                <input type="number" id="fcost" class="events" wire:model.live="finalCost">
                <label for="fcost"><i class="fa fa-calendar" right-6 aria-hidden="true"></i> Final Cost</label>
                @error('finalCost')
                <p class="badge badge-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="input-group iconwrapper">
                <input type="number" id="advance" class="events" wire:model.live="advancePaid">
                <label for="advance"><i class="fa fa-calendar" right-6 aria-hidden="true"></i> Advance Paid</label>
                @error('advancePaid')
                <p class="badge badge-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="input-group iconwrapper">
                <input type="date" id="advancedate" class="events" wire:model.live="advancePaidDate">
                <label for="advancedate"><i class="fa fa-calendar" right-6 aria-hidden="true"></i> Advance Paid Date</label>
                @error('advancePaidDate')
                <p class="badge badge-danger">{{$message}}</p>
                @enderror
            </div>
            {{-- <div class="input-group iconwrapper">
                <input type="number" id="amonttopaids" class="events" wire:model.live="amounttoPaid">
                <label for="amonttopaids"><i class="fa fa-calendar" right-6 aria-hidden="true"></i> Amount to be Paid</label>
                @error('amounttoPaid')
                <p class="badge badge-danger">{{$message}}</p>
                @enderror
            </div> --}}

            <div class="input-group iconwrapper">
                <input type="date" id="paydate" class="events" wire:model.live="paymentDueDate">
                <label for="paydate"><i class="fa fa-calendar" right-6 aria-hidden="true"></i> Payment Due Date</label>
                @error('paymentDueDate')
                <p class="badge badge-danger">{{$message}}</p>
                @enderror
            </div>
            <div class="input-group iconwrapper">
            <input type="text" id="person" class="events" wire:model.live="paidPersonName">
            <label for="person"><i class="fa fa-calendar" right-6 aria-hidden="true"></i> Paid Person Name</label>
            @error('paidPersonName')
            <p class="badge badge-danger">{{$message}}</p>
            @enderror
          </div>

          <div class="input-group iconwrapper" style="display:flex; margin-top:-20px; padding-left:10px;">
            <div style="display:flex; flex-direction:row; justify-content:start; align-content:center;">
                <div><input type="checkbox" id="paid" class="" style="margin-top: -10px; margin:0;" wire:model.live="hasPaid"></div>
                <div><label for="paid" style="padding-top: 0px; margin-left: 20px; margin-bottom: -20px;"> Has Paid?</label></div>
            </div>
            @error('hasPaid')
            <p class="badge badge-danger">{{$message}}</p>
            @enderror
        </div>

            <button type="submit" class="event-btn">Add To Budget <i class="fa fa-plus" aria-hidden="true"></i></button>

        </form>


    </div>
</div>






    <script>
        document.addEventListener('livewire:init', function () {
            let weddingcapital = $capital;
            $(document).ready(function(){
                $("#updatebudgets").val(10000);
            });
        })
    </script>

</div>
