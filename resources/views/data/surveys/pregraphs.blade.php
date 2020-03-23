@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Seleccionar Fechas
@endsection

@section('contentheader_title')
    Seleccionar Fechas
@endsection

@section('main-content')

<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header with-border">
					<div class="col-md-9">
						<h3 class="box-title">Estadisticas</h3>
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
				<div class="col-md-12">
					<h3 class="box-title">Estadistica General de Preguntas</h3>
				</div>
				<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<div class=" col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
						<a href="{{ route('graphsQuestions', $surveys->id)}}" class="btn btn-primary">Estadisticas Generales de preguntas</a>
					</div>
				</div>
				{!!Form::model($surveys,['route'=>['graphsDateQuestions',$surveys],'method'=>'PUT', 'files' => true])!!}
				<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<div class="col-md-6">
						<h3 class="box-title">Estadisticas de Preguntas Por Fecha</h3>
					</div>
					<div class="row">
						<div class="col-xs-1 col-sm-1 col-md-6 col-lg-12 col-xl-12">
							<div data-toggle="tooltip" title data-original-title="La fecha de inicio de la busqueda">
								{!!Form::date('dateOne',null,['class'=>'form-control','placeholder'=>'Ingrese la fecha inicial', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
							</div>
							<br>
						</div>
						<div class="col-xs-1 col-sm-1 col-md-6 col-lg-12 col-xl-12">
							<div data-toggle="tooltip" title data-original-title="La fecha final de la busqueda">
								{!!Form::date('dateTwo',null,['class'=>'form-control','placeholder'=>'Ingrese la fecha final', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
							</div>
							<br>
						</div>
						<div class="pull-right">
							{!!Form::submit('Buscar',['class'=>'btn btn-primary', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}

							{!!Form::close()!!}
						</div>
					</div>
				</div>

				@if($surveys->flag == 1)
					{!!Form::model($surveys,['route'=>['graphsWaiterQuestions',$surveys],'method'=>'PUT', 'files' => true])!!}
					<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
						<div class="col-md-6">
							<h3 class="box-title">Estadisticas de Preguntas Por Mesero</h3>
						</div>
						<div class="row">
							<div class="col-xs-1 col-sm-1 col-md-6 col-lg-12 col-xl-12">
								<div data-toggle="tooltip" title data-original-title="Seleccione el mesero">
									{!! Form::select('waiter_id', $waiters2, null, ['class'=>'form-control','placeholder'=>'Seleccione el mesero', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;']) !!}
								</div>
								<br>
							</div>
							<div class="pull-right">
								{!!Form::submit('Buscar',['class'=>'btn btn-primary', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}

								{!!Form::close()!!}
							</div>
						</div>
					</div>
				@endif

				<div class="col-md-12">
					<h3 class="box-title">Estadistica General de Satisfaccion</h3>
				</div>
				<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
						<a href="{{ route('graphsSatisfaction', $surveys->id)}}" class="btn btn-primary">Estadisticas Generales de satisfaccion</a>
					</div>
				</div>

				{!!Form::model($surveys,['route'=>['graphsDateSatisfaction',$surveys],'method'=>'PUT', 'files' => true])!!}
				<div class="col-md-12">
					<h3 class="box-title">Estadisticas de Satisfaccion Por fecha</h3>
				</div>
				<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<div class="row">
						<div class="col-xs-1 col-sm-1 col-md-6 col-lg-12 col-xl-12">
							<div data-toggle="tooltip" title data-original-title="La fecha de inicio de la busqueda">
								{!!Form::date('dateOne',null,['class'=>'form-control','placeholder'=>'Ingrese la fecha inicial', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
							</div>
							<br>
						</div>
						<div class="col-xs-1 col-sm-1 col-md-6 col-lg-12 col-xl-12">
							<div data-toggle="tooltip" title data-original-title="La fecha final de la busqueda">
								{!!Form::date('dateTwo',null,['class'=>'form-control','placeholder'=>'Ingrese la fecha final', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
							</div>
							<br>
						</div>
						<div class="pull-right">
							{!!Form::submit('Buscar',['class'=>'btn btn-primary', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}

							{!!Form::close()!!}
						</div>
					</div>
				</div>
				
				@if($surveys->flag == 1)
					{!!Form::model($surveys,['route'=>['graphsWaiterSatisfaction',$surveys],'method'=>'PUT', 'files' => true])!!}
					<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
						<div class="col-md-6">
							<h3 class="box-title">Estadisticas de Preguntas Por Mesero</h3>
						</div>
						<div class="row">
							<div class="col-xs-1 col-sm-1 col-md-6 col-lg-12 col-xl-12">
								<div data-toggle="tooltip" title data-original-title="Seleccione el mesero">
									{!! Form::select('waiter_id', $waiters2, null, ['class'=>'form-control','placeholder'=>'Seleccione el mesero', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;']) !!}
								</div>
								<br>
							</div>
							<div class="pull-right">
								{!!Form::submit('Buscar',['class'=>'btn btn-primary', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}

								{!!Form::close()!!}
							</div>
						</div>
					</div>
				@endif

				<div class="pull-right">

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