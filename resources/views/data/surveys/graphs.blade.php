@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Graficas de la Encuesta
@endsection

@section('contentheader_title')
    Graficas de la Encuesta
@endsection

@section('main-content')
<div class="box-body">
	@if(isset($chart))
		{!! Charts::assets() !!}
		<center>
	   		{!! $chart->render() !!}

		</center>
		<br>
	@endif

	@foreach($chart2 as $c)
		<center>
		   	{!! $c->render() !!}
		</center>
		<br>
	@endforeach

	<div class="pull-right">
		<a href="{{ route('pregraphs', $survey->id)}}" class="btn btn-default btn3d">Atras</a>
	</div>
</div>
@endsection