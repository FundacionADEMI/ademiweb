<html>
   <head>
      <title>Fundacion ADEMI</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="assets/css/main.css">
      <script>var tvt = tvt || {}; tvt.captureVariables = function (a){for(var b=new Date,c={},d=Object.keys(a||{}),e=0,f;f=d[e];e++)if(a.hasOwnProperty(f)&&
         "undefined"!=typeof a[f])try{var g=[];c[f]=JSON.stringify(a[f],function(a,b){try{if("function"!==typeof b){if("object"===typeof b&&null!==b){if(b instanceof HTMLElement||b instanceof Node||-1!=g.indexOf(b))return;g.push(b)}return b}}catch(c){}})}catch(l){}a=document.createEvent("CustomEvent");a.initCustomEvent("TvtRetrievedVariablesEvent",!0,!0,{variables:c,date:b});window.dispatchEvent(a)};window.setTimeout(function() {tvt.captureVariables({'dataLayer': window['dataLayer']})}, 2000);
      </script>
      <script src='https://www.google.com/recaptcha/api.js'></script>
   </head>
   <body class="" style="background-position: center -82.1px;">
      <article class="container box style3" style="margin-top: 10px;">
         <header style="margin-bottom: 0px;">
            <img src="logo.png">
            <p>Agencia Para el Desarrollo Económico de Misiones</p>
            <h4>
            Paso 3
            <h4>
            <p>Completá los datos y envíalos</p>
         </header>
         <form method="post" action="send.php">
            <div class="row 50%">
               <div class="6u 12u$(mobile)"><input type="text" class="text" name="nombre" placeholder="Nombre"></div>
               <div class="6u$ 12u$(mobile)"><input type="text" class="text" name="apellido" placeholder="Apellido"></div>
               <div class="6u 12u$(mobile)"><input type="text" class="text" name="telefono" placeholder="Teléfono"></div>
               <div class="6u$ 12u$(mobile)"><input type="text" class="text" name="correo" placeholder="Correo"></div>
               <div class="6u 12u$(mobile)"><input type="text" class="text" name="localidad" placeholder="Localidad"></div>
               <div class="6u$ 12u$(mobile)"><input type="text" class="text" name="direccion" placeholder="Dirección"></div>
               <div class="6u 12u$(mobile)"><input type="text" class="text" name="cuit" placeholder="CUIT"></div>
               <div class="6u$ 12u$(mobile)"><input type="text" class="text" name="nombref" placeholder="Nombre del emprendimiento/empresa"></div>
               <div id='latitud'></div>
               <div id='longitud'></div>
               <div class="12u$">
                  <ul class="actions">
                     <li><input type="submit" onclick="enviar()" value="Enviar"></li>
                  </ul>
               </div>
            </div>
         </form>
      </article>
      <section id="footer">
         <ul class="icons" style="padding-bottom: -55;padding-bottom: -5;padding-bottom: 0px;margin-bottom: 30px;">
            <li><a href="https://twitter.com/AgenciaADEMI" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
            <li><a href="https://www.facebook.com/fundacion.ademi/?fref=ts" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
         </ul>
         <div class="copyright">
            <ul class="menu">
               <li>Copyright © 2017 ADEMI - Agencia para el desarrollo Económico de Misiones.</li>
               <li></a></li>
            </ul>
         </div>
      </section>
      <script type="text/javascript">
         function enviar(){
            navigator.geolocation.getCurrentPosition;
         }

         if (navigator.geolocation) {
               navigator.geolocation.getCurrentPosition(mostrarUbicacion);
         }else{
                alert("¡Error! Este navegador no soporta la Geolocalización.");
              }
         function mostrarUbicacion(position) { 
              var latitud = position.coords.latitude;
              var longitud = position.coords.longitude;
              var div = document.getElementById("latitud");
              div.innerHTML = '<input type="text" name="latitud" placeholder="'+ latitud +'" value="'+ latitud +'" readonly="readonly">';
              var div = document.getElementById("longitud");
              div.innerHTML = '<input type="text" name="longitud" placeholder="'+ longitud +'" value="'+ longitud +'" readonly="readonly">';
            }    
      </script>
      <script src="assets/js/main.js"></script>
      <div class="poptrox-overlay" style="position: fixed; left: 0px; top: 0px; z-index: 1000; width: 100%; height: 100%; text-align: center; cursor: pointer; display: none;">
         <div style="display:inline-block;height:100%;vertical-align:middle;"></div>
         <div style="position:absolute;left:0;top:0;width:100%;height:100%;background:#0a1919;opacity:0.75;filter:alpha(opacity=75);"></div>
         <div class="poptrox-popup" style="display: none; vertical-align: middle; position: relative; z-index: 1; cursor: auto; min-width: 200px; min-height: 100px;">
            <div class="loader" style="display: none;"></div>
            <div class="pic" style="display: none;"></div>
            <div class="caption" style="display: none;"></div>
            <span class="closer" style="cursor: pointer; display: none;">×</span>
            <div class="nav-previous" style="display: none;"></div>
            <div class="nav-next" style="display: none;"></div>
         </div>
      </div>
   </body>
</html>