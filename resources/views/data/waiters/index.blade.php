@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Meseros
@endsection

@section('contentheader_title')
    Meseros
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
		<a href="{{ route('waiters.create') }}" class="btn btn-success" data-toggle="tooltip" title data-original-title="Agregar Mesero" type="button" style="width:100%;"><i class="fa fa-plus"></i></a>
	</div>
</div>

<section class="content">

	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header with-border">
					<div class="col-md-9">
						<h3 class="box-title">Lista de Meseros</h3>
					</div>
				</div>
				<div id="tbl-main" class="box-body">
					<div class="table-responsive">
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th class="fondo">Foto</th>
								<th class="fondo">Nombre</th>
								<th style="text-align: center;" class="fondo">Opciones</th>
							</tr>
						</thead>
						@foreach($waiters as $w)
						<tbody>
							<tr>
								<td><img src="{{ asset($w->url) }}" width="150px" height="150px"></td>
								<td>{!!$w->name!!}</td>
								<td align="right">
								<div class="btn-group">
									<a href="{{ route('waiters.edit', $w->id) }}" class="btn btn-default" data-toggle="tooltip" title data-original-title="Editar" type="edit"><i class="fa fa-edit"></i></a>
									{!!Form::open(['route'=>['waiters.destroy', $w], 'method'=>'DELETE'])!!}
										<button class="btn btn-danger" data-toggle="tooltip" title data-original-title="Eliminar" type="submit">
	    								<i class="fa fa-remove"></i> </button>
	    							{!!Form::close()!!}
								</div>
								</td>
							</tr>
						</tbody>
						@endforeach
					</table>
					{!!$waiters->render()!!}
					</div>
				</div>
				<div class="box-footer clearfix">
				</div>
			</div>
		</div>
	</div>
</section>

@endsection