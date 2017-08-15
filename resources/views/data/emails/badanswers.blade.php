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

@if($suranswers->calification > 21)
	<td>Calificacion: Excelente</td>
@elseif($suranswers->calification > 10 && $suranswers->calification <= 20)
	<td>Calificacion: Buena</td>
@elseif($suranswers->calification > 5 && $suranswers->calification <= 10)
	<td>Calificacion: Regular</td>
@elseif($suranswers->calification >= 0 && $suranswers->calification <= 5)
	<td>Calificacion: Mala</td>
@endif

</html>