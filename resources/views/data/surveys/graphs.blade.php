@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Graficas de la Encuesta
@endsection

@section('contentheader_title')
    Graficas de la Encuesta
@endsection

@section('main-content')

<div id="chart-div"></div>
<?= $lava->render('PieChart', 'Encuesta 1', 'chart-div') ?>

@endsection