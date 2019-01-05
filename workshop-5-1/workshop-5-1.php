<?php
/**
 * Plugin Name: Workshop Plugin - Section 5 - 1
 * Plugin URI:  https://plugin-url.com/
 * Description: This plugin demos WordPress security practices: Data Validation (also redirects for a bonus)
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

if ( ! class_exists( 'Workshop_Five_One_Main' ) ) :

	/**
	 * Main plugin class.
	 *
	 */
	class Workshop_Five_One_Main {

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

            /* PHP Functions */

            /* 
            - isset() and empty() for checking whether a variable exists and isn’t blank
            - mb_strlen() or strlen() for checking that a string has the expected number of characters
            - preg_match(), strpos() for checking for occurrences of certain strings in other strings
            - count() for checking how many items are in an array
            - in_array() for checking whether something exists in an array
            */

        }

        public function init() {
            
            // $email_text = $this->is_this_an_email('dbisset@dimensionmedia.com');
            // echo $email_text; exit;

            if ( is_admin() ) {
                return;
            }

            add_action( 'wp', array( $this, 'show_examples' ), 10 );

        }

        public function show_examples() {

            /* is this valid email? */

            // $email_text = $this->is_this_an_email('dbisset@dimensionmedia.com');
            // echo $email_text; exit;

            /* santitize or 'slug' a string/title */

            // $title = sanitize_title('This is a title.');
            // echo $title; exit;

            /* username exists? */

            // $username_exists = username_exists('dbisset');
            // echo $username_exists; exit;

            /* custom validation */
            // if ( is_home() || is_front_page() ) { // otherwise you get infinite redirects
            //     $is_zip_code = $this->is_us_zip_code( 33325 );
            //     if ( $is_zip_code ) {
            //         $link = home_url( 'yes-zip-code' );
            //     } else {
            //         $link = home_url( 'no-zip-code' );
            //     }
            //     wp_redirect( $link );
            //     exit;
            // }

            /* same thing but with shortcut */
            // $is_zip_code = $this->is_us_zip_code( 33325 );
            // $link = ( $is_zip_code ) ? home_url( 'yes-zip-code' ) : home_url( 'no-zip-code' );
            // wp_redirect( $link );
            // exit;

            // if ( is_404() ) {
            //     echo 'this is a 404';
            //     exit;
            // }

        }

        /* Core WordPress functions */
        /* See https://codex.wordpress.org/Data_Validation#Input_Validation */

        public function is_this_an_email( $email ) {

            // let's use the WordPress function

            if ( is_email( $email ) ) {

                return 'yes it is';
                    
            } else {

                return 'no it is not';

            }

        }

        function is_us_zip_code( $zip_code ) {
            // scenario 1: empty
            if ( empty( $zip_code ) ) {
                return false;
            }
         
            // scenario 2: more than 10 characters
            if ( strlen( trim( $zip_code ) ) > 10) {
                return false;
            }
         
            // scenario 3: incorrect format
            if (!preg_match('/^\d{5}(\-?\d{4})?$/', $zip_code)) {
                return false;
            }
         
            // passed successfully
            return true;
        }

             
    }

endif;

// Instantiate our class.
$Workshop_Five_One_Main = new Workshop_Five_One_Main();
$Workshop_Five_One_Main->init();

// $email_text = $Workshop_Five_One_Main->is_this_an_email('dbisset@dimensionmedia.com');
// echo $email_text; exit;