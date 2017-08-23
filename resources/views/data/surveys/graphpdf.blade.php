<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Graficas</title>
</head>
<body>
	<div class="box-body">
		<div style="text-align: center;">
			Fecha: {{ date('d-m-Y') }}
		</div>
		<br>
		
		{!! Charts::assets() !!}

		@foreach($chart2 as $c)
			<center>
			   	{!! $c->render() !!}
			</center>
			<br>
		@endforeach
	</div>
</body>
</html>