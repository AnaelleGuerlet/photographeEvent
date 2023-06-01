<?php
/*début : action qui permet de charger des scripts dans notre theme */
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
function theme_enqueue_styles()
{
    // Chargement du style.css du thème parent Twenty Twenty
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    // Chargement du css/theme.css pour personnaliser le site
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/css/theme.css', array(), filemtime(get_stylesheet_directory() . '/css/theme.css'));
	//Chargement de scripts.js
    wp_enqueue_script('theme-mondale', get_stylesheet_directory_uri() . '/js/scripts.js', array(), filemtime(get_stylesheet_directory() . '/js/scripts.js'));
}
/*fin : action qui permet de charger des scripts dans notre theme */


//chargement du code du modale Contact

?>