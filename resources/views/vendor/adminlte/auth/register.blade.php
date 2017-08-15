@extends('adminlte::layouts.auth')

@section('htmlheader_title')
    Registrar
@endsection

@section('content')

<body class="hold-transition register-page" style="margin-top: -60px;">
    <div id="app" v-cloak>
        <div class="register-box">
            <div class="register-logo">
                <img alt="calificame" class="nav__logo" src="{{ asset('web/images/logo.png') }}" width="300" height="70"></a>
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

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('saveuser') }}">
                        {{ csrf_field() }}

                        <div class="form-group has-feedback{{ $errors->has('type') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                {!!Form::select('type', ['1' => '1 mes', '2' => '3 meses', '3'=>'6 meses', '4'=>'12 meses'], null, ['class'=>'form-control', 'placeholder' => 'Seleccione un plan'])!!}
                            </div>
                        </div>

                        <div class="form-group has-feedback{{ $errors->has('pay') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                {!!Form::select('pay', ['1' => 'Paypal', '2' => 'Otro metodo'], null, ['class'=>'form-control', 'placeholder' => 'Seleccione un metodo de pago'])!!}
                            </div>
                        </div>

                        <div class="form-group has-feedback{{ $errors->has('branch') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <input id="branch" type="number" class="form-control" placeholder="Numero de sucursales" name="branch" value="{{ old('branch') }}" required>

                                @if ($errors->has('branch'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('branch') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

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

                        <div class="form-group has-feedback{{ $errors->has('avatar') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                {!!Form::label('Avatar')!!}
                                {!!Form::file('avatar',null,['class'=>'form-control', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
                            </div>
                        </div>

                        <div class="form-group has-feedback">
                            <div class="col-md-6">
                                <input type="checkbox" name="terms"><a href="">Términos y Condiciones</a>
                            </div><!-- /.col-lg-6 -->

                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">Guardar</button>
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
