{!!Form::open(['route'=>'answers.store', 'method'=>'POST', 'files' => true])!!}

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
	{!!Form::text('name', null, ['class'=>'form-control', 'autofocus'=>'autofocus', 'placeholder'=>'Ingrese su nombre'])!!}
	{!!Form::hidden('survey_id',$surveys->id)!!}
</div>

<br>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
	{!!Form::text('email', null, ['class'=>'form-control', 'placeholder'=>'Ingrese su correo'])!!}
</div>

<br>

@foreach($surquestions as $sq)
	{{ $sq->question }}

	<input type="hidden" name="question_id{{ $sq->position }}" value="{{ $sq->question_id }}">

	@if($sq->type == 1)
		<div class="radio{{ $sq->position }}">
			<label>
		   		<input type="radio" name="optionsRadios{{ $sq->position }}" id="optionsRadios{{ $sq->position }}1" value="1">
		    	Si
		  	</label>
		  	<label>
		   		<input type="radio" name="optionsRadios{{ $sq->position }}" id="optionsRadios{{ $sq->position }}2" value="2">
		    	No
		  	</label>
		</div>
		<br>
	@elseif($sq->type == 2)
		<div class="radio{{ $sq->position }}">
		 	<label>
		   		<input type="radio" name="optionsRadios{{ $sq->position }}" id="optionsRadios{{ $sq->position }}1" value="3">
				Muy Malo
			</label>
			<label>
		 		<input type="radio" name="optionsRadios{{ $sq->position }}" id="optionsRadios{{ $sq->position }}2" value="4">
				Malo
			</label>
			<label>
				<input type="radio" name="optionsRadios{{ $sq->position }}" id="optionsRadios{{ $sq->position }}3" value="5">
		 		Regular
	  		</label>
	  		<label>
		    	<input type="radio" name="optionsRadios{{ $sq->position }}" id="optionsRadios{{ $sq->position }}4" value="6">
		    	Bueno
	  		</label>
	  		<label>
		    	<input type="radio" name="optionsRadios{{ $sq->position }}" id="optionsRadios{{ $sq->position }}5" value="7">
		    	Muy Bueno
		  	</label>
		</div>
		<br>
	@endif
@endforeach

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
	{!!Form::label('Dejanos un comentario:')!!}<br>
</div>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
	{!!Form::textarea('comment',null,['class'=>'form-control'])!!}
</div>

<br>

<div class="pull-left">
	{!!Form::submit('Enviar',['class'=>'btn btn-success btn3d', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
</div>
{!! Form::close() !!}