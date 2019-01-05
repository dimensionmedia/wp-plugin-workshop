<?php
/**
 * Plugin Name: Workshop Plugin - Section 7 - 1
 * Plugin URI:  https://plugin-url.com/
 * Description: This plugin demos working with enqueuing JS and CSS
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

// Set our defined slug.
if ( ! defined( 'WORKSHOP_PLUGIN_SLUG' ) ) {
	define( 'WORKSHOP_PLUGIN_SLUG', 'WPPLUGIN' );
}

if ( ! class_exists( 'Workshop_Seven_One_Main' ) ) :

   /*
    **
    * Set up and load our class.
    */
   class Workshop_Seven_One_Main {
   
		/**
		 * Primary class constructor.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

            // Register CSS
            wp_register_style( 
                WORKSHOP_PLUGIN_SLUG . '-styles', // slug
                plugins_url( 'assets/css/styles.css', WORKSHOP_PLUGIN_CTA_BASE ) // location
            );

    		// Register script.
            wp_register_script( 
                WORKSHOP_PLUGIN_SLUG . '-script', // slug
                plugins_url( 'assets/js/scripts.js', WORKSHOP_PLUGIN_CTA_BASE ), // location
                array( 'jquery' ), // requirements
                WORKSHOP_PLUGIN_CTA_VER, // version
                true // in footer?
            );

            // Example of a localize script
            wp_localize_script(
                WORKSHOP_PLUGIN_SLUG . '-script', // what to attach to
                'workshop_additional_js_vars', // unique JS name
                array(
                    'ajax'  => admin_url( 'admin-ajax.php' ),
                    'test_var1' => 'test_value1',
                )
            );

            add_action( 'wp_enqueue_scripts', array( $this, 'load_the_scripts' ) );

       }

       public function load_the_scripts() {

            // Enqueue CSS + JS.
            wp_enqueue_style( WORKSHOP_PLUGIN_SLUG . '-styles' );
            wp_enqueue_script( WORKSHOP_PLUGIN_SLUG . '-script' );

       }
   }

endif;
   
// Instantiate our class.
$Workshop_Seven_One_Main = new Workshop_Seven_One_Main();
