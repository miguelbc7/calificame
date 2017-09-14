<?php
    session_start();
    if(isset($_SESSION['lang']))
    {
        if($_SESSION['lang'] == 'es')
        {
            App::setLocale('es');
        }
        elseif($_SESSION['lang'] == 'en')
        {   
            App::setLocale('en');
        }
        elseif($_SESSION['lang'] == 'pt-BR')
        {
            App::setLocale('pt-BR');
        }
        else
        {

        }
    }
?>
<!DOCTYPE html><!-- Last Published: Mon Jun 26 2017 11:32:10 GMT+0000 (UTC) --><html data-wf-domain="www.calificame.com" data-wf-page="58ff57253eae93580fa17c3f" data-wf-site="576bbb263b0f04c134edb9ab">
<!-- Mirrored from www.calificame.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 27 Jun 2017 15:01:08 GMT -->
<head>
<meta charset="utf-8">
<title>Calificame – Encuestas de Satisfacción para tu Restaurante</title>
<meta content="calificame es un sistema para hacer encuestas de satisfacción fáciles para restaurantes. Pruébalo gratis durante 30 días y descubre la opinión de tus clientes." name="description">
<meta content="calificame – Encuestas de Satisfacción para tu Restaurante" property="og:title"><meta content="calificame es un sistema para hacer encuestas de satisfacción fáciles para restaurantes. Pruébalo gratis durante 30 días y descubre la opinión de tus clientes." property="og:description">
<meta content="summary" name="twitter:card">
<meta content="width=device-width, initial-scale=1" name="viewport">

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- Latest compiled and minified CSS -->

<link href="{{ asset('web/css/webflow.css') }}" rel="stylesheet" type="text/css">
<!--<script src="{{ asset('web/js/webfont.js') }}"></script>-->
<!--<script type="text/javascript">WebFont.load({
google: {
  families: ["Open Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic","Source Sans Pro:300,300italic,regular,600"]
}
});
</script>-->
<!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js" type="text/javascript"></script><![endif]-->
<script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);
</script>
<link href="{{ asset('web/images/favicon-32.png') }}" rel="shortcut icon" type="image/x-icon">
<link href="{{ asset('web/images/favicon-256.png') }}" rel="apple-touch-icon">

<script type="text/javascript" src="{{ asset('web/js/jstz.min.js') }}"></script>

<script type="text/javascript">
var Webflow = Webflow || [];
Webflow.push(function () {
  var timeZone = jstz.determine();
  $('#signup_pro_form #user_time_zone_modal').val(timeZone.name());
  $('#signup_basic_form #user_time_zone_modal').val(timeZone.name());
});
</script>

