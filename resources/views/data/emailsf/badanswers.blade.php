<html>
<head></head>
<body style="background: black; color: white">
<h1>{{ $title }}</h1>
<p>{{ $content }}</p>

<p>Numero = {{ $suranswers->id }}</p>

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

<td>Calificacion: $c</td>

</html>