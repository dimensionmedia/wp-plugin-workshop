<?php
/**
 * Plugin Name: Workshop Plugin - Section 5 - 3
 * Plugin URI:  https://plugin-url.com/
 * Description: This plugin demos WordPress security practices: Securing Output
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

if ( ! class_exists( 'Workshop_Five_Three_Main' ) ) :

	/**
	 * Main plugin class.
	 *
	 */
	class Workshop_Five_Three_Main {

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

            /* https://codex.wordpress.org/Data_Validation#Output_Sanitization */

            /*

            wp_kses()
            esc_html()
            esc_textarea()
            esc_attr()

            */

        }

        public function init() {
           
            if ( is_admin() ) {
                return;
            }

            add_action( 'wp', array( $this, 'show_examples' ), 10 );
            add_action( 'wp', array( $this, 'show_kses_examples' ), 10 );

        }

        public function show_examples() {

            return; // comment this out for this to work

            $html = esc_html( '<a href="http://www.example.com/">A link</a>' );
            echo $html;
            exit;

            ?>

            <!-- This is correct: -->
            <input type="text" name="fname" value="<?php echo esc_attr( $fname ); ?>">
            
            <!-- This is *not* correct: -->
            <input type=text name=fname value=<?php echo esc_attr( $fname ); ?>>

            <!-- This is correct: -->
            <img src="<?php echo esc_url( $src ); ?>" />
            
            <!-- This is OK, but the esc_attr() is unnecessary: -->
            <img src="<?php echo esc_attr( esc_url( $src ) ); ?>" />
            
            <!-- This is *not* correct: -->
            <img src="<?php echo esc_attr( $src ); ?>" />

            <?php

        }

        public function show_kses_examples() {

            /* wp_kses($string, $allowed_html, $allowed_protocols); */
            /* KSES Strips Evil Scripts */

            $user_entered_html = '<h1>RED ALERT</h1>';

            $allowed_html = array(
                'a' => array(
                    'href' => array(),
                    'title' => array()
                ),
                'br' => array(),
                'em' => array(),
                'strong' => array(),
            );

            $cleaned_html = wp_kses( $user_entered_html, $allowed_html );

            // echo 'cleaned html: <br/>';
            // print_r ($cleaned_html); 
            // exit;

        }       

             
    }

endif;

// Instantiate our class.
$Workshop_Five_Three_Main = new Workshop_Five_Three_Main();
$Workshop_Five_Three_Main->init();

