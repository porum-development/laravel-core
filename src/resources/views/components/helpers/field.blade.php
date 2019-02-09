@if($field->type == 'image')
    @if(!is_null($value))
        <img class="img-avatar img-avatar48"
             src="{{ filter_var($value, FILTER_VALIDATE_URL) ? $value : asset('storage/' . str_replace('public', '', $value)) }}"
             alt="{{ $field->name }}">
    @else
        <img class="img-avatar img-avatar48"
             src="/media/avatars/avatar0.jpg"
             alt="{{ __('No image') }}">
    @endif
@elseif($field->type == 'relation' && isset($field->options))
    {{ __($value->{$field->options->display}) }}
@elseif($field->type == 'datetime')
    {!! !is_null($value) ? $value->format(__('Y-m-d h:i:s')) : '-' !!}
@elseif($field->type == 'secret')
    ******
@else
    {{ $value }}
@endif
