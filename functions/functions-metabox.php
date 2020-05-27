<?php 


function selectLayoutTemplate( $meta_boxes ) {
	$prefix = '';

	$meta_boxes[] = array(
		'id' => 'layout_template',
		'title' => esc_html__( 'Layout Template', 'metabox-online-generator' ),
		'post_types' => array('guide'),
		'context' => 'side',
		'priority' => 'default',
		'autosave' => 'false',
		'fields' => array(
		array(
				'id' => $prefix . 'page_layout_template',
				'name' => esc_html__( 'Page Layout Template', 'metabox-online-generator' ),
				'type' => 'select',
				'placeholder' => esc_html__( 'Select an Item', 'metabox-online-generator' ),
				'options' => array(
					'default' => esc_html__( 'Default', 'metabox-online-generator' ),
                    'two_column' => esc_html__( 'Two Column', 'metabox-online-generator' ),
                    'front_page' => esc_html__( 'Front Page', 'metabox-online-generator' ),
				),
				'std' => 'default',
            ),
            	array(
				'id' => $prefix . 'full_bleed',
				'name' => esc_html__( 'Full Bleed', 'metabox-online-generator' ),
				'type' => 'checkbox',
				'desc' => esc_html__( 'Page has no margins', 'metabox-online-generator' ),
			),
			array(
				'id' => 'page_break_after',
				'name' => esc_html__( 'Checkbox', 'metabox-online-generator' ),
				'type' => 'checkbox',
				'desc' => esc_html__( 'Page Break After', 'metabox-online-generator' )
			)
                
		),
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'selectLayoutTemplate' );

function selectHeroImage( $meta_boxes ) {
	$prefix = '';

	$meta_boxes[] = array(
		'id' => 'hero',
		'title' => esc_html__( 'Hero Image', 'metabox-online-generator' ),
		'post_types' => array('post', 'page','resource','profile','guide' ),
		'context' => 'side',
		'priority' => 'default',
		'autosave' => 'false',
		'fields' => array(
			array(
				'id' => $prefix . 'hero',
				'type' => 'image_advanced',
				'name' => esc_html__( 'Hero Image', 'metabox-online-generator' ),
				'desc' => esc_html__( '', 'metabox-online-generator' ),
			),
		),
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'selectHeroImage' );


    function video_meta( $meta_boxes ) {
        $prefix = '';

        $meta_boxes[] = array(
            'id' => 'featured_video',
            'title' => esc_html__( 'Featured Video', 'ps-video' ),
            'post_types' => array( 'page','post','project' ),
            'context' => 'side',
            'priority' => 'default',
            'autosave' => false,
            'fields' => array(
                array(
                    'id' => 'featured_video',
                    'type' => 'video',
                    'name' => esc_html__( 'Video', 'ps-video' ),
                    'max_file_uploads' => 4,
                ),
                array(
                    'id' => $prefix . 'featured_video_url',
                    'type' => 'url',
                    'name' => esc_html__( 'Featured Video URL', 'ps-video' ),
                ),
                array(
                    'id' => $prefix . 'video_aspect',
                    'name' => esc_html__( 'Video Aspect', 'ps-video' ),
                    'type' => 'select',
                    'placeholder' => esc_html__( 'Select an Item', 'ps-video' ),
                    'options' => array(
                        'hd' => '16:9',
                        'sd' => '4:3',
                    ),
                    'std' => 'hd',
                ),
            ),
        );

        return $meta_boxes;
    }
    add_filter( 'rwmb_meta_boxes', 'video_meta' );


    function social_meta( $meta_boxes ) {
        $prefix = '';

        $meta_boxes[] = array(
            'id' => 'social_url',
            'title' => esc_html__( 'Social', 'ps-social' ),
            'post_types' => array( 'social' ),
            'context' => 'side',
            'priority' => 'default',
            'autosave' => false,
            'fields' => array(
               
                array(
                    'id' => $prefix . 'social_url',
                    'type' => 'url',
                    'name' => esc_html__( 'URL', 'ps-social' ),
                ),
                
            ),
        );

        return $meta_boxes;
    }
    add_filter( 'rwmb_meta_boxes', 'social_meta' );



    function ps_metabox( $meta_boxes ) {
        $prefix = '';

        $meta_boxes[] = array(
            'id' => 'project_info',
            'title' => esc_html__( 'Project Info', 'ps_metabox' ),
            'post_types' => array( 'project' ),
            'context' => 'side',
            'priority' => 'default',
            'autosave' => false,
            'fields' => array(
                array(
                    'id' => $prefix . 'project_url',
                    'type' => 'url',
                    'name' => esc_html__( 'Project URL', 'ps_metabox' ),
                ),
                array(
                    'id' => $prefix . 'project_title',
                    'type' => 'text',
                    'name' => esc_html__( 'Project Title', 'ps_metabox' ),
                ),
                array(
                    'id' => $prefix . 'project_client',
                    'type' => 'text',
                    'name' => esc_html__( 'Client', 'ps_metabox' ),
                ),
                array(
                    'id' => $prefix . 'project_agency',
                    'type' => 'text',
                    'name' => esc_html__( 'Agency', 'ps_metabox' ),
                ),
                array(
                    'id' => $prefix . 'project_era',
                    'type' => 'text',
                    'name' => esc_html__( 'Era', 'ps_metabox' ),
                ),
            
            ),
        );

        return $meta_boxes;
    }
    add_filter( 'rwmb_meta_boxes', 'ps_metabox' );
            
function selectScreenImage( $meta_boxes ) {
	$prefix = '';

	$meta_boxes[] = array(
		'id' => 'screen_image',
		'title' => esc_html__( 'Screen Image', 'metabox-online-generator' ),
		'post_types' => array( 'post', 'page','project' ),
		'context' => 'side',
		'priority' => 'default',
		'autosave' => false,
		'fields' => array(
			array(
				'id' => 'screen_image',
				'type' => 'image_advanced',
				'name' => esc_html__( 'Screen Image', 'metabox-online-generator' ),
				'desc' => esc_html__( 'Appears in Screen', 'metabox-online-generator' ),
				'force_delete' => false,
				'max_file_uploads' => '10',
				'options' => array(),
				'attributes' => array(),
			),
		),
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'selectScreenImage' );

function profile_info( $meta_boxes ) {
	$prefix = '';

	$meta_boxes[] = array(
		'id' => 'profile_info',
		'title' => esc_html__( 'Profile Info', 'metabox-online-generator' ),
		'post_types' => array('profile' ),
		'context' => 'side',
		'priority' => 'default',
		'autosave' => 'false',
		'fields' => array(
			array(
				'id' => 'profile_title',
				'type' => 'text',
				'name' => esc_html__( 'Title', 'metabox-online-generator' ),
			),
			array(
				'id' => 'profile_company',
				'type' => 'text',
				'name' => esc_html__( 'Organization', 'metabox-online-generator' ),
			),
			array(
				'id' => 'profile_website',
				'type' => 'url',
				'name' => esc_html__( 'Website', 'metabox-online-generator' ),
			),
			array(
				'id' => 'profile_wikipedia',
				'type' => 'url',
				'name' => esc_html__( 'Wikipedia URL', 'metabox-online-generator' ),
			),
			array(
				'id' => 'profile_linkedin',
				'type' => 'url',
				'name' => esc_html__( 'LinkedIn URL', 'metabox-online-generator' ),
			),
			array(
				'id' => 'profile_twitter',
				'type' => 'url',
				'name' => esc_html__( 'Twitter URL', 'metabox-online-generator' ),
			),
			array(
				'id' => 'profile_facebook',
				'type' => 'url',
				'name' => esc_html__( 'Facebook URL', 'metabox-online-generator' ),
			),
			array(
				'id' => 'profile_flickr',
				'type' => 'url',
				'name' => esc_html__( 'Flickr URL', 'metabox-online-generator' ),
			),
			array(
				'id' => 'profile_instagram',
				'type' => 'url',
				'name' => esc_html__( 'Instagram URL', 'metabox-online-generator' ),
			),
			
		),
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'profile_info' );
    
?>