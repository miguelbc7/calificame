@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Links a la encuesta
@endsection

@section('contentheader_title')
    Links a la encuesta
@endsection

@section('main-content')

<div>Hipervinculo Directo</div>
	<div class="col-xs-1 col-sm-1 col-md-3 col-lg-4 col-xl-4" data-toggle="tooltip" title data-original-title="Hipervinculo a la encuesta en formato normal">
		<a href="{{ url('surveys/'.$survey->id.'/survey') }}">127.0.0.1:8000/surveys/{{ $survey->id }}/survey</a>
	</div>

<br>

<div>Codigo QR</div>
	<div class="col-xs-1 col-sm-1 col-md-2 col-lg-2 col-xl-2" data-toggle="tooltip" title data-original-title="Hipervinculo a la encuesta en formato de codigo QR">
		<a href="{{ url('surveys/'.$survey->id.'/survey') }}"><img src="data:image/png;base64,{{DNS2D::getBarcodePNG('http://127.0.0.1:8000/surveys/'.$survey->id.'/survey', 'QRCODE')}}" alt="barcode" /></a>
	</div>

<div class="box-body col-xs-1 col-sm-1 col-md-6 col-lg-12 col-xl-12">
	<div class="pull-right">
		{!!link_to_route('surveys.index', $title = 'Atras',  $parameters = '', $attributes = ['class' => 'btn btn-default btn3d', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
	</div>
</div>

@endsection