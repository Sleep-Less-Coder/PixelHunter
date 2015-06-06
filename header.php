<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package PixelHunter
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<!--<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'pixelhunter' ); ?></a> -->

	<header id="masthead" class="site-header" role="banner">
		<div class="backdrop">
			<div class="site-branding">
				
				<!--If there is a site logo then display it otherwise display the blog name and discription -->
				
				<?php
					$pixel_hunter_logo = esc_url(get_theme_mod('pixel_hunter_image_logo_upload'));
					
					if ( $pixel_hunter_logo ) { ?> 
 						
 						<a href="<?php echo esc_url(home_url());?>"><span class="custom-logo"><img src="<?php echo esc_url($pixel_hunter_logo); ?>" title="<?php bloginfo('title');?>"></span></a>
						
						<?php }else{ ?>
						
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>

				<?php } ?>

			</div>

			<!--  icons on right for search and sidebar -->
			<div class="right-icons">
				<i class="fa fa-search" id="search-icon"></i>
				<i class="fa fa-arrow-left" id="sidebar-icon"></i>
			</div>

			<!-- search box -->
			<div class="search-box">
				<?php get_search_form(); ?>
			</div>
			
			<!-- main navigation -->
			<nav id="site-navigation" role="navigation">	
				<div class="sidebar">
					<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
				</div>
				<span class="toggle"><i class="fa fa-bars"></i></span>
			</nav><!-- #site-navigation -->
		</div><!-- backdrop -->

	</header><!-- #masthead -->

	<!-- button for scrolling to the top -->
	<span class="scroll-top"></span>
	
	<div class="spacer"></div>
	<div id="content" class="site-content">
