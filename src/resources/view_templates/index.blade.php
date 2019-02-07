@extends('devplace::layouts.backend')

@section('content')
    <!-- Page Content -->
    <div class="content">
        <h2 class="content-heading p-5 clearfix">
            {{ __($params->name . ' Management') }}

            <div class="pull-right">
                <a href="{{ route('admin.' . strtolower($params->name) . '.create') }}" class="btn btn-success mb-5">
                    <i class="fa fa-plus"></i> {{ __('New ' . $params->name) }}
                </a>
            </div>
        </h2>

        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    {{ __($params->name . ' list') }}
                </h3>
                <div class="block-options">

                </div>
            </div>
            <div class="block-content">
                <table class="table table-hover table-vcenter">
                    <thead class="thead-light">
                    <tr>
                        <th class="text-center" style="width: 50px;">#</th>
                        @foreach($params->fields as $field)
                            @if($field->visibleOnList)
                                <th>{{ __($field->name) }}</th>
                            @endif
                        @endforeach
                        <th class="text-center" style="width: 100px;">{{ __('Actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
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
                                <div class="btn-group">
                                    <a href="{{ route('admin.' . strtolower($params->name) . '.edit', [$record]) }}" class="btn btn-sm btn-secondary js-tooltip-enabled"
                                            data-toggle="tooltip" title="" data-original-title="{{ __('Edit') }}">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-secondary js-tooltip-enabled"
                                            data-toggle="tooltip" title="" data-original-title="{{ __('Delete') }}">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!! $records->links() !!}
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
