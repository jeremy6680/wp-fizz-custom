<?php

function register_required_plugins() {
	$plugins = [
		[
			'name' 		=> 'Timber',
			'slug' 		=> 'timber-library',
			'required' 	=> true
		],
		[
			'name'         => 'Advanced Custom Fields PRO', // The plugin name.
			'slug'         => 'advanced-custom-fields-pro', // The plugin slug (typically the folder name).
			'source'       => 'https://www.advancedcustomfields.com/my-account/view-licenses/', // The plugin source.
			'required'     => false, // If false, the plugin is only 'recommended' instead of required.
			'external_url' => 'https://www.advancedcustomfields.com/my-account/view-licenses/', // If set, overrides default API URL and points to an external URL.
		],
	];

	$config = [
		'id'			=> 'wp-fizz-builder',
		'menu'			=> 'tgmpa-install-plugins',
		'parent_slug'	=> 'plugins.php',
		'capability'	=> 'edit_plugins',
		'has_notices'	=> true,
		'dismissable'	=> true
	];

	tgmpa( $plugins, $config );
}