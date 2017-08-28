<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Folleto</title>
</head>
<body>
    <div style="padding-right: 15px; padding-left: 15px;margin-right: 50px;margin-left: 50px;margin-top: 50px; border: 1px solid #000;">
        <div style="margin: 0 auto; text-align: center;">
            <img width="150" height="150" src="{{ asset(Auth::user()->avatar) }}" alt="logo">
        </div>
        <div style="margin-right: -15px; margin-left: -15px;background-color: #FF5200;color:#fff; text-align: center;">
        <b style="font-size: 60px;">AYÚDANOS</b><br>
        <b style="font-size: 60px;">A MEJORAR!</b>
        </div>
        <div style="margin-right: -15px; margin-left: -15px;background-color: #dce0e2;"><p style="text-align: center; margin: 0 auto; font-size: 35px;">Compártenos tu opinión en nuestro breve encuesta en menus de 30 segundos</p></div>
        <div style="margin-right: -15px; margin-left: -15px; margin-top: 5px;">
            <div style="position:relative;min-height:1px;padding-right: 15px;padding-left:15px; float:left; width: 50%;margin: 0 auto;text-align: center;background-color: #ccc;">
                <h2>SCANEA EL</h2>
                <h1>CODIGO</h1>
                <h2>QR <img width="30" height="30" src="{{ asset('web/images/arrowright.png') }}" alt=""></h2>
                <h2>O INGRESA</h2>
                <h2> a <img width="30" height="30" src="{{ asset('web/images/arrowdown.png') }}" alt=""></h2>
            </div>
            <div style="position:relative;min-height:1px;padding-right: 15px;padding-left:15px; float:left; width: 50%;margin: 0 auto;text-align: center;">
                <img src="data:image/png;base64,{{DNS2D::getBarcodePNG('http://tutophoton.com.ve/encuestas/public/surveys/'.$surveys->id.'/survey', 'QRCODE')}}" alt="barcode" width="350" height="254" />
            </div>
        </div>
        <div style="margin-right: -15px; margin-left: -15px;">
            <div><h3 style="margin: 0 auto;text-align: center; color: #fff">&nbsp;</h3></div><br>
            <div style="padding-right: 15px; padding-left: 15px;"><h3 style="margin: 0 auto;text-align: center;">calificame.mx/79</h3></div>
            <div style="padding-right: 15px; padding-left: 15px;    background-color: #FF5200;color:#fff;text-align: center;"><h3 style="margin: 0 auto;text-align: center;">TU OPINIÓN ES LO MAS IMPORTANTE</h3></div>
            <div style="padding-right: 15px; padding-left: 15px;background-color: #ccc;"><h2 style="margin: 0 auto;text-align: center;">calificame.mx</h2>
            </div>
        </div>
    </div>
</body>
</html>