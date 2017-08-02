@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Renovar Suscripcion
@endsection

@section('contentheader_title')
    Renovar Suscripcion
@endsection

@section('main-content')
<div class="box-body">
	{!!Form::open(['route'=>'renewpaypal', 'method'=>'POST', 'files' => true])!!}
		<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<div class="row">
				<div class="col-xs-1 col-sm-1 col-md-6 col-lg-12 col-xl-12">
					<div data-toggle="tooltip" title data-original-title="Fecha de pago">
						{!!Form::select('type', [''=>'Seleccione un plan', '1' => '1 mes', '2' => '3 meses', '3'=>'6 meses', '4'=>'12 meses'], null, ['class'=>'form-control', 'placeholder' => 'Seleccione un plan', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
					</div>
				</div>
			</div>
		</div>
		<div class="pull-right">
			<button type="submit" class="btn btn-primary btn-block btn-flat"><i class="fa fa-paypal"></i>Pagar con Paypal</button>
		</div>
		<div class="pull-right">
			<a href="{{ url('renewmoney') }}" class="btn btn-warning btn3d"><i class="fa fa-money"></i> <span>Pagar con otro metodo</span></a>
		</div>
	{!!Form::close()!!}
</div>
@endsection