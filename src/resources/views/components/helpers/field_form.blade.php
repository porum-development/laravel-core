@if($field->type == 'image')
   {{-- <img class="img-avatar img-avatar48"
         src="{{ $value ?? '/media/avatars/avatar0.jpg' }}"
         alt="{{ $value }}">--}}
@elseif($field->type == 'relation' && isset($field->options))
    {{--{{ __($value->{$field->options->display}) }}--}}
@elseif($field->type == 'secret')
    {!! Form::dPassword($field->name) !!}
@else
    {!! Form::dText($field->name, old($field->name)) !!}
@endif