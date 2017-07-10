@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Encuestas
@endsection

@section('contentheader_title')
    Encuestas
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
	<div class="col-md-4 noleftpadding">
		<a href="{{ route('answers.create') }}" class="btn btn-success" type="button" style="width:100%;">Agregar Encuesta</a>
	</div>
</div>

<section class="content">

	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header with-border">
					<div class="col-md-9">
						<h3 class="box-title">Lista de Encuestas</h3>
					</div>
				</div>
				<div id="tbl-main" class="box-body">
					<div class="table-responsive">
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Opciones</th>
							</tr>
						</thead>
						@foreach($surveys as $s)
						<tbody>
							<tr>
								<td>{!!$s->name!!}</td>
								<td align="center">
									
									{!!Form::open(['route'=>['surveys.destroy', $s], 'method'=>'DELETE'])!!}					
									<div class="btn-group">
										<a href="{{ route('surveys.edit', $s->id) }}" class="btn btn-default" type="edit"><i class="fa fa-edit"></i></a>
										
										<button class="btn btn-danger" type="submit">
    									<i class="fa fa-remove"></i> </button>
									</div>
									{!!Form::close()!!}
									
								</td>
							</tr>
						</tbody>
						@endforeach
					</table>
					{!!$surveys->render()!!}
					</div>
				</div>
				<div class="box-footer clearfix">
				</div>
			</div>
		</div>
	</div>
</section>

@endsection