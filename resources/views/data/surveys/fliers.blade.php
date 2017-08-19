@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Volante de la Encuesta
@endsection

@section('contentheader_title')
    Volante de la Encuesta
@endsection

@section('main-content')

<div class="container1">
        <div class="row">
            <div id="parte1" class="col-lg-6">
                <div class="center">
                    <img class="card-image" width="300px" height="300px" src="{{ asset('web/images/logo2.png') }}">
                    <h2>Participa</h2>
                    <p class="styleP">
                       Te hacemos una cordial invitación a participar en la encuesta de nuestra {empresa}. Donde buscamos saber tu opinion acerca de nuestro servicio, ayudandonos a mejorar como empresa.
                       <p class="styleP">Su encuesta sera tratanda de forma confidencial y no serán utilizadas para ningún propósito distinto a la investigación.</p>
                    </p>
                </div>
            </div>
            <div id="parte2" class="col-lg-6">

                <h2 class="center padingh2"> Desde este link podras participar en nuestra encuesta.</h2>
                <div class="margin">
                    <span class="Link"><a href="{{ url('surveys/'.$surveys->id.'/survey') }}"><h4> tutophoton.com.ve/encuestas/public/surveys/{{ $surveys->id }}/survey </h4></a></span>
                </div>

                <div class="center">
                   <a href="{{ url('surveys/'.$surveys->id.'/survey') }}">
                        <img src="data:image/png;base64,{{DNS2D::getBarcodePNG('http://tutophoton.com.ve/encuestas/public/surveys/'.$surveys->id.'/survey', 'QRCODE')}}" alt="barcode" width="200" height="200" /></a>
                    <p class="p-qr">Codigo QR</p>
                </div>

            </div>
        </div>
    </div>
    <div class="pull-right">
        <a href="{{ route('flierpdf', $surveys->id) }}" target="_blank" class="btn btn-primary" data-toggle="tooltip" data-original-title="Imprimir" type="edit">Imprimir</a>
        {!!link_to_route('surveys.index', $title = 'Atras',  $parameters = '', $attributes = ['class' => 'btn btn-default btn3d', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
	</div>

	<script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
    <script src="{{ asset('web/js/bootstrap.min.js') }}"></script>

@endsection