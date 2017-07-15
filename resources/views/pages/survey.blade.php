@foreach($surquestions as $sq)
	{{ $sq->question }}
	<ul>
	<li>Muy Malo</li>
	<li>Malo</li>
	<li>Regular</li>
	<li>Bueno</li>
	<li>Muy Bueno</li>
	</ul>
@endforeach