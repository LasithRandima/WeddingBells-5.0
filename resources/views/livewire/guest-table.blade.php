<div>


    <div style="overflow-x: scroll;" class="px-5 pt-5">
        <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Guest Name</th>
            <th scope="col">Contact No</th>
            <th scope="col">Email</th>
            <th scope="col">No of family Members</th>
            <th scope="col">drinking_buddies_count</th>
            <th scope="col">group</th>
            <th scope="col">status</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($guests as $guest)
            <tr>
                <th scope="row">{{ $guest-> id }}</th>
                <td>{{ $guest ->  guest_name }}</td>
                <td>{{ $guest -> contact_no }}</td>
                <td>{{ $guest -> email }}</td>
                <td>{{ $guest -> no_of_family_members }}</td>
                <td>{{ $guest -> drinking_buddies_count }}</td>
                <td>{{ $guest -> group }}</td>
                <td><input type="checkbox" id="customSwitch1" {{ $guest -> status}}   disabled></td>
                <td>
                    <div class="d-flex">
                        <button type="button" wire:click="editBudget(  )" class="btn btn-primary" data-toggle="modal" data-target="#budgetModal" ><i class="far fa-edit"></i></button>
                        <button type="button" wire:click="deleteBudget(  )" class="btn btn-danger mx-2" data-toggle="modal" data-target="#deleteBudgetModal"><i class="fas fa-trash-alt"></i></button>
                    </div>
                </td>
              </tr>
            @endforeach

        </tbody>
      </table>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
            crossorigin="anonymous"></script>



</div>
