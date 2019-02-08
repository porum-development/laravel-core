<table class="table table-hover table-vcenter">
    @if(isset($thead))
        <thead class="thead-light">
        <tr>
            {!! $thead !!}
        </tr>
        </thead>
    @endif
    <tbody>
    {!! $slot !!}
    </tbody>
</table>