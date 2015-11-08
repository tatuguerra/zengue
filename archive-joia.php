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

		global $paged;
    if (!isset($paged) || !$paged){
        $paged = 1;
    }

		$templates = array('joias.twig', 'archive.twig', 'index.twig');

		$args = array(
        'post_type' => 'Joia',
        'posts_per_page' => 12,
        'paged' => $paged
    );
		$data = Timber::get_context();

		$data['title'] = 'Archive';
		if (is_day()){
			$data['title'] = 'Archive: '.get_the_date( 'D M Y' );
		} else if (is_month()){
			$data['title'] = 'Archive: '.get_the_date( 'M Y' );
		} else if (is_year()){
			$data['title'] = 'Archive: '.get_the_date( 'Y' );
		} else if (is_tag()){
			$data['title'] = single_tag_title('', false);
		} else if (is_category()){
			$data['title'] = single_cat_title('', false);
			array_unshift($templates, 'archive-'.get_query_var('cat').'.twig');
		} else if (is_post_type_archive()){
			$data['title'] = post_type_archive_title('', false);
			array_unshift($templates, 'archive-'.get_post_type().'.twig');
		}

		
    
    
    /* THIS LINE IS CRUCIAL */
    /* in order for WordPress to know what to paginate */
    /* your args have to be the defualt query */
        query_posts($args);
    /* make sure you've got query_posts in your .php file */

    
    $joias_args = 'post_type=Joia';
	  $data['joias'] = Timber::get_posts($joias_args);
	  $data['categories'] = Timber::get_terms('categoria_joias');
	  //Get a term when on a term archive page
    /*$data['term_page'] = new TimberTerm();*/
	  $data['pagination'] = Timber::get_pagination();

	  print_r('test5');
	  #print_r($data);
		Timber::render($templates, $data);
