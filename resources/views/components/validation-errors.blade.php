@if ($errors->any())
    <div {{ $attributes }}>
        <div style="font-weight: 500; color: #800000;;">{{ __('Whoops! Something went wrong') }}</div>


        <ul class="mt-3 list-disc list-inside text-sm" style="color: #800000;">
           
        
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
