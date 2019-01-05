<?php
/**
 * Plugin Name: Workshop Plugin - Section 9 - 1
 * Plugin URI:  https://plugin-url.com/
 * Description: This plugin works with post metadata.
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
   class Workshop_Nine_One_Main {
   
		/**
		 * Primary class constructor.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

            /*

            Metadata, by its very definition, is information about information. In the case of WordPress, it’s information associated with posts, users, comments and terms.

            An example would be a Content Type called Products with a metadata field for price. This field would be stored in the postmeta table.

            https://codex.wordpress.org/Metadata_API

            */

        }

        public function examples() {

            // add_post_meta( 68, 'my_key', 47 ); 68 is the post_id, 47 is the value
            // add_post_meta( 68, 'my_key', 'The quick, brown fox jumped over the lazy dog.' ); // you can add multiple values of same key

            // update_post_meta( $post_id, $meta_key, $meta_value, $prev_value = '' );
            // update_post_meta( $page_id, '_wp_page_template', 'new_template.php' );

            // $allposts = get_posts( 'numberposts=-1&post_type=post&post_status=any' );
 
            // foreach( $allposts as $postinfo ) {
            //     delete_post_meta( $postinfo->ID, 'related_posts' );
            //     $inspiration = get_post_meta( $postinfo->ID, 'post_inspiration' );
            //     foreach( $inspiration as $value ) {
            //         if( 'Sherlock Holmes' !== $value )
            //             delete_post_meta( $postinfo->ID, 'post_inspiration', $value );
            //     }
            // }

            // Character Escaping

            /*
            $escaped_json = '{"key":"value with \"escaped quotes\""}';
            update_post_meta($id, 'escaped_json', $escaped_json);
            $broken = get_post_meta($id, 'escaped_json', true);
            */
            /*
            $broken, after stripslashes(), ends up unparsable:
            {"key":"value with "escaped quotes""}
            */
            
        }



   }

endif;
   
// Instantiate our class.
$Workshop_Nine_One_Main = new Workshop_Nine_One_Main();
