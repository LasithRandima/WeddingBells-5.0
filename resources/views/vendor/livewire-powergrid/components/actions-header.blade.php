@inject('helperClass','PowerComponents\LivewirePowerGrid\Helpers\Helpers')
@php
    if($action->singleParam) {
        $parameters = $helperClass->makeActionParameter($action->params);
    } else {
        $parameters = $helperClass->makeActionParameters($action->params);
    }
@endphp
@if($action->event !== '' && $action->to === '')
    <button wire:click='$dispatch("{{ $action->event }}", @json($parameters))'
       title="{{ $action->tooltip }}"
       id="{{ $action->id }}"
       class="power-grid-button {{ filled($action->class) ? $action->class : $theme->actions->headerBtnClass }}">
        {!! $action->caption !!}
    </button>
@elseif($action->event !== '' && $action->to !== '')
    <button wire:click='$emitTo("{{ $action->to }}", "{{ $action->event }}", @json($parameters))'
       title="{{ $action->tooltip }}"
       id="{{ $action->id }}"
       class="power-grid-button {{ filled($action->class) ? $action->class : $theme->actions->headerBtnClass }}">
        {!! $action->caption !!}
    </button>
@elseif($action->view !== '')
    <button wire:click='$dispatch("openModal", "{{$action->view}}", @json($parameters))'
       title="{{ $action->tooltip }}"
       id="{{ $action->id }}"
       class="power-grid-button {{ filled($action->class) ? $action->class : $theme->actions->headerBtnClass }}">
        {!! $action->caption !!}
    </button>
@else
    @if(strtolower($action->method) !== 'get')
        <form target="{{ $action->target }}"
              action="{{ route($action->route, $parameters) }}"
              method="{{ $action->method }}">
            @method($action->method)
            @csrf
            <button type="submit"
                    id="{{ $action->id }}"
                    title="{{ $action->tooltip }}"
                    class="power-grid-button {{ filled( $action->class) ? $action->class : $theme->actions->headerBtnClass }}">
                {!! $action->caption ?? '' !!}
            </button>
        </form>
    @else
        @if(data_get($action, 'route'))
        <a href="{{ route($action->route, $parameters) }}"
           id="{{ $action->id }}"
           title="{{ $action->tooltip }}"
           target="{{ $action->target }}"
           class="power-grid-button {{ filled($action->class) ? $action->class : $theme->actions->headerBtnClass }}">
            {!! $action->caption !!}
        </a>
        @endif
    @endif
@endif
