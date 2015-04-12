<?php
/**
 * PixelHunter functions and definitions
 *
 * @package PixelHunter
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'pixel_hunter_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function pixel_hunter_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on PixelHunter, use a find and replace
	 * to change 'pixel_hunter' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'pixel_hunter', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// Thumbnail size
	add_image_size('post-thumb',400,225,true);

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'pixel_hunter' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'pixel_hunter_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // pixel_hunter_setup
add_action( 'after_setup_theme', 'pixel_hunter_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function pixel_hunter_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'pixel_hunter' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'pixel_hunter_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function pixel_hunter_scripts() {
	wp_enqueue_style( 'pixel_hunter-style', get_template_directory_uri() . '/sass/main.css' );

	wp_enqueue_script( 'pixel_hunter-functions', get_template_directory_uri() . '/js/functions.js', array('jquery'), '20120206', true );

	wp_enqueue_script( 'pixel_hunter-post-animations', get_template_directory_uri() . '/js/posts-scroll-animations.js', array('jquery'), '20140111', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'pixel_hunter_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 *removin [..] from the excerpt.
 */
function pixel_hunter_excerpt_more($more){
	return '...';
}
add_filter('excerpt_more','pixel_hunter_excerpt_more');

/**
 * Adding editor style for better user experience
 */
function pixel_hunter_add_editor_styles() {
    add_editor_style(get_template_directory_uri() . '/sass/main.css');
}
add_action( 'init', 'pixel_hunter_add_editor_styles' );

/**
 * Shifting down the absolutely positioned icons when admin bar is showing
 */
function pixel_hunter_shift_icons(){
	if(is_admin_bar_showing()){
		echo '<style type="text/css">
		.toggle, .right-icons{top: 25px !important;}
		.widget-area{padding-top: 45px;}
		.sidebar{padding-top: 28px;}

		@media screen and(max-width: 782px){
			.toggle, .right-icons{top: 40px !important;}
			.widget-area{padding-top: 65px;}
			.sidebar{padding-top: 48px;}
		}
		</style>';
	}
}
add_action('wp_head','pixel_hunter_shift_icons');

/**
 * Different Styles on different pages
 */
function pixel_hunter_conditional_styles(){

	// If page is a archive page

	if(is_archive()){
		echo '<style>h1.page-title{opacity: 0.8; font-family: Open Sans} h1.page-title:before{content: "\f187"; font-family: FontAwesome}</style>';
	}

	//If page is a search page

	if( is_search() ) {
	echo '<style>h1.page-title{opacity: 0.8; font-family: Open Sans} h1.page-title:before{content:"\f002"; font-family: FontAwesome; margin: -5px 10px 0 0;}</style>';
	}

	//If page is a single post page

	if(is_single()){
	echo "<style>.site-content .post-info{margin-bottom: 55px !important;}.content-area .entry-content p:first-child:first-letter{float: left;color: #2E2D33;font-size: 75px;line-height: 60px;padding: 4px 8px 0 3px;}</style>";
	}
}
add_action('wp_head','pixel_hunter_conditional_styles');

/**
 * Adding the options to add different social media for author bio
 */
function pixel_hunter_add_to_author_profile( $contactmethods ) {

	$contactmethods['rss_url'] = 'RSS URL';
	$contactmethods['google_profile'] = 'Google Profile URL';
	$contactmethods['twitter_profile'] = 'Twitter Profile URL';
	$contactmethods['facebook_profile'] = 'Facebook Profile URL';
	$contactmethods['linkedin_profile'] = 'Linkedin Profile URL';

	return $contactmethods;
}
add_filter( 'user_contactmethods', 'pixel_hunter_add_to_author_profile', 10, 1);

/**
 * Removing hard coding of height and width on post-thumbnail
 */
function pixel_hunter_remove_img_attr ($html) {
    return preg_replace('/(width|height)="\d+"\s/', "", $html);
}

add_filter( 'post_thumbnail_html', 'pixel_hunter_remove_img_attr' );

/**
 * Throw the settings from Customier to the <head>
 */
function pixel_hunter_customizer(){

	//custom header background
	$header_background = get_theme_mod('pixel_hunter_header_background_upload');

	if(!empty($header_background))
		echo "<style>
				.site-header{
					background: url('". $header_background ."') no-repeat center center;
					background-size: cover
				}
			 </style>";

	//primary theme color
	$primary_theme_color = get_theme_mod('pixel_hunter_primary_theme_color');

	if(!empty($primary_theme_color))

	//every element using primary theme color has to be affected

	echo "<style>
		 .backdrop{
		 	background-color: rgba(" . pixel_hunter_hex2rgb($primary_theme_color) .",0.7);
		 }

		 .sidebar li:hover, .site-footer{
		 	background-color: $primary_theme_color;
		 }

		 a, a:hover, a:focus, .menu-color, #comments .comment-awaiting-moderation{
		 	color: $primary_theme_color;
		 }

		 .scroll-top{
		 	border-bottom: 25px solid $primary_theme_color;
		 }

		 .post .btn-read-more a:hover, .no-results .go-home-btn:hover, .error-404 .go-home-btn:hover{
		 	background-color: $primary_theme_color !important;
		 	border-color: $primary_theme_color !important;
		 }

		</style>";

	//secondary color
	$secondary_theme_color = get_theme_mod('pixel_hunter_secondary_theme_color');

	if (!empty($secondary_theme_color)){

		//every element secondary theme color has to be affected

		echo "<style>
			.sidebar, .nav-previous, .nav-next, .widget-area{
				background-color: $secondary_theme_color;
			}

			.no-results .go-home-btn, .error-404 .go-home-btn{
				border: 1px solid $secondary_theme_color !important;
			}

			.comments-title:before , .comment-reply-title:before{
				background-color: $secondary_theme_color !important;
			}

			.form-submit #submit, .form-submit #submit:hover{
				background-color: $secondary_theme_color !important;
			}

			input[type='text']:focus, input[type='email']:focus, input[type='url']:focus, textarea:focus{
				border: 1px solid $secondary_theme_color !important;
			}

		</style>";
	}
}
add_action('wp_head','pixel_hunter_customizer');