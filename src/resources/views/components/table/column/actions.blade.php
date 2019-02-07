<div class="btn-group">
    {{ $slot }}
    <a href="{{ $edit }}"
       class="btn btn-sm btn-secondary js-tooltip-enabled"
       data-toggle="tooltip" title="" data-original-title="{{ __('Edit') }}">
        <i class="fa fa-pencil"></i>
    </a>
    <button type="button" class="btn btn-sm btn-secondary js-tooltip-enabled"
            data-toggle="tooltip" title="" data-original-title="{{ __('Delete') }}">
        <i class="fa fa-times"></i>
    </button>
</div>