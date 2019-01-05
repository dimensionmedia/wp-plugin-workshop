<?php
/**
 * Plugin Name: Workshop Plugin - Section 14 - 1 
 * Plugin URI:  https://plugin-url.com/
 * Description: This plugin sets up a basic admin settings page.
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
   class Workshop_Forteen_One_Main {
   
		/**
		 * Primary class constructor.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

            /*

            See:

            https://developer.wordpress.org/plugins/settings/custom-settings-page/
            https://codex.wordpress.org/Creating_Options_Pages
            http://wpsettingsapi.jeroensormani.com/


            */

            add_action( 'admin_menu', array( $this, 'workshop_add_admin_menu' ) );
            add_action( 'admin_init', array( $this, 'workshop_settings_init' ) );

        }

        public function workshop_add_admin_menu(  ) { 

            // Add to tools page...
            // add_submenu_page( 'tools.php', 'Workshop Settings', 'Workshop Settings', 'manage_options', 'Workshop Settings', array( $this, 'workshop_options_page' ) );

            // ...or add to settings page.
            add_submenu_page( 'options-general.php', 'Workshop Settings', 'Workshop Settings', 'manage_options', 'Workshop Settings', array( $this, 'workshop_options_page' ) );
        
        }
        
        
        public function workshop_settings_init(  ) { 
        
            register_setting( 'pluginPage', 'workshop_settings' );
        
            add_settings_section(
                'workshop_pluginPage_section', 
                __( 'Your section description', 'workshop' ), 
                'workshop_settings_section_callback', 
                'pluginPage'
            );
        
            add_settings_field( 
                'workshop_text_field_0', 
                __( 'Settings field description', 'workshop' ), 
                array( $this, 'workshop_text_field_0_render' ), 
                'pluginPage', 
                'workshop_pluginPage_section' 
            );
        
            add_settings_field( 
                'workshop_checkbox_field_1', 
                __( 'Settings field description', 'workshop' ), 
                array( $this, 'workshop_checkbox_field_1_render' ), 
                'pluginPage', 
                'workshop_pluginPage_section' 
            );
        
            add_settings_field( 
                'workshop_radio_field_2', 
                __( 'Settings field description', 'workshop' ), 
                array( $this, 'workshop_radio_field_2_render' ), 
                'pluginPage', 
                'workshop_pluginPage_section' 
            );
        
            add_settings_field( 
                'workshop_textarea_field_3', 
                __( 'Settings field description', 'workshop' ), 
                array( $this, 'workshop_textarea_field_3_render' ), 
                'pluginPage', 
                'workshop_pluginPage_section' 
            );
        
            add_settings_field( 
                'workshop_select_field_4', 
                __( 'Settings field description', 'workshop' ), 
                array( $this, 'workshop_select_field_4_render' ), 
                'pluginPage', 
                'workshop_pluginPage_section' 
            );
        
        
        }
        
        
        public function workshop_text_field_0_render(  ) { 
        
            $options = get_option( 'workshop_settings' );
            ?>
            <input type='text' name='workshop_settings[workshop_text_field_0]' value='<?php echo $options['workshop_text_field_0']; ?>'>
            <?php
        
        }
        
        
        public function workshop_checkbox_field_1_render(  ) { 
        
            $options = get_option( 'workshop_settings' );
            ?>
            <input type='checkbox' name='workshop_settings[workshop_checkbox_field_1]' <?php checked( $options['workshop_checkbox_field_1'], 1 ); ?> value='1'>
            <?php
        
        }
        
        
        public function workshop_radio_field_2_render(  ) { 
        
            $options = get_option( 'workshop_settings' );
            ?>
            <input type='radio' name='workshop_settings[workshop_radio_field_2]' <?php checked( $options['workshop_radio_field_2'], 1 ); ?> value='1'>
            <?php
        
        }
        
        
        public function workshop_textarea_field_3_render(  ) { 
        
            $options = get_option( 'workshop_settings' );
            ?>
            <textarea cols='40' rows='5' name='workshop_settings[workshop_textarea_field_3]'> 
                <?php echo $options['workshop_textarea_field_3']; ?>
             </textarea>
            <?php
        
        }
        
        
        public function workshop_select_field_4_render(  ) { 
        
            $options = get_option( 'workshop_settings' );
            ?>
            <select name='workshop_settings[workshop_select_field_4]'>
                <option value='1' <?php selected( $options['workshop_select_field_4'], 1 ); ?>>Option 1</option>
                <option value='2' <?php selected( $options['workshop_select_field_4'], 2 ); ?>>Option 2</option>
            </select>
        
        <?php
        
        }
        
        
        public function workshop_settings_section_callback(  ) { 
        
            echo __( 'This section description', 'workshop' );
        
        }
        
        
        public function workshop_options_page(  ) { 
        
            ?>
            <form action='options.php' method='post'>
        
                <h2>Workshop Plugin Settings</h2>
        
                <?php
                settings_fields( 'pluginPage' );
                do_settings_sections( 'pluginPage' );
                submit_button();
                ?>
        
            </form>
            <?php
        
        }


   }

endif;
   
// Instantiate our class.
$Workshop_Forteen_One_Main = new Workshop_Forteen_One_Main();
