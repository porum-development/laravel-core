@if(!is_null($items))
    <div class="bg-body-light border-b">
        <div class="content py-5 text-center">
            <nav class="breadcrumb bg-body-light mb-0">
                <a class="breadcrumb-item" href="{{ route('dashboard', [$locale]) }}">{{ config('app.name') }}</a>
                @foreach($items as $item)
                    @if(is_null($item['route']))
                        <span class="breadcrumb-item active">{{ __($item['name']) }}</span>
                    @else
                        <a class="breadcrumb-item" href="{{ $item['route'] }}">{{ __($item['name']) }}</a>
                    @endif
                @endforeach
            </nav>
        </div>
    </div>
@endif
