<?php
/**
 * 	The Template name: Page pour une photo
 */

?>
<article class="article" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="article__partie1">
		<div class="article__partie1__descriptionPhoto">
			<div class="article__partie1__descriptionPhoto__description">
				<?php the_title( '<h2 class="article__partie1__descriptionPhoto__description--titre">', '</h2>' ); ?>
				<p>Référence : <?php the_field( 'reference' ); ?><br>
				<?php the_terms( $post->ID, 'categorie', 'Catégoie : ' ); ?><br>
				<?php the_terms( $post->ID, 'format', 'Format : ' ); ?><br>
				Type : <?php the_field( 'type' ); ?><br>
				Année : <?php the_field( 'annee' ); ?></p>
			</div>

			<div class="article__partie1__descriptionPhoto__photo">
				<?php twenty_twenty_one_post_thumbnail(); ?>
			</div>
		</div>

		<div class="article__partie1__interaction">
			<div class="article__partie1__interaction__contact">
				<p>Cette photo vous interresse ?</p> 
				<button>
					<a href="#" onclick="monModale()">Contact</a>
				</button>
			</div>
			
			<div class="article__partie1__interaction__pagination">
				<?php 

				$articlePrecedent = get_previous_post();
				if($articlePrecedent!=null)
				{
					$miniaturePrecendent = get_the_post_thumbnail( $articlePrecedent->ID );
					previous_post_link( '%link', $miniaturePrecendent, '' );
				}

				$articleSuivant = get_next_post();
				if($articleSuivant!=null)
				{
				$miniatureSuivant = get_the_post_thumbnail( $articleSuivant->ID );
				next_post_link( '%link', $miniatureSuivant, 'arrow' );
				}
			?>
			</div>
			
		</div>
	</div>
</article>