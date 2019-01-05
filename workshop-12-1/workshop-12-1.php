<?php
/**
 * Plugin Name: Workshop Plugin - Section 12 - 1
 * Plugin URI:  https://plugin-url.com/
 * Description: This plugin demos WPDB class and best practices working w/ database.
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

if ( ! class_exists( 'Workshop_Twelve_One_Main' ) ) :

	/**
	 * Main plugin class.
	 *
	 */
	class Workshop_Twelve_One_Main {

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
            
            https://codex.wordpress.org/Class_Reference/wpdb
            https://www.sitepoint.com/working-with-databases-in-wordpress/
            
            Prefixes

            $wpdb->posts will correspond to wp_posts table
            $wpdb->postmeta will correspond to wp_postmeta table
            $wpdb->users will correspond to wp_users table

            etc.

            $wpdb->get_col
            $wpdb->get_var
            $wpdb->get_row
            $wpdb->get_results

            */

            // add_action( 'wp', array( $this, 'get_posts_via_wpdb' ), 10 );
            // add_action( 'wp', array( $this, 'get_posts_via_wpdb_using_prepare' ), 10 );
            // add_action( 'wp', array( $this, 'insert_example' ), 10 );
            // add_action( 'wp', array( $this, 'update_example' ), 10 );
            // add_action( 'wp', array( $this, 'delete_example' ), 10 );
            // add_action( 'wp', array( $this, 'another_insert_example' ), 10 );
            

        }

        public function init() {
           
            // nothing here.

        }

        public function get_posts_via_wpdb() {

            global $wpdb;

            // do not hardcode the table name
            // DO NOT DO THIS: $result = $wpdb->get_results('SELECT * FROM wp_posts LIMIT 10');

            $result = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'posts LIMIT 10');

            print_r ($result);
            exit;

        }

        public function get_posts_via_wpdb_using_prepare() {

            global $wpdb;

            // do not hardcode the table name
            // DO NOT DO THIS: $result = $wpdb->get_results('SELECT * FROM wp_posts LIMIT 10');

            // $results = $wpdb->get_results( 
            //     "
            //     SELECT ID, post_title 
            //     FROM $wpdb->posts
            //     WHERE post_status = 'publish' 
            //         AND post_author = 1
            //     "
            // );

            /* AVOID: */

            $results = $wpdb->get_results( 
                "
                SELECT ID, post_title 
                FROM $wpdb->posts
                WHERE post_title LIKE '%Hello%'
                    AND post_author = 1
                "
            );

            /* USE PREPARE */

            $results = $wpdb->get_results( 
                $wpdb->prepare( 
                "
                SELECT ID, post_title 
                FROM $wpdb->posts
                WHERE post_title LIKE '%s'
                    AND post_author = %d
                ",
                '%Hello%',
                1
                )
            );
            
            foreach ( $results as $result ) {
                print_r ( $result->post_title );
            }

            exit;

        }
 
        public function insert_example() {

            global $wpdb;

            /* */

            $post_id    = $_POST['post_id'];
            $meta_key   = $_POST['meta_key'];
            $meta_value = $_POST['meta_value'];
            
            $the_id = $wpdb->insert(
                        $wpdb->postmeta, // custom tables - make this a variable that's global in your plugin so you can change it only once if need be
                        array(
                            'post_id'    => $_POST['post_id'],
                            'meta_key'   => $_POST['meta_key'],
                            'meta_value' => $_POST['meta_value']
                        )
                    );

            echo 'insert completed';

            exit;

        }

        public function update_example() {

            $wpdb->update( 
                'table', 
                array( 
                    'column1' => 'value1',	// string
                    'column2' => 'value2'	// integer (number) 
                ), 
                array( 'ID' => 1 ), 
                array( 
                    '%s',	// value1
                    '%d'	// value2
                ), 
                array( '%d' ) 
            );

        }

        public function delete_example() {

            // Default usage.
            $wpdb->delete( 'table', array( 'ID' => 1 ) );

            // Using where formatting.
            $wpdb->delete( 'table', array( 'ID' => 1 ), array( '%d' ) );

        }

        public function another_insert_example() {

            // Possible format values: %s as string; %d as integer (whole number); and %f as float.

            $metakey	= "Harriet's Adages";
            $metavalue	= "WordPress' database interface is like Sunday Morning: Easy.";
            
            $wpdb->query( $wpdb->prepare( 
                "
                    INSERT INTO $wpdb->postmeta
                    ( post_id, meta_key, meta_value )
                    VALUES ( %d, %s, %s )
                ", 
                10, 
                $metakey, 
                $metavalue 
            ) );

        }

             
    }

endif;

// Instantiate our class.
$Workshop_Twelve_One_Main = new Workshop_Twelve_One_Main();