<!-- Hotjar Tracking Code for http://calificame.com -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:496080,hjsv:5};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'//static.hotjar.com/c/hotjar-','.js?sv=');
</script>
</head>
<body class="body">
  <div class="nav--fixed w-nav" data-animation="default" data-collapse="medium" data-duration="400" data-ix="display-none">
    <div class="w-container">
      <a class="w-nav-brand" href="{{ URL('/') }}">
        <img alt="calificame" class="nav__logo" id="nav__logoTOP" src="{{ asset('web/images/logo.png') }}" width="180" height="50">
      </a>
      <nav class="nav_menu w-clearfix w-nav-menu" role="navigation">
        <a class="nav__link w-nav-link" href="#why-calificame">{{ Lang::get('message.menu1') }}</a>
        <a class="nav__link w-nav-link" href="#how-it-works">{{ Lang::get('message.menu2') }}</a>
        <a class="nav__link w-nav-link" href="#plans">{{ Lang::get('message.menu3') }}</a>
        <a class="button nav__button w-button" href="#plans">{{ Lang::get('message.menu4') }}</a>
      </nav>

      <div class="menu_button w-nav-button" id="w-icon-nav-menu">
        <div class="w-icon-nav-menu"></div>
      </div>
    </div>
  </div>

  <div class="hero" data-ix="display-nav">
    <div class="nav w-nav" data-animation="default" data-collapse="medium" data-duration="400">
    <a class="w-nav-brand logo-right logo-right2" href="{{ URL('/') }}"><img alt="calificame" class="nav__logo logo-right" src="{{ asset('web/images/logo.png') }}"></a>
      <div class="w-container">
        <nav class="nav_menu nav_menu_not_fixed w-nav-menu" role="navigation">
          <a class="nav__link w-nav-link" href="#why-calificame">{{ Lang::get('message.menu1') }}</a>
          <a class="nav__link w-nav-link" href="#how-it-works">{{ Lang::get('message.menu2') }}</a>
          <a class="nav__link w-nav-link" href="#plans">{{ Lang::get('message.menu3') }}</a>
          <a class="nav__link w-nav-link" href="{{ url('/logi') }}">{{ Lang::get('message.menu4') }}</a>

        </nav>

        <div class="menu_toggle w-nav-button" id="menu">
          <div class="w-icon-nav-menu"></div>
        </div>
      </div>
    </div>

    <div class="w-container">
      <h1 class="hero__heading">Mejora tu servicio y multiplica tus clientes</h1>
      <p class="hero__subheading">Ahora tus clientes ya podran dar su opinion desde su celular y calificar tu servicio</p>
      <!--<div class="hero__videocontainer">
          <img src="{{ asset('web/images/index.jpg') }}">
      </div>-->
      <a class="button hero__cta w-button" href="#plans">Crea tu cuenta&nbsp;</a>
      <h1 class="hero__subheading">¡Pruebalo 30 dias gratis!</h1>
    </div>
  </div>

    <!-- Beneficios de Usar Hidden -->
  <div class="section whycalificame" id="why-calificame" style="background-color: #92d6f6">
    <div class="w-container">
     <h2 class="section__header hidden-xs" >{{ Lang::get('message.why') }} <img alt="calificame" class="nav__logo" src="{{ asset('web/images/logo.png') }}" width="183" height="50"></h2>
      <h2 class="section__header hidden-sm hidden-md hidden-lg">{{ Lang::get('message.why') }}</h2>
       <img alt="calificame" class="nav__logo hidden-sm hidden-md hidden-lg" id="logo-calificame" src="{{ asset('web/images/logo.png') }}">  
      <div class="w-row">
        <div class="column w-col w-col-4">
          <div class="whycalificame__imagecontainer">
            <img class="column__image" data-ix="appear" src="{{ asset('web/images/midelo.png') }}" title="¡Mídelo!">
          </div>
          <h3 class="column__header">{{ Lang::get('message.why1') }}</h3>
          <div class="paragraph">{{ Lang::get('message.whydes1') }}</div>
        </div>
        <div class="column w-col w-col-4">
          <div class="whycalificame__imagecontainer">
            <img class="column__image" data-ix="appear-2" src="{{ asset('web/images/escuchalos.png') }}" title="¡Escúchalos!">
          </div>
          <h3 class="column__header">{{ Lang::get('message.why2') }}</h3>
          <div class="paragraph">{{ Lang::get('message.whydes2') }}</div>
        </div>
        <div class="column w-col w-col-4">
          <div class="whycalificame__imagecontainer">
            <img class="column__image grow" data-ix="appear-3" src="{{ asset('web/images/mejoralo.png') }}" title="¡Mejóralo!">
          </div>
          <h3 class="column__header">{{ Lang::get('message.why3') }}</h3>
          <div class="paragraph">{{ Lang::get('message.whydes3') }}</div>
        </div>
      </div>
    </div>
  </div>
  <!-- Beneficios de Usar -->

<!--<div class="testimonial">
  <div class="testimonial__container w-container">
    <div class="testimonial__quotecontainer">
      <div class="testimonial__quote">{{ Lang::get('message.review1') }}</div>
    </div>
    <div class="testimonial__authorcontainer">
      <img class="testimonial__authorpicture" src="{{ asset('web/images/foto.png') }}">
      <div class="testimonial__authordetails">
        <div class="testimonia__authorname">{{ Lang::get('message.reviewer1') }}</div>
        <div class="testimonial__authortitle">{{ Lang::get('message.reviewerdes1') }}</div>
      </div>
    </div>
  </div>
