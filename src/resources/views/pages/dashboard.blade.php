@extends('devplace::layouts.backend')

@section('content')
    <!-- Page Content -->
    <div class="content">
        <!-- Table Infos -->
        <div class="row">
            <div class="col">
                    Seja bem vindo <strong>{{ auth()->user()->name }}</strong>
            </div>
        </div>
        <!-- END Table Infos -->
    </div>
    <!-- END Page Content -->
@endsection
