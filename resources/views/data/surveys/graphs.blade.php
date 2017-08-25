@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Graficas de la Encuesta
@endsection

@section('contentheader_title')
    Graficas de la Encuesta
@endsection

@section('main-content')

<div class="box-body">
	<br>
	{!! Charts::assets() !!}

	@foreach($chart2 as $c)
		<center>

		   	{!! $c->render() !!}
		</center>
		<br>
	@endforeach

	<div class="pull-right">
		<!--<a href="{{ route('graphpdf', $survey->id) }}" target="_blank" class="btn btn-primary" data-toggle="tooltip" data-original-title="Imprimir" type="edit">Imprimir como PDF</a>-->
		<a href="{{ route('pregraphs', $survey->id)}}" class="btn btn-default btn3d">Atras</a>
	</div>
</div>
@endsection