</div>-->

    <!-- Fácil de Usar -->
    <div class="howitworks section" id="how-it-works">
      <div class="w-container"><h2 class="section__header">{{ Lang::get('message.how') }}</h2>
        <div class="w-row">
          <div class="column w-col w-col-4 w-col-medium-12 w-col-small-12">
            <div class="howworks_imagecointainer">
              <img class="column__image" src="{{ asset('web/images/creatyouraccount.png') }}" title="Crea tu encuesta">
            </div>
            <h3 class="column__header">{{ Lang::get('message.how1') }}</h3>
            <div class="paragraph">{{ Lang::get('message.howdes1') }}</div>
          </div>
          <div class="column w-col w-col-4 w-col-medium-12 w-col-small-12">
            <div class="howworks_imagecointainer">
              <img class="column__image" src="{{ asset('web/images/makeitvisible.png') }}" width="120" title="Hazla Visible">
            </div>
            <h3 class="column__header">{{ Lang::get('message.how2') }}</h3>
            <div class="paragraph">{{ Lang::get('message.howdes2') }}</div>
          </div>
          <div class="column w-col w-col-4 w-col-medium-12 w-col-small-12">
            <div class="howworks_imagecointainer">
              <img class="column__image" src="{{ asset('web/images/findout.png') }}" title="Conoce la opinión de tus clientes">
            </div>
            <h3 class="column__header">{{ Lang::get('message.how3') }}</h3>
            <div class="paragraph">{{ Lang::get('message.howdes3') }}</div>
          </div>
      </div>
    </div>
    </div> <!-- Hacia Falta este Div -->
    <!-- Fácil de Usar -->

        <!--<div class="testimonial">
          <div class="testimonial__container w-container">
            <div class="testimonial__quotecontainer">
              <div class="testimonial__quote">{{ Lang::get('message.review2') }}</div>
            </div>
            <div class="testimonial__authorcontainer">
              <img class="testimonial__authorpicture" src="{{ asset('web/images/fotosara.png') }}"><div>
                <div class="testimonia__authorname">{{ Lang::get('message.reviewer2') }}</div>
                <div class="testimonial__authortitle">{{ Lang::get('message.reviewerdes2') }}</div>
              </div>
            </div>
          </div>
        </div>-->


