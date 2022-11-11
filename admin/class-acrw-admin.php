<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://#
 * @since      1.0.0
 *
 * @package    Acrw
 * @subpackage Acrw/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Acrw
 * @subpackage Acrw/admin
 * @author     Belo  <belotakita@gmail.com>
 */
class Acrw_Admin {

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
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/acrw-admin-display.php';


	} 

	/**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles( $hook )
    {
        if( in_array($hook, array('post.php', 'post-new.php') ) ){
        $screen = get_current_screen();

        if( is_object( $screen ) && "product" == $screen->post_type ){

            wp_enqueue_style(
                $this->plugin_name . 'select2-min',
                plugin_dir_url( __FILE__ ) . 'css/select2.min.css',
                array(),
                'all'
            );  

			wp_enqueue_style(
                $this->plugin_name . 'admin',
                plugin_dir_url( __FILE__ ) . 'css/acrw-admin.css',
                array(),
                '1.2111111111111111'
            ); 

        }
	}
            
        
    
    }
    
    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts( $hook )
    { 
		if( in_array($hook, array('post.php', 'post-new.php') ) ){
        $screen = get_current_screen();
		if( is_object( $screen ) && "product" == $screen->post_type ){

            wp_enqueue_script(
                $this->plugin_name . '-select2-js',
                plugin_dir_url( __FILE__ ) . 'js/select2.full.min.js',
                array( 'jquery' ),
                "1.11",
                false
            ); 

			wp_enqueue_script(
                $this->plugin_name . 'admin',
                plugin_dir_url( __FILE__ ) . 'js/acrw-admin.js',
                array( 'jquery' ),
                "1.11111111111111111111111111111111111111111111111111111111111111111111111111111111111111",
                false
            );

        }
	}
            
                
       
    
    }
/**
	 * Register the add to cart url input fields.
	 *
	 * @since    1.0.0
	 */
	public function add_to_cart_simple_redirect_fields() {

		/**
		 * This function is used to add the add-to-cart url field for simple products.
		 * 
		 */

		global $post;
		$product = wc_get_product($post->ID); 
		 
		$options = array();
		$options['default'] = __( 'Select a value', "belo-acrw");  

		$post_string = __( 'post', "belo-acrw");
		$page_string = __( 'page', "belo-acrw");
		
		$main_data_pages = get_pages();
			foreach ($main_data_pages as  $item){
				$options[get_permalink($item->ID)] = $item->post_title.','.$page_string;
			}
            
			$main_data_posts = get_posts();
			foreach ($main_data_posts as  $item){
				$options[get_permalink($item->ID)] = $item->post_title.','.$post_string;
			}
				  

			 
			echo '<div class="show_if_simple acrw-wrapper ">';
			
			woocommerce_wp_select( array(
			'id'            => 'add_to_cart_simple_redirect',
			'value'         => get_post_meta( get_the_ID(), 'add_to_cart_simple_redirect', true ),
			'name'          => 'add_to_cart_simple_redirect',
			'label'         => __('Add to cart redirect', "belo-acrw"), 
			'options' =>  $options,  
			'desc_tip'      => true,
			'description'   => __( 'After this product is added to the cart, select the page to be redirected to', "belo-acrw" ),
			) );
			
			echo '</div>'; 
  	
	}
	public function add_to_cart_grouped_redirect_fields() {

		/**
		 * This function is used to add the add-to-cart url field for simple products.
		 * 
		 */

		global $post;
		$product = wc_get_product($post->ID); 
		if($product->is_type('grouped')){
			$options = array();
			$options['default'] = __( 'Select a value', "belo-acrw");  

            $post_string = __( 'post', "belo-acrw");
            $page_string = __( 'page', "belo-acrw");
            
			$main_data_posts = get_posts();
			$main_data_pages = get_pages();
			foreach ($main_data_pages as  $item){
				$options[get_permalink($item->ID)] = $item->post_title.','.$page_string;
			}
            
			$main_data_posts = get_posts();
			foreach ($main_data_posts as  $item){
				$options[get_permalink($item->ID)] = $item->post_title.','.$post_string;
			}
				  

			 
			echo '<div class="show_if_grouped acrw-wrapper">';
			
			woocommerce_wp_select( array(
			'id'            => 'add_to_cart_grouped_redirect',
			'value'         => get_post_meta( get_the_ID(), 'add_to_cart_simple_redirect', true ),
			'name'          => 'add_to_cart_simple_redirect',
			'label'         => __('Add to cart redirect', "belo-acrw"), 
			'options' =>  $options,  
			'desc_tip'      => true,
			'description'   => __( 'After this product is added to the cart, select the page to be redirected to', "belo-acrw" ),
			) );
			
			echo '</div>';
		}
			
		
	}
	public function add_to_cart_variation_parent_redirect_fields() {

		/**
		 * This function is used to add the add-to-cart url field for simple products.
		 * 
		 */

		global $post;
		$product = wc_get_product($post->ID); 
		 //var_dump( get_pages());
		 $options = array();
		 $options['default'] = __( 'Select a value', "belo-acrw");  

		 $post_string = __( 'post', "belo-acrw");
		 $page_string = __( 'page', "belo-acrw");
		 
		 $main_data_pages = get_pages();
			foreach ($main_data_pages as  $item){
				$options[get_permalink($item->ID)] = $item->post_title.','.$page_string;
			}
            
			$main_data_posts = get_posts();
			foreach ($main_data_posts as  $item){
				$options[get_permalink($item->ID)] = $item->post_title.','.$post_string;
			}
				  

			 
			echo '<div class="show_if_variable acrw-wrapper">';
			
			woocommerce_wp_select( array(
			'id'            => 'add_to_cart_variation_parent_redirect',
			'value'         => get_post_meta( get_the_ID(), 'add_to_cart_variation_parent_redirect', true ),
			'name'          => 'add_to_cart_variation_parent_redirect',
			'label'         => __('Add to cart redirect - parent', "belo-acrw"), 
			'options' =>  $options,  
			'desc_tip'      => true,
			'description'   => __( 'After this product is added to the cart, select the page to be redirected to', "belo-acrw" ),
			) );
			
			echo '</div>';
		 
	}
	
	public function save_admin_add_to_cart_simple_redirect_values($product) {

		/**
		 * This function is used to save the add-to-cart url field value for simple products.
		 * 
		 */

		if ( isset($_POST['add_to_cart_simple_redirect']) ) {
			$product->update_meta_data( 'add_to_cart_simple_redirect', $_POST['add_to_cart_simple_redirect'] );
		}
	}

	public function save_admin_add_to_cart_variation_parent_redirect_values($product) {

		/**
		 * This function is used to save the add-to-cart url field value for variation_parent products.
		 * 
		 */

		if ( isset($_POST['add_to_cart_variation_parent_redirect']) ) {
			$product->update_meta_data( 'add_to_cart_variation_parent_redirect',  $_POST['add_to_cart_variation_parent_redirect'] );
		}
	}

	public function add_add_to_cart_variation_redirect_to_variations( $loop, $variation_data, $variation )  {
		
		/**
		 * This function is used to add the add-to-cart url field for variation products.
		 * 
		 */
		$options = array();
			$options['same_as_parent'] = __( 'Same as parent', "belo-acrw");  

            $post_string = __( 'post', "belo-acrw");
            $page_string = __( 'page', "belo-acrw");
            
			$main_data_pages = get_pages();
			foreach ($main_data_pages as  $item){
				$options[get_permalink($item->ID)] = $item->post_title.','.$page_string;
			}
            
			$main_data_posts = get_posts();
			foreach ($main_data_posts as  $item){
				$options[get_permalink($item->ID)] = $item->post_title.','.$post_string;
			}
			echo '<div class=" acrw-wrapper">';
			woocommerce_wp_select( array(
				'id' => 'add_to_cart_variation_redirect'.$loop, 
				'name' => 'add_to_cart_variation_redirect['.$loop.']', 
				'class' => 'long belo_variation_select',
				'value'         => get_post_meta( $variation->ID, 'add_to_cart_variation_redirect', true ), 
				'label'         => __('Add to cart redirect', "belo-acrw"), 
				'options' =>  $options,  
				'desc_tip'      => true,
				'description'   => __( 'After this product is added to the cart, select the page to be redirected to', "belo-acrw" ),
				) );
				echo '</div>';
	}

	public function save_add_to_cart_variation_redirect_variations($variation_id, $i) {

		/**
		 * This function is used to save the add-to-cart url field value for variation products.
		 * 
		 */

		$add_to_cart_variation_redirect = $_POST['add_to_cart_variation_redirect'][$i];
		if ( isset( $add_to_cart_variation_redirect ) ) 
		{
			update_post_meta( $variation_id, 'add_to_cart_variation_redirect', wp_kses_post( $add_to_cart_variation_redirect, array()) );  
		}
	}
}