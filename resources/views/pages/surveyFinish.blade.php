<!DOCTYPE html>
<html lang="es">

<head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Encuesta terminada con exito</title>
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('web/css/survey.css') }}">
    <link href="{{ asset('web/images/favicon-32.fw.png') }}" rel="shortcut icon" type="image/x-icon">
    <link href="{{ asset('web/images/favicon-256.fw.png') }}" rel="apple-touch-icon">
</head>

<body>
    <!--<div class="center">
        <img id="preloader" src="{{ asset('web/images/preloader4.gif') }}" alt="">
    </div>-->
    <nav id="hola" class="navbar navbar-inverse navbar-fixed-top animated fadeIn">
        <div class="container-fluid">
            <div class="centro">
                <img class="imgnav animated bounceInLeft" height="50px" width="250px" src="{{ asset('web/images/logotrans.png') }}" alt="">
            </div>
        </div>
    </nav>
    <div class="thumbnail center fondo animated fadeIn">
        <div class="margin">
            <h3>Gracias por compartir tu opinion</h3>
            <a href="{{ url('s/'.Session::get('surveyid')) }}" class="btn btn-success">¿Alguien mas desea contestar la encuesta?</a>
            <a href="https://www.facebook.com/sharer/sharer.php?title=Mira+lo+que+opinan+nuestros+clientes&u=http://calificame.mx/s/{{ Session::get('surveyid')) }}/shared&display=popup" class="btn btn-primary">Comparte tu experiencia en Facebook</a>
        </div> 
    </div>
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