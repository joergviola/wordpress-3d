<?php

/**
 * Plugin Name: Wordpress 3D
 * Plugin URI: http://www.joergviola.de
 * Description: The first live 3D plugin for wordpress
 * Version: 1.0.0
 * Author: Joerg Viola
 * Author URI: http://www.joergviola.de
 */


class WP_3D {
	
	// Constructor
	public function __construct() {
		add_shortcode( '3D', array('WP_3D', 'shortcode_3d') );
	}
	
	// Activate the plugin
	public static function activate() {
	}
	
	// Deactivate the plugin
	public static function deactivate() {
	}
	
	// Add link to the settings page
	function admin_menu_hook() {
		// Do nothing so far ;)
	}
	
	// The 3D shortcode
	function shortcode_3d($atts, $content = null) {
		ob_start();
		require('output.php');
		return ob_get_clean();
	}
	
}

register_activation_hook(__FILE__, array('WP_3D', 'activate'));
register_deactivation_hook(__FILE__, array('WP_3D', 'deactivate'));
$wp3d = new WP_3D();
