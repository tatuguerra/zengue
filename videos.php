<?php

$context = Timber::get_context();
$movie_args = 'post_type=videos';
$context['videos'] = Timber::get_posts($movie_args);

$templates = array('videos.twig');
Timber::render($templates, $context);