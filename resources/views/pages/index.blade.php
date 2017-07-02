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
<!DOCTYPE html><!-- Last Published: Mon Jun 26 2017 11:32:10 GMT+0000 (UTC) --><html data-wf-domain="www.keweno.com" data-wf-page="58ff57253eae93580fa17c3f" data-wf-site="576bbb263b0f04c134edb9ab">
<!-- Mirrored from www.keweno.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 27 Jun 2017 15:01:08 GMT -->
<head>
  <meta charset="utf-8">
  <title>Keweno – Encuestas de Satisfacción para tu Restaurante</title>
  <meta content="Keweno es un sistema para hacer encuestas de satisfacción fáciles para restaurantes. Pruébalo gratis durante 30 días y descubre la opinión de tus clientes." name="description">
  <meta content="Keweno – Encuestas de Satisfacción para tu Restaurante" property="og:title"><meta content="Keweno es un sistema para hacer encuestas de satisfacción fáciles para restaurantes. Pruébalo gratis durante 30 días y descubre la opinión de tus clientes." property="og:description">
  <meta content="summary" name="twitter:card">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <link href="{{ asset('web/css/webflow.min.css') }}" rel="stylesheet" type="text/css">
  <script src="{{ asset('web/js/webfont.js') }}"></script>
  <script type="text/javascript">WebFont.load({
  google: {
    families: ["Open Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic","Source Sans Pro:300,300italic,regular,600"]
  }
  });
  </script>
  <!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js" type="text/javascript"></script><![endif]-->
  <script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);
  </script>
  <link href="{{ asset('web/images/favicon-32.png') }}" rel="shortcut icon" type="image/x-icon">
  <link href="{{ asset('web/images/favicon-256.png') }}" rel="apple-touch-icon">
  <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','js/analytics.js','ga');

  ga('create', 'UA-47841060-1', 'auto', {'allowLinker': true});
  ga('require', 'linker');
  ga('linker:autoLink', ['dashboard.keweno.com', 'blog.keweno.com'] );
  ga('send', 'pageview');

  </script>
  <script type="text/javascript" src="{{ asset('web/js/jstz.min.js') }}"></script>

<script type="text/javascript">
var Webflow = Webflow || [];
Webflow.push(function () {
  var timeZone = jstz.determine();
  $('#signup_pro_form #user_time_zone_modal').val(timeZone.name());
  $('#signup_basic_form #user_time_zone_modal').val(timeZone.name());
});
</script>

