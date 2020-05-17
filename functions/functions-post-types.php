<?php

add_action( 'init', 'projects_to_cpt' );
function projects_to_cpt() {
    $args = array(
      
        'label'=>"Social",
        'hierarchical'=>false,
        'public'       => true,
        'show_in_rest' => true,
        'show_ui'=>true,
        'label'        => 'project',
        'show_in_rest' => 'project',
        
    );
    register_post_type( 'project', $args );
}
//add_action( 'init', 'socials_to_cpt' );
function socials_to_cpt() {
    $args = array(
      'public'       => true,
      'show_in_rest' => true,
      'label'        => 'Social'
    );
    register_post_type( 'social', $args );
}

?>