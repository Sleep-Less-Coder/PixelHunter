<?php
/**
 * PixelHunter Theme Customizer
 *
 * @package PixelHunter
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function pixel_hunter_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	//logo upload section
	$wp_customize->add_section('pixel_hunter_image_uploads',array(
		'title' => __('Upload your images.','pixel_hunter'),
		'description' => 'In this section you can upload your logo and header background.'
	));
	$wp_customize->add_setting('pixel_hunter_image_logo_upload',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'pixel_hunter_image_logo_upload',array(
        'label' => 'Logo Upload',
        'section' => 'pixel_hunter_image_uploads',
        'settings' => 'pixel_hunter_image_logo_upload'
	)));

	//Header only background section
	$wp_customize->add_setting('pixel_hunter_header_background_upload',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'pixel_hunter_header_background_upload',array(
        'label' => 'Header Background Image Upload',
        'section' => 'pixel_hunter_image_uploads',
        'settings' => 'pixel_hunter_header_background_upload'
	)));

	//Giving users the ability to change main theme colors
	$wp_customize->add_section('pixel_hunter_main_theme_colors',array(
		'title' => __('Change color scheme of the theme','pixel_hunter'),
		'description' => 'In this section you can change the theme colors to instantly change the color scheme to your liking.'
	));

	//primary color
	$wp_customize->add_setting('pixel_hunter_primary_theme_color',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'pixel_hunter_primary_theme_color',array(
		'label' => __('Change the primary theme color.','pixel_hunter'),
		'section' => 'pixel_hunter_main_theme_colors',
		'settings' => 'pixel_hunter_primary_theme_color'
	)));

	//secondary color
	$wp_customize->add_setting('pixel_hunter_secondary_theme_color',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'pixel_hunter_secondary_theme_color',array(
        'label' => 'Change the Secondary theme color.',
        'section' => 'pixel_hunter_main_theme_colors',
        'settings' => 'pixel_hunter_secondary_theme_color'
	)));
	
	//social media section
	$wp_customize->add_section('pixel_hunter_social_urls',array(
		'title' => __('Social Media Links','pixel_hunter'),
		'description' => 'Enter the URLs of the respective social media.'
	));

	//facebook
	$wp_customize->add_setting('pixel_hunter_facebook_url',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control('pixel_hunter_facebook_url',array(
		'label' => __('Enter your Facebook URL','pixel_hunter'),
		'section' => 'pixel_hunter_social_urls',
		'settings' => 'pixel_hunter_facebook_url',
		'type' => 'text'
	));
	
	//google-plus
	$wp_customize->add_setting('pixel_hunter_google_plus_url',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control('pixel_hunter_google_plus_url',array(
		'label' => __('Enter your Google Plus URL','pixel_hunter'),
		'section' => 'pixel_hunter_social_urls',
		'settings' => 'pixel_hunter_google_plus_url',
		'type' => 'text'
	));

	//twitter
	$wp_customize->add_setting('pixel_hunter_twitter_url',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control('pixel_hunter_twitter_url',array(
		'label' => __('Enter your Twitter URL','pixel_hunter'),
		'section' => 'pixel_hunter_social_urls',
		'settings' => 'pixel_hunter_twitter_url',
		'type' => 'text'
	));

	//YouTube
	$wp_customize->add_setting('pixel_hunter_youtube_url',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control('pixel_hunter_youtube_url',array(
		'label' => __('Enter your YouTube URL','pixel_hunter'),
		'section' => 'pixel_hunter_social_urls',
		'settings' => 'pixel_hunter_youtube_url',
		'type' => 'text'
	));

	//Pinterest
	$wp_customize->add_setting('pixel_hunter_pinterest_url',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control('pixel_hunter_pinterest_url',array(
		'label' => __('Enter your Pinterest URL','pixel_hunter'),
		'section' => 'pixel_hunter_social_urls',
		'settings' => 'pixel_hunter_pinterest_url',
		'type' => 'text'
	));

	//Instagram
	$wp_customize->add_setting('pixel_hunter_instagram_url',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control('pixel_hunter_instagram_url',array(
		'label' => __('Enter your Instagram URL','pixel_hunter'),
		'section' => 'pixel_hunter_social_urls',
		'settings' => 'pixel_hunter_instagram_url',
		'type' => 'text'
	));

	//Giving users ability to disable features
	$wp_customize->add_section('pixel_hunter_disable_features',array(
		'title' => __('Disable Features','pixel_hunter'),
		'description' => 'Here you can disable the theme features if you dont like'
	));

	//giving the user the ability to disable the author bio widget 
	$wp_customize->add_setting('pixel_hunter_author_bio',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_key'
	));
	$wp_customize->add_control('pixel_hunter_author_bio',array(
        'label' => 'Disable the author information at the end of post.',
        'section' => 'pixel_hunter_disable_features',
        'settings' => 'pixel_hunter_author_bio',
        'type' => 'checkbox'
	));

	//giving the user the ability to disable the Random Posts widget
	$wp_customize->add_setting('pixel_hunter_random_posts',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_key'
	));
	$wp_customize->add_control('pixel_hunter_random_posts',array(
        'label' => 'Disable the random posts widget.',
        'section' => 'pixel_hunter_disable_features',
        'settings' => 'pixel_hunter_random_posts',
        'type' => 'checkbox'
	));
}
add_action( 'customize_register', 'pixel_hunter_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function pixel_hunter_customize_preview_js() {
	wp_enqueue_script( 'pixel_hunter_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'pixel_hunter_customize_preview_js' );