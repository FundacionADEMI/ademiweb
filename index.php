<?php
   // Check http://www.systutorials.com/136102/a-php-function-for-fetching-rss-feed-and-outputing-feed-items-as-html/ for description
   // RSS to HTML
   /*
       $tiem_cnt: max number of feed items to be displayed
       $max_words: max number of words (not real words, HTML words)
       if <= 0: no limitation, if > 0 display at most $max_words words
    */
   function get_rss_feed_as_html($feed_url, $max_item_cnt = 10, $show_date = true, $show_description = true, $max_words = 0, $cache_timeout = 7200, $cache_prefix = "/tmp/rss2html-")
   {
   $result = "";
   // get feeds and parse items
     $rss = new DOMDocument();
    $cache_file = $cache_prefix . md5($feed_url);
    // load from file or load content
    if ($cache_timeout > 0 &&
        is_file($cache_file) &&
        (filemtime($cache_file) + $cache_timeout > time())) {
            $rss->load($cache_file);
    } else {
        $rss->load($feed_url);
        if ($cache_timeout > 0) {
            $rss->save($cache_file);
        }
    }
       $feed = array();
       foreach ($rss->getElementsByTagName('item') as $node) {
           $item = array (
               'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
               'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
               'content' => $node->getElementsByTagName('description')->item(0)->nodeValue,
               'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
               'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
           );
           $content = $node->getElementsByTagName('encoded'); // <content:encoded>
           if ($content->length > 0) {
               $item['content'] = $content->item(0)->nodeValue;
           }
           array_push($feed, $item);
       }
       // real good count
       if ($max_item_cnt > count($feed)) {
           $max_item_cnt = count($feed);
       }
       
       for ($x=0;$x<$max_item_cnt;$x++) {
           
           $title = str_replace(' & ', ' &amp; ', $feed[$x]['title']);
           $link = $feed[$x]['link'];
           if ($show_description) {
               $description = $feed[$x]['desc'];
               $content = $feed[$x]['content'];
               // find the img
               $has_image = preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $content, $image);
               // no html tags
               $description = strip_tags(preg_replace('/(<(script|style)\b[^>]*>).*?(<\/\2>)/s', "$1$3", $description), '');
               // whether cut by number of words
               if ($max_words > 0) {
                   $arr = explode(' ', $description);
                   if ($max_words < count($arr)) {
                       $description = '';
                       $w_cnt = 0;
                       foreach($arr as $w) {
                           $description .= $w . ' ';
                           $w_cnt = $w_cnt + 1;
                           if ($w_cnt == $max_words) {
                               break;
                           }
                       }
                   }
               }
               // add img if it exists
               if ($has_image == 1) {
                   $img = $image['src'];
               }
           
              
           }
   
   $result .= '<div class="mdl-cell mdl-cell--3-col mdl-cell--4-col-tablet mdl-cell--4-col-phone mdl-card mdl-shadow--3dp">';
   $result .= '<div class="mdl-card__media">';
   $result .= '<img class="img-color" src="'.$img.'">';
   #$result .= '<img src="images/more-from-noticias.png" style="height: 20px;">';
   $result .= '</div>';
   $result .= '<div class="mdl-card__title">';
   $result .= '<h4 class="mdl-card__title-text">'.$title.'</h4>';
   $result .= '</div>';
   $result .= '<div class="mdl-card__supporting-text">';
   $result .= '<span class="mdl-typography--font-light mdl-typography--subhead">'. $description .'...';
   $result .= '</div>';
   $result .= '<div class="mdl-card__actions">';
   $result .= '<a class="android-link mdl-button mdl-js-button mdl-typography--text-uppercase" href="'.$link.'">';
   $result .= 'Ver mas';
   $result .= '<i class="material-icons">chevron_right</i>';
   $result .= '</a></div></div>';
   
   
           
           $result .= '</li>';
       }
       $result .= '</ul>';
       return $result;
   }
   function output_rss_feed($feed_url, $max_item_cnt = 10, $show_date = true, $show_description = true, $max_words = 0)
   {
       echo get_rss_feed_as_html($feed_url, $max_item_cnt, $show_date, $show_description, $max_words);
   }
   ?>
