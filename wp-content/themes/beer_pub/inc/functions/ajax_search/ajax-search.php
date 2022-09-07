<?php
add_action( 'wp_ajax_beer_pub_search', 'beer_pub_autocomplete_search' );
add_action( 'wp_ajax_nopriv_beer_pub_search', 'beer_pub_autocomplete_search' );
function beer_pub_autocomplete_search() {
    $term = strtolower( $_GET['term'] );
    $post_type = strtolower($_GET['post_type']);
    $suggestions = array();
        
    $args = array(
        's'                 => $term , 
        'post_type'         => $post_type,                  
    );  
    
    $loop = new WP_Query( $args );  
    while( $loop->have_posts() ) {
        $loop->the_post();
        $suggestion = array();
        $suggestion['label'] = get_the_title();
        $suggestion['link'] = get_permalink(); 
        $suggestion['imgsrc'] = ''; 
        $suggestion['add_cart'] = '';
        $suggestions[] = $suggestion;
    }
    wp_reset_postdata();
    
    
    $response = json_encode( $suggestions );
    echo $response;
    exit();
}

