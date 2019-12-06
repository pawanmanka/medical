<select

@if (!empty($parameters['id']))
    id="{{ $parameters['id'] }}"
@endif

@if (!empty($parameters['class']))
    class="{{ $parameters['class'] }}"
@endif

@if (!empty($parameters['size']))
    size="{{ $parameters['size'] }}"
@endif
@if (!empty($parameters['selected_option']))
    selected_option="{{ $parameters['selected_option'] }}"
@endif

@if (!empty($parameters['multiple']))
    multiple
    name="{{ $name }}[]"
@else
    name="{{ $name }}"
@endif

@if (!empty($parameters['required']))
    required
@endif

@if (!empty($parameters['autofocus']))
    autofocus
@endif

@if (!empty($parameters['disabled']))
    disabled
@endif
>
@if(!empty($parameters['empty']))
    <option value="">
        @if (is_string($parameters['empty']))
            {{ $parameters['empty'] }}
        @endif
    </option>
@endif
@foreach($parameters['options'] as $option => $text)
    <option value="{{ $option }}"
        @if (
            is_scalar($parameters['value']) && $option == $parameters['value']
            || is_array($parameters['value']) && in_array($option, $parameters['value'])
        )
            selected
        @endif
    >{{ $text }}</option>
@endforeach
</select>