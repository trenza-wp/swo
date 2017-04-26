<?php get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <!-- <header class="entry-header">
                <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
            </header> --><!-- .entry-header -->
        	

            <div class="entry-content wrapper">
	            <?php if (has_post_thumbnail( $post->ID ) ): ?>
				  <?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' ); ?>
					<img src="<?php echo $url ?>" />
				<?php endif; ?>
                <?php the_content(); ?>
            </div><!-- .entry-content -->
        
        </article><!-- #post-## -->
            

        <?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}

			// End of the loop.
		endwhile;
		?>

	</main><!-- .site-main -->
	<?php get_sidebar( ); ?>

</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
