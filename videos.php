<?php

$context = Timber::get_context();
$blog_args = 'post_type=colunistas';
$context['colunistas'] = Timber::get_posts($blog_args);
$movie_args = 'post_type=videos';
$context['videos'] = Timber::get_posts($movie_args);

$templates = array('videos.twig');
Timber::render($templates, $context);