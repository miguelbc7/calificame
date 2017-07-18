@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Links a la encuesta
@endsection

@section('contentheader_title')
    Links a la encuesta
@endsection

@section('main-content')

<div>Hipervinculo Directo</div>
<a href="{{ url('surveys/'.$survey->id.'/survey') }}">127.0.0.1:8000/surveys/{{ $survey->id }}/survey</a>

<br>

<div>Codigo QR</div>
<a href="{{ url('surveys/'.$survey->id.'/survey') }}"><img src="data:image/png;base64,{{DNS2D::getBarcodePNG('http://127.0.0.1:8000/surveys/'.$survey->id.'/survey', 'QRCODE')}}" alt="barcode" /></a>

@endsection