@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Tendencias de la Encuesta
@endsection

@section('contentheader_title')
    Tendencias de la Encuesta
@endsection

@section('main-content')
<div class="box-body">

	{!! Charts::assets() !!}

	@foreach($chart2 as $c)
		<center>
		   	{!! $c->render() !!}
		</center>
	<br>
	@endforeach

	<div class="pull-right">
		<a href="{{ route('pretrends', $survey->id)}}" class="btn btn-default btn3d">Atras</a>
	</div>
@endsection