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
$settings_tabs['settings_add_to_cart_redirect_acrw'] = __( 'Add To Cart Redirect', 'woocommerce-settings-tab-demo' );
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
    plugin_dir_url( __FILE__ ) . '../css/acrw-global-admin.css',
    array(),
    '1.21'
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
    "1.2111",
    false
);
?>
<script>
jQuery(document).on("select2:open", () => {
    document
        .querySelector(".select2-container--open .select2-search__field")
        .focus();
});
</script>
<?php
    }
 
public static function update_settings() {
    woocommerce_update_options( self::get_settings() );
}


public static function get_settings() {

    $main_data = get_posts();
    $options['default_global'] = __( 'Select a value', "acrw"); 

    foreach ($main_data as  $item){
        $options[get_permalink( $item->ID )] = $item->post_title;
    }


    $settings = array(
        'section_title' => array(
            'name'     => __( 'Global Settings', 'woocommerce-settings-tab-demo' ),
            'type'     => 'title',
            'desc'     => '',
            'id'       => 'wc_settings_add_to_cart_redirect_acrw_section_title'
        ),
        'select_acrw_global' => array(
            'name' => __( 'Add to cart redirect - global', 'woocommerce-settings-tab-demo' ),
            'type' => 'select',
            'desc' => __( 'select the global redirect', 'woocommerce-settings-tab-demo' ),
            'id'   => 'wc_settings_add_to_cart_redirect_acrw_title',
            'options'=> $options,
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