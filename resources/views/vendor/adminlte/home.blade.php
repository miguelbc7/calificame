@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection


@section('main-content')

	<!-- Panel Administrativo LTE ADMIN -->
	<div class="row col-md-12" id="Links">
	<h2>Panel Administrativo</h2>
	<img alt="calificame" class="nav__logo" src="{{ asset('web/images/logo.png') }}" width="220" height="40">
	</div>
	<br><br>
	<div class="wrap">
		<div class="container row" style="text-align: center;">
		  <div class="col-sm-6">
		  	<div class="tile"> 
			  <img src="/web/images/encuesta.png"/>
			  <div class="text">
			  <h2 class="animate-text">Módulo de Encuestas</h2>
			  <p class="animate-text">En este módulo podras crear todas tus encuestas.</p>
			  <button type="button" class="btn btn-primary animate-text btn-ms btn-block">Encuestas</button> 
			  <div class="dots">
			  </div>
			  </div>
			 </div>
		  </div>
		  <div class="col-sm-6">
			<div class="tile"> 
			  <img src="/web/images/questions.png"/>
			  <div class="text">
			  <h2 class="animate-text">Módulo de Preguntas</h2>
			  <p class="animate-text">En este módulo podras crear todas tus preguntas.</p>
			  <button type="button" class="btn btn-primary animate-text btn-ms btn-block">Preguntas</button>
			<div class="dots">
			  </div>
			  </div>
			 </div>
		  </div>
		</div>
		</div>
	</div>
	<!-- Panel Administrativo LTE ADMIN -->
	
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">

				<!-- Default box -->
				<!--<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">Home</h3>

						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
								<i class="fa fa-minus"></i></button>
							<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
								<i class="fa fa-times"></i></button>
						</div>
					</div>
					<div class="box-body">
						{{ trans('adminlte_lang::message.logged') }}. Start creating your amazing application!
					</div>-->
					<!-- /.box-body -->
				<!--</div>-->
				<!-- /.box -->

			</div>
		</div>
	</div>
@endsection
