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
		'title' => __('Upload your images.','pixelhunter'),
		'description' => __('In this section you can upload your logo and header background.','pixelhunter')
	));
	$wp_customize->add_setting('pixel_hunter_image_logo_upload',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'pixel_hunter_image_logo_upload',array(
        'label' => __('Logo Upload','pixelhunter'),
        'section' => 'pixel_hunter_image_uploads',
        'settings' => 'pixel_hunter_image_logo_upload'
	)));

	//Header only background section
	$wp_customize->add_setting('pixel_hunter_header_background_upload',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'pixel_hunter_header_background_upload',array(
        'label' => __('Header Background Image Upload','pixelhunter'),
        'section' => 'pixel_hunter_image_uploads',
        'settings' => 'pixel_hunter_header_background_upload'
	)));

	//Giving users the ability to change main theme colors
	$wp_customize->add_section('pixel_hunter_customize_styles',array(
		'title' => __('Customize theme styles','pixelhunter'),
		'description' => __('In this section you can change the theme colors to instantly change the color scheme to your liking and various other customizations.','pixelhunter')
	));

	//primary color
	$wp_customize->add_setting('pixel_hunter_primary_theme_color',array(
		'default' => '#2D8E59',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'pixel_hunter_primary_theme_color',array(
		'label' => __('Change the primary theme color.','pixelhunter'),
		'section' => 'pixel_hunter_customize_styles',
		'settings' => 'pixel_hunter_primary_theme_color'
	)));

	//secondary color
	$wp_customize->add_setting('pixel_hunter_secondary_theme_color',array(
		'default' => '#324353',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'pixel_hunter_secondary_theme_color',array(
        'label' => __('Change the Secondary theme color.','pixelhunter'),
        'section' => 'pixel_hunter_customize_styles',
        'settings' => 'pixel_hunter_secondary_theme_color'
	)));

	//Header/Sidebar text color
	$wp_customize->add_setting('pixel_hunter_hs_text_color',array(
		'default' => '#FFF0FF',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'pixel_hunter_hs_text_color',array(
        'label' => __('Change the header/sidebar text color.','pixelhunter'),
        'section' => 'pixel_hunter_customize_styles',
        'settings' => 'pixel_hunter_hs_text_color'
	)));

	//always show the nav menu (or not)
	$wp_customize->add_setting('pixel_hunter_nav_menu',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_key'
	));
	$wp_customize->add_control('pixel_hunter_nav_menu',array(
        'label' => __('Always show the navigation menu.','pixelhunter'),
        'section' => 'pixel_hunter_customize_styles',
        'settings' => 'pixel_hunter_nav_menu',
        'type' => 'checkbox'
	));

	//Use solid fill no background
	$wp_customize->add_setting('pixel_hunter_header_color',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_key'
	));
	$wp_customize->add_control('pixel_hunter_header_color',array(
        'label' => __('No background on header. Only solid fill.','pixelhunter'),
        'section' => 'pixel_hunter_customize_styles',
        'settings' => 'pixel_hunter_header_color',
        'type' => 'checkbox'
	));

	//social media section
	$wp_customize->add_section('pixel_hunter_social_urls',array(
		'title' => __('Social Media Links','pixelhunter'),
		'description' => __('Enter the URLs of the respective social media.','pixelhunter')
	));

	//facebook
	$wp_customize->add_setting('pixel_hunter_facebook_url',array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw'
	));
	$wp_customize->add_control('pixel_hunter_facebook_url',array(
		'label' => __('Enter your Facebook URL','pixelhunter'),
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
		'label' => __('Enter your Google Plus URL','pixelhunter'),
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
		'label' => __('Enter your Twitter URL','pixelhunter'),
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
		'label' => __('Enter your YouTube URL','pixelhunter'),
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
		'label' => __('Enter your Pinterest URL','pixelhunter'),
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
		'label' => __('Enter your Instagram URL','pixelhunter'),
		'section' => 'pixel_hunter_social_urls',
		'settings' => 'pixel_hunter_instagram_url',
		'type' => 'text'
	));

	//Giving users ability to disable features
	$wp_customize->add_section('pixel_hunter_disable_features',array(
		'title' => __('Disable Features','pixelhunter'),
		'description' => __('Here you can disable the theme features if you dont like','pixelhunter')
	));

	//giving the user the ability to disable the author bio widget
	$wp_customize->add_setting('pixel_hunter_author_bio',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_key'
	));
	$wp_customize->add_control('pixel_hunter_author_bio',array(
        'label' => __('Disable the author information at the end of post.','pixelhunter'),
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
        'label' => __('Disable the random posts widget.','pixelhunter'),
        'section' => 'pixel_hunter_disable_features',
        'settings' => 'pixel_hunter_random_posts',
        'type' => 'checkbox'
	));

	//giving the user the ability to disable the drop caps on posts
	$wp_customize->add_setting('pixel_hunter_dropcaps',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_key'
	));
	$wp_customize->add_control('pixel_hunter_dropcaps',array(
        'label' => __('Disable the drop caps on posts','pixelhunter'),
        'section' => 'pixel_hunter_disable_features',
        'settings' => 'pixel_hunter_dropcaps',
        'type' => 'checkbox'
	));

	//giving the user the ability to disable the backdrop filter on the header
	$wp_customize->add_setting('pixel_hunter_headerfilter',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_key'
	));
	$wp_customize->add_control('pixel_hunter_headerfilter',array(
        'label' => __('Disable the header backdrop filter.','pixelhunter'),
        'section' => 'pixel_hunter_disable_features',
        'settings' => 'pixel_hunter_headerfilter',
        'type' => 'checkbox'
	));

	//giving the user the ability to disable the posts animations when scrolling 
	$wp_customize->add_setting('pixel_hunter_postanimation',array(
		'default' => '',
		'sanitize_callback' => 'sanitize_key'
	));
	$wp_customize->add_control('pixel_hunter_headerfilter',array(
        'label' => __('Disable the animations when scrolling the posts.','pixelhunter'),
        'section' => 'pixel_hunter_disable_features',
        'settings' => 'pixel_hunter_postanimation',
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