<!-- Llamados de los Script -->
<link rel="stylesheet" href="{{ asset('web/js/jquery.flipster.min.css') }}">
<script src="{{ asset('web/js/jquery.min.js') }}"></script>
<script src="{{ asset('web/js/jquery.flipster.min.js') }}"></script>
 <!-- Llamados de los Script -->
 <!-- Section Plan de Pagos con Carousel Nuevo / 24/7 -->
 <!--   <div class="plans section" id="plans">
          <div class="container w-container">
            <h2 class="section__header">{{ Lang::get('message.planslogan') }}</h2>
            <p class="customers_subheading">{{ Lang::get('message.plansubslogan') }}</p>
            <div class="pricingcard__container" data-ix="close-contact">
              <div id="carousel" class="demo">
                <ul class="flip-items">
                  <li data-flip-title="Plan 24/7" id="demo1">
                    <div class="pricingcard__card pricingcard__card--highlighted">
                      <div class="pricingcard__headercontainer">
                        <h3 class="pricingcard__heading">{{ Lang::get('message.plan2') }}</h3>
                        <div class="pricingcard__maspopular">{{ Lang::get('message.subplan2') }}</div>
                        <div class="pricingcard__pricingwraper">
                          <div class="pricingcard__pricing">{{ Lang::get('message.price2') }}<br><em class="pricingcard__pricing--em">{{ Lang::get('message.subprice2') }}</em>
                          </div>
                        </div>
                        <dl class="pricingcard__features" id="text-color">
                          <dt>Aquí va el término que definiremos</dt> 
                            <dd>Y aquí dentro irá la definición propiamente dicha.</dd>
                        </dl>
                        <dl class="pricingcard__features" id="text-color">
                          <dt>Aquí va el término que definiremos</dt> 
                            <dd>Y aquí dentro irá la definición propiamente dicha.</dd>
                        </dl>
                        <dl class="pricingcard__features" id="text-color">
                          <dt>Aquí va el término que definiremos</dt> 
                            <dd>Y aquí dentro irá la definición propiamente dicha.</dd>
                        </dl>
                          <a class="button w-button" href="{{ URL('regis') }}">{{ Lang::get('message.planbutton2') }}</a>
                      </div>
                    </div>
                    </li>
                    <li data-flip-title="Plan 24/7" id="demo1">
                    <div class="pricingcard__card pricingcard__card--highlighted">
                      <div class="pricingcard__headercontainer">
                        <h3 class="pricingcard__heading">{{ Lang::get('message.plan2') }}</h3>
                        <div class="pricingcard__maspopular">{{ Lang::get('message.subplan2') }}</div>
                        <div class="pricingcard__pricingwraper">
                          <div class="pricingcard__pricing">{{ Lang::get('message.price2') }}<br><em class="pricingcard__pricing--em">{{ Lang::get('message.subprice2') }}</em>
                          </div>
                        </div>
                        <dl class="pricingcard__features" id="text-color">
                          <dt>Aquí va el término que definiremos</dt> 
                            <dd>Y aquí dentro irá la definición propiamente dicha.</dd>
                        </dl>
                        <dl class="pricingcard__features" id="text-color">
                          <dt>Aquí va el término que definiremos</dt> 
                            <dd>Y aquí dentro irá la definición propiamente dicha.</dd>
                        </dl>
                        <dl class="pricingcard__features" id="text-color">
                          <dt>Aquí va el término que definiremos</dt> 
                            <dd>Y aquí dentro irá la definición propiamente dicha.</dd>
                        </dl>
                          <a class="button w-button" href="{{ URL('regis') }}">{{ Lang::get('message.planbutton2') }}</a>
                      </div>
                    </div>
                    </li>
                    <li data-flip-title="Plan 24/7" id="demo1">
                    <div class="pricingcard__card pricingcard__card--highlighted">
                      <div class="pricingcard__headercontainer">
                        <h3 class="pricingcard__heading">{{ Lang::get('message.plan2') }}</h3>
                        <div class="pricingcard__maspopular">{{ Lang::get('message.subplan2') }}</div>
                        <div class="pricingcard__pricingwraper">
                          <div class="pricingcard__pricing">{{ Lang::get('message.price2') }}<br><em class="pricingcard__pricing--em">{{ Lang::get('message.subprice2') }}</em>
                          </div>
                        </div>
                        <dl class="pricingcard__features" id="text-color">
                          <dt>Aquí va el término que definiremos</dt> 
                            <dd>Y aquí dentro irá la definición propiamente dicha.</dd>
                        </dl>
                        <dl class="pricingcard__features" id="text-color">
                          <dt>Aquí va el término que definiremos</dt> 
                            <dd>Y aquí dentro irá la definición propiamente dicha.</dd>
                        </dl>
                        <dl class="pricingcard__features" id="text-color">
                          <dt>Aquí va el término que definiremos</dt> 
                            <dd>Y aquí dentro irá la definición propiamente dicha.</dd>
                        </dl>
                          <a class="button w-button" href="{{ URL('regis') }}">{{ Lang::get('message.planbutton2') }}</a>
                      </div>
                    </div>
                    </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <!-- Section Plan de Pagos con Carousel Nuevo / 24/7 -->

<!-- Section Plan de Pagos con Carousel Nuevo Script / 24/7 -->
<script>
    var carousel = $("#carousel").flipster({
        style: 'carousel',
        spacing: -0.5,
        nav: true,
        buttons:   true,
    });
