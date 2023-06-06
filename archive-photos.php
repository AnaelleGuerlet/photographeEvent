<?php
/*
Template Name: Photos
*/


get_header(); ?>
<header id="archive_header" class="archive__header">
<img class="archive__header--hero" src="wp-content/themes/photographeEvent/assets/header_images/nathalie-<?php echo(rand(0,15));?>.jpeg"/>
    <h1>PHOTOGRAPHE EVENT</h1>
</header>

<main class="archive__body">
<!--début : création des filtres pour la page archive-->
        <form class="archive__body__filtres" action="#" method="GET">
            <select class="archive__body__filtres__selection archive__filtres__selection--date" name="categorie" id="selection_categorie">
                <option selected>CATEGORIE</option>
                <option value="reception">Réception</option>
                <option value="television">Télévision</option>
                <option value="concert">Concert</option>
                <option value="mariage">Mariage</option>
            </select>
        
            <select class="archive__body__filtres__selection archive__filtres__selection--date" name="format" id="selection_format">
                <option value="">FORMATS</option>
                <option value="paysage">Paysage</option>
                <option value="portrait">Portrait</option>
            </select>

            <select class="archive__body__filtres__selection archive__filtres__selection--date" name="date" id="seclection_date">
                <option value="">TRIER PAR</option>
                <option value="recentes">Des plus récentes aux plus anciennes</option>
                <option value="anciennes">Des plus anciennes aux plus récentes</option>
            </select>

            <button type="submit">envoyer</button>
        </form>
<!--fin : création des filtres pour la page archive-->

<!-- je définis ce que je veux -->
    <?php $filtres = array( 'post_type' => 'Photos', 'posts_per_page' => 12, 'paged' => $paged);
/*début : vérification du filtre format*/
    if (isset ($_GET ['format']))
    {
        $filtres ['format']=$_GET['format'];
    }
    if (isset ($_GET ['categorie']))
    {
        $filtres ['categorie']=$_GET['categorie'];
    }
    if (isset ($_GET ['date']))
    {
        $filtres ['date']=$_GET['date'];
    }
    ?>
    <!--fin : vérification du filtre format-->

    <!--je fais la demande des informations que je souhaite a wp que je stock dans une réponse(variable)-->
    <?php $reponse = new WP_Query( $filtres ); ?>

    <div class="archive__body__photos">
        <!--parcourir les informations ($reponse) et les affiche-->
        <?php while ( $reponse->have_posts() ) : $reponse->the_post(); ?>
        <!--début : l'ensemble des photos de la page-->
        <?php get_template_part('template-parts/content/content', get_theme_mod('display_excerpt_or_full_post', 'excerpt' ));?>
        <!--fin : l'ensemble des photos de la page-->
        <!--nextpage-->
        <?php endwhile; ?>
    </div>
</main>


<?php get_footer(); ?>