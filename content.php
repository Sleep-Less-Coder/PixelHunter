<?php
/**
 * @package PixelHunter
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<!-- sticky icon for sticky posts -->
	<?php if(is_sticky()): ?>
		<i class="fa fa-thumb-tack sticky fa-2x" title="Sticky Post"></i>
	<?php endif; ?>

	<div class="post-content-wrapper">
		<?php if(has_post_thumbnail()): ?>
			<div class="post-thumbnail">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('post-thumb'); ?></a>
			</div>
		<?php endif; ?>

		<div class="post-content">
			<header class="entry-header">
				<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
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
									$output .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s", "pixel_hunter"), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
								}
							echo trim($output, $separator);
							}
						?>
					</span>
				</span>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php the_excerpt(); ?>
				<div class="btn-read-more">
						<a href="<?php the_permalink(); ?>"><?php _e('Continue Reading', 'pixelhunter'); ?></a>
				</div>
			</div><!-- .entry-content -->

			<footer class="entry-footer">
				<!--<?php pixel_hunter_entry_footer(); ?> -->
			</footer><!-- .entry-footer -->
		</div><!-- post-content -->
	</div><!-- post-content-wrapper -->
</article><!-- #post-## -->