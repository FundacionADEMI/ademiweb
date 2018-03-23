<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

/** 
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
define('DB_NAME', 'cl000468_ademiwp');

/** Deshabilito WP_CRON */
define('DISABLE_WP_CRON', true);

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'cl000468_ademiwp');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', 'ma26siDEbi');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', 'localhost');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', '19&u&pB&`=mA;ttQir)u<sWn<I[~0yB3bsW#:9mt&<k9d(]U8iAurZb:^M#E7Gg/');
define('SECURE_AUTH_KEY', 'WT~a}FfcO@cCZQhXcjeb7*xl?`[I&NS..A`el|*V84M3_t{5YA8 r%!F_fK8>>BU');
define('LOGGED_IN_KEY', '1 Y.xxB#>)[>3]g<$tCnJyExwAys1Ko]x{g}DOnBu{xWBB2%hP )[-H9:H_-C2sD');
define('NONCE_KEY', ']z7|>1v)v^+GX  ,t>(_9-%Hy9-%>1)7vM^,2xEO4}2&h#x SAuO?=p(IgZ1zKn>');
define('AUTH_SALT', '8.}xp&n[ygNU/Fwe-5~4#c;qny[U*4wP{2<nhY+ngKl3Zm|UC&={Op;LM+awKmb{');
define('SECURE_AUTH_SALT', 'Gm8D^yE2arFRQjv!L%roVf.X)|S-zOl1H#1m&w@3Uq;rV@Y)`bAuxh^I4@|8&LV<');
define('LOGGED_IN_SALT', 'RnnVrV&:UV:>|Jzc4)[NG4hKH nqQt3=]R|+Ah+0%p`id_#gAb.W5Gq V>1hAF1a');
define('NONCE_SALT', 'W?7h)E6hCKqCMhxq}B*(oAYBl_xfHXP8CNJW7B&9t6,Rj7P1][;syAVeFEB3ITxM');

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'wp_';


/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', false);

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