<!doctype html>
<html lang="es">
   <head>
      <!-- Page styles-->
      <link rel="stylesheet" href="styles.css">
      <link rel="stylesheet" href="animate.css">
      <link rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/animate.css@3.5.2/animate.min.css">
  <!-- or -->
  <link rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
      <style type="text/css">
         /* latin */       
         @font-face {
         font-family: 'Roboto';
         font-style: normal;
         font-weight: 400;
         src: local('Roboto'), local('Roboto-Regular'), url(https://fonts.gstatic.com/s/roboto/v18/CWB0XYA8bzo0kSThX0UTuA.woff2) format('woff2');
         unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2212, U+2215;
         }
         /* fallback */   
         @font-face {
         font-family: 'Material Icons';
         font-style: normal;
         font-weight: 400;
         src: url(https://fonts.gstatic.com/s/materialicons/v36/2fcrYFNaTjcS6g4U3t-Y5UEw0lE80llgEseQY3FEmqw.woff2) format('woff2');
         }
         .material-icons {
         font-family: 'Material Icons';
         font-weight: normal;
         font-style: normal;
         font-size: 24px;
         line-height: 1;
         letter-spacing: normal;
         text-transform: none;
         display: inline-block;
         white-space: nowrap;
         word-wrap: normal;
         direction: ltr;
         -webkit-font-feature-settings: 'liga';
         -webkit-font-smoothing: antialiased;
         }
         .img-color{
          height: 20px;
         }
         #view-source {
         position: fixed;
         display: block;
         right: 0;
         bottom: 0;
         margin-right: 40px;
         margin-bottom: 40px;
         z-index: 900;
         }
         .mdl-color--accent {
         background-color: rgb(255, 0, 0)!important;
         }
         .mdl-color-text--accent-contrast {
         color: rgb(255, 255, 255)!important;
         }
         .android-wear-section {
         position: relative;
         background: url(images/portada.jpg) center top no-repeat;
         background-repeat: no-repeat;
         background-size: contain;
         background-position: center;
         height: 581px;
         }
         
        
        .mdl-card:hover {
   
    animation-name: swing;
      animation-duration: 1s;
  
}



         box-shadow: 0 0 8px black;
      </style>
      <title>Fundación ADEMI - Agencia Para El Desarrollo Económico de Misiones</title>
      <link rel="canonical" href="https://ademi.org.ar/">
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="description" content="La Agencia para el Desarrollo Económico de Misiones - ADEMI es una organización mixta que articula el accionar del sector público, privado y del conocimiento en la generación de oportunidades que promuevan el crecimiento sostenido de la economía Misionera.">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
      <meta name="description" content="Agencia Para El Desarrollo Económico de Misiones">
      <meta property="og:locale" content="es_ES">
      <meta property="og:type" content="website">
      <meta property="og:title" content="Fundacion ADEMI - Agencia Para El Desarrollo Económico de Misiones">
      <meta property="og:description" content="Agencia Para El Desarrollo Económico de Misiones">
      <meta property="og:url" content="https://ademi.org.ar/">
      <meta property="og:site_name" content="Fundacion ADEMI">
      <meta name="twitter:card" content="summary">
      <meta name="twitter:description" content="Agencia Para El Desarrollo Económico de Misiones">
      <meta name="twitter:title" content="Fundacion ADEMI - Agencia Para El Desarrollo Económico de Misiones">
      <meta name="twitter:site" content="@AgenciaADEMI">
   </head>
   <body>
      <div id="fb-root"></div>
      <script>(function(d, s, id) {
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) return;
         js = d.createElement(s); js.id = id;
         js.src = 'https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.12&appId=1322224157857367&autoLogAppEvents=1';
         fjs.parentNode.insertBefore(js, fjs);
         }(document, 'script', 'facebook-jssdk'));
      </script>
      <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
         <div class="android-header mdl-layout__header mdl-layout__header--waterfall">
            <div class="mdl-layout__header-row">
               <span class="android-title mdl-layout-title">
               <img class="android-logo-image" src="images/logo.png">
               </span>
               <!-- Add spacer, to align navigation to the right in desktop -->
               <div class="android-header-spacer mdl-layout-spacer"></div>
               <div class="android-search-box mdl-textfield mdl-js-textfield mdl-textfield--expandable mdl-textfield--floating-label mdl-textfield--align-right mdl-textfield--full-width">
                  <form role="search" method="get" class="search-form" action="https://ademi.org.ar/blog/">
                     <label class="mdl-button mdl-js-button mdl-button--icon" for="fixed-header-drawer-exp" data-upgraded=",MaterialButton">
                     <i class="material-icons">search</i>
                     </label>
                     <div class="mdl-textfield__expandable-holder">
                        <input class="mdl-textfield__input" type="text" value="" name="s" id="fixed-header-drawer-exp">
                     </div>
                  </form>
               </div>
               <!-- Navigation -->
               <div class="android-navigation-container">
                  <nav class="android-navigation mdl-navigation">
                     <a class="mdl-navigation__link mdl-typography--text-uppercase" href="https://ademi.org.ar/">INICIO</a>
                     <a class="mdl-navigation__link mdl-typography--text-uppercase" href="https://ademi.org.ar/blog/">NOTICIAS</a>
                     <a class="mdl-navigation__link mdl-typography--text-uppercase" href="">AREAS DE TRABAJO</a>
                     <a class="mdl-navigation__link mdl-typography--text-uppercase" href="https://ademi.org.ar/blog/category/programas/">PROGRAMAS</a>
                     <a class="mdl-navigation__link mdl-typography--text-uppercase" href="https://ademi.org.ar/blog/calendario/">CALENDARIO</a>
                  </nav>
               </div>
               <span class="android-mobile-title mdl-layout-title">
               <img class="android-logo-image" src="images/logo.png">
               </span>
            </div>
         </div>
         <div class="android-drawer mdl-layout__drawer">
            <nav class="mdl-navigation">
               <a class="mdl-navigation__link" href="https://ademi.org.ar/">INICIO</a>
               <a class="mdl-navigation__link" href="https://ademi.org.ar/blog/">NOTICIAS</a>
               <a class="mdl-navigation__link" href="">AREAS DE TRABAJO</a>
               <a class="mdl-navigation__link" href="https://ademi.org.ar/blog/category/programas/">PROGRAMAS</a>
               <a class="mdl-navigation__link" href="https://ademi.org.ar/blog/calendario/">CALENDARIO</a>
               <div class="android-drawer-separator"></div>
               <div class="android-drawer-separator"></div>
            </nav>
         </div>
         <div class="android-content mdl-layout__content">
            <!--destacado-->
            <div class="android-wear-section">
               <div class="android-wear-band">
                  <div class="android-wear-band-text">
                     <div class="mdl-typography--display-2 mdl-typography--font-thin">Titulo de evento</div>
                     <p class="mdl-typography--headline mdl-typography--font-thin">
                        texto descriptivo de evento
                     </p>
                     <p>
                        <a class="mdl-typography--font-regular mdl-typography--text-uppercase android-alt-link" href="">
                        texto del enlase
                        <i class="material-icons">chevron_right</i>
                        </a>
                     </p>
                  </div>
               </div>
            </div>
            <!--destacado-->
           
            <!--areas-->
            <div class="android-more-section">
               <div class="android-card-container mdl-grid">
                  <div class="mdl-cell mdl-cell--2-col mdl-cell--4-col-tablet mdl-cell--4-col-phone mdl-card mdl-shadow--3dp">
                     <div class="mdl-card__media">
                        <img src="images/more-from-1-p.png">
                     </div>
                     <div class="mdl-card__title">
                        <h4 class="mdl-card__title-text">Emprendedores</h4>
                     </div>
                     <div id="mini" class="mdl-card__supporting-text">
                     </div>
                     <br>
                     <div class="mdl-card__actions">
                        <a class="android-link mdl-button mdl-js-button mdl-typography--text-uppercase" href="https://ademi.org.ar/blog/emprendedores">
                        comenza
                        <i class="material-icons">chevron_right</i>
                        </a>
                     </div>
                  </div>
                  <div class="mdl-cell mdl-cell--2-col mdl-cell--4-col-tablet mdl-cell--4-col-phone mdl-card mdl-shadow--3dp">
                     <div class="mdl-card__media">
                        <img src="images/more-from-2-p.png">
                     </div>
                     <div class="mdl-card__title">
                        <h4 class="mdl-card__title-text">Empresas</h4>
                     </div>
                     <div id="mini" class="mdl-card__supporting-text">
                     </div>
                     <br>
                     <div class="mdl-card__actions">
                        <a class="android-link mdl-button mdl-js-button mdl-typography--text-uppercase" href="https://ademi.org.ar/blog/empresas/">
                        mejora
                        <i class="material-icons">chevron_right</i>
                        </a>
                     </div>
                  </div>
                  <div class="mdl-cell mdl-cell--2-col mdl-cell--4-col-tablet mdl-cell--4-col-phone mdl-card mdl-shadow--3dp">
                     <div class="mdl-card__media">
                        <img src="images/more-from-3-p.png">
                     </div>
                     <div class="mdl-card__title">
                        <h4 class="mdl-card__title-text">Profesionales</h4>
                     </div>
                     <div id="mini" class="mdl-card__supporting-text">
                     </div>
                     <br>
                     <div class="mdl-card__actions">
                        <a class="android-link mdl-button mdl-js-button mdl-typography--text-uppercase" href="http://registro.ademi.org.ar/">
                        participa
                        <i class="material-icons">chevron_right</i>
                        </a>
                     </div>
                  </div>
                  <div class="mdl-cell mdl-cell--2-col mdl-cell--4-col-tablet mdl-cell--4-col-phone mdl-card mdl-shadow--3dp">
                     <div class="mdl-card__media">
                        <img src="images/more-from-4-p.png">
                     </div>
                     <div class="mdl-card__title">
                        <h4 class="mdl-card__title-text">Desarrollo Local</h4>
                     </div>
                     <div id="mini" class="mdl-card__supporting-text">
                     </div>
                     <div class="mdl-card__actions">
                        <a class="android-link mdl-button mdl-js-button mdl-typography--text-uppercase" href="https://ademi.org.ar/blog/category/reportes-economico/">
                        integrate
                        <i class="material-icons">chevron_right</i>
                        </a>
                     </div>
                  </div>
                  <div class="mdl-cell mdl-cell--2-col mdl-cell--4-col-tablet mdl-cell--4-col-phone mdl-card mdl-shadow--3dp">
                     <div class="mdl-card__media">
                        <img src="images/more-from-5-p.png">
                     </div>
                     <div class="mdl-card__title">
                        <h4 class="mdl-card__title-text">Centro de información</h4>
                     </div>
                     <div id="mini" class="mdl-card__supporting-text">
                     </div>
                     <div class="mdl-card__actions">
                        <a class="android-link mdl-button mdl-js-button mdl-typography--text-uppercase" href="https://ademi.org.ar/blog/centro-de-informacion/">
                        conoce <i class="material-icons">chevron_right</i>
                        </a>
                     </div>
                  </div>
               </div>





               <!--areas-->
               <div class="android-customized-section">
                  <div class="android-customized-section-text">
                     <div class="mdl-typography--font-light mdl-typography--display-1-color-contrast">Visita una lista de los programas que en ADEMI tenemos para vos!</div>
                     <p class="mdl-typography--font-light">
                        Put the stuff that you care about right on your home screen: the latest news, the weather or a stream of your recent photos.
                        <br>
                        <a href="" class="android-link mdl-typography--font-light">Customise your phone</a>
                     </p>
                  </div>
               </div>
               <div class="android-card-container mdl-grid">
                  <?php
                     // output RSS feed to HTML
                     
                     output_rss_feed('http://feeds.feedburner.com/fundacionademi', 4, true, true, 15);
                     ?>
               </div>
            
            <div class="android-customized-section">
               <div class="android-customized-section-text">
                  <div class="mdl-typography--font-light mdl-typography--display-1-color-contrast">Visita una lista de los programas que en ADEMI tenemos para vos!</div>
                  <p class="mdl-typography--font-light">
                     Put the stuff that you care about right on your home screen: the latest news, the weather or a stream of your recent photos.
                     <br>
                     <a href="" class="android-link mdl-typography--font-light">Customise your phone</a>
                  </p>
               </div>
            </div>
            <!--contacto-->
            <div class="android-card-container mdl-grid">
               <div class="mdl-cell mdl-cell--2-col mdl-cell--4-col-tablet mdl-cell--4-col-phone mdl-card mdl-shadow--3dp">
                  <div class="mdl-card__media">
                     <img src="images/more-from-6.png">
                  </div>
                  <div class="mdl-card__title">
                     <h4 class="mdl-card__title-text">Incubate</h4>
                  </div>
                  <div class="mdl-card__actions">
                     <a class="android-link mdl-button mdl-js-button mdl-typography--text-uppercase" href="https://docs.google.com/forms/d/e/1FAIpQLSfSxcyFVx-TG6yHdikgG77zRpIx-wLnnz_VHtqxag_BdhwUqQ/viewform?c=0&w=1">
                     impulsa tu idea
                     <i class="material-icons">chevron_right</i>
                     </a>
                  </div>
               </div>
               <div class="mdl-cell mdl-cell--2-col mdl-cell--4-col-tablet mdl-cell--4-col-phone mdl-card mdl-shadow--3dp">
                  <div class="mdl-card__media">
                     <img src="images/more-from-6.png">
                  </div>
                  <div class="mdl-card__title">
                     <h4 class="mdl-card__title-text">Dudas sobre Programas</h4>
                  </div>
                  <div class="mdl-card__actions">
                     <a class="android-link mdl-button mdl-js-button mdl-typography--text-uppercase" href="https://ademi.org.ar/contacto/">
                     Contacto
                     <i class="material-icons">chevron_right</i>
                     </a>
                  </div>
               </div>
               <div class="mdl-cell mdl-cell--2-col mdl-cell--4-col-tablet mdl-cell--4-col-phone mdl-card mdl-shadow--3dp">
                  <div class="mdl-card__media">
                     <img src="images/more-from-7.png">
                  </div>
                  <div class="mdl-card__title">
                     <h4 class="mdl-card__title-text">Asistencia a Empresas</h4>
                  </div>
                  <div class="mdl-card__actions">
                     <a class="android-link mdl-button mdl-js-button mdl-typography--text-uppercase" href="https://docs.google.com/forms/d/e/1FAIpQLSdSFF_fvOZvefARC1ZbGW1109faM8DQaBPibTde3wUYqvf8EA/viewform?c=0&w=1">
                     Consultoria
                     <i class="material-icons">chevron_right</i>
                     </a>
                  </div>
               </div>
               <div class="mdl-cell mdl-cell--2-col mdl-cell--4-col-tablet mdl-cell--4-col-phone mdl-card mdl-shadow--3dp">
                  <div class="mdl-card__media">
                     <img src="images/more-from-facebook.png">
                  </div>
                  <div class="mdl-card__title">
                     <h4 class="mdl-card__title-text">Facebook</h4>
                  </div>
                  <div class="mdl-card__actions">
                     <a class="android-link mdl-button mdl-js-button mdl-typography--text-uppercase" href="https://docs.google.com/forms/d/e/1FAIpQLSdSFF_fvOZvefARC1ZbGW1109faM8DQaBPibTde3wUYqvf8EA/viewform?c=0&w=1">
                     Me Gusta
                     <i class="material-icons">chevron_right</i>
                     </a>
                  </div>
               </div>
               <div class="mdl-cell mdl-cell--2-col mdl-cell--4-col-tablet mdl-cell--4-col-phone mdl-card mdl-shadow--3dp">
                  <div class="mdl-card__media">
                     <img src="images/more-from-twitter.png">
                  </div>
                  <div class="mdl-card__title">
                     <h4 class="mdl-card__title-text">Twitter</h4>
                  </div>
                  <div class="mdl-card__actions">
                     <a class="android-link mdl-button mdl-js-button mdl-typography--text-uppercase" href="https://docs.google.com/forms/d/e/1FAIpQLSdSFF_fvOZvefARC1ZbGW1109faM8DQaBPibTde3wUYqvf8EA/viewform?c=0&w=1">
                     sigenos
                     <i class="material-icons">chevron_right</i>
                     </a>
                  </div>
               </div>
            </div>

                     <!--contacto-->
            </div>
   
            <footer class="android-footer mdl-mega-footer">
               <div class="mdl-mega-footer--middle-section">
                  <p class="mdl-typography--font-light">© Copyright 2018 | Fundación ADEMI - Agencia Para El Desarrollo Económico de Misiones</p>
               </div>
               <div class="mdl-mega-footer--bottom-section">
                  <a class="android-link mdl-typography--font-light" href="">Novedades</a>
                  <a class="android-link mdl-typography--font-light" href="">Aula Virtual</a>
                  <a class="android-link mdl-typography--font-light" href="">¿Quiénes nos Integran?</a>
                  <a class="android-link mdl-typography--font-light" href="">Autoridades</a>
               </div>
            </footer>
         </div>
      </div>
      <a href="https://www.ademi.org.ar/blog/" target="_blank" id="view-source" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--accent mdl-color-text--accent-contrast">NOTICIAS</a>
      <script src="material.min.js"></script>
   </body>
</html>