<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
    
    <title>Folleto</title>
</head>
<body>
    <div style="width: 399px; height: 582px; padding-right: 15px; padding-left: 15px;margin-right: 50px;margin-left: 50px;margin-top: 50px; border: 1px solid #000;">
        
    </div>
    
    <div style="position:absolute; top: 0px; left: 20%;padding: 10px 0px 10px 0px; text-align: center;">
            <img width="120" height="60" src="{{ asset(Auth::user()->avatar) }}" alt="logo">
    </div>
    
    <div style="width: 428px; height:80px;position:absolute; top: 5%; left: 5%;background-color: #FF5200;color:#fff; text-align: center;">
            <b style="font-size: 25px;">AYUDANOS</b><br>
            <b style="font-size: 25px;">A MEJORAR!</b>
        </div>
        <div style="width: 428px; height:80px;position:absolute; top: 10.5%; left: 5%;background-color: #dce0e2;color:#000; text-align: center;">
            <b style="font-size:20px">Compartenos tu opinion en nuestro breve encuesta en menus de 30 segundos</b>
        </div>
         <br>
         <div style="position:absolute; top:14.6%;left:1%; margin-top: 5px;">
            <div style="left:-360px;position:relative;min-height:1px; width: 200px;margin: 0 auto;text-align: center;background-color: #ccc;">
                <h5>SCANEA EL</h5>
                <h4>CODIGO</h4>
                <h5>QR <img width="30" height="30" src="{{ asset('web/images/arrowright.png') }}" alt=""></h5>
                <h5>O INGRESA</h5>
                <h5> a <img width="30" height="30" src="{{ asset('web/images/arrowdown.png') }}" alt=""></h5>
            </div>
            <div style="position:absolute;left:25.7%;top: 2.2%;min-height:1px;width: 200px;margin: 0 auto;text-align: center;">
                <img src="data:image/png;base64,{{DNS2D::getBarcodePNG('http://calificame.mx/s/'.$surveys->id, 'QRCODE')}}" alt="barcode" width="160" height="190" />
            </div>
        </div>
        <div style="text-align:center; padding:10px;position: absolute; top:31%; background-color: #fff;font-size: 1.2em; color: #000; width: 400px; left: 5%">calificame.mx/s/{{ $surveys->id }}</div>
        <div style="text-align:center; padding:10px;position: absolute; top:34%; background-color: #FF5200;font-size: 1.2em; color: #fff; width: 408px; left: 5%">calificame.mx/s/{{ $surveys->id }}</div>
        <div style="text-align:center; padding:5px;position: absolute; top:37%; background-color: #ccc;font-size: 1.9em; color: #222; width: 418px; left: 5%">calificame.mx/s/{{ $surveys->id }}</div>
         
    
       
</body>
</html>


