@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Graficas de la Encuestas
@endsection

@section('contentheader_title')
    Graficas de la Encuestas
@endsection

@section('main-content')

<div id="chart-div"></div>
<?= $lava->render('PieChart', 'IMDB', 'chart-div') ?>

@endsection