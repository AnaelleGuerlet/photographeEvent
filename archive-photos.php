<?php
/*
Template Name: Photos
*/


get_header(); 
include(ABSPATH.'wp-content/themes/photographeEvent/overlay.php');
?>
<!--début : création du hero-->
<header id="archive_header" class="archive__header">
<img class="archive__header--hero" src="wp-content/themes/photographeEvent/assets/header_images/nathalie-<?php echo(rand(0,15));?>.jpeg"/>
    <h1>PHOTOGRAPHE EVENT</h1>
</header>
<!--fin : création du hero-->

<main class="archive__body">

<!--début : création des filtres pour la page archive-->
        <form class="archive__body__filtres" method="POST">
            <select class="archive__body__filtres__selection archive__filtres__selection--date" name="categorie" id="selection_categorie">
                <option selected value="0">CATEGORIE</option>
                <option value="reception">Réception</option>
                <option value="television">Télévision</option>
                <option value="concert">Concert</option>
                <option value="mariage">Mariage</option>
                
            </select>
        
            <select class="archive__body__filtres__selection archive__filtres__selection--date" name="format" id="selection_format">
                <option selected value="0">FORMATS</option>
                <option value="paysage">Paysage</option>
                <option value="portrait">Portrait</option>
            </select>

            <select class="archive__body__filtres__selection archive__filtres__selection--date" name="date" id="seclection_date">
                <option selected value="0">TRIER PAR</option>
                <option value="recentes">Des plus récentes aux plus anciennes</option>
                <option value="anciennes">Des plus anciennes aux plus récentes</option>
            </select>

            <button type="submit">envoyer</button>
        </form>
<!--fin : création des filtres pour la page archive-->

<!-- je définis ce que je veux -->
    <?php $filtres = array( 'post_type' => 'Photos', 'posts_per_page' => 12, 'paged' => $paged);
/*début : vérification du filtre format*/

    if (isset ($_POST ['format']) && ($_GET ['format']) != "0")
    {
        $filtres ['format']=$_GET['format'];
    }
    if (isset ($_POST ['categorie']) && ($_GET ['categorie']) != "0")
    {
        $filtres ['categorie']=$_GET['categorie'];
    }
    if (isset ($_POST ['date']) && ($_GET ['date']) != "0")
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
		<?php
        echo '<div class="overlay">';
            echo '<a href="'.esc_url( get_permalink() ) .'">';
                $image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'large'); 
                echo '<img class="miniature overlay__image" src="'.$image[0].'"/>';
            //include 'overlay.php';
            echo '</a>';
        echo '</div>';
        ?> 
        <!--fin : l'ensemble des photos de la page-->

        <?php endwhile;?>
        <button id="boutonChargerPlus" class=" load-posts">
            Charger plus
        </button> 
        <div id="post-container"></div>
        
    </div>
</main>

<?php get_footer(); ?>