<!-- Hotjar Tracking Code for http://keweno.com -->
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
  <div class="signupbasic" data-ix="modal-interaction">
    <a class="close_link" data-ix="close-signup-basic" href="#">Cerrar</a>
    <h2 class="modal_header">Prueba Keweno gratis</h2>
      <div class="signupform__container w-form">
        <form action="https://dashboard.keweno.com/users" data-name="Email Form" id="signup_basic_form" method="post" name="email-form">
          <input autofocus="autofocus" class="signupform__field w-input" data-name="business[name]" id="business[name]-4" maxlength="256" name="business[name]" placeholder="Nombre de tu negocio" required="required" type="text">
          <input class="signupform__field w-input" data-name="user[email]" id="user[email]-4" maxlength="256" name="user[email]" placeholder="Tu e-mail" required="required" type="email">
          <input class="signupform__field w-input" data-name="user[password]" id="user[password]-4" maxlength="256" name="user[password]" placeholder="Una contraseña" required="required" type="password">
          <div class="w-embed">
            <input id="user_time_zone_modal" type="hidden" name="user[time_zone]" value="">
            <input id="business_subscription_plan_id_basic" type="hidden" name="business[subscription][plan_id]" value="basic">
          </div>
          <div class="signupform__buttoncontainer">
            <input class="big button w-button" data-wait="Por favor, espera" type="submit" value="Crear cuenta" wait="Por favor, espera">
            <div class="modal_formterms">Al registrarte aceptas nuestros&nbsp;<a href="http://keweno.com/es/terms-and-conditions/" class="modal_formtems--link">terminos y condiciones</a>.</div>
          </div>
        </form>
          
        <div class="formsuccess success-message w-form-done" id="formSuccess">
          <div class="text-block">Registro completado correctamente</div></div><div class="w-form-fail">
            <div class="text-block-4">Se ha producido un error mandando el formulario</div></div>
          </div>
        </div>

        <div class="signuppro" data-ix="modal-interaction">
          <a class="close_link" data-ix="close-signup-pro" href="#">Cerrar</a>
          <h2 class="modal_header">Prueba Keweno gratis</h2>
          <div class="signupform__container w-form">
            <form action="https://dashboard.keweno.com/users" data-name="Email Form" id="signup_pro_form" method="post" name="email-form">
              <input autofocus="autofocus" class="signupform__field w-input" data-name="business[name]" id="business[name]-4" maxlength="256" name="business[name]" placeholder="Nombre de tu negocio" required="required" type="text">
              <input class="signupform__field w-input" data-name="user[email]" id="user[email]-4" maxlength="256" name="user[email]" placeholder="Tu e-mail" required="required" type="email">
              <input class="signupform__field w-input" data-name="user[password]" id="user[password]-4" maxlength="256" name="user[password]" placeholder="Una contraseña" required="required" type="password">
              <div class="w-embed">
                <input id="user_time_zone_modal" type="hidden" name="user[time_zone]" value="">
                <input id="business_subscription_plan_id_pro" type="hidden" name="business[subscription][plan_id]" value="pro">
              </div>
              <div class="signupform__buttoncontainer">
                <input class="big button w-button" data-wait="Por favor, espera" type="submit" value="Crear cuenta" wait="Por favor, espera">
                <div class="modal_formterms">Al registrarte aceptas nuestros&nbsp;<a href="http://keweno.com/es/terms-and-conditions/" class="modal_formtems--link">terminos y condiciones</a>.
                </div>
              </div>
            </form>

            <div class="success-message w-form-done">
              <div class="text-block-2">Registro completado correctamente</div>
            </div>

            <div class="w-form-fail">
              <div class="text-block-3">Se ha producido un error mandando el formulario</div>
            </div>
          
          </div>
        </div>

        <div class="contactform" data-ix="modal-interaction">
          <a class="close_link" data-ix="close-contact-form" href="#">Cerrar</a>
          <h2 class="modal_header">Contáctanos</h2>
          <div class="signupform__container w-form">
            <form data-name="Email Form" id="email-form" method="post" name="email-form">
              <input autofocus="autofocus" class="signupform__field w-input" data-name="business-name" id="business-name-2" maxlength="256" name="business-name" placeholder="Nombre de tu negocio" required="required" type="text">
              <input class="signupform__field w-input" data-name="user-name" id="user-name" maxlength="256" name="user-name" placeholder="Tu nombre" required="required" type="text">
              <input class="signupform__field w-input" data-name="e-mail" id="e-mail" maxlength="256" name="e-mail" placeholder="Tu e-mail" required="required" type="email">
                <textarea class="signupform__field w-input" data-name="description" id="description" maxlength="5000" name="description" placeholder="Tu mensaje"></textarea>
                <div class="signupform__buttoncontainer">
                  <input class="big button w-button" data-wait="Por favor, espera" type="submit" value="Enviar mensaje" wait="Por favor, espera">
                </div>
            </form>

            <div class="success-message w-form-done">
              <div>¡Gracias! Tu mensaje se ha guardado correctamente.</div>
            </div>

            <div class="error-message w-form-fail">
              <div>Se ha producido un error mandando el formulario.</div>
            </div>
          </div>
        </div>

        <div class="nav--fixed w-nav" data-animation="default" data-collapse="medium" data-duration="400" data-ix="display-none">
          <div class="w-container">
            <a class="w-nav-brand" href="#"><img alt="Keweno" class="nav__logo" src="{{ asset('web/images/logo.png') }}" width="128"></a>
            <nav class="nav_menu w-clearfix w-nav-menu" role="navigation">
              <a class="nav__link w-nav-link" href="#why-keweno">{{ Lang::get('message.menu1') }}</a>
              <a class="nav__link w-nav-link" href="#how-it-works">{{ Lang::get('message.menu2') }}</a>
              <a class="nav__link w-nav-link" href="#plans">{{ Lang::get('message.menu3') }}</a>
              <a class="button nav__button w-button" href="#plans">{{ Lang::get('message.menu4') }}</a>
            </nav>

            <div class="menu_button w-nav-button">
              <div class="w-icon-nav-menu"></div>
            </div>
          </div>
        </div>

        <div class="hero" data-ix="display-nav">
          <div class="nav w-nav" data-animation="default" data-collapse="medium" data-duration="400">
            <div class="w-container">
              <a class="w-nav-brand" href="index.html"><img alt="Keweno" class="nav__logo" src="{{ asset('web/images/logo.png') }}" width="128"></a>
              <nav class="nav_menu nav_menu_not_fixed w-nav-menu" role="navigation">
                <a class="nav__link w-nav-link" href="#why-keweno">{{ Lang::get('message.menu1') }}</a>
                <a class="nav__link w-nav-link" href="#how-it-works">{{ Lang::get('message.menu2') }}</a>
                <a class="nav__link w-nav-link" href="#plans">{{ Lang::get('message.menu3') }}</a>
                <a class="nav__link w-nav-link" href="http://dashboard.keweno.com/">{{ Lang::get('message.menu4') }}</a>
                <div class="language_switch_dropdow w-dropdown w-hidden-medium w-hidden-small w-hidden-tiny" data-delay="0" data-hover="1">
                  <div class="language_switch_toggle w-dropdown-toggle w-hidden-medium w-hidden-small w-hidden-tiny">
                    @if(App::getLocale() == 'es')
                      <div class="language_swith_text">Español</div>
                    @elseif(App::getLocale() == 'en')
                      <div class="language_swith_text">English</div>
                    @elseif(App::getLocale() == 'pt-BR')
                      <div class="language_swith_text">Português</div>
                    @endif
                    <img class="language_switch_icon" src="{{ asset('web/images/triangle.png') }}">
                  </div>

                  <nav class="language_witch_list w-dropdown-list">
                  @if(App::getLocale() == 'es')
                    <a class="language_swith_link w-dropdown-link" href="{{ URL('lang', Lang::get('message.en')) }}">Ingles</a>
                    <a class="language_swith_link w-dropdown-link" href="{{ URL('lang', Lang::get('message.pt-BR')) }}">Portugués</a>
                  @elseif(App::getLocale() == 'en')
                    <a class="language_swith_link w-dropdown-link" href="{{ URL('lang', Lang::get('message.es')) }}">Spanish</a>
                    <a class="language_swith_link w-dropdown-link" href="{{ URL('lang', Lang::get('message.pt-BR')) }}">Portuguese</a>
                  @elseif(App::getLocale() == 'pt-BR')
                    <a class="language_swith_link w-dropdown-link" href="{{ URL('lang', Lang::get('message.es')) }}">Espanhol</a>
                    <a class="language_swith_link w-dropdown-link" href="{{ URL('lang', Lang::get('message.en')) }}">Inglês</a>
                  @endif
                  </nav>
                </div>
              </nav>

              <div class="menu_toggle w-nav-button" id="menu">
                <div class="w-icon-nav-menu"></div>
              </div>
            </div>
          </div>

          <div class="w-container">
            <h1 class="hero__heading">{{ Lang::get('message.slogan') }}</h1>
            <p class="hero__subheading">{{ Lang::get('message.subslogan') }}</p>
            <div class="hero__videocontainer">
              <div class="hero__video w-embed w-video" style="padding-top: 56.17021276595745%;">
                <iframe class="embedly-embed" src="http://cdn.embedly.com/widgets/media.html?src=https%3A%2F%2Fplayer.vimeo.com%2Fvideo%2F129528622&amp;url=https%3A%2F%2Fvimeo.com%2F129528622&amp;image=http%3A%2F%2Fi.vimeocdn.com%2Fvideo%2F521080412_640.jpg&amp;key=c4e54deccf4d4ec997a64902e9a30300&amp;type=text%2Fhtml&amp;schema=vimeo" scrolling="no" frameborder="0" allowfullscreen></iframe>
              </div>
            </div>
            <a class="button hero__cta w-button" href="#plans">{{ Lang::get('message.button1') }}&nbsp;</a>
          </div>
        </div>

        <div class="section whykeweno" id="why-keweno">
          <div class="w-container"><h2 class="section__header">{{ Lang::get('message.why') }}</h2>
            <div class="w-row">
              <div class="column w-col w-col-3">
                <div class="whykeweno__imagecontainer">
                  <img class="column__image" data-ix="appear" src="{{ asset('web/images/chart.png') }}" width="143">
                </div>
                <h3 class="column__header">{{ Lang::get('message.why1') }}</h3>
                <div class="paragraph">{{ Lang::get('message.whydes1') }}</div>
              </div>
              <div class="column w-col w-col-3">
                <div class="whykeweno__imagecontainer">
                  <img class="column__image" data-ix="appear-2" src="{{ asset('web/images/handshake.png') }}" width="150">
                </div>
                <h3 class="column__header">{{ Lang::get('message.why2') }}</h3>
                <div class="paragraph">{{ Lang::get('message.whydes2') }}</div>
              </div>
              <div class="column w-col w-col-3">
                <div class="whykeweno__imagecontainer">
                  <img class="column__image grow" data-ix="appear-3" src="{{ asset('web/images/empty.png') }}">
                </div>
                <h3 class="column__header">{{ Lang::get('message.why3') }}</h3>
                <div class="paragraph">{{ Lang::get('message.whydes3') }}</div>
              </div>
              <div class="column w-col w-col-3">
                <div class="whykeweno__imagecontainer">
                  <img class="column__image grow" data-ix="appear-3" src="{{ asset('web/images/empty.png') }}">
                </div>
                <h3 class="column__header">{{ Lang::get('message.why4') }}</h3>
                <div class="paragraph">{{ Lang::get('message.whydes4') }}</div>
              </div>
            </div>
          </div>
        </div>

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

        <div class="howitworks section" id="how-it-works">
          <div class="w-container"><h2 class="section__header">{{ Lang::get('message.how') }}</h2>
            <div class="w-row">
              <div class="column w-col w-col-4 w-col-medium-12 w-col-small-12">
                <div class="howworks_imagecointainer">
                  <img class="column__image" src="{{ asset('web/images/macbookpro.png') }}" width="226">
                </div>
                <h3 class="column__header">{{ Lang::get('message.how1') }}</h3>
                <div class="paragraph">{{ Lang::get('message.howdes1') }}</div>
              </div>
              <div class="column w-col w-col-4 w-col-medium-12 w-col-small-12">
                <div class="howworks_imagecointainer">
                  <img class="column__image" src="{{ asset('web/images/polaroid.png') }}" width="232">
                </div>
                <h3 class="column__header">{{ Lang::get('message.how2') }}</h3>
                <div class="paragraph">{{ Lang::get('message.howdes2') }}</div>
              </div>
              <div class="column w-col w-col-4 w-col-medium-12 w-col-small-12">
                <div class="howworks_imagecointainer">
                  <img class="column__image" src="{{ asset('web/images/iphone.png') }}" width="231">
                </div>
                <h3 class="column__header">{{ Lang::get('message.how3') }}</h3>
                <div class="paragraph">{{ Lang::get('message.howdes3') }}</div>
              </div>
          </div>
        </div>

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

        <div class="plans section" id="plans">
          <div class="container w-container">
            <h2 class="section__header">{{ Lang::get('message.planslogan') }}</h2>
            <p class="customers_subheading">{{ Lang::get('message.plansubslogan') }}</p>
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
                <div class="pricingcard__headercontainer">
                  <h3 class="pricingcard__heading">{{ Lang::get('message.plan2') }}</h3>
                  <div class="pricingcard__maspopular">{{ Lang::get('message.subplan2') }}</div>
                  <div class="pricingcard__pricingwraper">
                    <div class="pricingcard__pricing">{{ Lang::get('message.price2') }}<br><em class="pricingcard__pricing--em">{{ Lang::get('message.subprice2') }}</em>
                    </div>
                  </div>
                </div>

                <ul class="pricingcard__features">
                  <li>{{ Lang::get('message.plandes2.1') }}</li>
                  <li>{{ Lang::get('message.plandes2.2') }}</li>
                  <li>{{ Lang::get('message.plandes2.3') }}</li>
                  <li>{{ Lang::get('message.plandes2.4') }}</li>
                </ul>

                <a class="button w-button" data-ix="open-signup-pro" href="#">{{ Lang::get('message.planbutton2') }}</a>
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

        <!--<div class="section whouseskeweno">
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
                      <a class="w-inline-block" href="#" id="http-www.abc.es-tecnologia-redes-20141102-abci-keweno-hosteleria-201410301745.html"><img class="press_logo" src="{{ asset('web/images/abc.png') }}"></a>
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
                      <a class="w-inline-block" href="http://www.techfoodmag.com/keweno-valora-mi-restaurante-pero-cuentamelo-a-mi/http://www.techfoodmag.com/keweno-valora-mi-restaurante-pero-cuentamelo-a-mi/">
                        <img class="press_logo" src="{{ asset('web/images/techfood.png') }}">
                      </a>
                    </div>
                  </div>
                  <div class="w-slide">
                    <div class="press_container">
                      <blockquote class="press_quote">{{ Lang::get('message.press4') }}</blockquote>
                      <a class="w-inline-block" href="http://profesionalhoreca.com/keweno-el-sistema-de-encuestas-mas-facil-para-el-restaurante/">
                        <img class="press_logo" src="{{ asset('web/images/horeca.png') }}">
                      </a>
                    </div>
                  </div>
                  <div class="w-slide">
                    <div class="press_container">
                      <blockquote class="press_quote">{{ Lang::get('message.press5') }}</blockquote>
                      <a class="w-inline-block" href="http://marketingastronomico.com/como-subir-las-ventas-en-un-restaurante-con-keweno/">
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

          <div class="testimonial w-hidden-tiny">
            <div class="testimonial__container w-container">
              <div class="testimonial__quotecontainer">
                <div class="testimonial__quote">{{ Lang::get('message.review1') }}</div>
              </div>
              <div class="testimonial__authorcontainer">
                <img class="testimonial__authorpicture" src="{{ asset('web/images/manfred.png') }}"><div>
                  <div class="testimonia__authorname">{{ Lang::get('message.reviewer1') }}</div>
                  <div class="testimonial__authortitle">{{ Lang::get('message.reviewerdes1') }}</div>
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
                <img class="testimonial__authorpicture" src="{{ asset('web/images/foto.png') }}"><div>
                  <div class="testimonia__authorname">{{ Lang::get('message.reviewer2') }}</div>
                  <div class="testimonial__authortitle">{{ Lang::get('message.reviewerdes2') }}</div>
                </div>
              </div>
            </div>
          </div>

          <div class="footer">
            <div class="w-container">
              <div class="footer__column w-row">
                <div class="w-col w-col-9 w-col-small-6 w-col-tiny-6">
                  <img alt="Keweno" class="logo_footer" src="{{ asset('web/images/logo.png') }}" width="128">
                  <div class="footer__address">2011-2017 © Emtrics S.L.</div>
                  <div class="footer__address">Leganitos 47, 9º (Arrabe Integra)<br>28013 Madrid<br> Spain</div>
                </div>
                <div class="w-col w-col-3 w-col-small-6 w-col-tiny-6">
                  <div class="footer_social">
                    <a class="footer__sociallink w-inline-block" href="https://www.facebook.com/keweno/">
                      <img alt="Facebook" class="footer__socialimage" src="{{ asset('web/images/facebook.png') }}" width="42">
                    </a>
                    <a class="footer__sociallink w-inline-block" href="https://twitter.com/keweno">
                      <img alt="Twitter" class="footer__socialimage" src="{{ asset('web/images/twitter.png') }}" width="43">
                    </a>
                    <a class="footer__sociallink w-inline-block" href="https://www.linkedin.com/company/keweno">
                      <img alt="LinkedIn" class="footer__socialimage" src="{{ asset('web/images/linkedin.png') }}" width="42">
                    </a>
                  </div>
                  <ul class="legal-links w-list-unstyled">
                    <li><a id="legal-link" href="es/terms-and-conditions.html" class="legal-link">{{ Lang::get('message.terms') }}</a></li>
                    <li><a href="es/privacy.html" class="legal-link">{{ Lang::get('message.privacy') }}</a></li>
                    <li><a href="es/contract.html" class="legal-link">{{ Lang::get('message.contract') }}</a></li>
                    <li><a href="http://help.keweno.com/help_center">{{ Lang::get('message.help') }}</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

    <script src="{{ asset('web/js/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('web/js/webflow.js') }}" type="text/javascript"></script>
    <!--[if lte IE 9]><script src="//cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif]--><!-- begin olark code -->
    <script type="text/javascript" async> ;(function(o,l,a,r,k,y){if(o.olark)return; r="script";y=l.createElement(r);r=l.getElementsByTagName(r)[0]; y.async=1;y.src="//"+a;r.parentNode.insertBefore(y,r); y=o.olark=function(){k.s.push(arguments);k.t.push(+new Date)}; y.extend=function(i,j){y("extend",i,j)}; y.identify=function(i){y("identify",k.i=i)}; y.configure=function(i,j){y("configure",i,j);k.c[i]=j}; k=y._={s:[],t:[+new Date],c:{},l:a}; })(window,document,"static.olark.com/jsclient/loader.html");
    /* custom configuration goes here (www.olark.com/documentation) */
    olark.identify('7458-228-10-3338');</script>
    <!-- end olark code -->
  </body>
  <!-- Mirrored from www.keweno.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 27 Jun 2017 15:01:54 GMT -->
</html>
