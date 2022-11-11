<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://#
 * @since      1.0.0
 *
 * @package    Acrw
 * @subpackage Acrw/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Acrw
 * @subpackage Acrw/public
 * @author     Belo  <belotakita@gmail.com>
 */
class Acrw_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * This code executes the add to cart redirection logic.
	 *
	 * @since    1.0.0
	 */
	public function add_to_cart_redirect_url( $url ) {
	
		if ( ! isset( $_REQUEST['add-to-cart'] ) || ! is_numeric( $_REQUEST['add-to-cart'] ) ) {
			return $url;
		}

		$product_id = (int) apply_filters( 'woocommerce_add_to_cart_product_id', absint( $_REQUEST['add-to-cart'] ) );
		 
		$product = wc_get_product($product_id); 

		$show_global = get_option( 'wc_settings_add_to_cart_redirect_acrw_checkbox', true );
			$global_url = get_option( 'wc_settings_add_to_cart_redirect_acrw_url', true );
		if(($show_global  == "yes") && ( $global_url  !="default") ){
			$url_id =  url_to_postid(get_option( 'wc_settings_add_to_cart_redirect_acrw_url', true ));
            $cur_lang =  apply_filters( 'wpml_current_language', NULL ); 
            $def_lang = apply_filters( 'wpml_default_language', NULL );
            $post_typ = get_post_type($url_id);
            //echo apply_filters( 'wpml_object_id', $url_id, $post_typ, FALSE, $def_lang );
            $cur_lang_url= apply_filters( 'wpml_object_id', $url_id, $post_typ, FALSE, $cur_lang );
            
            if(apply_filters( 'wpml_element_has_translations', NULL, $url_id, $post_typ ) ==true){
                $url =  get_permalink($cur_lang_url);
            }
            else{
                $url = get_option( 'wc_settings_add_to_cart_redirect_acrw_url', true );
            }
			
		} 
		else if(  $product->is_type( 'simple' ) || $product->is_type( 'grouped' ) ){
			
		 if(  !empty(get_post_meta( $product_id, 'add_to_cart_simple_redirect', true ) && (get_post_meta( $product_id, 'add_to_cart_simple_redirect', true ) != "default"))
		){
			$url = get_post_meta( $product_id, 'add_to_cart_simple_redirect', true );
		}
			
		}
		else if($product->is_type( 'variable' )){
			$variation = wc_get_product($_REQUEST['variation_id']);
			if(  !empty(get_post_meta(  $_REQUEST['variation_id'], 'add_to_cart_variation_redirect', true )) && (get_post_meta( $_REQUEST['variation_id'], 'add_to_cart_variation_redirect', true ) !== "same_as_parent"))
			{
				$url = get_post_meta(  $_REQUEST['variation_id'], 'add_to_cart_variation_redirect', true );
			}
			else if(  !empty(get_post_meta(  $_REQUEST['variation_id'], 'add_to_cart_variation_redirect', true )) && (get_post_meta( $_REQUEST['variation_id'], 'add_to_cart_variation_redirect', true ) === "same_as_parent"))
			{
				
				
				//$parent_id = $variation->get_parent_id();
                if( !empty(get_post_meta(  $variation->get_parent_id(), 'add_to_cart_variation_parent_redirect', true )) && get_post_meta(  $variation->get_parent_id(), 'add_to_cart_variation_parent_redirect', true ) !== "default"){
					$url = get_post_meta(  $variation->get_parent_id(), 'add_to_cart_variation_parent_redirect', true );
				}
				 

			}
			else if(  empty(get_post_meta(  $_REQUEST['variation_id'], 'add_to_cart_variation_redirect', true )) && !empty(get_post_meta( $variation->get_parent_id(), 'add_to_cart_variation_parent_redirect', true )))
			{
				$url = get_post_meta(  $variation->get_parent_id(), 'add_to_cart_variation_parent_redirect', true ); 
			}
			   
		   
			
		}
		  
		return $url;
	
	}

	 

}