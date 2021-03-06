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
	<div class="col-md-1 noleftpadding">
		<a href class="btn btn-block btn-default" data-toggle="tooltip" title data-original-title="Actualizar" style="font-size: 14px">
			<i class="fa fa-refresh"></i>
		</a>
	</div>
</div>

<input type="hidden" id="hidden" value="{{ $survey->id }}">

<section class="content">

	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header with-border">
					<div class="col-md-9">
						<h3 class="box-title">Lista de Respuestas</h3>
					</div>
				</div>
				<div class="box-header with-border">
					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
						<select class="form-control" onchange="location = this.value;">
							<option value="{{ route('suranswers', $survey->id) }}">Todas las respuestas</option>
						    @foreach($waiters as $w)
						      @if($wai->id == $w->id)
								<option selected value="{{ route('suranswersfilter', [$survey->id, $w->id]) }} ">{{ $w->name }}</option>
						      @else
								<option value="{{ route('suranswersfilter', [$survey->id, $w->id]) }}">{{ $w->name }}</option>
						      @endif 
						    @endforeach
					  	</select>

					</div>
				</div>
				<div id="tbl-main" class="box-body">
					<div class="table-responsive">
					<table id="users-table" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th class="fondo">Fecha y Hora</th>
								<th class="fondo">Mesero</th>
								@foreach($questions as $q)
									<th class="fondo">{{ $q->name }}</th>
									<th class="fondo">Comentario</th>
								@endforeach
								<th class="fondo">Calificacion General</th>
								<th class="fondo">Opciones</th>
								<th class="fondo">Nombre</th>
								<th class="fondo">Email</th>
							</tr>
						</thead>
						@foreach($suranswers as $s)
						<tbody>
							<tr>				
								<td>{!! date('d-m-Y H:i:s', strtotime($s->created_at)) !!}</td>				
								@if($s->flag == 1)
									@foreach($waiters as $w)
										@if($s->waiter_id == $w->id)
											<td>{!!$w->name!!} {!!$w->lastname!!}</td>
										@endif
									@endforeach
								@else
									<td>Sin Mesero</td>
								@endif

								@foreach($answersdet as $a)
									@if($a->ansid == $s->id)
										@if($s->surid == $a->survey)
											@if($a->answer == 1)
												<td>Si</td>
												<td>{!!$a->comment!!}</td>
											@elseif($a->answer == 2)
												<td>No</td>
												<td>{!!$a->comment!!}</td>
											@elseif($a->answer == 3)
												<td>Malo</td>
												<td>{!!$a->comment!!}</td>
											@elseif($a->answer == 4)
												<td>Regular</td>
												<td>{!!$a->comment!!}</td>
											@elseif($a->answer == 5)
												<td>Bueno</td>
												<td>{!!$a->comment!!}</td>
											@elseif($a->answer == 6)
												<td>Excelente</td>
												<td>{!!$a->comment!!}</td>
											@endif
										@endif
									@endif
								@endforeach
								
								@if($s->calification > 90)
									<td style="color:#fff; background-color: #5c7ef6">Excelente</td>
								@elseif($s->calification > 75 && $s->calification <= 89)
									<td style="background-color: #5cf65e">Buena</td>
								@elseif($s->calification > 65 && $s->calification <= 75)
									<td style="background-color: #edf65c">Regular</td>
								@elseif($s->calification >= 0 && $s->calification = 64)
									<td style="color:#fff; background-color: #f65c6e">Mala</td>
								@endif
								
								<td align="center">
									
									<!--{!!Form::open(['route'=>['answers.destroy', $s], 'method'=>'DELETE'])!!}-->			
									<div class="btn-group">
										<!--<a href="{{ route('answers.edit', $s->id) }}" class="btn btn-default" data-toggle="tooltip" data-original-title="Editar" type="edit"><i class="fa fa-edit"></i></a>-->

										<a href="https://www.facebook.com/sharer/sharer.php?title=Mira+lo+que+opinan+nuestros+clientes&u=http://calificame.mx/s/{{ $s->id }}/shared&display=popup" class="btn btn-primary" data-toggle="tooltip" data-original-title="Compartir comentario en Facebook" type="fbshare"><i class="fa fa-facebook-square"></i></a>

										<a href="https://twitter.com/intent/tweet?text=Mira+lo+qué+opinan+nuestros+clientes&url=http://calificame.mx/s/{{ $s->id }}/shared" class="btn btn-info" data-toggle="tooltip" data-original-title="Compartir comentario en Twitter" type="fbshare"><i class="fa fa-twitter-square"></i></a>
										
										<!--<button class="btn btn-danger" data-toggle="tooltip" data-original-title="Eliminar" type="submit">
    									<i class="fa fa-remove"></i> </button>-->
									</div>
									<!--{!!Form::close()!!}-->
									
								</td>
								@if(isset($s->name))
									<td>{!!$s->name!!}</td>
								@else
									<td>Anonimo</td>
								@endif

								@if(isset($s->email))
									<td>{!!$s->email!!}</td>
								@else
									<td>Anonimo</td>
								@endif
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

	<div class="box-body">
		<div class="pull-right">
			{!!link_to_route('surveys.index', $title = 'Atras',  $parameters = '', $attributes = ['class' => 'btn btn-default btn3d', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
		</div>
	</div>
</section>

@endsection

