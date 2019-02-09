@extends('devplace::layouts.backend')

@section('breadcrumb')
    @include('devplace::layouts.partials.breadcrumb', ['items' => $breadcrumb ?? null])
@endsection

@section('content')
    <!-- Page Content -->
    <div class="content">
        {!! Form::open(['route' => ['admin.' . strtolower($params->name) . '.store', $locale], 'files' => true, 'method' => 'post']) !!}
        <h2 class="content-heading p-5 clearfix">
            {{ __('Creating ' . $params->name) }}

            <div class="pull-right">
                <a href="{{ route('admin.' . strtolower($params->name) . '.index', [$locale]) }}"
                   class="btn btn-alt-danger btn-rounded mb-5">
                    <i class="fa fa-arrow-left"></i> {{ __('Cancel Create') }}
                </a>
                <button type="submit"
                        class="btn btn-success btn-rounded mb-5">
                    <i class="fa fa-check"></i> {{ __('Create ' . $params->name) }}
                </button>
            </div>
        </h2>

        @component('devplace::components.ui.blocks.default')
            @slot('title')
                {{ __('Fill the form') }}
            @endslot

            @foreach($params->fields as $field)
                <div class="row">
                    <div class="col-12">
                        @if($field->onCreateForm)
                            @component('devplace::components.helpers.field_form', ['field' => $field])
                                @if($field->type == 'relation')
                                    {!! Form::dSelect($field->name, ${$field->options->on}, old($field->name)) !!}
                                @endif
                            @endcomponent
                        @endif
                    </div>
                </div>
            @endforeach
        @endcomponent
        <hr>
        <div class="pull-right">
            <a href="{{ route('admin.' . strtolower($params->name) . '.index', [$locale]) }}"
               class="btn btn-alt-danger btn-rounded mb-5">
                <i class="fa fa-arrow-left"></i> {{ __('Cancel Create') }}
            </a>
            <button type="submit"
                    class="btn btn-success btn-rounded mb-5">
                <i class="fa fa-check"></i> {{ __('Create ' . $params->name) }}
            </button>
        </div>

        {!! Form::close() !!}
    </div>
    <!-- END Page Content -->
@endsection
