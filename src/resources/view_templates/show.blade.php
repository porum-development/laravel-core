@extends('devplace::layouts.backend')

@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading p-5 clearfix">
            {{ $record->name }}
            <small>
                ({{ __($params->name) }})
            </small>

            <div class="pull-right">
                <a href="{{ route('admin.' . strtolower($params->name) . '.edit', [$record]) }}"
                   class="btn btn-alt-warning btn-rounded mb-5">
                    <i class="fa fa-pencil"></i> {{ __('Edit ' . $params->name) }}
                </a>
                <a href="{{ route('admin.' . strtolower($params->name) . '.edit', [$record]) }}"
                   class="btn btn-alt-danger btn-rounded mb-5">
                    <i class="fa fa-trash"></i> {{ __('Delete ' . $params->name) }}
                </a>
            </div>
        </h2>

        @component('devplace::components.ui.blocks.default')
            @slot('title')
                {{ __($params->name . ' details') }}
            @endslot

            @component('devplace::components.table.default')
                @foreach($params->fields as $field)
                    <tr>
                        @if($field->type == 'image')
                            <th style="width: 50px">{{ __($field->name) }}</th>
                        @else
                            <th>{{ __($field->name) }}</th>
                        @endif
                        <td>
                            @component('devplace::components.helpers.field', ['field' => $field, 'value' => $record->{$field->name}])@endcomponent
                        </td>
                    </tr>
                @endforeach
            @endcomponent
        @endcomponent
    </div>
    <!-- END Page Content -->
@endsection