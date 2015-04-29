<?php

add_theme_support('post-formats');
add_theme_support('post-thumbnails');
add_theme_support('menus');



add_filter('get_twig', 'add_to_twig');
add_filter('timber_context', 'add_to_context');

add_action('wp_enqueue_scripts', 'load_scripts');
add_filter('show_admin_bar', '__return_false'); //tt_REMOVE WP ADMIN BAR

define('THEME_URL', get_template_directory_uri());
function add_to_context($data){
  /* this is where you can add your own data to Timber's context object */
  $data['qux'] = 'I am a value set in your functions.php file';
  $data['menu'] = new TimberMenu();
  return $data;
}

function add_to_twig($twig){
  /* this is where you can add your own fuctions to twig */
  $twig->addExtension(new Twig_Extension_StringLoader());
  $twig->addFilter('myfoo', new Twig_Filter_Function('myfoo'));
  return $twig;
}

function myfoo($text){
  $text .= ' bar!';
  return $text;
}

function load_scripts(){
  wp_enqueue_script('jquery');
}


//Register Custom Post Type

function post_joia() {
  $labels = array(
    'name'               => _x( 'Joia', 'post type general name' ),
    'singular_name'      => _x( 'Joia', 'post type singular name' ),
    'add_new'            => _x( 'Añadir', 'book' ),
    'add_new_item'       => __( 'Añadir Joia' ),
    'edit_item'          => __( 'Edita Joia' ),
    'new_item'           => __( 'Nueva Joia' ),
    'all_items'          => __( 'Todas las Joias' ),
    'view_item'          => __( 'Vea Joia' ),
    'search_items'       => __( 'Buscar Joias' ),
    'not_found'          => __( 'No se ha encontrado niguna joia' ),
    'not_found_in_trash' => __( 'No se ha encontrado niguna joia en la basura' ),
    'parent_item_colon'  => '',
    'menu_name'          => 'Joias'
  );
  $args = array(
    'labels'        => $labels,
    'description'   => 'Holds our joias and joia specific data',
    'public'        => true,
    'menu_position' => 5,
    'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
    'has_archive'   => true,
  );
  register_post_type( 'joia', $args );
}
add_action( 'init', 'post_joia' );

//Register Custom Taxonomy

function taxonomies_joia() {
  $labels = array(
    'name'              => _x( 'Categorias Joia', 'taxonomy general name' ),
    'singular_name'     => _x( 'Categoria Joia', 'taxonomy singular name' ),
    'search_items'      => __( 'Busca Categorias de Joia' ),
    'all_items'         => __( 'Todas las Categorias de Joia' ),
    'parent_item'       => __( 'Categoria Padre de Joia' ),
    'parent_item_colon' => __( 'Categoria Padre de Joia:' ),
    'edit_item'         => __( 'Edita Categoria de Joia' ),
    'update_item'       => __( 'Actualiza Categoria de Joia' ),
    'add_new_item'      => __( 'Añadir Catgoria de Joia' ),
    'new_item_name'     => __( 'Añadir Categoria de Joia' ),
    'menu_name'         => __( 'Catergorias de Joia' ),
  );
  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
  );
  register_taxonomy( 'joia_categoria', 'joia', $args );
}
add_action( 'init', 'taxonomies_joia', 0 );




/*function arphabet_widgets_init() {
  register_sidebar( array(
  'name' => 'Sidebar',
  'id' => 'sidebar',
  'before_widget' => '<div class="widget">',
    'after_widget' => '</div>',
    'before_title' => '<h4>',
      'after_title' => '</h4>',
      ));
      register_sidebar( array(
      'name' => 'Footer',
      'id' => 'footer',
      'before_widget' => '',
      'after_widget' => '',
      'before_title' => '',
      'after_title' => '',
      ));
    }

    add_action( 'widgets_init', 'arphabet_widgets_init' );*/
