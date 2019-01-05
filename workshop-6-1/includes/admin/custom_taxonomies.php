<?php
/**
 * Create a custom taxonomy.
 * See https://codex.wordpress.org/Taxonomies and https://www.wpbeginner.com/wp-tutorials/create-custom-taxonomies-wordpress/
 */

 class Workshop_Movies_Custom_Taxonomies {

        /**
         * Primary class constructor.
         *
         */
        public function __construct() {
    
            add_action( 'init', array( $this, 'create_topics_hierarchical_taxonomy' ) );
            // add_action( 'init', array( $this, 'create_topics_nonhierarchical_taxonomy' ) );
    
        }
           
        public function create_topics_hierarchical_taxonomy() {
 
            // Add new taxonomy, make it hierarchical like categories
            // first do the translations part for GUI
            
            $labels = array(
                'name' => _x( 'Topics', 'taxonomy general name' ),
                'singular_name' => _x( 'Topic', 'taxonomy singular name' ),
                'search_items' =>  __( 'Search Topics' ),
                'all_items' => __( 'All Topics' ),
                'parent_item' => __( 'Parent Topic' ),
                'parent_item_colon' => __( 'Parent Topic:' ),
                'edit_item' => __( 'Edit Topic' ), 
                'update_item' => __( 'Update Topic' ),
                'add_new_item' => __( 'Add New Topic' ),
                'new_item_name' => __( 'New Topic Name' ),
                'menu_name' => __( 'Topics' ),
            );    
            
            // Now register the taxonomy
            
            register_taxonomy('topics',array('movies'), array(
                'hierarchical' => true,
                'labels' => $labels,
                'show_ui' => true,
                'show_admin_column' => true,
                'query_var' => true,
                'rewrite' => array( 'slug' => 'topic' ),
            ));
        
        }
       
        public function create_topics_nonhierarchical_taxonomy() {
        
            // Labels part for the GUI
            
            $labels = array(
                'name' => _x( 'Topics', 'taxonomy general name' ),
                'singular_name' => _x( 'Topic', 'taxonomy singular name' ),
                'search_items' =>  __( 'Search Topics' ),
                'popular_items' => __( 'Popular Topics' ),
                'all_items' => __( 'All Topics' ),
                'parent_item' => null,
                'parent_item_colon' => null,
                'edit_item' => __( 'Edit Topic' ), 
                'update_item' => __( 'Update Topic' ),
                'add_new_item' => __( 'Add New Topic' ),
                'new_item_name' => __( 'New Topic Name' ),
                'separate_items_with_commas' => __( 'Separate topics with commas' ),
                'add_or_remove_items' => __( 'Add or remove topics' ),
                'choose_from_most_used' => __( 'Choose from the most used topics' ),
                'menu_name' => __( 'Topics' ),
            ); 
            
            // Now register the non-hierarchical taxonomy like tag
            
            register_taxonomy('topics','movies',array(
                'hierarchical' => false,
                'labels' => $labels,
                'show_ui' => true,
                'show_admin_column' => true,
                'update_count_callback' => '_update_post_term_count',
                'query_var' => true,
                'rewrite' => array( 'slug' => 'topic' ),
            ));

        }


    
} 

// Instantiate our class.
$Workshop_Movies_Custom_Taxonomies = new Workshop_Movies_Custom_Taxonomies();

