@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Graficas de la Encuestas
@endsection

@section('contentheader_title')
    Graficas de la Encuestas
@endsection

@section('main-content')

@foreach($answersdet as $a)
<div id="chart-div"></div>
<?= $lava[]->renderAll() ?>
@endforeach

@endsection