<div class="form-group">
    {{ Form::label(__($name), null) }}
    {{ Form::select($name, $options, $value, array_merge(['class' => $errors->has($name) ? 'form-control is-invalid' : 'form-control'], $attributes)) }}

    @if ($errors->has($name))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first($name) }}</strong>
        </span>
    @endif
</div>
