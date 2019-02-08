@extends('devplace::layouts.backend')

@section('content')
    <!-- Page Content -->
    <div class="content">
        {!! Form::model($record, ['route' => ['admin.' . strtolower($params->name) . '.update', $record]]) !!}
        <h2 class="content-heading p-5 clearfix">
            {{ $record->name }}
            <small>
                ({{ __($params->name) }})
            </small>

            <div class="pull-right">
                <a href="{{ route('admin.' . strtolower($params->name) . '.show', [$record]) }}"
                   class="btn btn-alt-danger btn-rounded mb-5">
                    <i class="fa fa-arrow-left"></i> {{ __('Cancel Edit') }}
                </a>
                <button type="submit"
                        class="btn btn-success btn-rounded mb-5">
                    <i class="fa fa-check"></i> {{ __('Save ' . $params->name) }}
                </button>
            </div>
        </h2>

        @component('devplace::components.ui.blocks.default')
            @slot('title')
                {{ __('Editing ' . $params->name) }}
            @endslot

            @component('devplace::components.table.default')
                @foreach($params->fields as $field)
                    <div class="row">
                        <div class="col-12">
                            @component('devplace::components.helpers.field_form', ['field' => $field])@endcomponent
                        </div>
                    </div>
                @endforeach
            @endcomponent
        @endcomponent
        {!! Form::close() !!}
    </div>
    <!-- END Page Content -->
@endsection
