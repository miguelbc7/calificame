<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>Preguntas</title>
	<link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('web/css/webflow.css') }}">
	<link href="{{ asset('web/images/favicon-32.fw.png') }}" rel="shortcut icon" type="image/x-icon">
	<link href="{{ asset('web/images/favicon-256.fw.png') }}" rel="apple-touch-icon">
</head>

<body>
<img class="posicion" src="{{ asset('web/images/logo4.png') }} " alt="">
<br><br>
<div class="container carta">
	<br>
	<h1 class="center">Preguntas De La Encuentas</h1>
	<br>

	<div>
		<div class="center questionlabel"><label> Esta Es La Pregunta Numero 1?</label></div>

		<div class="container inputDiv">
			<div class="fondo"></div>
			<div class="rangeText"><span id="rangeText"></span></div>
			<input type="range" id="rangeInput" name="rangeInput" value="0" step="1" min="0" max="4">
			<br>
		</div>
	</div>

	<div>
		<div class="center questionlabel"><label> Esta Es La Pregunta Numero 2?</label></div>

		<div class="container inputDiv">
			<div class="fondo"></div>
			<div class="rangeText"><span id="rangeText2"></span></div>
			<input type="range" id="rangeInput2" name="rangeInput2" value="0" step="1" min="0" max="4">
			<br>
		</div>
	</div>

	<div>
		<div class="center questionlabel"><label> Esta Es La Pregunta Numero 3?</label></div>

		<div class="container inputDiv">
			<div class="fondo"></div>
			<div class="rangeText"><span id="rangeText3"></span></div>
			<input type="range" id="rangeInput3" name="rangeInput3" value="0" step="1" min="0" max="4">
			<br>
		</div>
	</div>

	<div>
		<div class="center questionlabel"><label> Esta Es La Pregunta Numero 4?</label></div>

		<div class="container inputDiv">
			<div class="fondo"></div>
			<div class="rangeText"><span id="rangeText4"></span></div>
			<input type="range" id="rangeInput4" name="rangeInput4" value="0" step="1" min="0" max="4">
			<br>
		</div>
	</div>


</div>
<br>

</body>


<script
  src="https://code.jquery.com/jquery-3.2.1.js"
  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
  crossorigin="anonymous"></script>
<script src="{{ asset('web/js/main.js') }}"></script>
<script src="{{ asset('web/js/bootstrap.min.js') }}"></script>
</html>