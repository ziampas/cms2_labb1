<?php
/**
 * Plugin Name: CMS Labb 1 Contact Form
 * Plugin URI: http://localhost/cms2
 * Description: For school
 * Version: 1.0
 * Author: Kristian Ziampas Olausson
 * Author URI: http://www.mywebsite.com
 */

add_shortcode('c-frm', 'wordpress_plugin_form');
function wordpress_plugin_form($atts) {
    // Meddelande som visas när e-post skickats
    if( !empty( $_GET['emf_success'] ) ) {
		$emf_display = '<div class="emf-success"><p><h2>Thank you for your email!</h2></p></div>';
	}
	else {
		$emf_display = 
        extract(shortcode_atts(array(
            'receiver' => 'kristian.olausson@gmail.com',
            'placeholder' => 'Write your message here..',
            'success-text' => '',
           ), $atts, 'wordpress_plugin_form' ));
    
         return '
      <form method="post" action="' . admin_url( 'admin-ajax.php' ) . '">
      <input type="hidden" name="receiver" value="' . esc_attr( $receiver) . '">
      <p><label>Subject: </label><input type="text" name="subject"></p>
      <p><label>Message: </label><textarea name="message" placeholder="' . esc_attr( $placeholder) . '"></textarea></p>
      <input type="submit" value="Send">
      <input type="hidden" name="action" value="send_post">
      </form>
         ';;
	}

	return $emf_display;

 }

// Hämta CSS
add_action('wp_enqueue_scripts', 'custom_form_script');
function custom_form_script() {
    wp_register_style( 'namespace', plugins_url('style.css', __FILE__) );
    wp_enqueue_style( 'namespace' );
}

// Kopplar ihop formuläret med min WP_mail funktion
add_action('wp_ajax_send_post', 'submit_values');
add_action('wp_ajax_nopriv_send_post', 'submit_values');

function submit_values(){
    // Error om man inte fyller i alla fält
    if ( empty( $_POST['subject'] ) || empty( $_POST['message'] )
    ) {
        die('Please fill in all the fields!');
        return;
    }
    
    $to = $_POST['receiver'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    wp_mail( $to, $subject, $message );

    echo "<br>";
// Om e-post lyckades skickas så redirecta tillbaka dit vi kom ifrån
	$url = add_query_arg( 'emf_success', 'true', $_SERVER['HTTP_REFERER'] );
    wp_redirect( $url );
    
	die();
}

?>