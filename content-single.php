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
				'before' => '<div class="page-links">' . __( 'Pages:', 'pixelhunter' ),
				'after'  => '</div>',
			) );
		?>

		<!-- showing the tags for the post (if there are any) -->
		<?php 
			$tags = get_the_tag_list();
			if(!empty($tags)){ ?>
				<p class="post-tags">
					<i class="fa fa-tags"></i><?php echo get_the_tag_list('',', ','');?>
				</p>
			<?php 
			}
		?>
		
		<!-- Author meta box (Description of the post author with social links -->
		<?php if(!esc_html(get_theme_mod('pixel_hunter_author_bio')) == 1){ ?>
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
						<?php _e('It seems like this author has no description. Add your discription/bio at user profile or disable this widget in theme customizer if you dont want to use it.', 'pixelhunter'); ?>
					</p>
				<?php } ?>
			</div><!-- author-info -->
		</div><!-- author-bio -->
		<?php } ?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
