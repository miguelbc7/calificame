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
                    <span class="Link">https://www.google.co.ve/</span>
                </div>

                <div class="center">
                    <img class="card-image-QR" width="300px" height="300px" src="{{ asset('img/codigoqr.png') }}">
                    <p class="p-qr">Codigo QR</p>
                </div>

            </div>
        </div>
    </div>
    <div class="pull-right">
	    <button class="btn btn-primary btn3d">Imprimir</button>
	    {!!link_to_route('surveys.index', $title = 'Atras',  $parameters = '', $attributes = ['class' => 'btn btn-default btn3d', 'style'=>'-webkit-border-radius: 8px;-moz-border-radius: 8px;border-radius: 8px;'])!!}
	</div>

	<script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
    <script src="{{ asset('web/js/bootstrap.min.js') }}"></script>

@endsection