</script>
<!-- Section Plan de Pagos con Carousel Nuevo Script / 24/7 -->   
        <section>
          <div class="testimonial w-hidden-tiny">
                <div class="testimonial__container w-container">
                  <div class="testimonial__quotecontainer">
                    <div class="testimonial__quote">“Con califícame se lo que sucede en mi restaurante todo el tiempo, cuando algún cliente tiene una queja lo solucionamos inmediatamente”</div>
                  </div>
                  <div class="testimonial__authorcontainer">
                    <div>
                      <div class="testimonia__authorname"> Saddam Gavilanes </div>
                      <div class="testimonial__authortitle">Maz Salads</div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="testimonial w-hidden-tiny">
                <div class="testimonial__container w-container">
                  <div class="testimonial__quotecontainer">
                    <div class="testimonial__quote">{{ Lang::get('message.review2') }}</div>
                  </div>
                  <div class="testimonial__authorcontainer">
                  <div>
                      <div class="testimonia__authorname">{{ Lang::get('message.reviewer2') }}</div>
                      <div class="testimonial__authortitle">{{ Lang::get('message.reviewerdes2') }}</div>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
        </section>
      
        <div class="plans section" id="plans">
          <div class="container w-container">
            <!--<h2 class="section__header">Planes</h2>-->
            <!--<p class="customers_subheading">{{ Lang::get('message.plansubslogan') }}</p>-->
            <div class="pricingcard__container" data-ix="close-contact">
              
              <div class="pricingcard__card">
                <!--<div class="pricingcard__headercontainer">
                  <h3 class="pricingcard__heading--basic">{{ Lang::get('message.plan1') }}</h3>
                  <div class="pricingcard__pricingwraper">
                    <div class="pricingcard__pricing">{{ Lang::get('message.price1') }}<br><em class="pricingcard__pricing--em">{{ Lang::get('message.subprice1') }}</em>
                    </div>
                  </div>
                </div>
                <ul class="pricingcard__features">
                  <li class="list-item">{{ Lang::get('message.plandes1.1') }}</li>
                  <li class="list-item-2">{{ Lang::get('message.plandes1.2') }}</li>
                  <li class="list-item-3">{{ Lang::get('message.plandes1.3') }}</li>
                  <li class="list-item-4">{{ Lang::get('message.plandes1.4') }}</li>
                </ul>
                <a class="button w-button" data-ix="open-signup-pro" href="#">{{ Lang::get('message.planbutton1') }}</a>-->
              </div>

              <div class="pricingcard__card pricingcard__card--highlighted">
                <h1 class="hero__subheading">Pruebalo 30 dias gratis</h1>
                <div class="pricingcard__headercontainer">
                  <h3 class="pricingcard__heading">Plan Sin Limites</h3>
                  <div class="pricingcard__maspopular"></div>
                  <div class="pricingcard__pricingwraper">
                    <br>
                    <div class="pricingcard__pricing">{{ Lang::get('message.price2') }}<br><em class="pricingcard__pricing--em">{{ Lang::get('message.subprice2') }}</em>
                    </div>
                </div>
               </div>

                <ul class="pricingcard__features">
                  <b><img width="40" height="40" src="web/images/check2.png">&nbsp;&nbsp;&nbsp;Encuestas personalizadas</b><br>
                  <b><img width="40" height="40" src="web/images/check2.png">&nbsp;&nbsp;&nbsp;Aplicacion Ilimitada de encuestas</b><br>
                  <b><img width="40" height="40" src="web/images/check2.png">&nbsp;&nbsp;&nbsp;Alertas en tu email de clientes no satisfechos</b><br>
                  <b><img width="40" height="40" src="web/images/check2.png">&nbsp;&nbsp;&nbsp;Resultados en estadisticas de satisfaccion</b><br>
                  <b><img width="40" height="40" src="web/images/check2.png">&nbsp;&nbsp;&nbsp;Resultados de cada cliente</b><br>
                </ul>

                <a class="button w-button" href="{{ URL('regis') }}">$400 Pesos Mensuales</a>
              </div>

              <div class="pricingcard__card">
                <!--<div class="pricingcard__headercontainer">
                  <h3 class="pricingcard__heading--basic">{{ Lang::get('message.plan3') }}</h3>
                  <div class="pricingcard__pricingwraper">
                    <div class="pricingcard__pricing">{{ Lang::get('message.price3') }}<br>
                      <em class="pricingcard__pricing--em">{{ Lang::get('message.subprice3') }}</em>
                    </div>
                  </div>
                </div>

                <ul class="pricingcard__features">
                  <li>{{ Lang::get('message.plandes3.1') }}</li>
                  <li>{{ Lang::get('message.plandes3.2') }}</li>
                  <li>{{ Lang::get('message.plandes3.3') }}</li>
                  <li>{{ Lang::get('message.plandes3.4') }}</li>
                </ul>

                <a class="button w-button" data-ix="open-signup-pro" href="#">{{ Lang::get('message.planbutton3') }}</a>-->
              </div>

            </div>
          </div>
        </div>
        <!-- Section Plan / 24/7 Desactivado -->

        <!--<div class="testimonial w-hidden-tiny">
          <div class="testimonial__container w-container">
            <div class="testimonial__quotecontainer">
              <div class="testimonial__quote">{{ Lang::get('message.review3') }}</div>
            </div>
            <div class="testimonial__authorcontainer">
              <img class="testimonial__authorpicture" src="{{ asset('web/images/fotoeduardo.png') }}">
              <div>
                <div class="testimonia__authorname">{{ Lang::get('message.reviewer3') }}</div>
                  <div class="testimonial__authortitle">{{ Lang::get('message.reviewerdes3') }}</div>
              </div>
            </div>
          </div>
        </div>-->

        <!--<div class="section whousescalificame">
          <div class="w-container">
            <h2 class="section__header">{{ Lang::get('message.who') }}</h2>
            <p class="customers_subheading">{{ Lang::get('message.whoslogan') }}</p>
            <div class="customers__container">
              <div class="w-row" data-ix="appear">
                <div class="w-col w-col-3 w-col-small-6">
                  <div class="customers__logocontainer"><img class="customers__logo" src="{{ asset('web/images/melia.png') }}"></div>
                </div>
                <div class="w-col w-col-3 w-col-small-6">
                  <div class="customers__logocontainer">
                    <img class="customers__logo" src="{{ asset('web/images/ribs.png') }}">
                  </div>
                </div>
                <div class="w-col w-col-3 w-col-small-6">
                  <div class="customers__logocontainer">
                    <img class="customers__logo" src="{{ asset('web/images/dominos.png') }}">
                  </div>
                </div>
                <div class="w-col w-col-3 w-col-small-6">
                  <div class="customers__logocontainer">
                    <img class="customers__logo" src="{{ asset('web/images/fosters.png') }}">
                  </div>
                </div>
              </div>
              <div class="w-row" data-ix="appear-2">
                <div class="w-col w-col-3 w-col-small-6">
                  <div class="customers__logocontainer">
                    <img class="customers__logo" src="{{ asset('web/images/barra.png') }}">
                  </div>
                </div>
                <div class="w-col w-col-3 w-col-small-6">
                  <div class="customers__logocontainer">
                    <img class="customers__logo" src="{{ asset('web/images/shintai.jpg') }}">
                  </div>
                </div>
                <div class="w-col w-col-3 w-col-small-6">
                  <div class="customers__logocontainer">
                    <img class="customers__logo" src="{{ asset('web/images/tonyromas.png') }}">
                  </div>
                </div>
                <div class="w-col w-col-3 w-col-small-6">
                  <div class="customers__logocontainer">
                    <img class="customers__logo" src="{{ asset('web/images/nostra.png') }}">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>-->
        
        <!--<div class="testimonial w-hidden-tiny">
          <div class="testimonial__container w-container">
            <div class="testimonial__quotecontainer">
              <div class="testimonial__quote">{{ Lang::get('message.review4') }}</div>
            </div>
            <div class="testimonial__authorcontainer">
              <img class="testimonial__authorpicture" src="{{ asset('web/images/marioaguilar.png') }}">
              <div>
                <div class="testimonia__authorname">{{ Lang::get('message.reviewer4') }}</div>
                  <div class="testimonial__authortitle">{{ Lang::get('message.reviewerdes4') }}</div>
              </div>
            </div>
          </div>
        </div>-->

        <!--<div class="press section w-hidden-tiny">
          <div class="w-container">
            <h2 class="section__header">{{ Lang::get('message.press') }}</h2></div>
            <div class="w-container">
              <div class="press_slider w-slider" data-animation="slide" data-autoplay="1" data-delay="4000" data-duration="500" data-infinite="1">
                <div class="w-slider-mask">
                  <div class="w-slide">
                    <div class="press_container">
                      <blockquote class="press_quote">{{ Lang::get('message.press1') }}</blockquote>
                      <a class="w-inline-block" href="#" id="http-www.abc.es-tecnologia-redes-20141102-abci-calificame-hosteleria-201410301745.html"><img class="press_logo" src="{{ asset('web/images/abc.png') }}"></a>
                    </div>
                  </div>
                  <div class="w-slide">
                    <div class="press_container">
                      <blockquote class="press_quote">{{ Lang::get('message.press2') }}</blockquote>
                      <a class="w-inline-block" href="http://cincodias.com/cincodias/2015/11/05/tecnologia/1446721339_348138.html">
                        <img class="press_logo" sizes="(max-width: 479px) 100vw, (max-width: 767px) 146.09375px, 292.203125px" src="../daks2k3a4ib2z.cloudfront.net/576bbb263b0f04c134edb9ab/5773a0332daa894b44a66b83_csm_LOGO-CINCO-DIAS_adb7c956e0.png" srcset="https://daks2k3a4ib2z.cloudfront.net/576bbb263b0f04c134edb9ab/5773a0332daa894b44a66b83_csm_LOGO-CINCO-DIAS_adb7c956e0-p-500x103.png 500w, https://daks2k3a4ib2z.cloudfront.net/576bbb263b0f04c134edb9ab/5773a0332daa894b44a66b83_csm_LOGO-CINCO-DIAS_adb7c956e0-p-800x165.png 800w, https://daks2k3a4ib2z.cloudfront.net/576bbb263b0f04c134edb9ab/5773a0332daa894b44a66b83_csm_LOGO-CINCO-DIAS_adb7c956e0-p-1080x222.png 1080w, https://daks2k3a4ib2z.cloudfront.net/576bbb263b0f04c134edb9ab/5773a0332daa894b44a66b83_csm_LOGO-CINCO-DIAS_adb7c956e0.png 1125w">
                      </a>
                    </div>
                  </div>
                  <div class="w-slide">
                    <div class="press_container">
                      <blockquote class="press_quote">{{ Lang::get('message.press3') }}</blockquote>
                      <a class="w-inline-block" href="http://www.techfoodmag.com/calificame-valora-mi-restaurante-pero-cuentamelo-a-mi/http://www.techfoodmag.com/calificame-valora-mi-restaurante-pero-cuentamelo-a-mi/">
                        <img class="press_logo" src="{{ asset('web/images/techfood.png') }}">
                      </a>
                    </div>
                  </div>
                  <div class="w-slide">
                    <div class="press_container">
                      <blockquote class="press_quote">{{ Lang::get('message.press4') }}</blockquote>
                      <a class="w-inline-block" href="http://profesionalhoreca.com/calificame-el-sistema-de-encuestas-mas-facil-para-el-restaurante/">
                        <img class="press_logo" src="{{ asset('web/images/horeca.png') }}">
                      </a>
                    </div>
                  </div>
                  <div class="w-slide">
                    <div class="press_container">
                      <blockquote class="press_quote">{{ Lang::get('message.press5') }}</blockquote>
                      <a class="w-inline-block" href="http://marketingastronomico.com/como-subir-las-ventas-en-un-restaurante-con-calificame/">
                        <img class="press_logo" src="{{ asset('web/images/mg.png') }}">
                      </a>
                    </div>
                  </div>
                </div>
                <div class="w-slider-arrow-left">
                  <div class="press_sliderarrow w-icon-slider-left"></div>
                </div>
                <div class="w-slider-arrow-right">
                  <div class="press_sliderarrow w-icon-slider-right"></div>
                </div>
                <div class="press__slidernavigation w-round w-slider-nav w-slider-nav-invert"></div>
              </div>
            </div>
          </div>-->
          


      <!-- Desactivado <div class="footer">
          <div class="w-container">
            <div class="footer__column w-row">
              <div class="w-col w-col-9 w-col-small-6 w-col-tiny-6">
                <img alt="calificame" class="logo_footer" src="{{ asset('web/images/logo.png') }}" width="158">
                <div class="footer__address">2011-2017 © Emtrics S.L.</div>
                <div class="footer__address">Leganitos 47, 9º (Arrabe Integra)<br>28013 Madrid<br> Spain</div>
              </div>
              <div class="w-col w-col-3 w-col-small-6 w-col-tiny-6">
                <div class="footer_social">
                  <a class="footer__sociallink w-inline-block" href="https://www.facebook.com/calificame/">
                    <img alt="Facebook" class="footer__socialimage" src="{{ asset('web/images/facebook.png') }}" width="42">
                  </a>
                  <a class="footer__sociallink w-inline-block" href="https://twitter.com/calificame">
                    <img alt="Twitter" class="footer__socialimage" src="{{ asset('web/images/twitter.png') }}" width="43">
                  </a>
                  <a class="footer__sociallink w-inline-block" href="https://www.linkedin.com/company/calificame">
                    <img alt="LinkedIn" class="footer__socialimage" src="{{ asset('web/images/linkedin.png') }}" width="42">
                  </a>
                </div>
                <ul class="legal-links w-list-unstyled">
                  <li><a id="legal-link" href="{{ URL('terms') }}" class="legal-link">{{ Lang::get('message.terms') }}</a></li>
                  <li><a href="{{ URL('privacy') }}" class="legal-link">{{ Lang::get('message.privacy') }}</a></li>
                  <li><a href="{{ URL('contract') }}" class="legal-link">{{ Lang::get('message.contract') }}</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div> -->

