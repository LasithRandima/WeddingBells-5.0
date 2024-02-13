{{-- <div class="w-full h-auto flex flex-col items-center justify-center h-screen" >
    <div class="w-full h-auto" style="max-width: 60%; margin-top: 20px;  margin-bottom: 0px;">
    <form wire:submit="submit" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4>
        {{ $this->form }}
        <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}" />
    </form>
    </div>
</div> --}}

{{-- <div class="wrapper w-full md;max-w-5xl mx-auto pt-20 px-32" >
    {{ $this->form }}
</div> --}}

<div class="wrapper w-full md:max-w-5xl mx-auto pt-20 px-32" >
    <div>
        <form wire:submit="submit" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            {{ $this->form }}
            <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}" />
        </form>
    </div>
</div>
