<?php
/**
 * 	The Template name: Page pour une photo
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="pagePhoto__description">
		<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
		<?php the_terms( $post->ID, 'categorie', 'Catégoie : ' ); ?><br>
		<?php the_terms( $post->ID, 'format', 'Format : ' ); ?><br>
		Référence : <?php the_field( 'reference' ); ?><br>
		Type : <?php the_field( 'type' ); ?>
	</div>

	<div class="pagePhoto__photo">
		<?php twenty_twenty_one_post_thumbnail(); ?>
	</div>
	

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before'   => '<nav class="page-links" aria-label="' . esc_attr__( 'Page', 'twentytwentyone' ) . '">',
				'after'    => '</nav>',
				/* translators: %: Page number. */
				'pagelink' => esc_html__( 'Page %', 'twentytwentyone' ),
			)
		);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer default-max-width">
		<?php twenty_twenty_one_entry_meta_footer(); ?>
	</footer><!-- .entry-footer -->

	<?php if ( ! is_singular( 'attachment' ) ) : ?>
		<?php get_template_part( 'template-parts/post/author-bio' ); ?>
	<?php endif; ?>

	</article><!-- #post-<?php the_ID(); ?> -->
