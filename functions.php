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
	 * to change 'pixelhunter' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'pixelhunter', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'title-tag' );

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
		'primary' => __( 'Primary Menu', 'pixelhunter' ),
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
		'name'          => __( 'Sidebar', 'pixelhunter' ),
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

	//loading only if animations are not disabled

	if(!esc_html(get_theme_mod('pixel_hunter_postanimation')) == 1)
	{
		wp_enqueue_script( 'pixel_hunter-post-animations', get_template_directory_uri() . '/js/posts-scroll-animations.js', array('jquery'), '20140111', true );
	}

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
	echo "<style>.site-content .post-info{margin-bottom: 55px !important;}</style>";

		$dropcaps = esc_html(get_theme_mod('pixel_hunter_dropcaps'));

		if(!$dropcaps == 1)
		{
			echo "<style>.content-area .entry-content p:first-child:first-letter{float: left;color: #2E2D33;font-size: 75px;line-height: 60px;padding: 4px 8px 0 3px;}</style>";
		}
	}
}
add_action('wp_head','pixel_hunter_conditional_styles');

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
	$header_background = esc_url(get_theme_mod('pixel_hunter_header_background_upload'));

	//only solid fill
	$header_type = esc_html(get_theme_mod('pixel_hunter_header_color'));

	//primary theme color
	$primary_theme_color = esc_html(get_theme_mod('pixel_hunter_primary_theme_color'));

	//secondary color
	$secondary_theme_color = esc_html(get_theme_mod('pixel_hunter_secondary_theme_color'));

	//header-sidebar text color
	$hs_text_color = esc_html(get_theme_mod('pixel_hunter_hs_text_color'));

	//header rgba filter
	$header_filter = esc_html(get_theme_mod('pixel_hunter_headerfilter'));

	//Giving the user the option to always show the navigation menu. Instead of being off canvas
	$nav_menu_always_show = esc_html(get_theme_mod('pixel_hunter_nav_menu'));

	//if solid fill is not checked we show a default background. If user has set his/her background
	//we show it

	if(!$header_type == 1){
		echo "<style>
			.site-header{
				background: url('" . get_template_directory_uri() . "/img/background.jpg') no-repeat center center;
				background-size: cover;
			}
		</style>";

		if(!empty($header_background)){
			echo "<style>
					.site-header{
						background: url('". $header_background ."') no-repeat center center;
						background-size: cover;
					}
				 </style>";
		}
	}
	else
	{
		// we change the rgba filter to solid color on backdrop so the color is exactly the user selected
		echo "<style>
		.backdrop{
			background-color: " . $primary_theme_color ." !important;
		}
		</style>";
	}

	

	if(!empty($primary_theme_color)){

	//every element using primary theme color has to be affected

	echo "<style>

		 .sidebar li:hover, .site-footer{
		 	background-color: $primary_theme_color;
		 }

		 a, a:hover, a:focus, .menu-color, #comments .comment-awaiting-moderation{
		 	color: $primary_theme_color;
		 }

		 .scroll-top{
		 	border-bottom: 25px solid $primary_theme_color;
		 	opacity: 0.5;
		 }

		 .post .btn-read-more a:hover, .no-results .go-home-btn:hover, .error-404 .go-home-btn:hover{
		 	background-color: $primary_theme_color !important;
		 	border-color: $primary_theme_color !important;
		 }

		</style>";
	}

	if (!empty($secondary_theme_color)){

		//every element using secondary theme color has to be affected

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

	if(!empty($hs_text_color))
	{
		//updating the text color of header/sidebar elements
		echo "
			<style>
				.site-header,
				.site-header .site-branding .site-title a,
				.site-header .site-branding .site-description,
				.toggle,
				.widget-area aside h1,
				.sidebar a,
				.widget-area,
				.widget-area aside ul li a,
				.widget-area .social a,
				.site-footer,
				.site-footer .site-info a{
					color: " . $hs_text_color . ";
				}
				
				.sidebar a{
					opacity: 0.8;
				}

				.sidebar a:hover{
					color: " . $hs_text_color . ";
					opacity: 1;
				}

				.site-header .search-box button{
					background-color: " . $hs_text_color . ";
				}

				.widget_recent_entries ul li:hover, .random-posts-widget ul li:hover{
					border: 1px solid " . $hs_text_color . "!important;
					border-left: 5px solid " . $hs_text_color . "!important;	
				}

				.widget-area .recentcomments a,
				.widget-area aside ul li a:hover{
					border-bottom: 1px dotted " . $hs_text_color . ";
				}

				.menu-color{
					color: " . $primary_theme_color . "
				}
			</style>
		";
	}

	// Remove header rgba filter if user doesn't want it. (Enabled by default)
	if(!$header_filter == 1)
	{
		if(!empty($primary_theme_color))
		{
			echo "
				<style>
					.backdrop{
					 	background-color: rgba(" . pixel_hunter_hex2rgb($primary_theme_color) .",0.7);
					 }
				</style>
			";
		}
		else
		{
			echo "
				<style>
					.backdrop{
					 	background-color: rgba(45, 142, 89, 0.7);
					 }
				</style>
			";
		}
	}

	//If user is not using the WP title and desc and using his/her own image only for header, we
	//set header height to at least 272px to make header look consistent(prevent it from colappsing).
	$blogname = get_bloginfo('name');
	$blogdesc= get_bloginfo('description');

	if(empty($blogname) && empty($blogdesc))
	{
		echo "
			<style>
				.site-header{
					height: 272px;
				}
				.backdrop{
					height: 100%;
				}
			</style>
		";
	}

	if($nav_menu_always_show == 1)
	{
		// we use viewport() JS function to identify the width of the user and then execute code
		// accordingly. Mobile will be same. We always show the menu only if width is greater than 650px

		echo "<script>

			function viewport() {
				var e = window, a = 'inner';
				if (!('innerWidth' in window )) {
				a = 'client';
				e = document.documentElement || document.body;
				}
				return { width : e[ a+'Width' ] , height : e[ a+'Height' ] };
			}

			jQuery(document).ready(function(){
				if (viewport().width >= 650) {
					jQuery('.sidebar').addClass('sidebar-is-displayed');
					jQuery('.toggle').remove();
				}
			});
		</script>";

		echo "<style>
			@media screen and (min-width: 650px){
				.sidebar{
					box-shadow: none;
				}
				
				.site-header{
					padding-left: 250px;
				}

				.site-content{
					max-width: 1140px;
					padding-left: 250px;
				}
				
				.site-footer{
					padding-left: 250px;
				}

				.site-footer .site-info{
					margin-left: 0;
				}
			}

			@media screen and (max-width: 1168px){
				.site-content .post, .site-content .page{
					margin-left: 10px !important;
					margin-right: 10px !important;
				}

				#comments, h1.page-title{
					padding: 0 10px 0 10px;
				}
			}
		</style>";
	}
}
add_action('wp_head','pixel_hunter_customizer');