<?php
/**
 * Plugin Name: Workshop Plugin - Section 4 - 1
 * Plugin URI:  https://plugin-url.com/
 * Description: This plugin demos a few hooks (actions and filters).
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

if ( ! class_exists( 'Workshop_Four_One_Main' ) ) :

	/**
	 * Main plugin class.
	 *
	 */
	class Workshop_Four_One_Main {

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

            // Hook into init.
            
            // add_action( 'init', array( $this, 'init_example' ) ); // default value of 10 is used since a priority wasn't specified
            // add_action( 'init', array( $this, 'init_example_run_me_late' ), 11 );

            // Hook into the admin.

            // add_action( 'admin_init', array( $this, 'admin_init_example' ), 10 );
            // add_action( 'admin_footer', array( $this, 'my_admin_add_js' ), 10 );

            // Hook into wp which can be front or backend.
            
            // add_action( 'wp', array( $this, 'query_example' ), 10 );
            
            // Hook into pre_get_posts, which shows how variables can get passed in.

            // add_action( 'pre_get_posts', array( $this, 'pre_get_posts_example' ), 10, 1 ); // default value of 1

        }

        public function init() {

            // This does nothing currently.

        }

        public function init_example() {

            echo 'i stop at init on the frontend.****';

        }

        public function init_example_run_me_late() {

            echo 'i stop at init on the frontend later.';
            exit;

        }


        public function admin_init_example() {

            echo 'this should only appear in the backend****';

        }

        public function my_admin_add_js() {
            echo '<script>alert("This will trigger an alert on the admin page.")</script>';
        }
        

		/**
		 * 
         * If you wanted to modify the query that fetches search results during The Loop on the frontend, you could hook into the pre_get_posts hook.
		 *
		 * @since 1.0.0
		*/
            
        function pre_get_posts_example( $query ) {

            if ( ! is_admin() && $query->is_main_query() && $query->is_search ) {
                $query->set('post_type', ['post', 'movie'] );
            }

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
$Workshop_Four_One_Main = new Workshop_Four_One_Main();
$Workshop_Four_One_Main->init();






// Example Of Hooking Outside of Classes (Function.php in a theme for example)
function outside_of_a_class_example() {
    global $post;

    if ( is_admin() ) { // do not run this in admin
        return;
    }

    echo "hello!";
    print_r ($post);
    exit;
}
//add_action( 'init', 'outside_of_a_class_example' );
//add_action( 'wp', 'outside_of_a_class_example' );