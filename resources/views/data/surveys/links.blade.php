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
			    		<div>
			    		<div>	
							<a style="word-wrap: break-word;" href="{{ url('surveys/'.$survey->id.'/survey')}}">
								<p data-toggle="tooltip" title data-original-title="Hipervinculo a la encuesta en formato normal"> tutophoton.com.ve/encuestas/public/surveys/{{ $survey->id }}/survey</p>
							</a>
			    			<hr>
						</div>
							<div>Codigo QR</div>
							<br>
							<div class="col-xs-12 col-xl-12" data-toggle="tooltip" title data-original-title="Hipervinculo a la encuesta en formato de codigo QR">
								<a href="{{ url('surveys/'.$survey->id.'/survey') }}">
								<img src="data:image/png;base64,{{DNS2D::getBarcodePNG('http://tutophoton.com.ve/encuestas/public/surveys/'.$survey->id.'/survey', 'QRCODE')}}" alt="barcode" width="120" height="120" /></a>
							</div>
							
							<div class="box-body col-md-6 col-lg-12 col-xl-12">
							<hr>
								<div class="pull-right">
									{!!link_to_route('surveys.index', $title = 'Atras',  $parameters = '', $attributes = ['class' => 'btn btn-default btn3d', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px; margin-top: 12px;'])!!}
								</div>
							</div>		    		
			    		</div>
			    	</div>
	    		</div>
    		</div>
    	</div>
    </div>

@endsection