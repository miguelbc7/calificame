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
    {!!Form::open(['route'=>'answers.store', 'method'=>'POST', 'files' => true])!!}
   <nav id="hola" class="navbar navbar-inverse animated fadeIn">
        <div class="container-fluid">
            <div class="centro">
                <img class="imgnav animated bounceInLeft" height="50px" width="250px" src="{{ asset('web/images/logotrans.png') }}" alt="">
            </div>
            {!!Form::email('email', null, ['class'=>'posiinput pull-right hidden-xs', 'placeholder'=>'Correo electronico'])!!}
            {!!Form::text('name', null, ['class'=>'posiinput pull-right hidden-xs', 'placeholder'=>'Nombre completo'])!!}
            {!!Form::hidden('survey_id',$surveys->id)!!} 
        </div>
    </nav>
    <div class="thumbnail center fondo animated fadeIn">
        <div class="margin">
            <img class="imglogo img-circle animated  pulse" width="200px" height="180px" src="{{ asset($user->avatar) }}" alt="logo">
        </div>
        @foreach($surquestions as $sq)
            <input type="hidden" name="question_id{{ $sq->position }}" value="{{ $sq->question_id }}">
            
            @if($sq->type == 1)

            <div class="margin">
                <h3 class="center pregunta">{{ $sq->question }}</h3>
            </div>
            <div class="row">
                <div class="col-lg-12 col-xs-12 MarginDirecto">
                    <div class="centrardirecta">
                        <label class="posicion{{ $sq->position }}">
                            <input type="radio" class="option-input radio" id="option{{ $sq->position }}" name="option{{ $sq->position }}" value="1" checked /> Si
                        </label>
                        <label class="posicion{{ $sq->position }}">
                            <input type="radio" class="option-input radio" id="option{{ $sq->position }}" name="option{{ $sq->position }}" value="2" /> No
                        </label>
                    </div>
                </div>
                <div class="col-lg-12 col-xs-12">
                    {!!Form::textarea('comment'.$sq->position,null,['class'=>'textarea', 'placeholder' => 'Agregar comentario adicional...'])!!}
                    <br>
                </div>
            </div>
            <hr class="hr hidden-xs">

            @elseif($sq->type == 2)

            <div class="margin">
                <h3 class="center pregunta">{{ $sq->question }}</h3>
            </div>
            <div class="row">
                <div class="col-lg-12 col-xs-12">
                    <div class="centrarindirecta">
                        <label class="posicionInLine posicion0">
                            <input type="radio" class="option-input radio" id="option{{ $sq->position }}" name="option{{ $sq->position }}" value="6" checked /> Excelente
                        </label>
                        <label class="posicionInLine posicionbueno">
                            <input type="radio" class="option-input radio" id="option{{ $sq->position }}" name="option{{ $sq->position }}" value="5" /> Bueno
                        </label>
                        <label class="posicionInLine posicion0">
                            <input type="radio" class="option-input radio" id="option{{ $sq->position }}" name="option{{ $sq->position }}" value="4" /> Regular
                        </label>
                        <label class="posicionInLine posicion2">
                            <input type="radio" class="option-input radio" id="option{{ $sq->position }}" name="option{{ $sq->position }}" value="3" /> Malo
                        </label>
                    </div>
                </div>
                <div class="col-lg-12 col-xs-12">
                    {!!Form::textarea('comment'.$sq->position,null,['class'=>'textarea', 'placeholder' => 'Agregar comentario adicional...'])!!}
                    <br>
                </div>
            </div>
            <hr class="hr hidden-xs">
            @endif
        @endforeach
        
        <div class="row">
            {!!Form::submit('He Terminado!!',['class'=>'posibtn btn btn-primary'])!!}
        </div>
        <br>
    </div>
    {!! Form::close() !!}
    <hr>
<script
  src="https://code.jquery.com/jquery-3.2.1.js"
  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
  crossorigin="anonymous"></script>
<script src="{{ asset('web/js/main.js') }}"></script>
<script src="{{ asset('web/js/bootstrap.min.js') }}"></script>

</body>
<footer class="hidden-sm hidden-md hidden-lg">
    <div class="row center">
    {!!Form::open(['route'=>'answers.store', 'method'=>'POST', 'files' => true])!!}
        <div class="col-xs-12 col-md-6">
            {!!Form::email('name', null, ['class'=>'posiinput', 'placeholder'=>'Nombre completo'])!!}
        </div>
        <div class="col-xs-12 col-md-6">
            {!!Form::text('email', null, ['class'=>'posiinput2', 'placeholder'=>'Correo electronico'])!!}
            {!!Form::hidden('survey_id',$surveys->id)!!} 
        </div>
    </div>
    {!!Form::close()!!}
    <br>
</footer>

</html>