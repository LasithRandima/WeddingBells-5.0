<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

$Categories = DB::table('vendor_categories')->get();
$client = AUTH::id();
$capital = DB::scalar("select budget from client_capitals where c_id = '$client'");
// $listbudget = DB::table('client_budgets')->where('c_id', '=', AUTH::id())->get();
?>


<div>



<!-- Modal -->
<div wire:ignore.self class="modal fade" id="budgetModal" tabindex="-1" role="dialog" aria-labelledby="updateBudgetModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="updateBudgetModalLabel">Edits Budget</h5>
          <button type="button" class="close" wire:click="closeModal" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body modal-form">



            <form wire:submit="updateBudget">
                <div class="input-group iconwrapper">
                  <input type="text" id="expense" class="events" wire:model.live="expense">
                  <label for="expense"><i class="fa fa-calendar" right-6 aria-hidden="true"></i> Expense</label>
                  @error('expense')
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
                    <label for="ecost"><i class="fa fa-calendar" right-6 aria-hidden="true"></i> Estimated Cost</label>
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
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" wire:click="closeModal" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>

            </form>



      </div>
    </div>
  </div>


  {{-- delete modal --}}



  <div wire:ignore.self class="modal fade" id="deleteBudgetModal" tabindex="-1" role="dialog" aria-labelledby="deleteBudgetModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteBudgetModalLabel">Delete Budget Items</h5>
          <button type="button" class="close" wire:click="closeModal" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body modal-form">
            <p class="font-weight-bold mb-2 text-danger"> Are you sure you wanna delete this ?</p><p class="text-muted "> Note -> You can't Recover this</p>
            <form wire:submit="destroyBudget">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" wire:click="closeModal" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Delete</button>
        </div>

            </form>



      </div>
    </div>
  </div>








</div>

