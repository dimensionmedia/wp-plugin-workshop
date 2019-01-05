<?php
/**
 * Plugin Name: Workshop Plugin - Section 11 - 1
 * Plugin URI:  https://plugin-url.com/
 * Description: This plugin shows how AJAX works in a plugin and is_user_logged_in(), json_encode()
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

if ( ! class_exists( 'Workshop_Eleven_One_Main' ) ) :

	/**
	 * Main plugin class.
	 *
	 */
	class Workshop_Eleven_One_Main {

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

            /* 
            
            See:
            
            https://wptheming.com/2013/07/simple-ajax-example/
            https://stackoverflow.com/questions/1359018/in-jquery-how-to-attach-events-to-dynamic-html-elements
            https://eric.blog/2013/06/18/how-to-add-a-wordpress-ajax-nonce/
            
            */
            
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

            // enqueue the scripts

            add_action( 'wp_enqueue_scripts', array( $this, 'load_the_scripts' ) );

            // add button to end of content

            add_filter( 'the_content', array( $this, 'display_button' ), 10, 1 );

            // ajax calls

            add_action('wp_ajax_get_post_info', array( $this, 'get_post_info') ); // admin / priv
            
            add_action('wp_ajax_nopriv_get_post_info', array( $this, 'get_post_info') ); // non-admin / noprive

        }

        public function init() {
           
            // nothing here.

        }

       public function load_the_scripts() {

            // Enqueue CSS + JS.
            wp_enqueue_style( WORKSHOP_PLUGIN_SLUG . '-styles' );
            wp_enqueue_script( WORKSHOP_PLUGIN_SLUG . '-script' );


            // Example of a localize script
            $params = array(
                'ajaxurl' => admin_url('admin-ajax.php'),
                'ajax_nonce' => wp_create_nonce('any_value_here'),
            );

            /* 
            
            ajaxurl – This is the absolute address, taking into account http:// or https://, to your ajax processing script. This script is in the wp-admin folder, but can be used for front end ajax scripts as well.

            ajax_nonce – This is our nonce that we check in our ajax function. Notice how I used the string ‘any_value_here’ within the wp_create_nonce function… You can use any string, but be sure to remember what you use, because we will need to use the same string when we check the AJAX nonce. 
            
            */

            wp_localize_script( WORKSHOP_PLUGIN_SLUG . '-script', 'workshop_additional_js_vars', $params );

       }

        /**
         * Adds a read me later button at the bottom of each post excerpt that allows logged in users to save those posts in their read me later list.
         *
         * @param string $content
         * @returns string
         */
        public function display_button( $content ) {   

            // Show read me later link only when the user is logged in
            if( is_user_logged_in() && get_post_type() == post ) {
                $html .= '<a href="#" class="rml_bttn" data-post-id="' . get_the_id() . '">Read Me Later</a>';
                $content .= $html;
            }

            return $content;       

        }

        public function get_post_info() {
            
            check_ajax_referer( 'any_value_here', 'security' );

            print_r ($_POST);
            
            // Get Post ID from AJAX submit
            
            $post_id = intval( $_POST['post_id'] );

            global $wpdb;
            
            $results = $wpdb->get_results(
                $wpdb->prepare("
                    SELECT
                        post_title
                    FROM
                        {$wpdb->posts}
                    WHERE
                        ID = '%d'",
                    $post_id), ARRAY_A);

            echo 'results: ';
          
            echo json_encode($results);
          
            exit;


        }

             
    }

endif;

// Instantiate our class.
$Workshop_Eleven_One_Main = new Workshop_Eleven_One_Main();


