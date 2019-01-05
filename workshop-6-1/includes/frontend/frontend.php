<?php

if ( ! class_exists( 'Workshop_Five_Three_Frontend' ) ) :

/**
 * Main plugin class.
 *
 */
class Workshop_Five_Three_Frontend {

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

    }

    public function init() {
       

    }

    public function get_valid_movie_posts() {

        $validPosts = array();
        $this_post = array();
        $id_pot = array();
        $i = 0;
    
        $my_query = new WP_Query('post_type=movies&showposts=10');
    
        if($my_query->have_posts()) {
            while($i < $my_query->post_count) : 
                $post = $my_query->posts;
    
                if(!in_array($post[$i]->ID, $id_pot)){
                    $this_post['id'] = $post[$i]->ID;
                    $this_post['post_content'] = $post[$i]->post_content;
                    $this_post['post_title'] = $post[$i]->post_title;
                    $this_post['guid'] = $post[$i]->guid;
    
                    $id_pot[] = $post[$i]->ID;
                    array_push($validPosts, $this_post);
    
                }
    
                $post = '';
                $i++;
    
            endwhile;
        }
    
        return $validPosts;

    }
       
}


// Instantiate our class.
$Workshop_Five_Three_Frontend = new Workshop_Five_Three_Frontend();

endif;