@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Graficas de la Encuesta
@endsection

@section('contentheader_title')
    Graficas de la Encuesta
@endsection

@section('main-content')

<div id="chart-div"></div>
<?= $lava->render('PieChart', 'Encuesta', 'chart-div') ?>

<div class="box-body">
	<div class="pull-right">
		{!!link_to_route('surveys.index', $title = 'Atras',  $parameters = '', $attributes = ['class' => 'btn btn-default btn3d', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
	</div>
</div>
@endsection