<!-- New Footer -->          
  <footer id="footer-Section">
    <div class="footer-top-layout">
      <div class="container">
        <div class="row">
          <div class="OurBlog">
            <img alt="calificame" class="nav__logo" id="nav__logo" src="{{ asset('web/images/logo.png') }}" width="340" height="60">
            <!--<p>Encuestas fáciles para tu restaurante.</p>-->
            <!--<div class="post-blog-date">19 Julio 2017.</div>-->
          </div>
          <div class=" col-lg-8 col-lg-offset-2">
            <div class="col-sm-6 col-xs-offset-0">
              <div class="footer-col-item">
                <h4>¿Alguna duda? Escribenos</h4>
                <address>
                contacto@calificame.mx
                Celular: 6671007521
                </address>
              </div>
            </div>
            <!--<div class="col-sm-4" id="col-left">
              <div class="footer-col-item">
                <h4>Compromiso</h4>
                <div class="item-contact"> 
                <a id="legal-link" href="{{ URL('terms') }}" class="legal-link">{{ Lang::get('message.terms') }}</a>
                <a href="{{ URL('privacy') }}" class="legal-link">{{ Lang::get('message.privacy') }}</a> 
                <a href="{{ URL('contract') }}" class="legal-link">{{ Lang::get('message.contract') }}</a> 
                </div>
              </div>
            </div>-->
            <div class="col-sm-6">
              <div class="footer-col-item">
                <h4 id="col-left-text">Contáctanos</h4>
                <form class="signUpNewsletter" action="" method="get" id="col-left-form">
                  <textarea class="form-control" rows="2" placeholder="Dejanos tu comentario..."></textarea>
                </form>
                <br>
                <form class="signUpNewsletter" action="" method="get" id="col-left-form">
                  <input name="" class="gt-email form-control" placeholder="contacto@calificame.mx" type="text">
                  <input name="" class="btn-go" value="Go" type="button">
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="footer-bottom-layout">
      <div class="socialMedia-footer"> 
      <a class="footer__sociallink w-inline-block" href="https://www.facebook.com/calificame/">
      <img alt="Facebook" class="footer__socialimage" src="{{ asset('web/images/facebook.png') }}" width="42"></a> 
      <a class="footer__sociallink w-inline-block" href="https://twitter.com/calificame">
      <img alt="Twitter" class="footer__socialimage" src="{{ asset('web/images/twitter.png') }}" width="43"></a> 
      <a class="footer__sociallink w-inline-block" href="https://www.linkedin.com/company/calificame">
      <img alt="LinkedIn" class="footer__socialimage" src="{{ asset('web/images/linkedin.png') }}" width="42"></a> 
      </div>
      <div class="copyright-tag">Copyright © 2017 Califícame. All Rights Reserved.</div>
    </div>
  </footer>
<!-- New Footer --> 

    <script src="{{ asset('web/js/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('web/js/webflow.js') }}" type="text/javascript"></script>
    <!--[if lte IE 9]><script src="//cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif]--><!-- begin olark code -->
    <!--<script type="text/javascript" async> ;(function(o,l,a,r,k,y){if(o.olark)return; r="script";y=l.createElement(r);r=l.getElementsByTagName(r)[0]; y.async=1;y.src="//"+a;r.parentNode.insertBefore(y,r); y=o.olark=function(){k.s.push(arguments);k.t.push(+new Date)}; y.extend=function(i,j){y("extend",i,j)}; y.identify=function(i){y("identify",k.i=i)}; y.configure=function(i,j){y("configure",i,j);k.c[i]=j}; k=y._={s:[],t:[+new Date],c:{},l:a}; })(window,document,"static.olark.com/jsclient/loader.html");
    /* custom configuration goes here (www.olark.com/documentation) */
    olark.identify('7458-228-10-3338');</script>-->
    <!-- end olark code -->
  </body>
  <!-- Mirrored from www.calificame.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 27 Jun 2017 15:01:54 GMT -->
</html>