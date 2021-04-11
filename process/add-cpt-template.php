<?php

if (is_singular( self::CPT_SLUG)) {
    // check the active theme directory
    if (file_exists( get_stylesheet_directory() . 'single-' . self::CPT_SLUG . '.php')) {
        return get_stylesheet_directory() . 'single-' . self::CPT_SLUG . '.php';
    }

    // failing that, use the bundled copy
    return plugin_dir_path(__FILE__) . 'templates/single-' . self::CPT_SLUG . 'php';
}

return $template;