<?php
/**
 * The Template for displaying all single posts
 *
 * Methods for TimberHelper can be found in the /functions sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$context['wp_title'] .= ' - ' . $post->title();
$context['comment_form'] = TimberHelper::get_comment_form();
$context['widgets'] = Timber::get_widgets('sidebar');
$joias_args = 'post_type=Joia';
$context['joias'] = Timber::get_posts($joias_args);
//Get a term when on a term archive page
$context['categories'] = Timber::get_terms('categoria_joias');
Timber::render(array('single-' . $post->ID . '.twig', 'single-' . $post->post_type . '.twig', 'single.twig'), $context);
