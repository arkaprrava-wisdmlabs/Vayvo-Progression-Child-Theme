<?php
//
// Recommended way to include parent theme styles.
//  (Please see http://codex.wordpress.org/Child_Themes#How_to_Create_a_Child_Theme)
//  
add_action( 'wp_enqueue_scripts', 'vayvo_child_progression_studios_enqueue_styles' );
function vayvo_child_progression_studios_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style'),
        wp_get_theme()->get("Version")
    );
}
//
// Your code goes below
//
add_post_type_support( 'page', 'excerpt' );
function bbp_enable_visual_editor( $args = array() ) {
    $args['tinymce'] = true;
    $args['quicktags'] = false;
    return $args;
}
add_filter( 'bbp_after_get_the_content_parse_args', 'bbp_enable_visual_editor' );
add_filter('bbp_pre_get_user_profile_url', 'mjj_profile_link');
function mjj_profile_link( $user_id ){
	$user_info = get_userdata( $user_id );
	$user_nicename = $user_info -> user_nicename;
	return 'https://theuncorked.wisdmlabs.net/my-profile/' . $user_nicename;
}
/**
 * @snippet       Add Product to WooCommerce Cart Programmatically
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 3.9
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */
   
/**
 * @snippet       WooCommerce User Registration Shortcode
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 7
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */
   
add_shortcode( 'wc_reg_form_bbloomer', 'bbloomer_separate_registration_form' );
     
function bbloomer_separate_registration_form() {
   if ( is_user_logged_in() ) return '<p>You are already registered</p>';
   ob_start();
   do_action( 'woocommerce_before_customer_login_form' );
   $html = wc_get_template_html( 'myaccount/form-login.php' );
   $dom = new DOMDocument();
   $dom->encoding = 'utf-8';
   $dom->loadHTML( utf8_decode( $html ) );
   $xpath = new DOMXPath( $dom );
   $form = $xpath->query( '//form[contains(@class,"register")]' );
   $form = $form->item( 0 );
   echo $dom->saveXML( $form );
   return ob_get_clean();
}

function change_product_link($products_merge_tag, $products, $message, $args) {
    // Modify the product link
    // Example: Append a query parameter to the product link
    var_dump($products_merge_tag);
    echo "<br> - wdm -";
    var_dump($products);
    echo "<br> - wdm -";
    var_dump($message);
    echo "<br> - wdm -";
    var_dump($args);
    $modified_products_merge_tag = $products_merge_tag . '?custom_param=1';

    return $modified_products_merge_tag;
}

// add_filter('wc_memberships_message_products_merge_tag_replacement', 'change_product_link', 10, 4);
