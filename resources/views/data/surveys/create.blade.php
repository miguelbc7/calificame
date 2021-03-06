@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Crear Encuesta
@endsection

@section('contentheader_title')
    Crear Encuesta
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
						<h3 class="box-title">Crear nueva Encuesta</h3>
					</div>
				</div>
				<div class="box-body">
					{!!Form::open(['route'=>'surveys.store', 'method'=>'POST', 'files' => true])!!}
					<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
						<div class="row">
							<div class="col-xs-1 col-sm-1 col-md-6 col-lg-12 col-xl-12">
								<div data-toggle="tooltip" title data-original-title="El nombre de la encuesta no tiene parametros especificos">
									{!!Form::label('Nombre de la encuesta')!!}
									{!!Form::text('name',null,['class'=>'form-control','placeholder'=>'Ingrese el nombre de la encuesta', 'autofocus'=>'autofocus', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
								</div>
							</div>
						</div>
					</div>
					<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
						<div class="row">
							<div class="col-xs-1 col-sm-1 col-md-6 col-lg-12 col-xl-12">
								<div data-toggle="tooltip" title data-original-title="Usara meseros">
									{!!Form::label('¿Desea activar como ultima pregunta quien te atendio?')!!}
									{!!Form::checkbox('flag', 0)!!}
									<br>
									{!!Form::label('Al activar el modo quien te atendio significa que cuando los clientes terminen de contestar la encuesta, el sistema arrojara una ultima pregunta que sera Y por ultimo ¿Quien te atendio? y apareceran las fotos y nombres de los meseros que tengas registrados en la seccion meseros, puedes agregar o eliminar meseros sin ningun problema. No olvides egistrar sus fotos y nombres en caso de tener activa esta función')!!}
								</div>

							</div>
						</div>
					</div>
					<div class="pull-right">
					{!!Form::submit('Registrar',['class'=>'btn btn-success btn3d', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}

					{!!Form::close()!!}

					{!!link_to_route('surveys.index', $title = 'Atras',  $parameters = '', $attributes = ['class' => 'btn btn-default btn3d', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
					</div>
				</div>
				<div class="box-footer clearfix">	
				</div>
			</div>
		</div>
	</div>
</section>

@endsection