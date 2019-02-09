<div class="form-group">
    {{ Form::label($name, null) }}
    {{ Form::file($name, array_merge(['class' => $errors->has($name) ? 'form-control is-invalid' : 'form-control'], $attributes)) }}

    @if ($errors->has($name))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first($name) }}</strong>
        </span>
    @endif
</div>
