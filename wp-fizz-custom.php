<?php
/*
Plugin Name: WP Fizz Custom Post Type
Description: Plugin to register a custom post type, its custom taxonomies and its custom fields
Author: Jeremy Marchandeau
Author URI: https://jeremymarchandeau.com
Version: 1.1
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

$filepath = get_template_directory() . '/vendor/autoload.php';

if (file_exists($filepath)) {
    require_once(get_template_directory() . '/vendor/autoload.php');
} elseif ( is_readable( __DIR__ . '/vendor/autoload.php' ) ) {
    require __DIR__ . '/vendor/autoload.php';
}

$timber = new \Timber\Timber();

// Set Timber Locations + possibility to override templates in theme
Timber::$locations = array(

	get_stylesheet_directory() . '/templates',
    //get_stylesheet_directory() . '/views',
    //get_stylesheet_directory() . '/components',
    //get_template_directory() . '/templates/components',
    //get_template_directory() . '/views',
    //get_template_directory() . '/components',
    plugin_dir_path( __DIR__ ) . '/templates/twig'
);

// Change the five instances of "WPFizzCustom" by the name of your custom post type
class WPFizzCustom {
  private static $instance;

  const FIELD_PREFIX = 'wpfc_';

  const CPT_SLUG = 'docs'; // this is just an example with a custom post types called "docs" - replace it so that it suits your needs

  const TEXT_DOMAIN = 'wpfc-docs'; // here again, that's just an example with a CPT called "docs" 

  public static function getInstance() {
    if (self::$instance == NULL) {
      self::$instance = new self();
    }

    return self::$instance;
  }

  private function __construct() {
    // initialize custom post types
    add_action('init', 'WPFizzCustom::register_post_type' );

    add_action('init', array( $this, 'custom_taxonomies' ) );

    add_filter( 'acf/init', array( $this, 'custom_fields' ) );

    add_action( 'template_include', array( $this, 'add_cpt_template' ) );

    add_action( 'wp_enqueue_scripts', array( $this, 'add_styles_scripts' ) );

  }

  /**
   *
   * Defined statically for use in activation hook
   */
  public static function register_post_type() {
      require('custom-post-types/custom-post-type.php'); 
  }

  /**
   * Activation hook (see register_activation_hook)
   */
  public static function activate() {
    self::register_post_type();
    flush_rewrite_rules();
  }

  /**
   * Create custom taxonomies
   */
  function custom_taxonomies() {
    require('custom-taxonomies/custom-taxonomies.php'); 
  }

  /**
   * Create custom fields
   */
  function custom_fields() {
    require('custom-fields/custom-fields.php'); 
  }

  /**
   * Add a custom template
   */
  function add_cpt_template( $template ) {
    if (is_singular( self::CPT_SLUG)) {
      // check the active theme directory
      if (file_exists( get_stylesheet_directory() . 'single-' . self::CPT_SLUG . '.php')) {

          return get_stylesheet_directory() . 'single-' . self::CPT_SLUG . '.php';
      }

      // failing that, use the bundled copy
      return plugin_dir_path(__FILE__) . 'templates/single-' . self::CPT_SLUG . '.php';
  }
  
  return $template;   
  }

  /**
   * Enqueues the stylesheet for our CPT
   */
  function add_styles_scripts() {
    require('process/add-styles-scripts.php');     
  }


}

WPFizzCustom::getInstance();

register_deactivation_hook( __FILE__, 'flush_rewrite_rules' );
register_activation_hook( __FILE__, 'WPFizzCustom::activate' );