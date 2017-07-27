@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Editar Encuesta
@endsection

@section('contentheader_title')
    Editar Encuesta
@endsection

@section('main-content')

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header with-border">
					<div class="col-md-9">
						<h3 class="box-title">Editar Encuesta</h3>
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
				{!!Form::model($surveys,['route'=>['surveys.update',$surveys],'method'=>'PUT', 'files' => true])!!}
				<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<div class="row">
						<div class="col-xs-1 col-sm-1 col-md-6 col-lg-12 col-xl-12">
							<div data-toggle="tooltip" title data-original-title="El nombre de la encuesta no tiene parametros especificos">
								{!!Form::text('name',null,['class'=>'form-control','placeholder'=>'Ingrese la pregunta', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
							</div>
						</div>
					</div>
					</div>
				<div class="pull-right">
				{!!Form::submit('Guardar',['class'=>'btn btn-primary', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}

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