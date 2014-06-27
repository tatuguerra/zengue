<?php

add_theme_support('post-formats');
add_theme_support('post-thumbnails');
add_theme_support('menus');

add_filter('get_twig', 'add_to_twig');
add_filter('timber_context', 'add_to_context');

add_action('wp_enqueue_scripts', 'load_scripts');

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

add_action( 'init', 'create_posttype' );
function create_posttype() {
    register_post_type( 'videos',
                       array(
    'labels' => array(
    'name' => __( 'Videos' ),
                      'singular_name' => __( 'Video' )
),
'public' => true,
'menu_icon' => 'dashicons-video-alt',
'has_archive' => true,
'rewrite' => array('slug' => 'videos'),
)
);
    register_post_type( 'colunistas',
                       array(
    'labels' => array(
    'name' => __( 'Colunistas' ),
                      'singular_name' => __( 'Colunista' )
),
'public' => true,
'menu_icon' => 'dashicons-groups',
'has_archive' => true,
'rewrite' => array('slug' => 'colunistas'),
));


}

function arphabet_widgets_init() {
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

add_action( 'widgets_init', 'arphabet_widgets_init' );

Timber::add_route('noticias', function($params){
    $query = 'Timber::get_context();';
    Timber::load_template('archive.php', $query);
});

Timber::add_route('videos', function($params){
    $query = 'Timber::get_context();';
    Timber::load_template('videos.php', $query);
});

function Vermelhovivo_customize_register( $wp_customize ) {
$wp_customize->add_setting('destaques_position', array());
$wp_customize->add_control('destaques_position', array(
  'label'      => __('Disposição destaques', 'Vermelhovivo'),
  'section'    => 'layout',
  'settings'   => 'destaques_position',
  'type'       => 'radio',
  'choices'    => array(
    'grade'   => 'Grade',
    'linha'  => 'Linha',
  ),
));
$wp_customize->add_section('layout' , array(
    'title' => __('Destaques','Vermelhovivo'),
));

}
add_action( 'customize_register', 'Vermelhovivo_customize_register' );
