@extends('porum::layouts.simple')

@section('content')
    <div class="bg-body-dark bg-pattern">
        <div class="row mx-0 justify-content-center">
            <div class="hero-static col-lg-6 col-xl-4">
                <div class="content content-full overflow-hidden">
                    <!-- Header -->
                    <div class="py-30 text-center">
                        <a class="link-effect font-w700" href="/">
                            <img src="{{ asset('media/logo.png') }}"
                                 alt="">
                        </a>
                    </div>
                    <!-- END Header -->

                    @component('porum::components.ui.blocks.default', ['bg' => 'bg-gd-aqua'])
                        @slot('title')
                            {{ __('Reset Password') }}
                        @endslot

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email', $locale) }}">
                            @csrf

                            <div class="row">
                                <div class="col-12">
                                    {!! Form::dText('email', old('email'), ['required', 'autofocus']) !!}
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col text-sm-right push">
                                    {!! Form::dSubmit('Send Password Reset Link') !!}
                                </div>
                            </div>
                        </form>

                        @slot('footer')
                            <div class="form-group text-center clearfix">
                                @component('porum::components.ui.links.default', ['href' => route('login', [$locale]), 'icon' => 'fa-arrow-left', 'class' => 'pull-left'])
                                    {{ __('Login') }}
                                @endcomponent
                            </div>
                    @endslot
                @endcomponent
                <!-- END Sign Up Form -->
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
