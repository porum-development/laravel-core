@extends('devplace::layouts.backend')

@section('breadcrumb')
    @include('devplace::layouts.partials.breadcrumb', ['items' => $breadcrumb ?? null])
@endsection

@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading p-5 clearfix">
            {{ __($params->name . ' Management') }}

            <div class="pull-right">
                <a href="{{ route('admin.' . strtolower($params->name) . '.create', [$locale]) }}"
                   class="btn btn-rounded btn-success mb-5">
                    <i class="fa fa-plus"></i> {{ __('New ' . $params->name) }}
                </a>
            </div>
        </h2>

        @component('devplace::components.ui.blocks.default')
            @slot('title')
                {{ __($params->name . ' list') }}
            @endslot

            @component('devplace::components.table.default')

                @slot('thead')
                    <th class="text-center" style="width: 50px;">#</th>
                    @foreach($params->fields as $field)
                        @if($field->visibleOnList)
                            @if($field->type == 'image')
                                <th style="width: 50px">{{ __($field->name) }}</th>
                            @else
                                <th>{{ __($field->name) }}</th>
                            @endif
                        @endif
                    @endforeach
                    <th class="text-center" style="width: 100px;">{{ __('Actions') }}</th>
                @endslot

                @foreach($records as $record)
                    <tr>
                        <th class="text-center" scope="row">
                            <a href="{{  route('admin.' . strtolower($params->name) . '.show', [$locale, $record]) }}">{{ $record->id }}</a>
                        </th>
                        @foreach($params->fields as $field)
                            @if($field->visibleOnList)
                                <td>
                                    @if($field->type == 'relation')
                                        @component('devplace::components.helpers.field', ['field' => $field, 'value' => $record->{$field->options->relationName}])@endcomponent
                                    @else
                                        @component('devplace::components.helpers.field', ['field' => $field, 'value' => $record->{$field->name}])@endcomponent
                                    @endif
                                </td>
                            @endif
                        @endforeach
                        <td class="text-center">
                            @component('devplace::components.table.column.actions', ['options' => ['show', 'edit', 'delete'], 'routeName' => strtolower($params->name), 'routeParams' => [$locale, $record]])@endcomponent
                        </td>
                    </tr>
                @endforeach
            @endcomponent

            <div class="row">
                <div class="col clear-fix">
                    <hr>
                    <div class="pull-right">
                        {!! $records->links() !!}
                    </div>
                </div>
            </div>
        @endcomponent
    </div>
    <!-- END Page Content -->
@endsection
