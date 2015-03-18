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
		add_action( 'wp_enqueue_scripts', array('WP_3D', 'add_scripts') );
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
	
	public function add_scripts() {
		wp_register_script('threejs', plugins_url('js/three.min.js', __FILE__), array(),'1.1', false);
		wp_enqueue_script('threejs');
		wp_register_script('collada-loader', plugins_url('js/loaders/ColladaLoader.js', __FILE__), array(),'1.1', false);
		wp_enqueue_script('collada-loader');
		wp_register_script('obj-loader', plugins_url('js/loaders/OBJLoader.js', __FILE__), array(),'1.1', false);
		wp_enqueue_script('obj-loader');
		wp_register_script('orbital', plugins_url('js/controls/OrbitControls.js', __FILE__), array(),'1.1', false);
		wp_enqueue_script('orbital');
	}
	
	
	// The 3D shortcode
	public function shortcode_3d($atts, $content = null) {
		ob_start();
		require('output.php');
		return ob_get_clean();
	}
	
}

register_activation_hook(__FILE__, array('WP_3D', 'activate'));
register_deactivation_hook(__FILE__, array('WP_3D', 'deactivate'));
$wp3d = new WP_3D();
