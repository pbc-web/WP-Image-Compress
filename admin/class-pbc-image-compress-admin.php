<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://poweredbycoffee.co.uk
 * @since      1.0.0
 *
 * @package    Pbc_Image_Compress
 * @subpackage Pbc_Image_Compress/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Pbc_Image_Compress
 * @subpackage Pbc_Image_Compress/admin
 * @author     Stewart Ritchie <stewart@poweredbycoffee.co.uk>
 */
class Pbc_Image_Compress_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Pbc_Image_Compress_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Pbc_Image_Compress_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/pbc-image-compress-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Pbc_Image_Compress_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Pbc_Image_Compress_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/pbc-image-compress-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Add the new Implimentations of the Image Editor to The list that wordpress looks through
	 *
	 * @since    1.0.0
	 */

	public function add_editor_to_impimentations($implimentations){

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wp-image-editor-gd-compress.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wp-image-editor-imagemagik-compress.php';

		$new = array_unshift($implimentations, "WP_Image_Editor_Imagick_Compress", "WP_Image_Editor_GD_Compress");
		
		return $implimentations;
	}

	public function wp_handle_upload_compress($file){
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-pbc-image-compressor.php';
		
		$compressor = PBC_Image_Compress_Compressor::get_instance();
		$compressor->compress($file["file"], $file["type"]);
		return $file;
	}
}
