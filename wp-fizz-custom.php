<?php
/*
Plugin Name: WP Fizz Custom Post Type
Description: Boilerplate Plugin to register a custom post type, its custom taxonomies and its custom fields. This plugin requires Timber, ACF PRO, Extended ACF and Extended CPTs.
Author: Jeremy Marchandeau
Author URI: https://jeremymarchandeau.com
Version: 1.1
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

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

    include( 'includes/init.php' );

    include( 'includes/register-plugins.php' );

    require_once( plugin_dir_path( __FILE__) . "/includes/libs/class-tgm-plugin-activation.php" );

    add_action( 'tgmpa_register', 'register_required_plugins' );

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
    require('includes/front/enqueue.php');     
  }


}

WPFizzCustom::getInstance();

register_deactivation_hook( __FILE__, 'flush_rewrite_rules' );
register_activation_hook( __FILE__, 'WPFizzCustom::activate' );