<?php
/**
 * Plugin Name: Workshop Plugin - Section 9 - 2
 * Plugin URI:  https://plugin-url.com/
 * Description: This plugin adds a custom meta box.
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

if ( ! class_exists( 'Workshop_Nine_Two_Main' ) ) :

   /*
    **
    * Set up and load our class.
    */
   class Workshop_Nine_Two_Main {
   
		/**
		 * Primary class constructor.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

            /* see https://www.sitepoint.com/adding-custom-meta-boxes-to-wordpress/ */

            add_action( 'add_meta_boxes', array( $this, 'add_custom_meta_box' ) );
            add_action( 'save_post', array( $this, 'save_custom_meta_box' ), 10, 3 );

        }

        public function custom_meta_box_markup( $object ) {
            
            wp_nonce_field( basename(__FILE__), 'meta-box-nonce' );

            ?>
                <div>
                    <label for="meta-box-text">Text</label>
                    <input name="meta-box-text" type="text" value="<?php echo get_post_meta($object->ID, "meta-box-text", true); ?>">
        
                    <br>
        
                    <label for="meta-box-dropdown">Dropdown</label>
                    <select name="meta-box-dropdown">
                        <?php 
                            $option_values = array(1, 2, 3);
        
                            foreach($option_values as $key => $value) 
                            {
                                if($value == get_post_meta($object->ID, "meta-box-dropdown", true))
                                {
                                    ?>
                                        <option selected><?php echo $value; ?></option>
                                    <?php    
                                }
                                else
                                {
                                    ?>
                                        <option><?php echo $value; ?></option>
                                    <?php
                                }
                            }
                        ?>
                    </select>
        
                    <br>
        
                    <label for="meta-box-checkbox">Check Box</label>
                    <?php
                        $checkbox_value = get_post_meta($object->ID, "meta-box-checkbox", true);
        
                        if($checkbox_value == "")
                        {
                            ?>
                                <input name="meta-box-checkbox" type="checkbox" value="true">
                            <?php
                        }
                        else if($checkbox_value == "true")
                        {
                            ?>  
                                <input name="meta-box-checkbox" type="checkbox" value="true" checked>
                            <?php
                        }
                    ?>
                </div>
            <?php  
        }

        public function add_custom_meta_box() {

            add_meta_box( 'demo-meta-box', 'Custom Meta Box', array( $this, 'custom_meta_box_markup' ), 'post', 'side', 'high', null);

            /* add_meta_box takes 7 arguments. Here are the list of arguments:

            $id: Every meta box is identified by WordPress uniquely using its id. Provide an id and remember to prefix it to prevent overriding.
            $title: Title of the meta box on the admin interface.
            $callback: add_meta_box calls the callback to display the contents of the custom meta box.
            $screen: Its used to instruct WordPress in which screen to display the meta box. Possible values are "post", "page", "dashboard", "link", "attachment" or "custom_post_type" id. In the above example we are adding the custom meta box to WordPress posts screen.
            $context: Its used to provide the position of the custom meta on the display screen. Possible values are "normal", "advanced" and "side". In the above example we positioned the meta box on side.
            $priority: Its used to provide the position of the box in the provided context. Possible values are "high", "core", "default", and "low". In the above example we positioned the meta box
            $callback_args: Its used to provide arguments to the callback function. */
            
           
        }

        function save_custom_meta_box($post_id, $post, $update) {

            if (!isset($_POST["meta-box-nonce"]) || !wp_verify_nonce($_POST["meta-box-nonce"], basename(__FILE__)))
                return $post_id;
        
            if (!current_user_can("edit_post", $post_id))
                return $post_id;
        
            if (defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
                return $post_id;
        
            $slug = "post";
            if($slug != $post->post_type)
                return $post_id;
        
            $meta_box_text_value = "";
            $meta_box_dropdown_value = "";
            $meta_box_checkbox_value = "";
        
            if(isset($_POST["meta-box-text"]))
            {
                $meta_box_text_value = $_POST["meta-box-text"];
            }   
            update_post_meta($post_id, "meta-box-text", $meta_box_text_value);
        
            if(isset($_POST["meta-box-dropdown"]))
            {
                $meta_box_dropdown_value = $_POST["meta-box-dropdown"];
            }   
            update_post_meta($post_id, "meta-box-dropdown", $meta_box_dropdown_value);
        
            if(isset($_POST["meta-box-checkbox"]))
            {
                $meta_box_checkbox_value = $_POST["meta-box-checkbox"];
            }   
            update_post_meta($post_id, "meta-box-checkbox", $meta_box_checkbox_value);
        }
        
        



   }

endif;
   
// Instantiate our class.
$Workshop_Nine_Two_Main = new Workshop_Nine_Two_Main();
