<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://#
 * @since      1.0.0
 *
 * @package    Acrw
 * @subpackage Acrw/admin/partials
 */
 

class WC_get_options_acrw {
 
 
public static function get_options_data() {
            
            $options = array();

			$options['default'] = __( 'Select a value', 'belo-add-to-cart-redirect');

            global $wpdb;

            $post_types = get_post_types( array( 'public' => true ) );
            $post_types = implode( "','", $post_types );
             
            $query      = $wpdb->prepare( "
            SELECT ID, post_title, post_type FROM {$wpdb->posts} as posts
            WHERE posts.post_status = 'publish'
            AND post_type IN ('$post_types') 
            " ); 

            $posts = $wpdb->get_results( $query ); 
            
            // Include wpml support.
			if ( defined( 'ICL_SITEPRESS_VERSION' ) ) {
				$cur_lang =  apply_filters( 'wpml_current_language', NULL );

                foreach ( $posts as $values ) {
                    $args = array('element_id' => $values->ID, 'element_type' => $values->post_type);
                    $post_language_code = apply_filters( 'wpml_element_language_code', null, $args );
                    if($post_language_code == $cur_lang){
                        if($values->post_type == "product"){
                            $ptype = __( "product",'belo-add-to-cart-redirect');
                        }
                        else if($values->post_type == "post"){
                            $ptype = __( "post",'belo-add-to-cart-redirect');
                        }
                        else if($values->post_type == "page"){
                            $ptype = __( "page",'belo-add-to-cart-redirect');
                        }
                        else {
                            $ptype = __( $values->post_type,'belo-add-to-cart-redirect');
                        }
                        if(!empty($values->ID)){
                            $options[get_permalink($values->ID)] = $values->post_title.','.$ptype; 
                        }
                        
                    } 
                }
			}
            else{
                foreach ( $posts as $values ) {
                    $args = array('element_id' => $values->ID, 'element_type' => $values->post_type); 
                        if($values->post_type == "product"){
                            $ptype = __( "product",'belo-add-to-cart-redirect');
                        }
                        else if($values->post_type == "post"){
                            $ptype = __( "post",'belo-add-to-cart-redirect');
                        }
                        else if($values->post_type == "page"){
                            $ptype = __( "page",'belo-add-to-cart-redirect');
                        }
                        else {
                            $ptype = __( $values->post_type,'belo-add-to-cart-redirect');
                        }
                        if(!empty($values->ID)){
                            $options[get_permalink($values->ID)] = $values->post_title.','.$ptype; 
                        }
                         
                }
            }
            

            

            return $options;
        }
}