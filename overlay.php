<?php
function overlay($url, $categorie, $titre)
{
?>
    <div class="overlay__hover">
        <div class="overlay__hover--image">
            <a class="overlaySource" href="<?php echo $url; ?>">
                <div class="overlayTitre" style="display:None;"><?php echo $titre; ?></div>
                <div class="overlayCategory" style="display:None;"><?php echo $categorie; ?></div>
                <img class="overlay__hover--image--pleinEcran" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/icone_plein_ecran.svg" alt="icone plein ecran">
            </a>
            <img class="overlay__hover--image--oeil" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/icone_oeil.svg" alt="icone oeil">
        </div>
    </div>
<?php
}
?>