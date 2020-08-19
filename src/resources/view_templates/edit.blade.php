@extends('porum::layouts.backend')

@section('breadcrumb')
    @include('porum::layouts.partials.breadcrumb', ['items' => $breadcrumb ?? null])
@endsection

@section('content')
    <!-- Page Content -->
    <div class="content">
        {!! Form::model($record, ['route' => ['admin.' . strtolower($params->name) . '.update', $locale, $record], 'files' => true, 'method' => 'put']) !!}
        <h2 class="content-heading p-5 clearfix">
            {{ $record->name }}
            <small>
                ({{ __($params->name) }})
            </small>

            <div class="pull-right">
                <a href="{{ route('admin.' . strtolower($params->name) . '.show', [$locale, $record]) }}"
                   class="btn btn-alt-danger btn-rounded mb-5">
                    <i class="fa fa-arrow-left"></i> {{ __('Cancel Edit') }}
                </a>
                <button type="submit"
                        class="btn btn-success btn-rounded mb-5">
                    <i class="fa fa-check"></i> {{ __('Save ' . $params->name) }}
                </button>
            </div>
        </h2>

        @component('porum::components.ui.blocks.default')
            @slot('title')
                {{ __('Editing ' . $params->name) }}
            @endslot

            @foreach($params->fields as $field)
                <div class="row">
                    <div class="col-12">
                        @if($field->onEditForm)
                            @component('porum::components.helpers.field_form', ['field' => $field])
                                @if($field->type == 'relation')
                                    {!! Form::dSelect($field->name, ${$field->options->on}, $record->{$field->options->column}) !!}
                                @endif
                            @endcomponent
                        @endif
                    </div>
                </div>
            @endforeach
        @endcomponent
        <hr>
        <div class="pull-right">
            <a href="{{ route('admin.' . strtolower($params->name) . '.show', [$locale, $record]) }}"
               class="btn btn-alt-danger btn-rounded mb-5">
                <i class="fa fa-arrow-left"></i> {{ __('Cancel Edit') }}
            </a>
            <button type="submit"
                    class="btn btn-success btn-rounded mb-5">
                <i class="fa fa-check"></i> {{ __('Save ' . $params->name) }}
            </button>
        </div>

        {!! Form::close() !!}
    </div>
    <!-- END Page Content -->
@endsection
