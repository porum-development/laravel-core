<div class="block {{ isset($bg) ? 'block-themed' : ''}} block-rounded block-shadow">
    <div class="block-header {{ $bg ?? 'block-header-default' }}">
        <h3 class="block-title">{{ $title }}</h3>
    </div>
    <div class="block-content">
        {{ $slot }}
    </div>
    @if(isset($footer))
        <div class="block-content bg-body-light">
            {{ $footer }}
        </div>
    @endif
</div>