<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Flier</title>
  <link href="web/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/flier.css'">
</head>
  <body>
    <div class="container">
        <div class="row" style="border: 1px solid #000;">
            <div class="col-lg-6">
                <div style="text-align: center">
                    <img  width="250px" height="250px" src="web/images/logo2.png">
                    <h2 style="color: #028ee4;font-weight: 900;text-align: left;margin-left: 30px;text-align: center;">Participa</h2>
                    <p style="font-size: 1.4em;margin: 30px;text-align: justify;text-indent: 30px;">
                       Te hacemos una cordial invitación a participar en la encuesta de nuestra {empresa}. Donde buscamos saber tu opinion acerca de nuestro servicio, ayudandonos a mejorar como empresa.
                       <p style="font-size: 1.4em;margin: 30px;text-align: justify;text-indent: 30px;">Su encuesta sera tratanda de forma confidencial y no serán utilizadas para ningún propósito distinto a la investigación.</p>
                    </p>
                </div>
            </div>
        </div>

        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

        <div class="row" style="border: 1px solid #000;">
            <div id="parte2" class="col-lg-6">

                <h2 style="text-align:center;padding-top: 50px;"> Desde este link podras participar en nuestra encuesta.</h2>
                <div style="text-align:center;">
                    <span style="font-size: 1.5em;color: #000;">tutophoton.com.ve/encuestas/public/surveys/{{ $surveys->id }}/survey</span>
                </div>

                <div style="text-align:center;">
                    <p style="  color: #028ee4;font-size: 1.4em;font-weight: 500;">Codigo QR</p>
                    <img src="data:image/png;base64,{{DNS2D::getBarcodePNG('http://tutophoton.com.ve/encuestas/public/surveys/'.$surveys->id.'/survey', 'QRCODE')}}" alt="barcode" width="250" height="250" />
                </div>
                
            </div>
          </div>
        </div>
    </div>

</body>
</html>