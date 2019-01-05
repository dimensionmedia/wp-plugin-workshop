<?php
/**
 * Plugin Name: Workshop Plugin - Section 4 - 2
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

if ( ! class_exists( 'Workshop_Four_Two_Main' ) ) :

	/**
	 * Main plugin class.
	 *
	 */
	class Workshop_Four_Two_Main {

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

            add_filter( 'the_title', array( $this, 'example_filter_title' ), 10, 1 ); // 10 is the priority level (default) and 1 is number of parameters (default)
            add_filter( 'body_class', array( $this, 'example_css_body_class' ), 10, 1 );

        }

        public function init() {

            // This does nothing currently.

        }

        public function example_filter_title( $title ) {

            return 'The ' . $title . ' was filtered';

        }

        public function example_css_body_class( $classes ) {
            if ( !is_admin() ) {
                $classes[] = 'wporg-is-awesome';
            }
            return $classes;
        }
              
    }

endif;

// Instantiate our class.
$Workshop_Four_Two_Main = new Workshop_Four_Two_Main();
$Workshop_Four_Two_Main->init();




function workshop_show_fruits( $another_extra_fruit ) {
	$fruits = array(
		'apples',
		'oranges',
		'kumkwats',
		'dragon fruit',
		'peaches',
		'durians'
	);
    $list = '<ul>';
    
	if( has_filter('workshop_add_fruits') ) {
		$fruits = apply_filters('workshop_add_fruits', $fruits, $another_extra_fruit );
	}
 
	foreach($fruits as $fruit) :
		$list .= '<li>' . $fruit . '</li>';
	endforeach;
 
	$list .= '</ul>';
 
	return $list;
}

function workshop_add_extra_fruits( $fruits, $another_extra_fruit = false ) {
	// the $fruits parameter is an array of all fruits from the workshop_show_fruits() function
 
	$extra_fruits = array(
		'plums',
		'kiwis',
		'tangerines',
		'pepino melons'
    );

    if ( $extra_fruit !== false ) {
        $extra_fruits[] = $another_extra_fruit;
    }
    
    // combine the two arrays
	$fruits = array_merge($extra_fruits, $fruits);
 
	return $fruits;
}
add_filter( 'workshop_add_fruits', 'workshop_add_extra_fruits', 10, 2 );

// echo workshop_show_fruits(); exit;
// echo workshop_show_fruits( 'banana' ); exit;