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
				<p>
					Référence : <?php the_field( 'reference' ); ?><br>
					<?php the_terms( $post->ID, 'categorie', 'Catégorie : ' ); ?><br>
					<?php the_terms( $post->ID, 'format', 'Format : ' ); ?><br>
					Type : <?php the_field( 'type' ); ?><br>
					Année : <?php the_field( 'annee' ); ?>
				</p>
			</div>

			<div class="article__partie1__descriptionPhoto__photo">
				<?php 
					echo '<div class="overlay">';	
						twenty_twenty_one_post_thumbnail(); 
						include('wp-content/themes/photographeEvent/overlay.php');
					echo '</div>';
					?>
			</div>
		</div>
		<div class="article__partie1__interaction">
			<div class="article__partie1__interaction__contact">
				<p>Cette photo vous interresse ?</p> 
				<button id="article__partie1__interaction__contact--bouton" href="#" onclick="monModale()">
					Contact
				</button>
			</div>
			
			<div class="article__partie1__interaction__pagination">
				<div class="article__partie1__interaction__pagination--precedent">
					<?php 
						$articlePrecedent = get_previous_post();
						if($articlePrecedent!=null)
						{
							echo '<a href="'.esc_url( get_permalink($articlePrecedent->ID) ) .'">'; 
							$miniaturePrecendent = wp_get_attachment_image_src( get_post_thumbnail_id($articlePrecedent->ID), 'thumbnail');
							echo '<img class="article__partie1__interaction__pagination--precedent--miniaturePagination" src="'.$miniaturePrecendent[0].'"/>';
							echo'</br>';
							echo '<img src="'.get_stylesheet_directory_uri().'/assets/flechePrecedent.png"/>';
							echo '</a>';
						}
					?>
				</div>
				
				<div class="article__partie1__interaction__pagination--suivant">
					<?php
						$articleSuivant = get_next_post();
						if($articleSuivant!=null)
						{
							echo '<a href="'.esc_url( get_permalink($articleSuivant->ID) ) .'">'; 
							$miniatureSuivant = wp_get_attachment_image_src( get_post_thumbnail_id($articleSuivant->ID), 'thumbnail'); 
							echo '<img class="article__partie1__interaction__pagination--suivant--miniaturePagination" src="'.$miniatureSuivant[0].'"/>';
							echo'</br>';
							echo '<img src="'.get_stylesheet_directory_uri().'/assets/flecheSuivant.png"/>';
							echo '</a>';
						}
					?>
				</div>
			</div>
		</div>
	</div>

	<div class="article__partie2">
		<h3>Vous aimerez aussi</h3>
		<div class="article__partie2__photosSimilaires">
				<?php 
				//je récupère l'article en cours
				$articleEnCours = get_post();
				//je recupère la catégorie de l'article en cours
				$categorieArticle = wp_get_post_terms( $articleEnCours->ID, 'categorie');
				//je récupère le lien (url) de la catégorie
				$lienCategorie = get_category_link($categorieArticle);

				//je créer un filtre qui contient les critères que je souhaite
				$filtreCategories =
				[
					'post_type' => 'Photos',
					'categorie'=> $categorieArticle[0]->name,
					'post_per_page'=> 12,
					'paged' => $paged,
				];

				//j'interroge wp sur mes critères, wp répond ($reponse)
				$reponse = new WP_Query( $filtreCategories );

				//je fais une boucle pour parcourir tous les articles 
				while ( $reponse->have_posts() ) :

					$reponse->the_post();
					$article = get_post();

					if ($articleEnCours->ID != $article->ID)
					{
						echo '<div class="overlay">';
						//j'affiche les liens des post
						echo '<a href="'.esc_url( get_permalink() ) .'.svg">';
						//je récupère l'image a la une 
						$image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'large');
						//j'affiche l'image a la une 
						echo '<img class="article__partie2__photosSimilaires--miniatures" src="'.$image[0].'"/>';
						echo '</a>';
						include('wp-content/themes/photographeEvent/overlay.php');
						echo '</div>';
					}
				endwhile; 
				
			?>
		</div>
	</div>
</article>



