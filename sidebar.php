<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package PixelHunter
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<div id="secondary" class="widget-area" role="complementary">
	<!-- Pulling the social icons from theme options only which are set -->
	<?php
		$pixel_hunter_facebook = get_theme_mod('pixel_hunter_facebook_url');
		$pixel_hunter_gplus = get_theme_mod('pixel_hunter_google_plus_url');
		$pixel_hunter_twitter = get_theme_mod('pixel_hunter_twitter_url');
		$pixel_hunter_youtube = get_theme_mod('pixel_hunter_youtube_url');
		$pixel_hunter_pinterest = get_theme_mod('pixel_hunter_pinterest_url');
		$pixel_hunter_instagram = get_theme_mod('pixel_hunter_instagram_url');
	?>

	<!-- if all are empty do nothing -->
	<?php if(empty($pixel_hunter_facebook) && empty($pixel_hunter_gplus) && empty($pixel_hunter_twitter) && empty($pixel_hunter_youtube) && empty($pixel_hunter_pinterest) && empty($pixel_hunter_instagram)){
	}else{
	?>

	<aside class="social">
	<h1><?php _e('Connect With Us', 'pixelhunter'); ?></h1>

	<?php if(!empty($pixel_hunter_facebook)){ ?>
		<a href="<?php echo esc_url($pixel_hunter_facebook); ?>" target=_blank>
			<span class="fa-stack fa-lg">
				<i class="fa fa-circle-thin fa-stack-2x"></i>
				<i class="fa fa-facebook fa-stack-1x"></i>
			</span>
		</a>
	<?php } ?>

	<?php if (!empty($pixel_hunter_gplus)) { ?>
		<a href="<?php echo esc_url($pixel_hunter_gplus); ?>" target=_blank>
			<span class="fa-stack fa-lg">
				<i class="fa fa-circle-thin fa-stack-2x"></i>
				<i class="fa fa-google-plus fa-stack-1x"></i>
			</span>
		</a>
	<?php } ?>

	<?php if (!empty($pixel_hunter_twitter)) { ?>
		<a href="<?php echo esc_url($pixel_hunter_twitter); ?>" target=_blank>
			<span class="fa-stack fa-lg">
				<i class="fa fa-circle-thin fa-stack-2x"></i>
				<i class="fa fa-twitter fa-stack-1x"></i>
			</span>
		</a>
	<?php } ?>

	<?php if (!empty($pixel_hunter_youtube)) { ?>
		<a href="<?php echo esc_url($pixel_hunter_youtube); ?>" target=_blank>
			<span class="fa-stack fa-lg">
				<i class="fa fa-circle-thin fa-stack-2x"></i>
				<i class="fa fa-youtube fa-stack-1x"></i>
			</span>
		</a>
	<?php } ?>

	<?php if (!empty($pixel_hunter_pinterest)) { ?>
		<a href="<?php echo esc_url($pixel_hunter_pinterest); ?>" target=_blank>
			<span class="fa-stack fa-lg">
				<i class="fa fa-circle-thin fa-stack-2x"></i>
				<i class="fa fa-pinterest fa-stack-1x"></i>
			</span>
		</a>
	<?php } ?>

	 <?php if (!empty($pixel_hunter_instagram)) { ?>
		<a href="<?php echo esc_url($pixel_hunter_instagram); ?>" target=_blank>
			<span class="fa-stack fa-lg">
				<i class="fa fa-circle-thin fa-stack-2x"></i>
				<i class="fa fa-instagram fa-stack-1x"></i>
			</span>
		</a>
	<?php } ?>

	 </aside>
	<?php } ?>

	<!-- Random Posts widget which displays 5 random posts -->
	<?php if(!esc_html(get_theme_mod('pixel_hunter_random_posts')) == 1){ ?>
		<aside class="random-posts-widget">
			<h1><?php _e('Random Posts', 'pixelhunter'); ?></h1>
			<ul>
				<?php
					$pixel_hunter_args = array('posts_per_page' => 5, 'orderby' => 'rand');
					$pixel_hunter_query = new WP_Query($pixel_hunter_args);
					while($pixel_hunter_query -> have_posts()) : $pixel_hunter_query -> the_post();
				?>
					<li><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>
				<?php
					endwhile;
					wp_reset_query();
				?>
			</ul>
		</aside>
	<?php } ?>

	<?php dynamic_sidebar( 'sidebar-1' ); ?>

</div><!-- #secondary -->
