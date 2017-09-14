@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Editar Mesero
@endsection

@section('contentheader_title')
    Editar Mesero
@endsection

@section('main-content')

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header with-border">
					<div class="col-md-9">
						<h3 class="box-title">Editar Mesero</h3>
					</div>
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
				</div>
				<div class="box-body">
				{!!Form::model($waiters,['route'=>['waiters.update',$waiters],'method'=>'PUT', 'files' => true])!!}
				<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
							<div data-toggle="tooltip" title data-original-title="El nombre del mesero">
								{!!Form::label('Nombre del Mesero')!!}
								{!!Form::text('name',null,['class'=>'form-control','placeholder'=>'Ingrese el nombre del mesero', 'autofocus'=>'autofocus', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
							<div data-toggle="tooltip" title data-original-title="El apellido del mesero">
								{!!Form::label('Apellido del Mesero')!!}
								{!!Form::text('lastname',null,['class'=>'form-control','placeholder'=>'Ingrese el apellido del mesero', 'autofocus'=>'autofocus', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
								<br>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
							<div data-toggle="tooltip" title data-original-title="El foto del mesero">
								{!!Form::label('Foto del mesero')!!}
								{!!Form::file('url',null,['class'=>'form-control','placeholder'=>'Ingrese la foto del mesero', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
							</div>
						</div>
					</div>
				</div>
				<div class="pull-right">
				{!!Form::submit('Guardar',['class'=>'btn btn-primary', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}

				{!!Form::close()!!}

				{!!link_to_route('waiters.index', $title = 'Atras',  $parameters = '', $attributes = ['class' => 'btn btn-default btn3d', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
				</div>
				</div>
				<div class="box-footer clearfix">	
				</div>
			</div>
		</div>
	</div>
</section>

@endsection