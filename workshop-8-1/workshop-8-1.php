<?php
/**
 * Plugin Name: Workshop Plugin - Section 8 - 1
 * Plugin URI:  https://plugin-url.com/
 * Description: This plugin introduces the Shortcode API and makes a really simple shortcode.
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

if ( ! class_exists( 'Workshop_Eight_One_Main' ) ) :

   /*
    **
    * Set up and load our class.
    */
   class Workshop_Eight_One_Main {
   
		/**
		 * Primary class constructor.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

            add_shortcode('ReallySimpleShortcode', array( $this, 'really_simple_short_code' ));
            add_shortcode('sitemap', array( $this, 'generate_sitemap') );


        }

       public function really_simple_short_code() {

            // [helloworld] somewhere within a page or post 

            return '<p>Hello World!</p>';

       }

       public function generate_sitemap( $params = array() ) {

            // [sitemap id='deepmap',depth=5]

            // default parameters
            extract(shortcode_atts(array(
                'title' => 'Site map',
                'id' => 'sitemap',
                'depth' => 2
            ), $params));
        
            // create sitemap
            $sitemap = wp_list_pages("title_li=&depth=$depth&sort_column=menu_order&echo=0");
            if ($sitemap != '') {
                $sitemap =
                    ($title == '' ? '' : "<h2>$title</h2>") .
                    '<ul' . ($id == '' ? '' : " id=\"$id\"") . ">$sitemap</ul>";
            }
        
            return $sitemap;
        }

   }

endif;
   
// Instantiate our class.
$Workshop_Eight_One_Main = new Workshop_Eight_One_Main();
