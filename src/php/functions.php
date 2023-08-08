<?php
function enqueue_custom_styles() {
    wp_enqueue_style('main-style', get_stylesheet_uri());
    wp_enqueue_style('reset-style', get_template_directory_uri() . '/reset.css');
    wp_enqueue_style('index-style', get_template_directory_uri() . '/index.css');
}
add_action('wp_enqueue_scripts', 'enqueue_custom_styles');


add_action( 'wp_enqueue_scripts', 'wp734_register_scripts' );
function wp734_register_scripts() {
    wp_register_script( 
	    'custom-script', 
	    get_stylesheet_directory_uri() . '/index.js', 
	    array( 'jquery' ) 
    );

    wp_localize_script( 
        'custom-script', 
        'OBJ', 
        array(
             'ajaxurl' => admin_url( 'admin-ajax.php' ),
             'nonce' => wp_create_nonce( 'my-nonce' )
             )
    );

    wp_enqueue_script('custom-script');
}

add_action( 'wp_ajax_my_ajax_action', 'wp343_handle_ajax' );
add_action( 'wp_ajax_nopriv_my_ajax_action', 'wp343_handle_ajax' );


function wp343_handle_ajax() {
    if ( isset( $_POST['nonce'] ) && wp_verify_nonce( $_POST['nonce'], 'my-nonce' ) ) {

        $name = sanitize_text_field( $_POST['fname'] );
        $email = sanitize_email( $_POST['email'] );
        $company = sanitize_textarea_field( $_POST['company'] );
        $message = sanitize_textarea_field( $_POST['message'] );

        $to = 'it@lughstudio.com';
        $subject = 'New Contact Form Submission';
        $headers = array('Content-Type: text/html; charset=UTF-8');
        $email_content = "Name: $name\nCompany: $company\nEmail: $email\nMessage: $message";


        $email_sent = wp_mail( $to, $subject, $email_content, $headers );

        if ( $email_sent ) {
            $array_result = array(
                'type' => 'success',
                'message' => 'Email sent successfully!',
            );
        } else {
            $array_result = array(
                'type' => 'error',
                'message' => 'Failed to send email.',
            );
        }

    } else {

        $array_result = array(
            'type' => 'error',
            'message' => 'Invalid nonce or form data.',
        );
    }

    wp_send_json( $array_result );
}
