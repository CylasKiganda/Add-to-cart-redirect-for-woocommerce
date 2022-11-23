<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://#
 * @since      1.0.0
 *
 * @package    Acrw
 * @subpackage Acrw/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Acrw
 * @subpackage Acrw/includes
 * @author     Belo  <belotakita@gmail.com>
 */
class Acrw {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Acrw_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'ACRW_VERSION' ) ) {
			$this->version = ACRW_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'acrw';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Acrw_Loader. Orchestrates the hooks of the plugin.
	 * - Acrw_i18n. Defines internationalization functionality.
	 * - Acrw_Admin. Defines all hooks for the admin area.
	 * - Acrw_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-acrw-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-acrw-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-acrw-admin.php';

		 
		


		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-acrw-public.php';

		$this->loader = new Acrw_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Acrw_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Acrw_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Acrw_Admin( $this->get_plugin_name(), $this->get_version() );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'bacrw_enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'bacrw_enqueue_scripts' );
		$this->loader->add_action( 'woocommerce_product_options_general_product_data', $plugin_admin, 'bacrw_add_to_cart_simple_redirect_fields',10,3 );
		$this->loader->add_action( 'woocommerce_product_options_inventory_product_data', $plugin_admin, 'bacrw_add_to_cart_grouped_redirect_fields',10,3 ); 
		$this->loader->add_action( 'woocommerce_product_options_general_product_data', $plugin_admin, 'bacrw_add_to_cart_variation_parent_redirect_fields',10,3 ); 
		$this->loader->add_action( 'woocommerce_admin_process_product_object', $plugin_admin, 'bacrw_save_admin_add_to_cart_simple_redirect_values' ); 
		$this->loader->add_action( 'woocommerce_admin_process_product_object', $plugin_admin, 'bacrw_save_admin_add_to_cart_grouped_redirect_values' ); 

		$this->loader->add_action( 'woocommerce_admin_process_product_object', $plugin_admin, 'bacrw_save_admin_add_to_cart_variation_parent_redirect_values' ); 

		$this->loader->add_action( 'woocommerce_product_after_variable_attributes', $plugin_admin, 'bacrw_add_add_to_cart_variation_redirect_to_variations',10,3 ); 
		$this->loader->add_action( 'woocommerce_save_product_variation', $plugin_admin, 'bacrw_save_add_to_cart_variation_redirect_variations',10,2 ); 
 
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Acrw_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'woocommerce_add_to_cart_redirect', $plugin_public, 'bacrw_add_to_cart_redirect_url',10,2 ); 

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function bacrw_run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Acrw_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}