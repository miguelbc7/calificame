@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Usuarios
@endsection

@section('contentheader_title')
    Usuarios
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
	<div class="col-md-1 noleftpadding">
		<a href class="btn btn-block btn-default" data-toggle="tooltip" title data-original-title="Actualizar" style="font-size: 14px">
			<i class="fa fa-refresh"></i>
		</a>
	</div>
	<div class="col-md-1 noleftpadding">
		<a href="{{ route('surveys.create') }}" class="btn btn-success" data-toggle="tooltip" title data-original-title="Agregar Encuesta" type="button" style="width:100%;"><i class="fa fa-plus"></i></a>
	</div>
</div>

<section class="content">

	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header with-border">
					<div class="col-md-9">
						<h3 class="box-title">Lista de Usuarios</h3>
					</div>
				</div>
				<div id="tbl-main" class="box-body">
					<div class="table-responsive">
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>Compañia</th>
								<th>Email</th>
								<th>Estatus</th>
								<th>Fecha de pago</th>
								<th>Fecha de vencimiento</th>
								<th>Opciones</th>
							</tr>
						</thead>
						@foreach($users as $u)
						<tbody>
							<tr>
								<td>{!!$u->company!!}</td>
								<td>{!!$u->email!!}</td>
								@if($u->status == 1)
									<td>Activo</td>
								@elseif($u->status == 2)
									<td>Inactivo</td>
								@endif		
								<td>{!!$u->datein!!}</td>
								<td>{!!$u->dateout!!}</td>
								<td align="center">
									
									<!--{!!Form::open(['route'=>['users.destroy', $u], 'method'=>'DELETE'])!!}					
									<div class="btn-group">
										<a href="{{ route('users.edit', $u->id) }}" class="btn btn-default" data-toggle="tooltip" data-original-title="Editar" type="edit"><i class="fa fa-edit"></i></a>
										
										<button class="btn btn-danger" data-toggle="tooltip" data-original-title="Eliminar" type="submit">
    									<i class="fa fa-remove"></i> </button>
									</div>
									{!!Form::close()!!}-->
									@if($u->status == 1)

									@elseif($u->status = 2)
									<a href="{{ route('uservalidate', $u->id) }}" class="btn btn-default" data-toggle="tooltip" data-original-title="Activar Usuario" type="edit"><i class="fa fa-play"></i></a>
									@endif
								</td>
							</tr>
						</tbody>
						@endforeach
					</table>
					{!!$users->render()!!}
					</div>
				</div>
				<div class="box-footer clearfix">
				</div>
			</div>
		</div>
	</div>
</section>

@endsection