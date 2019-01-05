<?php
/**
 * Plugin Name: Workshop Plugin - Section 10 - 1
 * Plugin URI:  https://plugin-url.com/
 * Description: This plugin works with user functions and metadata.
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

if ( ! class_exists( 'Workshop_Nine_One_Main' ) ) :

   /*
    **
    * Set up and load our class.
    */
   class Workshop_Ten_One_Main {
   
		/**
		 * Primary class constructor.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

            /*

            See:

            https://developer.wordpress.org/plugins/users/working-with-users/
            https://codex.wordpress.org/Class_Reference/WP_User
            https://codex.wordpress.org/Roles_and_Capabilities
            https://codex.wordpress.org/Function_Reference/get_users
            https://codex.wordpress.org/Class_Reference/WP_User_Query

            */

        }

        public function get_users() {

            $blogusers = get_users( 'blog_id=1&orderby=nicename&role=subscriber' );
            // Array of WP_User objects.
            foreach ( $blogusers as $user ) {
                echo '<span>' . esc_html( $user->user_email ) . '</span>';
            }

        }

        public function get_users_by_field() {

            $blogusers = get_users( array( 'fields' => array( 'display_name' ) ) );
            // Array of stdClass objects.
            foreach ( $blogusers as $user ) {
                echo '<span>' . esc_html( $user->display_name ) . '</span>';
            }

        }

        public function get_users_by_user_query() {

            // The Query
            $user_query = new WP_User_Query();

            // User Loop
            if ( ! empty( $user_query->get_results() ) ) {
                foreach ( $user_query->get_results() as $user ) {
                    echo '<p>' . $user->display_name . '</p>';
                }
            } else {
                echo 'No users found.';
            }

            // Example 2

            $args = array(
                'meta_query' => array(
                    'relation' => 'OR',
                        array(
                            'key'     => 'country',
                            'value'   => 'Israel',
                             'compare' => '='
                        ),
                        array(
                            'key'     => 'age',
                            'value'   => array( 20, 30 ),
                            'type'    => 'numeric',
                            'compare' => 'BETWEEN'
                        )
                )
             );
            $user_query = new WP_User_Query( $args );

            // Example 3

            // The search term
            $search_term = 'Ross';

            // WP_User_Query arguments
            $args = array (
                'role'       => 'reporter',
                'order'      => 'ASC',
                'orderby'    => 'display_name',
                'search'     => '*' . esc_attr( $search_term ) . '*',
                'meta_query' => array(
                    'relation' => 'OR',
                    array(
                        'key'     => 'first_name',
                        'value'   => $search_term,
                        'compare' => 'LIKE'
                    ),
                    array(
                        'key'     => 'last_name',
                        'value'   => $search_term,
                        'compare' => 'LIKE'
                    ),
                    array(
                        'key'     => 'description',
                        'value'   => $search_term ,
                        'compare' => 'LIKE'
                    )
                )
            );

            // Create the WP_User_Query object
            $wp_user_query = new WP_User_Query( $args );

            // Get the results
            $authors = $wp_user_query->get_results();

            // Check for results
            if ( ! empty( $authors ) ) {
                echo '<ul>';
                // loop through each author
                foreach ( $authors as $author ) {
                    // get all the user's data
                    $author_info = get_userdata( $author->ID );
                    echo '<li>' . $author_info->first_name . ' ' . $author_info->last_name . '</li>';
                }
                echo '</ul>';
            } else {
                echo 'No authors found';
            }

        }

        public function create_user( $user_name ) {

            // check if the username is taken
            $user_id = username_exists($user_name);
            
            // check that the email address does not belong to a registered user
            if (!$user_id && email_exists($user_email) === false) {
            // create a random password
                $random_password = wp_generate_password(
                    $length = 12,
                    $include_standard_special_chars = false
                );
            // create the user
                $user_id = wp_create_user(
                    $user_name,
                    $random_password,
                    $user_email
                );
            }
            
        }

        public function update_user() {

            $user_id = 1;
            $website = 'https://wordpress.org';
             
            $user_id = wp_update_user(
                [
                    'ID'       => $user_id,
                    'user_url' => $website,
                ]
            );
             
            if (is_wp_error($user_id)) {
                // error
            } else {
                // success
            }

        }


   }

endif;
   
// Instantiate our class.
$Workshop_Ten_One_Main = new Workshop_Ten_One_Main();
