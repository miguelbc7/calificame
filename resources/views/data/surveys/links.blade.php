@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Links a la encuesta
@endsection

@section('contentheader_title')
    Links a la encuesta
@endsection

@section('main-content')


<div class="container" id="Links">
        <div class="row centered-form">
        <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-3 col-md-offset-3">
        	<div class="panel panel-primary">
        		<div class="panel-heading">
			    		<h3 class="panel-title">Hipervinculo Directo</h3>
			 			</div>
			 			<div class="panel-body">
			    		<form role="form">
			    			<div class="row" style="text-align: center;">
			    				<div class="col-xs-12 col-sm-12 col-md-12">
			    					<div class="col-xs-1 col-sm-1 col-md-3 col-lg-4 col-xl-4" data-toggle="tooltip" title data-original-title="Hipervinculo a la encuesta en formato normal">
									<a href="{{ url('surveys/'.$survey->id.'/survey') }}"><h4> tutophoton.com.ve/encuestas/public/surveys/{{ $survey->id }}/survey </h4></a>
								</div>
			    				</div>
			    			</div>
			    			<hr>
							<div>Codigo QR</div>
							<br>
							<div class="col-xs-12 col-xl-12" data-toggle="tooltip" title data-original-title="Hipervinculo a la encuesta en formato de codigo QR">
								<a href="{{ url('surveys/'.$survey->id.'/survey') }}">
								<img src="data:image/png;base64,{{DNS2D::getBarcodePNG('http://tutophoton.com.ve/encuestas/public/surveys/'.$survey->id.'/survey', 'QRCODE')}}" alt="barcode" width="120" height="120" /></a>
							</div>
							
							<div class="box-body col-xs-1 col-sm-1 col-md-6 col-lg-12 col-xl-12">
							<hr>
								<div class="pull-right">
									{!!link_to_route('surveys.index', $title = 'Atras',  $parameters = '', $attributes = ['class' => 'btn btn-default btn3d', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
								</div>
							</div>		    		
			    		</form>
			    	</div>
	    		</div>
    		</div>
    	</div>
    </div>

@endsection