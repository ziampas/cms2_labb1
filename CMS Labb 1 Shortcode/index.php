<?php
/**
 * Plugin Name: CMS Labb 1 Shortcode
 * Plugin URI: http://localhost/cms2
 * Description: For school
 * Version: 1.0
 * Author: Kristian Ziampas Olausson
 * Author URI: http://www.mywebsite.com
 */

 //Hämtar CSS för button
add_action('wp_enqueue_scripts', 'customscripts');
function customscripts() {
    wp_register_style( 'custom_style', plugins_url('style.css', __FILE__) );
    wp_enqueue_style( 'custom_style' );
}

 function wordpress_plugin_button($atts) {

    //Lägger till attribut/parametrar och sätter defaultvärden
    extract(shortcode_atts(array(
        'href' => 'http://www.google.com',
        'label' => 'Knapp',
        'customstyle' => '',
       ), $atts, 'wordpress_plugin_button' ));
       //HTML som ritas ut
     return '
     <a href="' . esc_attr( $href) . '"><button class="button" style="' . esc_attr( $customstyle) . '">' . esc_attr( $label) . '</button></a>     </form>
     ';

 }
 //Skapar min shortcode och kopplar den till rätt funktion
 add_shortcode('btn', 'wordpress_plugin_button');
?>


