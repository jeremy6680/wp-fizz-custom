<?php
/*
Plugin Name: WP Fizz Custom
Description: Plugin to register custom post types, custom taxonomies and custom fields
Author: Jeremy Marchandeau
Author URI: https://jeremymarchandeau.com
Version: 1.0
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

class WPFizzCustom {
  private static $instance;

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

  }

  /**
   * Registers custom post types using https://github.com/johnbillion/extended-cpts/wiki
   *
   * Defined statically for use in activation hook
   */
  public static function register_post_type() {
      require('custom-post-types/cpt-docs.php'); 
  }

  /**
   * Activation hook (see register_activation_hook)
   */
  public static function activate() {
    self::register_post_type();
    flush_rewrite_rules();
  }

  /**
   * Create custom taxonomies using https://github.com/johnbillion/extended-cpts/wiki
   */
  function custom_taxonomies() {
    require('custom-taxonomies/ct-docs.php'); 
  }

  /**
   * Create custom fields using https://github.com/wordplate/extended-acf
   */
  function custom_fields() {
    require('custom-fields/cf-docs.php'); 
  }
}

WPFizzCustom::getInstance();

register_deactivation_hook( __FILE__, 'flush_rewrite_rules' );
register_activation_hook( __FILE__, 'WPFizzCustom::activate' );