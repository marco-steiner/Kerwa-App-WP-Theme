<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package kerwaapp
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$container = get_theme_mod( 'kerwaapp_container_type' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="apple-mobile-web-app-status-bar-style" content="default">
	<meta name="theme-color" content="#FFFFFF" />
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
	<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/img/touch-icon-iphone.png" type="image/x-icon" />
	<link rel="apple-touch-icon" href="<?php bloginfo('template_url'); ?>/img/touch-icon-iphone.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php bloginfo('template_url'); ?>/img/touch-icon-ipad.png">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php bloginfo('template_url'); ?>/img/touch-icon-iphone-retina.png">
	<link rel="apple-touch-icon" sizes="167x167" href="<?php bloginfo('template_url'); ?>/img/touch-icon-ipad-retina.png">

	<link rel="apple-touch-startup-image" href="<?php bloginfo('template_url'); ?>/img/apple-splash-2048-2732.png" media="(device-width: 1024px) and (device-height: 1366px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)">
	<link rel="apple-touch-startup-image" href="<?php bloginfo('template_url'); ?>/img/apple-splash-2732-2048.png" media="(device-width: 1024px) and (device-height: 1366px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)">
	<link rel="apple-touch-startup-image" href="<?php bloginfo('template_url'); ?>/img/apple-splash-1668-2388.png" media="(device-width: 834px) and (device-height: 1194px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)">
	<link rel="apple-touch-startup-image" href="<?php bloginfo('template_url'); ?>/img/apple-splash-2388-1668.png" media="(device-width: 834px) and (device-height: 1194px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)">
	<link rel="apple-touch-startup-image" href="<?php bloginfo('template_url'); ?>/img/apple-splash-1668-2224.png" media="(device-width: 834px) and (device-height: 1112px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)">
	<link rel="apple-touch-startup-image" href="<?php bloginfo('template_url'); ?>/img/apple-splash-2224-1668.png" media="(device-width: 834px) and (device-height: 1112px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)">
	<link rel="apple-touch-startup-image" href="<?php bloginfo('template_url'); ?>/img/apple-splash-1536-2048.png" media="(device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)">
	<link rel="apple-touch-startup-image" href="<?php bloginfo('template_url'); ?>/img/apple-splash-2048-1536.png" media="(device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)">
	<link rel="apple-touch-startup-image" href="<?php bloginfo('template_url'); ?>/img/apple-splash-1242-2688.png" media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)">
	<link rel="apple-touch-startup-image" href="<?php bloginfo('template_url'); ?>/img/apple-splash-2688-1242.png" media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)">
	<link rel="apple-touch-startup-image" href="<?php bloginfo('template_url'); ?>/img/apple-splash-1125-2436.png" media="(device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)">
	<link rel="apple-touch-startup-image" href="<?php bloginfo('template_url'); ?>/img/apple-splash-2436-1125.png" media="(device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)">
	<link rel="apple-touch-startup-image" href="<?php bloginfo('template_url'); ?>/img/apple-splash-828-1792.png" media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)">
	<link rel="apple-touch-startup-image" href="<?php bloginfo('template_url'); ?>/img/apple-splash-1792-828.png" media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)">
	<link rel="apple-touch-startup-image" href="<?php bloginfo('template_url'); ?>/img/apple-splash-1242-2208.png" media="(device-width: 414px) and (device-height: 736px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)">
	<link rel="apple-touch-startup-image" href="<?php bloginfo('template_url'); ?>/img/apple-splash-2208-1242.png" media="(device-width: 414px) and (device-height: 736px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)">
	<link rel="apple-touch-startup-image" href="<?php bloginfo('template_url'); ?>/img/apple-splash-750-1334.png" media="(device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)">
	<link rel="apple-touch-startup-image" href="<?php bloginfo('template_url'); ?>/img/apple-splash-1334-750.png" media="(device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)">
	<link rel="apple-touch-startup-image" href="<?php bloginfo('template_url'); ?>/img/apple-splash-640-1136.png" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)">
	<link rel="apple-touch-startup-image" href="<?php bloginfo('template_url'); ?>/img/apple-splash-1136-640.png" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)">
</head>

<body <?php body_class(); ?> data-oc-top="#FFEE81" data-oc-bottom="#FFEE81" data-barba="wrapper">

<div class="site site-container" id="page">

		<a class="skip-link sr-only sr-only-focusable" href="#content"><?php esc_html_e( 'Skip to content', 'kerwaapp' ); ?></a>

		<!-- Menu Start -->
		<?php if ( has_nav_menu( 'primary' ) ) : ?>
			<header class="header">
				<span class="menu-trigger">
					<i class="menu-trigger-bar top"></i>
					<i class="menu-trigger-bar middle"></i>
					<i class="menu-trigger-bar bottom"></i>
				</span>
				<div class="logo"><a href="<?php echo home_url(); ?>"><img src="<?php bloginfo('template_url'); ?>/img/logo.svg" alt="Kerwacrew App" /></a></div>
			</header>
			<div class="menu-wrapper">
				<span class="close-trigger">
					<i class="close-trigger-bar left"></i>
					<i class="close-trigger-bar right"></i>
				</span>
				<i class="menu-bg top"></i>
				<i class="menu-bg middle"></i>
				<i class="menu-bg bottom"></i>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'menu_class'     => 'menu',
						'container_class'	=> 'menu-container',
						'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					)
				);
				?>
			</div>
		<?php endif; ?>
		<!-- Menu End -->
