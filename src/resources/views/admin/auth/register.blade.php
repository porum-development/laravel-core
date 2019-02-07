@extends('devplace::layouts.simple')

@section('content')
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

                    {!! Form::open(['route' => 'register', 'method' => 'post']) !!}
                    @dpBlock
                    @slot('title')
                        {{ __('Register') }}
                    @endslot
                    <div class="row">
                        <div class="col-12">
                            {!! Form::dText('name', old('name'), ['required', 'autofocus']) !!}
                            {!! Form::dText('email', old('email'), ['required']) !!}
                            {!! Form::dPassword('password', ['required']) !!}
                            {!! Form::dPassword('password_confirmation', ['required']) !!}
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col text-sm-right push">
                            {!! Form::dSubmit('Register', 'si-plus') !!}
                        </div>
                    </div>

                    @slot('footer')
                        <div class="form-group text-center clearfix">
                            <a class="link-effect text-muted mr-10 mb-5 d-inline-block pull-left" href="#" data-toggle="modal"
                               data-target="#modal-terms">
                                <i class="fa fa-book text-muted mr-5"></i> {{ __('Read Terms') }}
                            </a>

                            @dpLink(['href' => route('login'), 'icon' => 'fa-user', 'class' => 'pull-right'])
                            {{ __('Login') }}
                            @enddpLink

                        </div>
                    @endslot
                    @enddpBlock
                {!! Form::close() !!}
                <!-- END Sign Up Form -->
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->

    <!-- Terms Modal -->
    <div class="modal fade" id="modal-terms" tabindex="-1" role="dialog" aria-labelledby="modal-terms"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-slidedown" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Terms &amp; Conditions</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <p>Potenti elit lectus augue eget iaculis vitae etiam, ullamcorper etiam bibendum ad feugiat
                            magna accumsan dolor, nibh molestie cras hac ac ad massa, fusce ante convallis ante urna
                            molestie vulputate bibendum tempus ante justo arcu erat accumsan adipiscing risus, libero
                            condimentum venenatis sit nisl nisi ultricies sed, fames aliquet consectetur consequat
                            nostra molestie neque nullam scelerisque neque commodo turpis quisque etiam egestas
                            vulputate massa, curabitur tellus massa venenatis congue dolor enim integer luctus, nisi
                            suscipit gravida fames quis vulputate nisi viverra luctus id leo dictum lorem, inceptos nibh
                            orci.</p>
                        <p>Potenti elit lectus augue eget iaculis vitae etiam, ullamcorper etiam bibendum ad feugiat
                            magna accumsan dolor, nibh molestie cras hac ac ad massa, fusce ante convallis ante urna
                            molestie vulputate bibendum tempus ante justo arcu erat accumsan adipiscing risus, libero
                            condimentum venenatis sit nisl nisi ultricies sed, fames aliquet consectetur consequat
                            nostra molestie neque nullam scelerisque neque commodo turpis quisque etiam egestas
                            vulputate massa, curabitur tellus massa venenatis congue dolor enim integer luctus, nisi
                            suscipit gravida fames quis vulputate nisi viverra luctus id leo dictum lorem, inceptos nibh
                            orci.</p>
                        <p>Potenti elit lectus augue eget iaculis vitae etiam, ullamcorper etiam bibendum ad feugiat
                            magna accumsan dolor, nibh molestie cras hac ac ad massa, fusce ante convallis ante urna
                            molestie vulputate bibendum tempus ante justo arcu erat accumsan adipiscing risus, libero
                            condimentum venenatis sit nisl nisi ultricies sed, fames aliquet consectetur consequat
                            nostra molestie neque nullam scelerisque neque commodo turpis quisque etiam egestas
                            vulputate massa, curabitur tellus massa venenatis congue dolor enim integer luctus, nisi
                            suscipit gravida fames quis vulputate nisi viverra luctus id leo dictum lorem, inceptos nibh
                            orci.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-alt-success" data-dismiss="modal">
                        <i class="fa fa-check"></i> Perfect
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- END Terms Modal -->
@endsection
