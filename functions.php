<?php
/**
 * kerwaapp functions and definitions
 *
 * @package kerwaapp
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$kerwaapp_includes = array(
	'/theme-settings.php',                  // Initialize theme default settings.
	'/setup.php',                           // Theme setup and custom theme supports.
	'/widgets.php',                         // Register widget area.
	'/enqueue.php',                         // Enqueue scripts and styles.
	'/template-tags.php',                   // Custom template tags for this theme.
	'/pagination.php',                      // Custom pagination for this theme.
	'/hooks.php',                           // Custom hooks.
	'/extras.php',                          // Custom functions that act independently of the theme templates.
	'/customizer.php',                      // Customizer additions.
	'/custom-comments.php',                 // Custom Comments file.
	'/jetpack.php',                         // Load Jetpack compatibility file.
	'/class-wp-bootstrap-navwalker.php',    // Load custom WordPress nav walker.
	'/woocommerce.php',                     // Load WooCommerce functions.
	'/editor.php',                          // Load Editor functions.
);

foreach ( $kerwaapp_includes as $file ) {
	$filepath = locate_template( 'inc' . $file );
	if ( ! $filepath ) {
		trigger_error( sprintf( 'Error locating /inc%s for inclusion', $file ), E_USER_ERROR );
	}
	require_once $filepath;
}

	
register_nav_menu( 'secondary', __('Footer Navigation') );

// Deactivate Update of VSEL
function op_remove_update_vc($value) {
    unset($value->response['very-simple-event-list/vsel.php']);
	return $value;
}
add_filter('site_transient_update_plugins', 'op_remove_update_vc');


// Blende Theme updates aus.
function hide_theme_updates($a) {
    global $wp_version;
    return (object) array ('last_checked' => time(), 'version_checked' => $wp_version, );
}
add_filter ('pre_site_transient_update_themes', 'hide_theme_updates');


// Welches Template wird auf der Seite benutzt:
/*
add_filter('template_include', 'debug_template_use' );
function debug_template_use($template) {
 
  var_dump($template);
 
  // Important: return the default setting  
  return $template;
}
*/



// Remove Wordpress Version
function no_generator() { return ''; } 
add_filter( 'the_generator', 'no_generator' ); 



// Remove Dashboard Menus
function remove_menus () { 
    global $menu;
    $restricted = array(__('Comments'), __('Posts'), __('Links')); 
    end ($menu); 
     
    while (prev($menu)){ 
        $value = explode(' ',$menu[key($menu)][0]); 
        if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);} 
    } 
} 
//add_action('admin_menu', 'remove_menus');



// Styling für die Loginseite
add_action( 'login_enqueue_scripts', 'login_logo' );
function login_logo() { 
    ?>
    <style type="text/css">
    #login h1 a, .login h1 a {background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/xyz.png);margin-bottom: 30px;background-size: 100%;height: 83px;width: 83px;}
    .login .message {border-left: 4px solid #FF9900!important;}
    .login.wp-core-ui .button-primary {background: #FF9900!important; border-color: #ffac2f #e38800 #e38800!important; box-shadow: 0 1px 0 #e38800!important;text-shadow: 0 -1px 1px #e38800, 1px 0 1px #e38800, 0 1px 1px #e38800, -1px 0 1px #e38800!important;}
    .login input[type=checkbox]:checked:before, .login a:hover {color: #FF9900!important;}
    .login input:focus,.login h1 a:focus {border-color: #FF9900!important; box-shadow: 0 0 2px rgba(255,153,0,.8)!important;}
    .login a:focus {box-shadow: none!important;}
    </style>
   <?php 
}

// jQuery 3.3.0 einbinden
function my_init_method() {
    if (!is_admin()) {
        wp_deregister_script( 'jquery' );
        wp_register_script( 'jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.0/jquery.min.js');
        //wp_register_script( 'gasp', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.2.4/gsap.min.js');
        wp_register_script( 'tweenMax', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.2/TweenMax.min.js');
        wp_register_script( 'timelineMax', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.2/TimelineMax.min.js');
        wp_enqueue_script( 'jquery' );
        //wp_enqueue_script( 'gasp' );
        wp_enqueue_script( 'tweenMax' );
        wp_enqueue_script( 'timelineMax' );
    }
}
add_action('init', 'my_init_method');



// Remove Emoji Script
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

// Remove WP oEmbed
function my_deregister_scripts(){
	wp_dequeue_script( 'wp-embed' );
}
add_action( 'wp_footer', 'my_deregister_scripts' );

// Remove the wp-block-library.css
add_action( 'wp_enqueue_scripts', function() {
    wp_dequeue_style( 'wp-block-library' );
});

// Remove Header Code
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_resource_hints', 2);
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );

// Remove Rest Api Head
remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
remove_action('template_redirect', 'rest_output_link_header', 11, 0);

// Tiny MCE - Ul with custom class "checkList"
// Insert 'styleselect' into the $buttons array
function checklist_mce_button( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}
// Use 'mce_buttons' for button row #1, mce_buttons_3' for button row #3
add_filter('mce_buttons_2', 'checklist_mce_button');

function checklist_mce_before_init_insert_formats( $init_array ) {
    $style_formats = array(
        array(
            'title' => 'Checkliste', // Title to show in dropdown
            'selector' => 'ul', // Element to add class to
            'classes' => 'checkList' // CSS class to add
        )
    );
    $init_array['style_formats'] = json_encode( $style_formats );
    return $init_array;
}
add_filter( 'tiny_mce_before_init', 'checklist_mce_before_init_insert_formats' );


// Remove HTML comments
function callback($buffer){
	$buffer = preg_replace('/<!--(.|s)*?-->/', '', $buffer); return $buffer;
} 
function buffer_start(){
	ob_start("callback");
}
function buffer_end(){
	ob_end_flush();
}
add_action('get_header', 'buffer_start');
add_action('wp_footer', 'buffer_end');


function get_menu($data) {
    # Change 'menu' to your own navigation slug.
    return wp_get_nav_menu_items($data['slug']);
}
add_action( 'rest_api_init', function () { 
    register_rest_route( 'custom', '/menu/(?P<slug>[a-zA-Z0-9- ]+)', array( 
    'methods' => 'GET', 
    'callback' => 'get_menu'
    )); 
}); 
