<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Encuesta de {{ $user->company }}</title>
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('web/css/survey.css') }}">
    <link href="{{ asset('web/images/favicon-32.fw.png') }}" rel="shortcut icon" type="image/x-icon">
    <link href="{{ asset('web/images/favicon-256.fw.png') }}" rel="apple-touch-icon">
</head>

<body>
    <!--<div class="center">
        <img id="preloader" src="{{ asset('web/images/preloader4.gif') }}" alt="">
    </div>-->
{!!Form::model($answer2,['route'=>['answers.update', $answer2],'method'=>'PUT', 'files' => true])!!}
    <nav id="hola" class="navbar navbar-inverse animated">
        <div class="container-fluid">
            <div class="centro">
                <img class="imgnav animated bounceInLeft" height="50px" width="250px" src="{{ asset('web/images/logotrans.png') }}" alt="">
            </div>
        </div>
    </nav>
    <div class="thumbnail center fondo animated">
    <div class="margin">
        <h3 class="center pregunta">Y por ultimo, ¿quien te atendió?</h3>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        @if(isset($waiters))
            @foreach($waiters as $w)
                @if($wait == 1)
                <div class="col-lg-12 col-xs-12">
                    <input type="radio" name="radio" id="{{ $w->id }}" value="{{ $w->id }}" class="input-hidden" />
                    <label for="{{ $w->id }}">
                    <img class="img-circle" src="{{ asset($w->url) }}" alt="" width="100" height="100" />
                    <br>
                    {{ $w->name }}
                    </label>
                </div>
                @elseif($wait == 2)
                <div class="col-lg-6 col-xs-12">
                    <input type="radio" name="radio" id="{{ $w->id }}" value="{{ $w->id }}" class="input-hidden" />
                    <label for="{{ $w->id }}">
                    <img class="img-circle" src="{{ asset($w->url) }}" alt="" width="100" height="100" />
                    <br>
                    {{ $w->name }}
                    </label>
                </div>
                @elseif($wait > 2)
                <div class="col-lg-3 col-xs-12">
                    <input type="radio" name="radio" id="{{ $w->id }}" value="{{ $w->id }}" class="input-hidden" />
                    <label for="{{ $w->id }}">
                    <img class="img-circle" src="{{ asset($w->url) }}" alt="" width="100" height="100" />
                    <br>
                    {{ $w->name }}
                    </label>
                </div>
                @endif
            @endforeach
        @else
            <h1>DEBES REGISTRAR MESEROS EN EL PANEL ADMINISTRATIVO</h1>
        @endif
      </div>
    </div>
    <div class="row">
        {!!Form::submit('No lo recuerdo!!',['class'=>'btn btn-default', 'name' => 'button1', 'value'=>'button1'])!!}
        {!!Form::submit('He Terminado!!',['class'=>'btn btn-primary', 'name' => 'button2', 'value'=>'button2'])!!}
    </div>
</div>
{!!Form::close()!!}

<script
  src="https://code.jquery.com/jquery-3.2.1.js"
  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
  crossorigin="anonymous"></script>
<script src="{{ asset('web/js/main.js') }}"></script>
<script src="{{ asset('web/js/bootstrap.min.js') }}"></script>

</body>

</html>