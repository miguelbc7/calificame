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
    <div class="center">
        <img id="preloader" src="{{ asset('web/images/preloader4.gif') }}" alt="">
    </div>
    <nav id="hola" class="navbar navbar-inverse navbar-fixed-top animated fadeIn">
        <div class="container-fluid">
            <div class="centro">
                <img class="imgnav animated bounceInLeft" height="50px" width="250px" src="{{ asset('web/images/logotrans.png') }}" alt="">
            </div>
        </div>
    </nav>
    <div class="thumbnail center fondo animated fadeIn">
        <div class="margin">
            <img class="imglogo img-circle animated  pulse" width="200px" height="180px" src="{{ asset($user->avatar) }}" alt="logo">
        </div>

            <div class="margin">
                @if(isset($answers->name))
                    <h3 class="center pregunta">Nombre: {{ $answers->name }}</h3>
                @else
                    <h3 class="center pregunta">Nombre: Anonimo</h3>
                @endif
            </div>

            <div class="margin">
                @if(isset($answers->email))
                    <h3 class="center pregunta">Email: {{ $answers->email }}</h3>
                @else
                    <h3 class="center pregunta">Email: Anonimo</h3>
                @endif
            </div>

            @foreach($answersdetails as $ad)
                @foreach($questions as $q)
                    @if($ad->question_id == $q->id)
                    <div class="margin">
                        @if($answers->calification >= 25)
                             <h3 class="center pregunta">Calificacion General : Excelente</h3>
                        @elseif($answers->calification > 15 && $answers->calification <= 24)
                            <h3 class="center pregunta">Calificacion General : Buena</h3>
                        @elseif($answers->calification > 5 && $answers->calification <= 14)
                            <h3 class="center pregunta">Calificacion General : Regular</h3>
                        @elseif($answers->calification >= 0 && $answers->calification = 5)
                            <h3 class="center pregunta">Calificacion General : Mala</h3>
                        @endif
                    </div>

                    <div class="margin">
                        @if($ad->answer == 1)
                            <h3 class="center pregunta">Pregunta#{{ $q->position }} {{ $q->name }} : Si</h3>
                        @elseif($ad->answer == 2)
                            <h3 class="center pregunta">Pregunta#{{ $q->position }} {{ $q->name }} : No</h3>
                        @elseif($ad->answer == 3)
                            <h3 class="center pregunta">Pregunta#{{ $q->position }} {{ $q->name }} : Malo</h3>
                        @elseif($ad->answer == 4)
                            <h3 class="center pregunta">Pregunta#{{ $q->position }} {{ $q->name }} : Regular</h3>
                        @elseif($ad->answer == 5)
                            <h3 class="center pregunta">Pregunta#{{ $q->position }} {{ $q->name }} : Bueno</h3>
                        @elseif($ad->answer == 6)
                            <h3 class="center pregunta">Pregunta#{{ $q->position }} {{ $q->name }} : Excelente</h3>
                        @endif
                        
                    </div>
                    <div class="margin">
                        @if(isset($ad->comment))
                            <h3 class="center pregunta">Comentario #{{ $q->position }}: {{ $ad->comment }}</h3>
                        @else
                            <h3 class="center pregunta">Comentario #{{ $q->position }}: Sin Comentarios</h3>
                        @endif
                    </div>
                    @endif
                @endforeach
            @endforeach
            
    <hr>
    <br>
<script
  src="https://code.jquery.com/jquery-3.2.1.js"
  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
  crossorigin="anonymous"></script>
<script src="{{ asset('web/js/main.js') }}"></script>
<script src="{{ asset('web/js/bootstrap.min.js') }}"></script>

</body>
</html>