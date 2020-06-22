<?php

/*
    Ajax Functions 
*/

add_action('wp_ajax_nopriv_post_load_more', 'post_load_more');
add_action('wp_ajax_post_load_more', 'post_load_more');


function post_load_more() {
    
    $paged = $_POST["page"]+1;

    $query = new WP_Query( array(
        'orderby' => 'date',
        'post_type' => 'post',
        'posts_per_page' => 4,
        'paged' => $paged
    ));
    
    if ( $query->have_posts() ) : 
        
        $_SESSION['postCount'] = $paged;

        while ( $query->have_posts() ) : $query->the_post();             

            get_template_part('/template-parts/ajax-content', get_post_format());    
            
            $_SESSION['postCount']++;

        $counter++;            

        endwhile;

    endif; 

    wp_reset_postdata();
    
    // Always use die to stop the execution of an ajax call after it's done its job
    die();
}


