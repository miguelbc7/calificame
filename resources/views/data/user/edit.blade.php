@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Perfil
@endsection

@section('contentheader_title')
    Perfil
@endsection

@section('main-content')

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header with-border">
					<div class="col-md-9">
						<h3 class="box-title">Editar Perfil</h3>
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
				{!!Form::model($user,['route'=>['user.update',$user],'method'=>'PUT', 'files' => true])!!}
				<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<div class="row">
						<div class="col-xs-1 col-sm-1 col-md-6 col-lg-12 col-xl-12">
							<div data-toggle="tooltip" title data-original-title="El nombre de la compañia no tiene parametros especificos">
								{!!Form::text('company',null,['class'=>'form-control','placeholder'=>'Ingrese el nombre', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
							</div>
						</div>
						<div class="col-xs-1 col-sm-1 col-md-6 col-lg-12 col-xl-12">
							<div data-toggle="tooltip" title data-original-title="El telefono celular no tiene parametros especificos">
								{!!Form::text('cellphone',null,['class'=>'form-control','placeholder'=>'Ingrese el numero de celular', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
							</div>
						</div>
						<div class="col-xs-1 col-sm-1 col-md-6 col-lg-12 col-xl-12">
							<div data-toggle="tooltip" title data-original-title="El avatar de la compañia no tiene parametros especificos">
								{!!Form::label('Avatar')!!}
                                {!!Form::file('avatar',null,['class'=>'form-control', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
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