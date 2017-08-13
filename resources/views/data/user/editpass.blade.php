@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Cambiar Contraseña
@endsection

@section('contentheader_title')
    Cambiar Contraseña
@endsection

@section('main-content')

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header with-border">
					<div class="col-md-9">
						<h3 class="box-title">Cambiar Contraseña</h3>
					</div>
					@if(Session::Has('message'))
					<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						{{Session::get('message')}}
					</div>
					@endif

					@if(Session::Has('error'))
					<div class="alert alert-danger alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						{{Session::get('error')}}
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
				</div>
				<div class="box-body">
				{!!Form::model($user,['route'=>['updatepass',$user],'method'=>'PUT', 'files' => true])!!}
				<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
							<div data-toggle="tooltip" title data-original-title="Su Contraseña actual">
								{!!Form::label('Contraseña actual')!!}
								{!!Form::password('old_password',null,['class'=>'form-control','placeholder'=>'Ingrese la contraseña actual', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
							<div data-toggle="tooltip" title data-original-title="Su nueva contraseña">
								{!!Form::label('Contraseña nueva')!!}
								{!!Form::password('password',null,['class'=>'form-control','placeholder'=>'Ingrese la contraseña nueva', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
							<div data-toggle="tooltip" title data-original-title="Repita su nueva contraseña">
								{!!Form::label('Repita su contraseña nueva')!!}
                                {!!Form::password('password_confirmation',null,['class'=>'form-control','placeholder'=>'Repita la contraseña nueva', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
							</div>
						</div>
					</div>
					</div>
				<div class="pull-right">
				{!!Form::submit('Guardar',['class'=>'btn btn-primary', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}

				{!!Form::close()!!}

				{!!link_to_route('admin', $title = 'Atras',  $parameters = '', $attributes = ['class' => 'btn btn-default btn3d', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
				</div>
				</div>
				<div class="box-footer clearfix">	
				</div>
			</div>
		</div>
	</div>
</section>

@endsection