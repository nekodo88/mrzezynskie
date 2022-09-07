<?php

function beer_pub_allow_html(){
    return array(
        'form'=>array(
            'role' => array(),
            'method'=> array(),
            'class'=> array(),
            'action'=>array(),
            'id'=>array(),
            ),
        'input' => array(
            'type' => array(),
            'name'=> array(),
            'class'=> array(),
            'title'=>array(),
            'id'=>array(), 
            'value'=> array(), 
            'placeholder'=>array(), 
            'autocomplete' => array(),
            'data-number' => array(),
            'data-keypress' => array(),                        
            ),
        'button' => array(
            'type' => array(),
            'name'=> array(),
            'class'=> array(),
            'title'=>array(),
            'id'=>array(),                            
            ),  
        'img'=> array(
            'src' => array(),
            'alt' => array(),
            'class'=> array(),
            ),                      
        'div'=>array(
            'class'=> array(),
            ),
        'h4'=>array(
            'class'=> array(),
            ),
        'a'=>array(
            'class'=> array(),
            'href'=>array(),
            'onclick' => array(),
            'aria-expanded' => array(),
            'aria-haspopup' => array(),
            'data-toggle' => array(),
            ),
        'i' => array(
            'class'=> array(),
        ),
        'p' => array(
            'class'=> array(),
        ), 
        'br' => array(),
        'span' => array(
            'class'=> array(),
            'onclick' => array(),
            'style' => array(),
        ), 
        'strong' => array(
            'class'=> array(),
        ),  
        'ul' => array(
            'class'=> array(),
        ),  
        'li' => array(
            'class'=> array(),
        ), 
        'del' => array(),
        'ins' => array(),
        'select'=> array(
            'class' => array(),
            'name' => array(),
        ),
        'option'=> array(
            'class' => array(),
            'value' => array(),
        ),        
    );
}

function beer_pub_pagination_types(){
    return array(
        "pagination" => esc_html__("Pagination", 'beer_pub'),
        "loadmore" => esc_html__("Loadmore", 'beer_pub'),
    );
}
