@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Activar Usuario
@endsection

@section('contentheader_title')
    Activar Usuario
@endsection

@section('main-content')

<section class="content">
	<div class="row">
		<div class="col-md-12">

			@if(Session::Has('message'))
			<div class="alert alert-success alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				{{Session::get('message')}}
			</div>
			@endif
			@if (count($errors) > 0)
		    <div class="alert alert-danger">
		        {{ trans('adminlte_lang::message.someproblems') }}<br><br>
		        <ul>
		            @foreach ($errors->all() as $error)
		            <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		    @endif
        
			<div class="box">
				<div class="box-header with-border">
					<div class="col-md-9">
						<h3 class="box-title">Activar Usuario</h3>
					</div>
				</div>
				<div class="box-body">
					<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
						Compañia: {{ $user->company }}
						<br>
					</div>
					<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
						Email: {{ $user->email }}
						<br>
					</div>
					{!!Form::model($user,['route'=>['useractive',$user],'method'=>'PUT', 'files' => true])!!}
					<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
						<div class="row">
							<div class="col-xs-1 col-sm-1 col-md-6 col-lg-12 col-xl-12">
								<div data-toggle="tooltip" title data-original-title="Fecha de pago">
									{!!Form::date('dateIn',null,['class'=>'form-control','placeholder'=>'Ingrese la fecha de inicio', 'autofocus'=>'autofocus', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
									<br>
								</div>
							</div>
							<div class="col-xs-1 col-sm-1 col-md-6 col-lg-12 col-xl-12">
								<div data-toggle="tooltip" title data-original-title="Tipo de plan">
									{!!Form::select('type', ['1' => '1 mes', '2' => '3 meses', '3'=>'6 meses', '4'=>'12 meses'], null, ['class'=>'form-control', 'placeholder' => 'Seleccione un plan', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
								</div>
							</div>
						</div>
					</div>
					<div class="pull-right">
					{!!Form::submit('Guardar',['class'=>'btn btn-success btn3d', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}

					{!!Form::close()!!}

					{!!link_to_route('users.index', $title = 'Atras',  $parameters = '', $attributes = ['class' => 'btn btn-default btn3d', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
					</div>
				</div>
				<div class="box-footer clearfix">	
				</div>
			</div>
		</div>
	</div>
</section>

@endsection