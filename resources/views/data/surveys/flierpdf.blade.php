<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
    
    <title>Folleto</title>
</head>
<body>
    <div style="width: 1380px; height: 900px; padding-right: 15px; padding-left: 15px;margin-right: 50px;margin-left: 50px;margin-top: 50px; border: 1px solid #000;">
        
    </div>
    
    <div style="position:absolute; top: 0px; left: 45%;padding: 10px 0px 10px 0px; text-align: center;">
            <img width="150" height="150" src="{{ asset(Auth::user()->avatar) }}" alt="logo">
    </div>
    
    <div style="width: 1410px;margin-left: -5px; height:200px;position:absolute; top: 20%; left: 3.8%;background-color: #FF5200;color:#fff; text-align: center;">
            <b style="font-size: 60px;">AYÚDANOS</b><br>
            <b style="font-size: 60px;">A MEJORAR!</b>
        </div>
        <div style="width: 1388px; height:100px;position:absolute; top: 40.4%; left: 4.35%;padding:10px;margin-right: -15px; margin-left: -15px;background-color: #dce0e2;color:#000; text-align: center;">
            <b style="font-size:40px">Compártenos tu opinión en nuestro breve encuesta en menus de 30 segundos</b>
        </div>
         <br>
         <div style="position:absolute; top:51%;left:1.8%;margin-right: -15px; margin-left: -15px; margin-top: 5px;">
            <div style="left:-320px;position:relative;min-height:1px;padding-right: 15px;padding-left:15px; width: 50%;margin: 0 auto;text-align: center;background-color: #ccc;">
                <h2>SCANEA EL</h2>
                <h1>CODIGO</h1>
                <h2>QR <img width="30" height="30" src="{{ asset('web/images/arrowright.png') }}" alt=""></h2>
                <h2>O INGRESA</h2>
                <h2> a <img width="30" height="30" src="{{ asset('web/images/arrowdown.png') }}" alt=""></h2>
            </div>
            <div style="position:absolute;left:50%;top: 4.8%;min-height:1px;padding-right: 15px;padding-left:15px; width: 50%;margin: 0 auto;text-align: center;">
                <img src="data:image/png;base64,{{DNS2D::getBarcodePNG('http://tutophoton.com.ve/encuestas/public/surveys/'.$surveys->id.'/survey', 'QRCODE')}}" alt="barcode" width="350" height="234" />
            </div>
        </div>
        <div style="text-align:center; padding:10px;position: absolute; top:79%; background-color: #fff;font-size: 1.2em; color: #000; width: 1389px; left: 3.5%">calificame.mx/79</div>
        <div style="text-align:center; padding:10px;position: absolute; top:83%; background-color: #FF5200;font-size: 1.2em; color: #fff; width: 1389px; left: 3.5%">calificame.mx/79</div>
        <div style="text-align:center; padding:5px;position: absolute; top:87%; background-color: #ccc;font-size: 1.9em; color: #222; width: 1400px; left: 3.5%">calificame.mx/79</div>
         
    
       
</body>
</html>



