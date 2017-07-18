@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Respuestas de la Encuestas
@endsection

@section('contentheader_title')
    Respuestas de la Encuestas
@endsection

@section('main-content')

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

<div class="col-md-12" style="margin-top:20px;margin-bottom:10px;">
	<div class="col-md-3 noleftpadding">
		<a href class="btn btn-block btn-default" data-toggle="tooltip" title data-original-title="Actualizar" style="font-size: 14px">
			<i class="fa fa-refresh"></i>
		</a>
	</div>
</div>

<section class="content">

	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header with-border">
					<div class="col-md-9">
						<h3 class="box-title">Lista de Respuestas</h3>
					</div>
				</div>
				<div id="tbl-main" class="box-body">
					<div class="table-responsive">
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Email</th>
								<th>Comentario</th>
								<th>Opciones</th>
							</tr>
						</thead>
						@foreach($suranswers as $s)
						<tbody>
							<tr>
								<td>{!!$s->clientname!!}</td>
								<td>{!!$s->clientemail!!}</td>
								<td>{!!$s->comment!!}</td>
								<td align="center">
									
									{!!Form::open(['route'=>['answers.destroy', $s], 'method'=>'DELETE'])!!}					
									<div class="btn-group">
										<a href="{{ route('answers.edit', $s->id) }}" class="btn btn-default" data-toggle="tooltip" data-original-title="Editar" type="edit"><i class="fa fa-edit"></i></a>

										<a href="{{ route('suranswersdetails', $s->id) }}" class="btn btn-info" data-toggle="tooltip" data-original-title="Respuestas de las preguntas" type="suranswersdetails"><i class="fa fa-address-card-o"></i></a>

										<a href="#" class="btn btn-info" data-toggle="tooltip" data-original-title="Compartir comentario en facebook" type="fbshare"><i class="fa fa-facebook-square"></i></a>
										
										<button class="btn btn-danger" data-toggle="tooltip" data-original-title="Eliminar" type="submit">
    									<i class="fa fa-remove"></i> </button>
									</div>
									{!!Form::close()!!}
									
								</td>
							</tr>
						</tbody>
						@endforeach
					</table>
					{!!$suranswers->render()!!}
					</div>
				</div>
				<div class="box-footer clearfix">
				</div>
			</div>
		</div>
	</div>
</section>

@endsection