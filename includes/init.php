<?php

$filepath = get_template_directory() . '/vendor/autoload.php';

if (file_exists($filepath)) {
    require_once(get_template_directory() . '/vendor/autoload.php');
} elseif ( is_readable( __DIR__ . '/vendor/autoload.php' ) ) {
    require __DIR__ . '/vendor/autoload.php';
}

$timber = new Timber\Timber();

if ( !class_exists( 'Timber' ) ):

	add_action(
		'admin_notices',
		function() {
			echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
		}
	);

endif;

// Set Timber Locations + possibility to override templates in theme
Timber::$locations = array(

	get_stylesheet_directory() . '/templates',
    get_stylesheet_directory() . '/views',
    plugin_dir_path( __DIR__ ) . '/templates/twig'
);