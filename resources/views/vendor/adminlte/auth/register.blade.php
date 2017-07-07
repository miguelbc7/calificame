@extends('adminlte::layouts.auth')

@section('htmlheader_title')
    Registrar
@endsection

@section('content')

<body class="hold-transition register-page">
    <div id="app" v-cloak>
        <div class="register-box">
            <div class="register-logo">
                <a href="{{ url('/') }}"><b>Keweno</b></a>
            </div>

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> {{ trans('adminlte_lang::message.someproblems') }}<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="register-box-body">
                <p class="login-box-msg">{{ trans('adminlte_lang::message.registermember') }}</p>

                <!--<register-form></register-form>-->

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('userstore') }}">
                        {{ csrf_field() }}

                        <div class="form-group has-feedback{{ $errors->has('company') ? ' has-error' : '' }}">

                            <div class="col-md-12">
                                <input id="company" type="text" class="form-control" placeholder="Nombre de la compañia" name="company" value="{{ old('company') }}" required autofocus>
                                <span class="glyphicon glyphicon-home form-control-feedback"></span>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control" placeholder="Correo Electrónico" name="email" value="{{ old('email') }}" required>
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control" placeholder="Contraseña" name="password" required>
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback">

                            <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control" placeholder="Vuelva a escribir la contraseña" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group has-feedback">
                            <div class="col-md-6">
                                <input type="checkbox" name="terms"><a href="">Términos y Condiciones</a>
                            </div><!-- /.col-lg-6 -->

                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary pull-right">
                                    Registrar
                                </button>
                            </div>

                        </div>


                    </form>

                @include('adminlte::auth.partials.social_login')

                <a href="{{ url('/logi') }}" class="text-center">{{ trans('adminlte_lang::message.membreship') }}</a>
            </div><!-- /.form-box -->
        </div><!-- /.register-box -->
    </div>

    @include('adminlte::layouts.partials.scripts_auth')

    @include('adminlte::auth.terms')

</body>

@endsection
