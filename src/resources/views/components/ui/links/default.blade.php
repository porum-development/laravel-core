<a class="link-effect text-muted mr-10 mb-5 d-inline-block {{ $class ?? '' }}"
   href="{{ $href }}">
    @if(isset($icon))
        <i class="fa {{ $icon }} mr-5"></i>
    @endif
    {{ $slot }}
</a>