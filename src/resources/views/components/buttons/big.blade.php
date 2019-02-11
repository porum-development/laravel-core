<div class="col-6 col-md-4 col-xl-2">
    <a class="block block-rounded text-center" href="{{ $href }}">
        <div class="block-content">
            <p class="mt-5 mb-10">
                <i class="fa {{ $icon }} text-gray fa-2x d-xl-none"></i>
                <i class="fa {{ $icon }} text-gray fa-3x d-none d-xl-inline-block"></i>
            </p>
            <p class="font-w600 font-size-sm text-uppercase">{{ $slot }}</p>
        </div>
    </a>
</div>