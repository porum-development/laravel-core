@extends('devplace::layouts.simple')

@section('content')
    <!-- Page Content -->
    <div class="bg-body-dark bg-pattern">
        <div class="row mx-0 justify-content-center">
            <div class="hero-static col-lg-6 col-xl-4">
                <div class="content content-full overflow-hidden">
                    <!-- Header -->
                    <div class="py-30 text-center">
                        <a class="link-effect font-w700" href="/">
                            <img src="https://devplace.com.br/wp-content/uploads/2018/01/logo-horizontal-500-175-e1516125454261.png"
                                 alt="">
                        </a>
                    </div>
                    <!-- END Header -->

                    {!! Form::open(['route' => 'login', 'method' => 'post']) !!}
                    @dpBlock
                        @slot('title')
                            {{ __('Login') }}
                        @endslot

                        <div class="row">
                            <div class="col-12">
                                {!! Form::dText('email', old('email'), ['required', 'autofocus']) !!}
                                {!! Form::dPassword('password', ['required']) !!}
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-sm-6 d-sm-flex align-items-center push">
                                <div class="custom-control custom-checkbox mr-auto ml-0 mb-0">
                                    <input class="custom-control-input" type="checkbox" name="remember"
                                           id="login-remember-me" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label"
                                           for="login-remember-me">{{ __('Remember Me') }}</label>
                                </div>
                            </div>
                            <div class="col-sm-6 text-sm-right push">
                                {!! Form::dSubmit('Login') !!}
                            </div>
                        </div>

                    <div class="row">
                        <div class="col text-center">
                            <a class="loginBtn loginBtn-facebook mb-15 mr-5" href="{{ route('login.social', ['facebook']) }}">
                                {{ __('Login with Facebook') }}
                            </a>

                            <a class="loginBtn loginBtn-google mb-15 mr-5" href="{{ route('login.social', ['google']) }}">
                                {{ __('Login with Google') }}
                            </a>
                        </div>
                    </div>

                        @slot('footer')
                            <div class="form-group text-center clearfix">
                                @dpLink(['href' => route('register'), 'icon' => 'fa-plus', 'class' => 'pull-left'])
                                    {{ __('Create Account') }}
                                @enddpLink

                                @if (Route::has('password.request'))
                                    @dpLink(['href' => route('password.request'), 'icon' => 'fa-warning', 'class' => 'pull-right'])
                                    {{ __('Forgot Your Password?') }}
                                    @enddpLink
                                @endif
                            </div>
                        @endslot
                    @enddpBlock
                {!! Form::close() !!}
                <!-- END Sign In Form -->
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection