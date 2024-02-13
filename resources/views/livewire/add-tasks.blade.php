<?php
use Illuminate\Support\Facades\DB;
$Category = DB::table('vendor_categories')->get();


?>

<div>
    <form class="mb-4" wire:submit="addTask">

        <div class="flex-fill mb-3">
        {{-- <label class="form-label" for="form2"></label> --}}
          <input type="text" id="form2" placeholder="New task..." class="form-control" wire:model.live="TaskName" />
          @error('TaskName')
          <p class="badge badge-danger">{{$message}}</p>
          @enderror
        </div>

        <div class="flex-fill mb-3 border-1">
            <input type="text" id="form2" placeholder="Description..." class="form-control" wire:model.live="TaskDescription" />
            @error('TaskDescription')
            <span class="badge badge-danger">{{$message}}</span>
             @enderror
        </div>
        <div class="flex-fill mb-3">
            <select id="form2" class="form-control form-outline" wire:model.live="TaskCategory" >
                <option selected>Select Catagory</option>
                @foreach ($Category as $cat)
                <option value="{{ $cat-> Category_name  }}">{{ $cat-> Category_name  }}</option>
                @endforeach
            </select>


            @error('TaskCategory')
            <span class="badge badge-danger">{{$message}}</span>
           @enderror
        </div>

        <div class="flex-fill mt-3">
            <select id="form2" class="form-control" wire:model.live="TaskDate">
                <option selected>Select Start Date</option>
                <option value="From 10 to 12 months">From 10 to 12 months</option>
                <option value="From 7 to 9 months">From 7 to 9 months</option>
                <option value="From 4 to 6 months">From 4 to 6 months</option>
                <option value="From 2 to 3 months">From 2 to 3 months</option>
                <option value="The last month">The last month</option>
                <option value="2 weeks">2 weeks</option>
                <option value="Last week">Last week</option>
                <option value="Last day">Last day</option>
                <option value="After the wedding">After the wedding</option>

            </select>

        @error('TaskDate')
        <span class="badge badge-danger">{{$message}}</span>
        @enderror
        </div>

        <div class="flex-fill mt-3">
            <input class="form-check-input me-2" type="checkbox" value="" aria-label="..." id="essential"  wire:model.live="EssentialTask"  />
            <label for="essential">Is Essential</label>

            @error('EssentialTask')
            <span class="badge badge-danger">{{$message}}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-rose-gold mt-3 mb-4">Add</button>
      </form>

      {{-- @if ($errors->all())
      <div class="alert alert-light" role="alert">
          @foreach($errors->all() as $error)
          <ul>
              <li>{{$error}} </li>
          </ul>
          @endforeach
      </div>
      @endif --}}


      {{-- @if ($errors->all())
          @foreach($errors->all() as $error)
          <span class="badge badge-danger">{{$error}}</span>
          @endforeach
      @endif --}}


</div>
