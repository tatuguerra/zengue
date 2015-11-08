<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * Methods for TimberHelper can be found in the /functions sub-directory
 *
 * @package 	WordPress
 * @subpackage 	Timber
 * @since 		Timber 0.2
 */

		$templates = array('category-joias.twig', 'joias.twig', 'archive.twig', 'index.twig');

		$context = Timber::get_context();


		$context['categories'] = Timber::get_terms('category');

    $joias_args = 'post_type=Joia';
	  $context['joias'] = Timber::get_posts($joias_args);
	  $context['categories'] = Timber::get_terms('categoria_joias');
	  //Get a term when on a term archive page
    $context['term_page'] = new TimberTerm();
	  $context['pagination'] = Timber::get_pagination();
	  print_r('cata')
		Timber::render($templates, $context);
