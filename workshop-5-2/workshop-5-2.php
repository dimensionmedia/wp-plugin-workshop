<?php
/**
 * Plugin Name: Workshop Plugin - Section 5 - 2
 * Plugin URI:  https://plugin-url.com/
 * Description: This plugin demos WordPress security practices: Securing Input
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

if ( ! class_exists( 'Workshop_Five_Two_Main' ) ) :

	/**
	 * Main plugin class.
	 *
	 */
	class Workshop_Five_Two_Main {

		/**
		 * Plugin file.
		 *
		 * @since 1.0.0
		 *
		 * @var string
		 */
		public $file = __FILE__;

		/**
		 * Primary class constructor.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

            /* https://developer.wordpress.org/plugins/security/securing-input/ */

            /*

            The sanitize_*() series of helper functions are super nice, as they ensure you’re ending up with safe data.

            sanitize_email()
            sanitize_file_name()
            sanitize_hex_color()
            sanitize_hex_color_no_hash()
            sanitize_html_class()
            sanitize_key()
            sanitize_meta()
            sanitize_mime_type()
            sanitize_option()
            sanitize_sql_orderby()
            sanitize_text_field()
            sanitize_title()
            sanitize_title_for_query()
            sanitize_title_with_dashes()
            sanitize_user()
            esc_url_raw()
            wp_filter_post_kses()
            wp_filter_nohtml_kses()

            */

        }

        public function init() {
            
            if ( is_admin() ) {
                return;
            }

            add_action( 'wp', array( $this, 'show_examples' ), 10 );

        }

        public function show_examples() {

            // $sanitized_email = sanitize_email('     admin@example.com!     ');
            // echo $sanitized_email; // will output: 'admin@example.com'

            // Useful for (in theory) a form is summitted with: <input id="title" type="text" name="title">
            // $title = sanitize_text_field( $_POST['title'] );
            // echo $title;
            // update_post_meta( $post->ID, 'title', $title );

            // Don't forget to use PHP santiziation in your functions
            // $the_post_id = intval( $post->ID );

        }       

             
    }

endif;

// Instantiate our class.
$Workshop_Five_Two_Main = new Workshop_Five_Two_Main();
$Workshop_Five_Two_Main->init();

