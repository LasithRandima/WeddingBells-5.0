<div class="wrapper w-full md:max-w-5xl mx-auto pt-20 px-22" >
    <div>
        <form wire:submit="create" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            {{ $this->form }}
            {{-- <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}" /> --}}


            <div class="flex justify-end">
                <button type="submit" name="submit" class="bg-purple-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-5">
                    Create
                </button>
            </div>
        </form>
    </div>
</div>
