<?php
/*début : action qui permet de charger des scripts dans notre theme */
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
function theme_enqueue_styles()
{
    // Chargement du style.css du thème parent Twenty Twenty
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    // Chargement du css/theme.css pour personnaliser le site
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/css/style.css', array(), filemtime(get_stylesheet_directory() . '/css/style.css'));
	//Chargement de modaleContact.js
    wp_enqueue_script('js-mondale', get_stylesheet_directory_uri() . '/js/modaleContact.js', array(), filemtime(get_stylesheet_directory() . '/js/modaleContact.js'));
    //chargement de scripts.js
    wp_enqueue_script( 'frontend-ajax', get_stylesheet_directory_uri(). '/js/scripts.js', array('jquery'), null, true );
	wp_localize_script( 'frontend-ajax', 'frontend_ajax_object',
		array( 
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			//'data_var_1' => 'value 1',
			//'data_var_2' => 'value 2',
		)
	);
    //Chargement de modalelightbox.js
    wp_enqueue_script('js-lightbox', get_stylesheet_directory_uri() . '/js/modaleLightbox.js', array(), filemtime(get_stylesheet_directory() . '/js/modaleLightbox.js'));
}
/*fin : action qui permet de charger des scripts dans notre theme */

//permet a ce que les photos de la page archive soit des liens
add_filter('post_thumbnail_html', 'gkp_post_thumbnail_html', 10, 2 );
function gkp_post_thumbnail_html( $html, $post_id ) {
    $html = '<a href="' . get_permalink( $post_id ) . '">' . $html . '</a>';
    return $html;
}


//ajax
add_action( 'admin_enqueue_scripts', 'my_ajax_scripts' );
function my_ajax_scripts() {
    wp_localize_script( 'ajaxRequestId', 'myapiurl', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}

add_action( 'wp_ajax_post_cart_clb', 'cart_clb' );
add_action( 'wp_ajax_nopriv_post_cart_clb', 'cart_clb' );

function cart_clb(){
    $_POST['action'];

    $articlesApparus = get_post();
    
    $filtres = [
        'post_type' => 'Photos',
        'posts_per_page' => 12,
        'paged' => $_POST['paged'],
    ];

    $reponse = new WP_Query($filtres);?>

    <div class="archive__body__photos">
        <!--parcourir les informations ($reponse) et les affiche-->
        <?php while ( $reponse->have_posts() ) : 

            $reponse -> the_post();
			$article = get_post();

        //if($articlesApparus->ID != $article->ID)
        {
            //début : l'ensemble des photos de la page
            echo '<a href="'.esc_url( get_permalink() ) .'">';
            $image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'large'); 
            echo '<img class="miniature" src="'.$image[0].'"/>';
            echo '</a>';
            //fin : l'ensemble des photos de la page
        }
        
        endwhile; ?>
    </div>
    <?php die();
}
?>