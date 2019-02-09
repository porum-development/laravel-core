@extends('devplace::layouts.backend')

@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading p-5 clearfix">
            {{ __($params->name . ' Management') }}

            <div class="pull-right">
                <a href="{{ route('admin.' . strtolower($params->name) . '.create', [$locale]) }}" class="btn btn-rounded btn-success mb-5">
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
                        <th class="text-center" scope="row">{{ $record->id }}</th>
                        @foreach($params->fields as $field)
                            @if($field->visibleOnList)
                                <td>
                                    @if($field->type == 'image')
                                        <img class="img-avatar img-avatar48"
                                             src="{{ $record->{$field->name} ?? '/media/avatars/avatar0.jpg' }}"
                                             alt="{{ $record->{$field->name} }}">
                                    @else
                                        {{ $record->{$field->name} }}
                                    @endif
                                </td>
                            @endif
                        @endforeach
                        <td class="text-center">
                            @component('devplace::components.table.column.actions', ['edit' => route('admin.' . strtolower($params->name) . '.edit', [$locale, $record])])@endcomponent
                        </td>
                    </tr>
                @endforeach
            @endcomponent

            {!! $records->links() !!}
        @endcomponent


    </div>
    <!-- END Page Content -->
@endsection
