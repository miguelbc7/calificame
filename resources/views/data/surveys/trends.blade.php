@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Tendencias de la Encuesta
@endsection

@section('contentheader_title')
    Tendencias de la Encuesta
@endsection

@section('main-content')
<div class="box-body">
	@if(isset($chart))
		{!! Charts::assets() !!}
		<center>
	   		{!! $chart->render() !!}
		</center>
	@endif
	<br>
	@foreach($chart2 as $c)
		<center>
		   	{!! $c->render() !!}
		</center>
	<br>
	@endforeach

<div class="pull-right">
	{!!link_to_route('surveys.index', $title = 'Atras',  $parameters = '', $attributes = ['class' => 'btn btn-default btn3d', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
</div>
@endsection