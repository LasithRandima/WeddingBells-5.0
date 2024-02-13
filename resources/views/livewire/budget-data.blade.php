<?php
use App\Models\ClientBudget;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

// $totEstimatedCost = ClientBudget::where('c_id', '=', AUTH::id())->sum('estimated_cost');
// $totFinalCost = ClientBudget::where('c_id', '=', AUTH::id())->sum('final_cost');
// $totAdvancePaid = ClientBudget::where('c_id', '=', AUTH::id())->sum('advance_paid');
// $totAmountToPaid = ClientBudget::where('c_id', '=', AUTH::id())->sum('amount_to_be_paid');

?>


<div>


    @include('livewire.budgetmodal')
    <div class="hero">
        @if (session()->has('message'))
       toastr.success('session('message')')
        @endif


        <div class="card bg-light mb-3" style="min-width: 44rem;">
            <div class="card-body">
                <div class="d-flex justify-content-between align-content-center">
                    <div class="dash_cards">
                        <img src="{{ asset('images/icons/money_bag_ruble_100px.png') }}" alt="" width="60px">
                        <h5 class="card-title mt-2">Estimated Budget Line</h5>
                        <p class="card-text"><strong> Rs. {{ $capital }}</strong></p>

                    </div>

                    <div class="dash_cards">
                        <img src="{{ asset('images/icons/fund_accounting_100px.png') }}" alt="" width="60px">
                        <h5 class="card-title mt-2">Total Estimated Cost</h5>
                        <p class="card-text">Rs. {{ $totEstimatedCost }}</p>
                    </div>

                    <div class="dash_cards">
                        <img src="{{ asset('images/icons/fund_accounting_100px.png') }}" alt="" width="60px">
                        <h5 class="card-title mt-2">Final Cost</h5>
                        <p class="card-text">Rs. {{ $totFinalCost }}</p>
                    </div>
                </div>

            </div>
        </div>

    <div class="container mt-3" style="overflow-x: scroll;">
        <div class="gradient-overlay-table">
        <div>
            <table class="table table-striped text-white">
                <thead>
                  <tr style="background-color: #C080C0; color: #EEE;">
                    <th scope="col">Expense</th>
                    <th scope="col">category</th>
                    <th scope="col">Estimate Cost</th>
                    <th scope="col">Final Cost</th>
                    <th scope="col">Advance Paid</th>
                    <th scope="col">Advance paid date</th>
                    <th scope="col">Amount To Paid</th>
                    <th scope="col">Final Cost paid_date</th>
                    <th scope="col">Paid Person Name</th>
                    <th scope="col">Has Paid</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>

                    @forelse($budgets as $bitem)

                    <tr>
                        <th scope="row">{{ $bitem -> exp_name }}</th>
                        <td>{{ $bitem -> exp_category }}</td>
                        <td>{{ $bitem -> estimated_cost }}</td>
                        <td>{{ $bitem -> final_cost }}</td>
                        <td>{{ $totAdvancePaid }}</td>
                        <td>{{ $bitem -> advance_paid_date }}</td>
                        <td>{{ $bitem -> amount_to_be_paid }}</td>
                        <td>{{ $bitem -> final_cost_paid_date }}</td>
                        <td>{{ $bitem -> paid_person_name }}</td>
                        <td><input type="checkbox" id="customSwitch1" {{ $bitem -> has_paid ? 'checked' : ''}}  disabled></td>
                        <td>
                        <div class="d-flex">
                                <button type="button" wire:click="editBudget( {{$bitem -> id}} )" class="btn btn-primary" data-toggle="modal" data-target="#budgetModal" ><i class="far fa-edit"></i></button>
                                <button type="button" wire:click="deleteBudget( {{$bitem -> id}} )" class="btn btn-danger mx-2" data-toggle="modal" data-target="#deleteBudgetModal"><i class="fas fa-trash-alt"></i></button>
                        </div>
                        </td>
                      </tr>

                      @empty
                      <tr>
                        <td colspan="11" class="text-center"> No Record Found</td>
                      </tr>
                    @endforelse

                    <tr style="background-color: #B08BDF; color: #EEE;">
                        <th scope="row">All Expenses Summary</th>
                        <td>All</td>
                        <td>{{ $totEstimatedCost }}</td>
                        <td>{{ $totFinalCost }}</td>
                        <td>{{ $totAdvancePaid }}</td>
                        <td>Not Specific</td>
                        <td>{{ $totAmountToPaid }}</td>
                        <td>Not Specific</td>
                        <td>All</td>
                        <td><input type="checkbox" id="customSwitch1" checked disabled></td>
                        <td>Summary</td>
                      </tr>

                </tbody>
              </table>

            </div>

        </div>

        <div class="my-3">
            {{ $budgets->links() }}

        </div>
    </div>

</div>


</div>





</div>
