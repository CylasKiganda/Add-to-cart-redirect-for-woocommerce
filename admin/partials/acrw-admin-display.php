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
 


class WC_Settings_add_to_cart_redirect_acrw {


public static function init() {
add_filter( 'woocommerce_settings_tabs_array', __CLASS__ . '::add_settings_tab', 50 );
add_action( 'woocommerce_settings_tabs_settings_add_to_cart_redirect_acrw', __CLASS__ . '::settings_tab' );
add_action( 'woocommerce_update_options_settings_add_to_cart_redirect_acrw', __CLASS__ . '::update_settings' );
}


public static function add_settings_tab( $settings_tabs ) {
$settings_tabs['settings_add_to_cart_redirect_acrw'] = __( 'Add To Cart Redirect', 'belo-acrw' );
return $settings_tabs;
}


public static function settings_tab() {
woocommerce_admin_fields( self::get_settings() );
self::add_to_cart_redirect_acrw_styles_scripts();
}

/**
* Function to add styles and script for Add to cart global settings page
*/
public function add_to_cart_redirect_acrw_styles_scripts() {

if ( ! wp_script_is( 'jquery' ) ) {
wp_enqueue_script( 'jquery' );
}

 
wp_enqueue_style(
    'acrw-select2-min',
    plugin_dir_url( __FILE__ ) . '../css/select2.min.css',
    array(),
    'all'
);  

wp_enqueue_style(
    'acrw-admin-global',
    plugin_dir_url( __FILE__ ) . '../css/acrw-admin.css',
    array(),
    '1.2111111111111111111111111'
); 
wp_enqueue_script(
    'acrw--select2-js',
    plugin_dir_url( __FILE__ ) . '../js/select2.full.min.js',
    array( 'jquery' ),
    '1.11',
    false
); 

wp_enqueue_script(
    'acrw-admin',
    plugin_dir_url( __FILE__ ) . '../js/acrw-admin.js',
    array( 'jquery' ),
    "1.21111111111",
    false
); 
    }
 
public static function update_settings() {
    woocommerce_update_options( self::get_settings() );
}


public static function get_settings() {
            
            $options = array();
			$options['default'] = __( 'Select a value', "acrw");  

            $post_string = __( 'post', 'acrw');
            $page_string = __( 'page', 'acrw');

            $main_data_pages = get_pages();
			foreach ($main_data_pages as  $item){
				$options[get_permalink($item->ID)] = $item->post_title.','.$page_string;
			}
            
			$main_data_posts = get_posts();
			foreach ($main_data_posts as  $item){
				$options[get_permalink($item->ID)] = $item->post_title.','.$post_string;
			}

			
?>
<style>
#wpbody-content .notice,
#wpbody-content .error,
#message {
    display: none !important;
}

.acrw_global_title {
    color: #2a8db0;
    font-size: 16px;
    border: 1px solid #d8d8d8;
    border-bottom: 0;
    background-color: #fff;
    padding: 35px 20px;
    margin: 0px;
}

table.form-table {
    border: 1px solid #d8d8d8;
    border-top: 0;
    margin-bottom: 40px;
}

table.form-table td,
th {
    padding: 30px 20px !important;
    background-color: #fff;
}

p.submit {
    margin-top: 30px;
    padding-top: 10px;
}

p.submit .button-primary {
    background: #00799f !important;
    border-color: #00799f !important;
}

.form-wrap p,
p.description {
    margin-top: 10px !important;
    line-height: 20px;
    max-width: 40%;
    min-width: min(100%, 360px);
}

input[type="radio"]:checked:before,
input[type="checkbox"]:checked:before {
    float: left;
    display: flex;
    background: #3dc1ab;
    content: "\2713";
    font-weight: bolder;
    color: white;
    border-radius: 4px;
    text-align: center;
    justify-content: center;
    align-items: center;
    height: 1.4125rem;
    width: 1.4125rem;
}

#wc_settings_add_to_cart_redirect_acrw_checkbox {
    margin-right: 10px !important;
}
</style>

<h2 class="acrw_global_title">
    <?php  echo __( 'Global Settings', 'belo-acrw' ); ?>

</h2>
<?php 
    $settings = array(
        'section_title' => array(
            'name'     => "",
            'type'     => 'title',
            'desc'     => '',
            'id'       => 'wc_settings_add_to_cart_redirect_acrw_section_title'
        ),
        'select_acrw_global' => array(
            'name' => __( 'Add to cart redirect - global', 'belo-acrw' ),
            'type' => 'select',
            'desc' => __( 'select the global redirect', 'belo-acrw' ),
            'id'   => 'wc_settings_add_to_cart_redirect_acrw_url',
            'options'=> $options,
        ), 
        'checkbox_acrw_global' => array(
            'name' => __( 'Enable the global redirect', 'belo-acrw' ),
            'type' => 'checkbox',
            'desc' => __( 'Enable the global redirect for all products', 'belo-acrw' ),
            'id'   => 'wc_settings_add_to_cart_redirect_acrw_checkbox',
            'default'=> 'false',
        ), 
        'section_end' => array(
             'type' => 'sectionend',
             'id' => 'wc_settings_add_to_cart_redirect_acrw_section_end'
        )
    );


    return apply_filters( 'wc_settings_add_to_cart_redirect_acrw_settings', $settings );
}

}

WC_Settings_add_to_cart_redirect_acrw::init();