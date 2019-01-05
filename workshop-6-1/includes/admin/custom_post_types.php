<?php
/**
 * Create a custom post type.
 * See https://developer.wordpress.org/plugins/post-types/registering-custom-post-types/
 */

 class Workshop_Movies_Custom_Post_Type {

        /**
         * Primary class constructor.
         *
         */
        public function __construct() {
    
            add_action( 'init', array( $this, 'register_postypes' ) );
    
        }
    
        /**
         * Register Posttypes.
         *
         */
        public function register_postypes() {
       
            // Set UI labels for Custom Post Type
            $labels = array(
                'name'                => _x( 'Movies', 'Post Type General Name', 'twentythirteen' ),
                'singular_name'       => _x( 'Movie', 'Post Type Singular Name', 'twentythirteen' ),
                'menu_name'           => __( 'Movies', 'twentythirteen' ),
                'parent_item_colon'   => __( 'Parent Movie', 'twentythirteen' ),
                'all_items'           => __( 'All Movies', 'twentythirteen' ),
                'view_item'           => __( 'View Movie', 'twentythirteen' ),
                'add_new_item'        => __( 'Add New Movie', 'twentythirteen' ),
                'add_new'             => __( 'Add New', 'twentythirteen' ),
                'edit_item'           => __( 'Edit Movie', 'twentythirteen' ),
                'update_item'         => __( 'Update Movie', 'twentythirteen' ),
                'search_items'        => __( 'Search Movie', 'twentythirteen' ),
                'not_found'           => __( 'Not Found', 'twentythirteen' ),
                'not_found_in_trash'  => __( 'Not found in Trash', 'twentythirteen' ),
            );
            
            // Set other options for Custom Post Type
            
            $args = array(
                'label'               => __( 'movies', 'twentythirteen' ),
                'description'         => __( 'Movie news and reviews', 'twentythirteen' ),
                'labels'              => $labels,
                // Features this CPT supports in Post Editor
                'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
                // You can associate this CPT with a taxonomy or custom taxonomy. 
                'taxonomies'          => array( 'genres' ),
                /* A hierarchical CPT is like Pages and can have
                * Parent and child items. A non-hierarchical CPT
                * is like Posts.
                */ 
                'hierarchical'        => false,
                'public'              => true,
                'show_ui'             => true,
                'show_in_menu'        => true,
                'show_in_nav_menus'   => true,
                'show_in_admin_bar'   => true,
                'menu_position'       => 5,
                'can_export'          => true,
                'has_archive'         => true,
                'exclude_from_search' => false,
                'publicly_queryable'  => true,
                'capability_type'     => 'page',
            );
    
            // Filter arguments.
            $args = apply_filters( 'workshop_movies_post_type_args', $args );
    
            // Register the post type with WordPress.
            register_post_type( 'movies', $args );
    
        }
    
} 

// Instantiate our class.
$Workshop_Movies_Custom_Post_Type = new Workshop_Movies_Custom_Post_Type();

