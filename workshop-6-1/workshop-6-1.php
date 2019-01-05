<?php
/**
 * Plugin Name: Workshop Plugin - Section 6 - 1
 * Plugin URI:  https://plugin-url.com/
 * Description: This plugin demos working with Custom Post Types & Taxonomies
 * Author:      David Bisset
 * Author URI:  http://davidbisset.com
 * Version:     1.0
 * Text Domain: sample-plugin
 * Domain Path: languages
 *
 * Sample Plugin is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Sample Plugin is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Sample Plugin. If not, see <http://www.gnu.org/licenses/>.
 *
  */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Set our defined base.
if ( ! defined( 'WORKSHOP_PLUGIN_CTA_BASE ' ) ) {
	define( 'WORKSHOP_PLUGIN_CTA_BASE', plugin_basename( __FILE__ ) );
}

// Set our defined directory.
if ( ! defined( 'WORKSHOP_PLUGIN_CTA_DIR' ) ) {
	define( 'WORKSHOP_PLUGIN_CTA_DIR', plugin_dir_path( __FILE__ ) );
}

// Set our defined version.
if ( ! defined( 'WORKSHOP_PLUGIN_CTA_VER' ) ) {
	define( 'WORKSHOP_PLUGIN_CTA_VER', '0.0.1' );
}

if ( ! class_exists( 'Workshop_Six_One_Main' ) ) :

   /*
    **
    * Set up and load our class.
    */
   class Workshop_Six_One_Main {
   
       /**
        * Load our hooks and filters.
        *
        * @return void
        */
       public function init() {
           add_action( 'plugins_loaded',               array( $this, 'load_files'          )           );
       }
   
       /**
        * Load textdomain for international goodness.
        *
        * @return void
        */
       public function textdomain() {
           load_plugin_textdomain( 'example-cta-plugin', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
       }
   
       /**
        * Call our files in the appropriate place.
        *
        * @return void
        */
       public function load_files() {
   
           // Load helper files.
   
           // Load our back end.
           if ( is_admin() ) {
               require_once( WORKSHOP_PLUGIN_CTA_DIR . 'includes/admin/custom_post_types.php' );
               require_once( WORKSHOP_PLUGIN_CTA_DIR . 'includes/admin/custom_taxonomies.php' );
           }
   
           // Load our front-end.
           if ( ! is_admin() ) {
               require_once( WORKSHOP_PLUGIN_CTA_DIR . 'includes/frontend/frontend.php' );
           }
       }
   
       // End the class.
   }

endif;
   
// Instantiate our class.
$Workshop_Six_One_Main = new Workshop_Six_One_Main();
$Workshop_Six_One_Main->init();


// Example

function get_valid_movie_posts() {
    $Workshop_Five_Three_Frontend = new Workshop_Five_Three_Frontend();
    $posts = $Workshop_Five_Three_Frontend->get_valid_movie_posts();
    print_r ($posts); exit;
}
add_action('wp', 'get_valid_movie_posts');
   