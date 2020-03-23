<html>
<head></head>
<body style="background: black; color: white">
<h1>{{ $title }}</h1>
<p>{{ $content }}</p>

@if(isset($suranswers->name))
	<p>Nombre: {{ $suranswers->name }}</p>
@else
	<p>Nombre: Anonimo</p>
@endif

@if(isset($suranswers->email))
	<p>Email: {{ $suranswers->email }}</p>
@else
	<p>Email: Anonimo</p>
@endif

@if(isset($suranswers->table))
	<p>Por favor dirigirse a la Mesa {{ $suranswers->table }} para hablar con los clientes</p>
@else
	<p>No se registro la mesa al realizar la encuesta</p>
@endif

</html>