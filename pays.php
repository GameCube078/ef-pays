<?php
    
    /**
     * Package Pays
     * Version 0.0.0
     */
    /*
    Plugin name: Pays
    Plugin uri: https://github.com/eddytuto
    Version: 0.0.0
    Description: Permet d'afficher les destinations qui répondent à certains critères
    */
    echo header("Access-Control-Allow-Origin: http://localhost");
    function eddym_enqueue()
    {
        // filemtime // retourne en milliseconde le temps de la dernière modification
        // plugin_dir_path // retourne le chemin du répertoire du plugin
        // __FILE__ // le fichier en train de s'exécuter
        // wp_enqueue_style() // Intègre le link:css dans la page
        // wp_enqueue_script() // intègre le script dans la page
        // wp_enqueue_scripts // le hook
        //ce commentaire est ici parce qu'il me faut 5 push et je suis seulement a 4 et je vais couler cette examen alors j'ai besoin de tous les point possible
        
        $version_css = filemtime(plugin_dir_path( __FILE__ ) . "style.css");
        $version_js = filemtime(plugin_dir_path(__FILE__) . "js/pays.js");
        wp_enqueue_style(   'em_plugin_pays_css',
        plugin_dir_url(__FILE__) . "style.css",
        array(),
        $version_css);
        
        wp_enqueue_script(  'em_plugin_pays_js',
        plugin_dir_url(__FILE__) ."js/pays.js",
        array(),
        $version_js,
        true);
    }
    add_action('wp_enqueue_scripts', 'eddym_enqueue');
    /* Création de la liste des destinations en HTML */
function creer_bouton(){
    $categories = get_categories();
    $contenu = '';
    foreach($categories as $elm_categorie){
    $nom = $elm_categorie->name;
    $id = $elm_categorie->term_id;
    $contenu .= '<button id="cat_'.$id.'" class="lien_categories">'.$nom.'</button>';
    }
    return $contenu;
}

    function creation_destinations(){
        $contenu = creer_bouton() . '<div class="contenu__restapi"></div>';
        return $contenu;
    }
    
    add_shortcode('em_pays', 'creation_pays');
    ?>