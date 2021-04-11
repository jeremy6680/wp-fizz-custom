<?php
/**
 * Default template for the CPT
 *
 */
$context = Timber::context();

$timber_post     = new Timber\Post();
$context['post'] = $timber_post;
$twigbase = get_template_directory() . '/templates/document/base.twig';
$file_exists = file_exists($twigbase);
if($file_exists):
Timber::render( 'twig/docs.twig', $context );
else:
Timber::render( 'twig/notimber-docs.twig', $context );
endif;