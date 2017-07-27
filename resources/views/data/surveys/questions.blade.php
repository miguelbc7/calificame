@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Agregar Preguntas a la Encuesta
@endsection

@section('contentheader_title')
    Agregar Preguntas a la Encuesta
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

		    <div class="box-body">
		    	
		    	<div class="box-header with-border">
					<div class="col-md-9">
						<h3 class="box-title">Nueva Pregunta</h3>
					</div>
				</div>

				{!!Form::open(['route'=>'surveys_questions.store', 'method'=>'POST', 'files' => true])!!}
				<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<div class="row">
						<div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
							{!!Form::text('question',null,['class'=>'form-control','placeholder'=>'Ingrese la pregunta', 'autofocus'=>'autofocus', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
							{!!Form::hidden('survey_id',$surveys->id)!!}
						</div>
						<div class="pull-left">
							{!!Form::submit('Agregar',['class'=>'btn btn-success btn3d', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}

				{!!Form::close()!!}
						</div>
					</div>
				</div>
			
			</div>

			<div class="box-body">
		    	
		    	<div class="box-header with-border">
					<div class="col-md-9">
						<h3 class="box-title">Preguntas establecidas</h3>
					</div>
				</div>

				{!!Form::open(['route'=>'surveys_questions.store', 'method'=>'POST', 'files' => true])!!}
				<div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<div class="row">
						<div class="col-xs-11 col-sm-11 col-md-11 col-lg-11">
							{!!Form::select('question_id',$questions, null, ['class'=>'form-control','placeholder'=>'Seleccione la pregunta', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
							{!!Form::hidden('survey_id',$surveys->id)!!}
						</div>
						<div class="pull-left">
							{!!Form::submit('Agregar',['class'=>'btn btn-success btn3d', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}

				{!!Form::close()!!}
						</div>
					</div>
				</div>
			
			</div>

		    <section class="content">

				<div class="row">
					<div class="col-md-12">
						<div class="box">
							<div class="box-header with-border">
								<div class="col-md-9">
									<h3 class="box-title">Preguntas de la encuesta</h3>
								</div>
							</div>
							<div id="tbl-main" class="box-body">
								<div class="table-responsive">
								<table class="table table-bordered table-hover">
									<thead>
										<tr>
											<th>Posicion</th>
											<th>Pregunta</th>
											<th>Opciones</th>
										</tr>
									</thead>
									@foreach($surquestions as $s)
									<tbody>
										<tr>
											<td>{!!$s->position!!}</td>
											<td>{!!$s->question!!}</td>
											<td align="center">
												
												{!!Form::open(['route'=>['surveys.destroy', $s], 'method'=>'DELETE'])!!}					
												<div class="btn-group">
													<a href="{{ route('surveys.edit', $s->id) }}" class="btn btn-default" type="edit"><i class="fa fa-edit"></i></a>
														@if($s->position == 1)
															<a href="{{ route('down', $s->id) }}" class="btn btn-info" type="down"><i class="fa fa-arrow-down"></i></a>
															<a href="{{ route('fullDown', $s->id) }}" class="btn btn-info" type="fullDown"><i class="fa fa-download"></i></a>
														@elseif($s->position == $last)
															<a href="{{ route('up', $s->id) }}" class="btn btn-info" type="up"><i class="fa fa-arrow-up"></i></a>
															<a href="{{ route('fullUp', $s->id) }}" class="btn btn-info" type="fullUp"><i class="fa fa-upload"></i></a>
														@else
															<a href="{{ route('up', $s->id) }}" class="btn btn-info" type="up"><i class="fa fa-arrow-up"></i></a>
															<a href="{{ route('fullUp', $s->id) }}" class="btn btn-info" type="fullUp"><i class="fa fa-upload"></i></a>
															<a href="{{ route('down', $s->id) }}" class="btn btn-info" type="down"><i class="fa fa-arrow-down"></i></a>
															<a href="{{ route('fullDown', $s->id) }}" class="btn btn-info" type="fullDown"><i class="fa fa-download"></i></a>
														@endif
													<button class="btn btn-danger" type="submit">
			    									<i class="fa fa-remove"></i> </button>
												</div>
												{!!Form::close()!!}
												
											</td>
										</tr>
									</tbody>
									@endforeach
								</table>
								{!!$surquestions->render()!!}
								</div>
							</div>
							<div class="box-footer clearfix">
							</div>
						</div>
					</div>
				</div>
			</section>

		</div>
	</div>

	<div class="box-body">
		<div class="pull-right">
			{!!link_to_route('surveys.index', $title = 'Atras',  $parameters = '', $attributes = ['class' => 'btn btn-default btn3d', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
		</div>
	</div>
</section>

@endsection