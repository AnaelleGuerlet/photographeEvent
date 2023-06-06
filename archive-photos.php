<?php
/*
Template Name: Photos
*/

/*début : création des filtres pour la page archive*/
get_header(); ?>
<div class="archivePhotos__filtres">
    <form action="#" method="GET">
    <select name="categorie" id="selection_categorie">
        <option value="">CATEGORIE</option>
        <option value="reception">Réception</option>
        <option value="television">Télévision</option>
        <option value="concert">Concert</option>
        <option value="mariage">Mariage</option>
    </select>
    <select name="format" id="selection_format">
        <option value="">FORMATS</option>
        <option value="paysage">Paysage</option>
        <option value="portrait">Portrait</option>
    </select>
    <button type="submit">envoyer</button>

    <select name="trier" id="seclection_trier"></select>
        <option value=""></option>
</form>
</div>
<!--fin : création des filtres pour la page archive-->

<!-- je définis ce que je veux -->
<?php $filtres = array( 'post_type' => 'Photos', 'posts_per_page' => 3, 'paged' => $paged);
/*début : vérification du filtre format*/
    if (isset ($_GET ['format']))
    {
        $filtres ['format']=$_GET['format'];
    }
?>
<!--fin : vérification du filtre format-->

<!--je fais la demande des informations que je souhaite a wp que je stock dans une réponse(variable)-->
<?php $reponse = new WP_Query( $filtres ); ?>

<!--parcourir les informations ($reponse) et les affiche-->
<?php while ( $reponse->have_posts() ) : $reponse->the_post(); ?>

<!--début : l'ensemble des photos de la page-->
<div class="archivePhotos__photos">
    <?php 
        get_template_part( 
            'template-parts/content/content', 
            get_theme_mod('display_excerpt_or_full_post', 'excerpt' ) 
        ); 
    ?>
</div>
<!--fin : l'ensemble des photos de la page-->

 <div class="entry-content">
 <?php the_content() ; ?>
 </div>

 <?php endwhile ; ?>
<?php get_footer(); ?>