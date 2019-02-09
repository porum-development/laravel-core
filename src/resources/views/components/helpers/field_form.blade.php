@if($field->type == 'image')
   {{-- <img class="img-avatar img-avatar48"
         src="{{ $value ?? '/media/avatars/avatar0.jpg' }}"
         alt="{{ $value }}">--}}
   {!! Form::dFile($field->name) !!}
@elseif($field->type == 'relation')
    {!! $slot !!}
@elseif($field->type == 'secret')
    {!! Form::dPassword($field->name) !!}
@elseif($field->type == 'datetime')
    {!! Form::dDatetime($field->name) !!}
@elseif($field->type == 'email')
    {!! Form::dEmail($field->name) !!}
@else
    {!! Form::dText($field->name, old($field->name)) !!}
@endif
