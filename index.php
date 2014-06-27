<?php
/**
 * The main template file
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file
 *
 * Methods for TimberHelper can be found in the /functions sub-directory
 *
 * @package 	WordPress
 * @subpackage 	Timber
 * @since 		Timber 0.1
 */

	if (!class_exists('Timber')){
		echo 'Timber not activated. Make sure you activate the plugin in <a href="/wp-admin/plugins.php#timber">/wp-admin/plugins.php</a>';
	}
	$context = Timber::get_context();
	$context['posts'] = Timber::get_posts();
        $args = 'category_name=destaques';
	$context['destaques'] = Timber::get_posts($args);
        $context['estrutura'] = get_theme_mods();

        $movie_args = 'post_type=videos';
	$context['videos'] = Timber::get_posts($movie_args);

        $blog_args = 'post_type=colunistas';
	$context['colunistas'] = Timber::get_posts($blog_args);

        $last_news_args = 'cat=-4';
	$context['ultimas_noticias'] = Timber::get_posts($last_news_args);
        $context['widgets'] = Timber::get_widgets('footer');
	$templates = array('index.twig');
	if (is_home()){
		array_unshift($templates, 'home.twig');
	}
	Timber::render($templates, $context);
