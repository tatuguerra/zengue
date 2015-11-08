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

//change post per page




//Register Custom Post Type

function post_joia() {
  $labels = array(
    'name'               => _x( 'Joias', 'post type general name' ),
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

//Register Joia Post Type

function taxonomies_joia() {
  $labels = array(
    'name'              => _x( 'Joias', 'taxonomy general name' ),
    'singular_name'     => _x( 'Joias', 'taxonomy singular name' ),
    'search_items'      => __( 'Busca de Joias' ),
    'all_items'         => __( 'Todas las Joias' ),
    'parent_item'       => __( 'Categoria Padre de Joias' ),
    'parent_item_colon' => __( 'Categoria Padre de Joias:' ),
    'edit_item'         => __( 'Edita Joias' ),
    'update_item'       => __( 'Actualiza Joias' ),
    'add_new_item'      => __( 'Añadir Joia' ),
    'new_item_name'     => __( 'Añadir Joia' ),
    'menu_name'         => __( 'Categorias de Joias' ),
  );
  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
  );
  register_taxonomy( 'categoria_joias', 'joia', $args );
}
add_action( 'init', 'taxonomies_joia', 0 );

    /*function my_home_query( $query ) {
      if ( $query->is_main_query() && !is_admin() ) {
        $query->set( 'post_type', array( 'Joia', 'post' ));
      }
    }
    add_action( 'pre_get_posts', 'my_home_query' );*/

//Register Portfolio Post Type

function post_portfolio() {
  $labels = array(
    'name'               => _x( 'Portfolios', 'post type general name' ),
    'singular_name'      => _x( 'Portfolio', 'post type singular name' ),
    'add_new'            => _x( 'Añadir', 'book' ),
    'add_new_item'       => __( 'Añadir Portfolio' ),
    'edit_item'          => __( 'Edita Portfolio' ),
    'new_item'           => __( 'Nuevo Portfolio' ),
    'all_items'          => __( 'Todos los Portfolio' ),
    'view_item'          => __( 'Vea Portfolio' ),
    'parent_item_colon'  => '',
    'menu_name'          => 'Portfolio'
  );
  $args = array(
    'labels'        => $labels,
    'description'   => 'Holds our portfolio and portfolio specific data',
    'public'        => true,
    'menu_position' => 7,
    'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt'),
    'has_archive'   => true,
  );
  register_post_type( 'portfolio', $args );
}
add_action( 'init', 'post_portfolio' );

function taxonomies_portfolio() {
  $labels = array(
    'name'              => _x( 'Portfolios', 'taxonomy general name' ),
    'singular_name'     => _x( 'Portfolio', 'taxonomy singular name' ),
    'search_items'      => __( 'Busca de Portfolio' ),
    'all_items'         => __( 'Todas los Portfolios' ),
    'parent_item'       => __( 'Categoria Padre de Portfolio' ),
    'parent_item_colon' => __( 'Categoria Padre de Portfolio:' ),
    'edit_item'         => __( 'Edita Portfolios' ),
    'update_item'       => __( 'Actualiza Portfolios' ),
    'add_new_item'      => __( 'Añadir Portfolio' ),
    'new_item_name'     => __( 'Añadir Portfolio' ),
    'menu_name'         => __( 'Categorias de Portfolios' ),
  );
  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
  );
  register_taxonomy( 'categoria_portfolio', 'portfolio', $args );
}
add_action( 'init', 'taxonomies_portfolio', 0 );


//Register Sobre Post Type

function post_sobre() {
  $labels = array(
    'name'               => _x( 'Sobres', 'post type general name' ),
    'singular_name'      => _x( 'Sobre', 'post type singular name' ),
    'add_new'            => _x( 'Añadir', 'book' ),
    'add_new_item'       => __( 'Añadir Sobre' ),
    'edit_item'          => __( 'Edita Sobre' ),
    'new_item'           => __( 'Nuevo Sobre' ),
    'all_items'          => __( 'Todos los Sobre' ),
    'view_item'          => __( 'Vea Sobre' ),
    'parent_item_colon'  => '',
    'menu_name'          => 'Sobre'
  );
  $args = array(
    'labels'        => $labels,
    'description'   => 'Holds our sobre and sobre specific data',
    'public'        => true,
    'menu_position' => 6,
    'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt'),
    'has_archive'   => false,
  );
  register_post_type( 'sobre', $args );
}
add_action( 'init', 'post_sobre' );





// =======================================================================//
// Foundation5 Gallery-Output with Clearing(JS)
// =======================================================================//

add_filter( 'post_gallery', 'f5_gallery', 10, 2 );

function f5_gallery( $output, $attr ) {
	global $post;

	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( ! $attr['orderby'] ) {
			unset( $attr['orderby'] );
		}
	}

	extract( shortcode_atts( array(
		'order'   => 'ASC',
		'orderby' => 'menu_order ID',
		'id'      => $post->ID,
		'columns' => 3,
		'size'    => 'thumbnail',
		'include' => '',
		'exclude' => '',
		'link'    => 'file',
	), $attr ) );


	$id = intval( $id );
	if ( 'RAND' === $order ) {
		$orderby = 'none';
	}

	if ( ! empty( $include ) ) {
		$include         = preg_replace( '/[^0-9,]+/', '', $include );
		$attachments_arr = get_posts( array(
			'include'        => $include,
			'post_status'    => 'inherit',
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'order'          => $order,
			'orderby'        => $orderby
		) );

		$attachments = array();
		foreach ( $attachments_arr as $key => $val ) {
			$attachments[ $val->ID ] = $attachments_arr[ $key ];
		}
	}

	if ( empty( $attachments ) ) {
		return '';
	}

	$output = '<ul class="small-block-grid-2 medium-block-grid-' . $columns . '"  data-clearing>';

	foreach ( $attachments as $id => $attachment ) {
		$img     = wp_get_attachment_image_src( $id, $size );
		$img_big = wp_get_attachment_image_src( $id, 'full' );

		$caption = ( ! $attachment->post_excerpt ) ? '' : ' data-caption="' . esc_attr( $attachment->post_excerpt ) . '" ';

		$output .= '<li><a href="' . $img_big[0] . '"><img src="' . $img[0] . '" ' . $caption . ' class="th" alt="' . esc_attr( $post->title ) . '" /></a></li>';
	}

	$output .= '</ul>';

	return $output;
}







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
