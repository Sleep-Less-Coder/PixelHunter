<?php
/**
 * @package PixelHunter
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<span class="post-info">
				<span>
					<i class="fa fa-user"></i><?php echo get_the_author(); ?>
				</span>
				<span>
					<i class="fa fa-comments"></i><?php echo get_comments_number(); ?>
				</span>
				<span>
					<i class="fa fa-clock-o"></i><?php the_date(); ?>
				</span>
				<span>
					<i class="fa fa-folder"></i>
					<?php
						$categories = get_the_category();
						$separator = ', ';
						$output = '';
						if($categories){
							foreach($categories as $category) {
								$output .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s", "pixel_hunter" ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
							}
						echo trim($output, $separator);
						}
					?>
				</span>
			</span>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'pixel_hunter' ),
				'after'  => '</div>',
			) );
		?>

		<!-- Author meta box (Description of the post author with social links -->

		<?php if(!get_theme_mod('pixel_hunter_author_bio') == 1){ ?>
		<div class="author-bio">
			<div class="author-avatar">
				<?php echo get_avatar( get_the_author_meta('email'), '90' ); ?>
			</div>
			<div class="author-info">
				<h3 class="author-title">Article by <?php the_author_link(); ?></h3>

				<?php $author_desc = get_the_author_meta('description'); ?>

				<p class="author-description">
					<?php echo $author_desc ; ?>
				</p>

				<?php if(empty($author_desc)){ ?>
					<p style="color: indianred; font-style:italic">
						<?php __('It seems like this author has no description. Add your discription/bio at user profile or disable this widget in theme customizer if you dont want to use it.'); ?>
					</p>
				<?php } ?>

				<ul class="author-social-icons">
				<?php
					$rss_url = get_the_author_meta( 'rss_url' );
					if ( $rss_url && $rss_url != '' ) {
					echo '<li class="rss"><a href="' . esc_url($rss_url) . '"><i class="fa fa-rss"></i></a></li>';
				}

				$google_profile = get_the_author_meta( 'google_profile' );
					if ( $google_profile && $google_profile != '' ) {
					echo '<li class="google"><a href="' . esc_url($google_profile) . '" rel="author"><i class="fa fa-google-plus"></i></a></li>';
				}

				$twitter_profile = get_the_author_meta( 'twitter_profile' );
					if ( $twitter_profile && $twitter_profile != '' ) {
					echo '<li class="twitter"><a href="' . esc_url($twitter_profile) . '"><i class="fa fa-twitter"></i></a></li>';
				}

				$facebook_profile = get_the_author_meta( 'facebook_profile' );
					if ( $facebook_profile && $facebook_profile != '' ) {
					echo '<li class="facebook"><a href="' . esc_url($facebook_profile) . '"><i class="fa fa-facebook"></i></a></li>';
				}

				$linkedin_profile = get_the_author_meta( 'linkedin_profile' );
					if ( $linkedin_profile && $linkedin_profile != '' ) {
					echo '<li class="linkedin"><a href="' . esc_url($linkedin_profile) . '"><i class="fa fa-linkedin"></i></a></li>';
				}
				?>
				</ul><!-- author-social-icons -->
			</div><!-- author-info -->
		</div><!-- author-bio -->
		<?php } ?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
