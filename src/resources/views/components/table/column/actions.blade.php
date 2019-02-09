<div class="btn-group">
    {{ $slot }}
    @if(in_array('show', $options))
        <a href="{{ route('admin.' . $routeName . '.show', $routeParams) }}"
           class="btn btn-sm btn-alt-info js-tooltip-enabled"
           data-toggle="tooltip" title="" data-original-title="{{ __('Show') }}">
            <i class="fa fa-eye"></i>
        </a>
    @endif
    @if(in_array('edit', $options))
        <a href="{{ route('admin.' . $routeName . '.edit', $routeParams) }}"
           class="btn btn-sm btn-alt-warning js-tooltip-enabled"
           data-toggle="tooltip" title="" data-original-title="{{ __('Edit') }}">
            <i class="fa fa-pencil"></i>
        </a>
    @endif
    <button type="button" class="btn btn-sm btn-alt-danger js-tooltip-enabled"
            data-toggle="tooltip" title="" data-original-title="{{ __('Delete') }}">
        <i class="fa fa-trash"></i>
    </button>
</div>

