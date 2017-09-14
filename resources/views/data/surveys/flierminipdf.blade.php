<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
    
    <title>Folleto</title>
</head>
<body>
    <div style="width: 220px; height: 336px; padding-right: 15px; padding-left: 15px;margin-right: 50px;margin-left: 50px;margin-top: 50px; border: 1px solid #000;">
        
    </div>
    
    <div style="position:absolute; top: 0px; left: 13%;padding: 10px 0px 10px 0px; text-align: center;">
            <img width="80" height="40" src="{{ asset(Auth::user()->avatar) }}" alt="logo">
    </div>
    
    <div style="width: 249px; height:40px;position:absolute; top: 4%; left: 5%;background-color: #FF5200;color:#fff; text-align: center;">
            <b style="font-size: 15px;">AYUDANOS</b><br>
            <b style="font-size: 15px;">A MEJORAR!</b>
        </div>
        <div style="width: 249px; height:30px;position:absolute; top: 6.5%; left: 5%;background-color: #dce0e2;color:#000; text-align: center;">
            <b style="font-size:12px">Compartenos tu opinion en nuestro breve encuesta en menus de 30 segundos</b>
        </div>
         <br>
         <div style="position:absolute; top:7.2%;left:1%; margin-top: 5px;">
            <div style="left:-405px;position:relative;max-height:120px; width: 120px; margin: 0 auto;text-align: center;background-color: #ccc;">
                <h6 style="font-size: 8px">SCANEA EL</h6>
                <h6 style="font-size: 8px">CODIGO</h6>
                <h6 style="font-size: 8px">QR <img width="10" height="10" src="{{ asset('web/images/arrowright.png') }}" alt=""></h6>
                <h6 style="font-size: 8px">O INGRESA</h6>
                <h6 style="font-size: 8px"> a <img width="10" height="10" src="{{ asset('web/images/arrowdown.png') }}" alt=""></h6>
            </div>
            <div style="position:absolute;left:12.7%;top: 1.5%;min-height:1px;width: 200px;margin: 0 auto;text-align: center;">
                <img src="data:image/png;base64,{{DNS2D::getBarcodePNG('http://calificame.mx/s/'.$surveys->id, 'QRCODE')}}" alt="barcode" width="100" height="120" />
            </div>
        </div>
        <div style="text-align:center; padding:2px;position: absolute; top:18%; background-color: #fff;font-size: 1em; color: #000; width: 244px; left: 5%">calificame.mx/s/{{ $surveys->id }}</div>
        <div style="text-align:center; padding:2px;position: absolute; top:19.4%; background-color: #FF5200;font-size: 1em; color: #fff; width: 245px; left: 5%">calificame.mx/s/{{ $surveys->id }}</div>
        <div style="text-align:center; padding:1px;position: absolute; top:21%; background-color: #ccc;font-size: 1.6em; color: #222; width: 247px; left: 5%">calificame.mx/s/{{ $surveys->id }}</div>
         
    
       
</body>
</html>
