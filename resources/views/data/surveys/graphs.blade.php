@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Graficas de la Encuesta
@endsection

@section('contentheader_title')
    Graficas de la Encuesta
@endsection

@section('main-content')

@if(isset($chart))
	{!! Charts::assets() !!}
	<center>
   		{!! $chart->render() !!}
	</center>
@endif

@foreach($chart2 as $c)
	<center>
	   	{!! $c->render() !!}
	</center>
@endforeach

@endsection