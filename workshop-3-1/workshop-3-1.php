<?php
/**
 * Plugin Name: Workshop Plugin - Section 3 - 1
 * Plugin URI:  https://plugin-url.com/
 * Description: This plugin demos WP_Query and defining global variables.
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

if ( ! class_exists( 'Workshop_Three_One_Main' ) ) :

	/**
	 * Main plugin class.
	 *
	 */
	class Workshop_Three_One_Main {

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

			// Hook into things.
			add_action( 'wp', array( $this, 'query_example' ), 0 );

        }

        public function init() {

            // This does nothing because the construct did query_example
            // add_action( 'wp', array( $this, 'query_example' ), 0 );

        }

        public function query_example() {

            if ( is_admin() ) { // do not run this in admin
                return;
            }

            // Refer to https://codex.wordpress.org/Class_Reference/WP_Query

            $args = array(
                'post_type'  => 'post',
                'meta_key'   => 'age',
                'orderby'    => 'ID',
                'order'      => 'ASC',
                'post_per_page' => 1,
                'meta_query' => array(
                    array(
                        'key'     => 'age',
                        'value'   => array( 3, 4 ),
                        'compare' => 'IN',
                    ),
                ),
            );

            $the_query = new WP_Query( $args );

            // The loop, if this was in a theme
            if ( $the_query->have_posts() ) {
                while ( $the_query->have_posts() ) {
                    $the_query->the_post();
                    echo '<li>' . get_the_title() . '</li>';
                }
            }   
            // You can also do a regular foreach
            if ( $the_query->have_posts() ) {
                foreach ( $the_query->posts as $the_post ) {
                    print_r ( $the_post );
                    // var_dump ( $the_post );
                }
            }  
            
            exit;
        }
        
    }

endif;

// Instantiate our class.
$Workshop_Three_One_Main = new Workshop_Three_One_Main();
$Workshop_Three_One_Main->init();