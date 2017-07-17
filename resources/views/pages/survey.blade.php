
@foreach($surquestions as $sq)
	{{ $sq->question }}
	
	<div class="radio{{ $sq->position }}">
	  <label>
	    <input type="radio" name="optionsRadios" id="optionsRadios{{ $sq->position }}1" value="1">
	    Muy Malo
	  </label>
	  <label>
	    <input type="radio" name="optionsRadios" id="optionsRadios{{ $sq->position }}2" value="2">
	    Malo
	  </label>
	  <label>
	    <input type="radio" name="optionsRadios" id="optionsRadios{{ $sq->position }}3" value="3">
	    Regular
	  </label>
	  <label>
	    <input type="radio" name="optionsRadios" id="optionsRadios{{ $sq->position }}4" value="4">
	    Bueno
	  </label>
	  <label>
	    <input type="radio" name="optionsRadios" id="optionsRadios{{ $sq->position }}5" value="5">
	    Muy Bueno
	  </label>
	</div>
	<br>
@endforeach