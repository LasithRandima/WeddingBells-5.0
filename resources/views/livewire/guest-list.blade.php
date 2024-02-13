<div>
    <div class="container my-5">
        <form action="" wire:submit="addGuests">
            <div class="form-outline mb-4">
            <label class="form-label" for="Guest">Guest Name</label>
            <input type="text" id="Guest" class="form-control" wire:model.live="guestName" placeholder="Please enter Guest Name" />
            @error('guestName')
            <p class="badge badge-danger">{{$message}}</p>
            @enderror
            </div>

            <div class="form-outline mb-4">
            <label class="form-label" for="Contact">Contact No</label>
            <input type="number" id="Contact" class="form-control" wire:model.live="contactNo" placeholder="Please enter contact no" />
                @error('contactNo')
                <p class="badge badge-danger">{{$message}}</p>
                @enderror
            </div>

            <div class="form-outline mb-4">
                <label class="form-label" for="Email">Email</label>
                <input type="text" id="Email" class="form-control" wire:Model="email" placeholder="Please enter Email" />
                @error('email')
                <p class="badge badge-danger">{{$message}}</p>
                @enderror
            </div>

            <div class="form-outline mb-4">
            <label class="form-label" for="no_of_family_members">No of family members</label>
            <input type="number" id="no_of_family_members" class="form-control" wire:Model="familyMembers" placeholder="Please enter No of family members" />
            @error('familyMembers')
            <p class="badge badge-danger">{{$message}}</p>
            @enderror
            </div>


            <div class="form-outline mb-4">
                <label class="form-label" for="drinking_buddies_count">Drinking Buddies Count</label>
                <input type="number" id="drinking_buddies_count" class="form-control" wire:Model="drinkingBuddies" placeholder="Please enter Drinking Buddies Count" />
                @error('drinkingBuddies')
                <p class="badge badge-danger">{{$message}}</p>
                @enderror
            </div>


            <div class="form-outline mb-4">
                <label class="form-label" for="Group">Group</label>
                <select name="groups" id="Group" class="form-control" wire:model.live="group">
                    <option selected>Select Catagory</option>
                    <option value="Groom Side">Groom Side</option>
                    <option value="Bride Side">Bride Side</option>
                @error('group')
                <p class="badge badge-danger">{{$message}}</p>
                @enderror
            </div>

            <div class="form-outline mb-4">
                    <input type="checkbox" id="Status" wire:Model="hasConfirm" class="" />
                    <label class="form-label" for="Status">Has confirm</label>
                    @error('hasConfirm')
                    <p class="badge badge-danger">{{$message}}</p>
                    @enderror
            </div>



            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block mb-4">Add To Guest List</button>
          </form>

    </div>
</div>
