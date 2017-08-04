<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Encuensta</title>
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('web/css/survey.css') }}">
    <link href="{{ asset('web/images/favicon-32.fw.png') }}" rel="shortcut icon" type="image/x-icon">
    <link href="{{ asset('web/images/favicon-256.fw.png') }}" rel="apple-touch-icon">
</head>

<body>
    <div class="center">
        <img id="preloader" src="{{ asset('web/images/preloader4.gif') }}" alt="">
    </div>
    <nav class="navbar navbar-inverse navbar-fixed-top animated fadeIn">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="centro">
          <img class="imgnav animated bounceInLeft" height="50px" width="250px" src="{{ asset('web/images/logotrans.png') }}" alt="">
        </div>
            <button class="posibtn btn btn-primary pull-right hidden-xs">Enviar</button>
            <input class=" posiinput pull-right hidden-xs" type="email" name="myEmailField" placeholder="Correo Electrónico">
            <input class="posiinput pull-right hidden-xs" type="text" name="nombre" placeholder="Nombre">
        <!-- <h2 class="titulopreguntas">Encuentas</h2> -->
      </div><!-- /.container-fluid -->
    </nav>
    
    <div class="thumbnail center fondo animated fadeIn">
        <div class="margin">
        <img class="imglogo img-circle animated  pulse" width="200px" height="180px" src="{{ asset('web/images/logo2.png') }}" alt="logo">
        </div>
        <div class="margin">
        <h3 class="center pregunta">Este es el espacio asignado para la primera pregunta</h3>
        </div>
        <div class="row">
            <div class="col-lg-8 col-xs-12 col-md-8">
                <div class="centrar">
                    <label class="posicionInLine posicion0">
                        <input type="radio" class="option-input radio" name="0" value="Malo" checked /> Malo
                    </label>
                    <label class="posicionInLine posicionregular">
                        <input type="radio" class="option-input radio" name="0" value="Regular" /> Regular
                    </label>
                    <label class="posicionInLine posicion0">
                        <input type="radio" class="option-input radio" name="0" value="Bueno" /> Bueno
                    </label>
                    <label class="posicionInLine posicion2">
                        <input type="radio" class="option-input radio" name="0" value="Excelente" /> Excelente
                    </label>
                </div>
            </div>
                <div class="col-lg-4 col-xs-12 col-md-4">
                <textarea class="textarea" placeholder="Coloque su comentario Aquí!!" rows="4" cols="50"></textarea>
                <br>
            </div>
        </div>
        <hr class="hr hidden-xs">
        <div class="margin">
            <h3 class="center pregunta">Este es el espacio asignado para la segunda pregunta</h3>
        </div>
        <div class="row">
            <div class="col-lg-8 col-xs-12 col-md-8">
                <div>
                    <label class="posicion1">
                        <input type="radio" class="option-input radio" name="1" value="Malo" checked /> Si
                    </label>
                    <label>
                        <input type="radio" class="option-input radio" name="1" value="Regular" /> No
                    </label>
                </div>
            </div>
            <div class="col-lg-4 col-xs-12 col-md-4">
                <textarea class="textarea" placeholder="Coloque su comentario Aquí!!" rows="4" cols="50"></textarea>
                <br>
            </div>
        </div>
        <hr class="hr hidden-xs">
        <div class="margin">
            <h3 class="center pregunta">Este es el espacio asignado para la tercera pregunta</h3>
        </div>
        <div class="row">
            <div class="col-lg-8 col-md-8">
                <div>
                    <label class="posicion1">
                        <input type="radio" class="option-input radio" name="2" value="Malo" checked /> Si
                    </label>
                    <label>
                        <input type="radio" class="option-input radio" name="2" value="Regular" /> No
                    </label>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <textarea class="textarea" placeholder="Coloque su comentario Aquí!!" rows="4" cols="50"></textarea>
                <br>
            </div>
        </div>
        <hr class="hr hidden-xs">
        <div class="margin">
            <h3 class="center pregunta">Este es el espacio asignado para la cuarta pregunta</h3>
        </div>
        <div class="row">
            <div class="col-lg-8 col-md-8">
                <div>
                    <label class="posicion0">
                        <input type="radio" class="option-input radio" name="3" value="Malo" checked /> Malo
                    </label>
                    <label>
                        <input type="radio" class="option-input radio" name="3" value="Regular" /> Regular
                    </label>
                    <label class="posicion0">
                        <input type="radio" class="option-input radio" name="3" value="Bueno" /> Bueno
                    </label>
                    <label class="posicion2">
                        <input type="radio" class="option-input radio" name="3" value="Excelente" /> Excelente
                    </label>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <textarea class="textarea" placeholder="Coloque su comentario Aquí!!" rows="4" cols="50"></textarea>
                <br>
            </div>
        </div>
    </div>
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
        <div class="col-xs-12 col-md-6">
            <input class="posiinput" type="text" name="nombre" placeholder="Nombre">
        </div>
        <div class="col-xs-12 col-md-6">
            <input class=" posiinput2" type="email" name="myEmailField" placeholder="Correo Electrónico">
        </div>
        <div class="col-xs-12 col-md-6">
            <button class="posibtn btn btn-primary btn-block">Enviar</button>
        </div>
    </div>
</footer>
</html>