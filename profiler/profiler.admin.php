<?php

//ENQUE

    function admin_q() {
		wp_enqueue_style('admin-styles', get_template_directory_uri().'/profiler/admin.css');
		wp_enqueue_style( 'font-awesome','https://use.fontawesome.com/releases/v5.6.3/css/all.css');

		wp_register_script('admin_js', get_template_directory_uri() . '/profiler/admin.js'); 
        wp_enqueue_script('admin_js');
		wp_register_script('ajax_js', get_template_directory_uri() . '/profiler/ajax.js'); 
        wp_enqueue_script('ajax_js');
    }
	add_action('admin_enqueue_scripts', 'admin_q');
	
	function setHardwareSpecs( $meta_boxes ) { // this shows the box were 
	$prefix = '';

	$meta_boxes[] = array(
		'id' => 'hardware_specs',
		'title' => esc_html__( 'Hardware Specs', 'omniscience-profiler' ),
		'post_types' => array('hardware' ),
		'context' => 'normal',
		'priority' => 'high',
		'autosave' => 'false',
		'fields' => array(
			//ABOUT GROUP
			array('type' => 'heading','name' => esc_html__( 'About', 'mbg' ),),

			array('id' => 'device_name','type' => 'text','name' => esc_html__( 'Device', 'mbg' ),),
			array('id' => 'MSRP','type' => 'text','name' => esc_html__( 'MSRP', 'mbg' ),),
			
		//	array('id' => 'availability_date','type' => 'date','name' => esc_html__( 'Availability date', 'mbg' ),),
			array('id' => 'colors','type' => 'text','name' => esc_html__( 'Color', 'mbg' ),),
			array('id' => 'hero_image_url','type' => 'text','name' => esc_html__( 'Model asset link', 'mbg' ),),
			array('id' => 'model_asset_url','type' => 'text','name' => esc_html__( 'Model asset link', 'mbg' ),),
			array('id' => 'video_urls','type' => 'text','name' => esc_html__( 'Video links', 'mbg' ),),
			array('id' => 'marketing_url','type' => 'text','name' => esc_html__( 'Website URL', 'mbg' ),),
			array('id' => 'specifications_url','type' => 'text','name' => esc_html__( 'Specs URL', 'mbg' ),),

			array('type' => 'divider'),
	// CASTING GROUP
			array('type' => 'heading','name' => esc_html__( 'Casting', 'mbg' ),),

		
			array('id' => 'airplay','type' => 'checkbox','name' => esc_html__( 'AirPlay', 'mbg' ),),
			array('id' => 'chromecast','type' => 'checkbox','name' => esc_html__( 'ChromeCast', 'mbg' ),),
			array('id' => 'miracast','type' => 'checkbox','name' => esc_html__( 'ChromeCast', 'mbg' ),),
	//		array('id' => 'native_app','type' => 'checkbox','name' => esc_html__( 'Native App', 'mbg' ),),

			array('type' => 'divider'),

			//COMMS GROUP
			array('type' => 'heading','name' => esc_html__( 'Communications', 'mbg' ),),
			//array('id' => 'gps','type' => 'checkbox','name' => esc_html__( 'GPS', 'mbg' ),),
			array('id' => 'wireless_link','type' => 'checkbox','name' => esc_html__( 'Wireless link to PC', 'mbg' ),),
			array('id' => 'wired_link','type' => 'checkbox','name' => esc_html__( 'Wired link to PC', 'mbg' ),),
			array('id' => 'bluetooth','type' => 'select_advanced','name'     => esc_html__( 'Bluetooth', 'mbg' ),
				'options'=>array(
					'3.0' => esc_html__( '3.0', 'online-generator' ),
                    '4.0' => esc_html__( '4.0', 'online-generator' ),
                    '4.1' => esc_html__( '4.1', 'online-generator' ),
                    '4.2' => esc_html__( '4.2', 'online-generator' ),
                    '5.0' => esc_html__( '5.0', 'online-generator' ),
                    '5.1' => esc_html__( '5.1', 'online-generator' ),
                    '5.2' => esc_html__( '5.2', 'online-generator' ),
				
				),
				
				'multiple'=>true,),



			array('id' => 'wifi','type' => 'text','name' => esc_html__( 'WiFi', 'mbg' ),),
			array('id' => 'cellular','type' => 'select_advanced','name'=> esc_html__( 'cellular', 'mbg' ),
				'options'=>array(
					'4G'  => esc_html__( '4G', 'online-generator' ),
                    'LTE' => esc_html__( 'LTE', 'online-generator' ),
					'5G'  => esc_html__( '5G', 'online-generator' ),
				),
				'multiple'=>true,),

			array('type' => 'divider'),
			//FEATURES GROUP

			array('type' => 'heading','name' => esc_html__( 'Features', 'mbg' ),),

			array('id' => 'eye_tracking','type' => 'checkbox','name' => esc_html__( 'Eye Tracking', 'mbg' ),),
			array('id' => 'hand_tracking','type' => 'checkbox','name' => esc_html__( 'Hand Tracking', 'mbg' ),),
			//array('id' => 'browser','type' => 'checkbox','name' => esc_html__( 'Browser', 'mbg' ),),
			array('id' => 'spatial_audio','type' => 'checkbox','name' => esc_html__( 'Spatial Audio', 'mbg' ),),
			array('id' => 'accessories','type' => 'textarea','name' => esc_html__( 'Accessories', 'mbg' ),),
			
			
			array('type' => 'divider'),
			// FORM FACTOR GROUP
			array('type' => 'heading','name' => esc_html__( 'Form Factor', 'mbg' ),),

			array('id' => 'fov','type' => 'number','name' => esc_html__( 'Field of View', 'mbg' ),),
			array('id' => 'mobile_tethered','type' => 'checkbox','name' => esc_html__( 'Tethers to mobile phone', 'mbg' ),),
			array('id' => 'battery_capacity','type' => 'text','name' => esc_html__( 'Battery Capacity', 'mbg' ),),
			array('id' => 'user_glasses_supported','type' => 'checkbox','name' => esc_html__( 'User Glasses Supported', 'mbg' ),),
			array('id' => 'usb','type' => 'multiple','name' => esc_html__( 'USB', 'mbg' ),),
			array('id' => 'ipd_adjustables','type' => 'select_advanced','name'     => esc_html__( 'IPD Adjustable ', 'mbg' ),'options'=>array( 
					'None'                => esc_html__( 'None', 'online-generator' ),
                    'Manual-Fixed Choice' => esc_html__( 'Manual-Fixed Choice', 'online-generator' ),
                    'Manual-Variable'     => esc_html__( 'Manual-Variable', 'online-generator' ),
					'Automatic'           => esc_html__( 'Automatic', 'online-generator' ),),
					'multiple'=>true,),



			array('id' => 'prescription_supported','type' => 'checkbox','name' => esc_html__( 'Prescription Supported', 'mbg' ),),
			array('id' => 'weight','type' => 'number','name' => esc_html__( 'Weight ', 'mbg' ),),
			array('id' => 'blackout_capability','type' => 'checkbox','name' => esc_html__( 'Blackout Capability', 'mbg' ),),
			array('id' => 'safety_glass','type' => 'checkbox','name' => esc_html__( 'Safety Glass', 'mbg' ),),
			array('id' => 'safety_hazardous_certification','type' => 'text','name' => esc_html__( 'Hazardous Certifications', 'mbg' ),),
			array('id' => 'accessibility_features','type' => 'text','name' => esc_html__( 'Accessibility Features', 'mbg' ),),
			array('id' => 'illumination','type' => 'checkbox','name' => esc_html__( 'Flash/scene illumination', 'mbg' ),),
			
			array('type' => 'divider'),

			//INPUT GROUP
			array('type' => 'heading','name' => esc_html__( 'Input', 'mbg' ),),

			array('id' => 'controllers','type' => 'text','name' => esc_html__( 'Controllers', 'mbg' ),),
			array('id' => 'tracking','type' => 'select_advanced','name'     => esc_html__( 'Tracking ', 'mbg' ),'options'=>array(
					'3DoF' => esc_html__( '3DoF', 'online-generator' ),
                    '6DoF' => esc_html__( '6DoF', 'online-generator' ),),'multiple'=>true,),

			array('id' => 'speech_recognition','type' => 'select_advanced','name'     => esc_html__( 'Speech Recognition', 'mbg' ),'options'=>array(  'none'    => esc_html__( 'none', 'online-generator' ),
                    'online'  => esc_html__( 'online', 'online-generator' ),
                    'offline' => esc_html__( 'offline', 'online-generator' ),),'multiple'=>true,),

			array('id' => 'touch_surface','type' => 'checkbox','name' => esc_html__( 'Touch Surface', 'mbg' ),),

			array('type' => 'divider'),

			//Platform Group
			array('type' => 'heading','name' => esc_html__( 'Platform', 'mbg' ),),

			array('id' => 'ios_app','type' => 'checkbox','name' => esc_html__( 'iOS App', 'mbg' ),),
			array('id' => 'android_app','type' => 'checkbox','name' => esc_html__( 'Android App', 'mbg' ),),
			array('id' => 'oculus','type' => 'checkbox','name' => esc_html__( 'Oculus', 'mbg' ),),
			array('id' => 'steam','type' => 'checkbox','name' => esc_html__( 'Steam', 'mbg' ),),
			array('id' => 'sidequest','type' => 'checkbox','name' => esc_html__( 'SideQuest', 'mbg' ),),
			array('id' => 'hololens_store','type' => 'checkbox','name' => esc_html__( 'Hololens Store', 'mbg' ),),
			array('id' => 'viveport','type' => 'checkbox','name' => esc_html__( 'Viveport', 'mbg' ),),
	
		//	array('id' => 'other_platfrom','type' => 'checkbox','name' => esc_html__( 'Other Platform', 'mbg' ),),
			
		//	array('id' => 'device_os','type' => 'text','name' => esc_html__( 'Device Operating System', 'mbg' ),),

			array('type' => 'divider'),

			// TECHNICAL SPECS GROUP
			array('type' => 'heading','name' => esc_html__( 'Specs', 'mbg' ),),

			array('id' => 'sensors','type' => 'textarea','name' => esc_html__( 'Sensors ', 'mbg' ),),
			array('id' => 'os_support','type' => 'select_advanced','name'     => esc_html__( 'OS Support', 'mbg' ),'options'=>array( 'Windows,' => esc_html__( 'Windows,', 'online-generator' ),
                    'MacOS,'   => esc_html__( 'MacOS,', 'online-generator' ),
                    'iOS,'     => esc_html__( 'iOS,', 'online-generator' ),
                    'Android'  => esc_html__( 'Android', 'online-generator' ),
                    'Linux'    => esc_html__( 'Linux', 'online-generator' ),),'multiple'=>true,),
			array('id' => 'storage_capacity','type' => 'num','name' => esc_html__( 'Storage Capacity ', 'mbg' ),),
			array('id' => 'ram','type' => 'num','name' => esc_html__( 'RAM ', 'mbg' ),),
			array('id' => 'GPU','type' => 'text','name' => esc_html__( 'GPU', 'mbg' ),),
			array('id' => 'CPU','type' => 'text','name' => esc_html__( 'CPU', 'mbg' ),),
			array('id' => 'optics','type' => 'text','name' => esc_html__( 'Optics', 'mbg' ),),
		//	array('id' => 'processors','type' => 'text','name' => esc_html__( 'Processors', 'mbg' ),),

			array('id' => 'refresh_rates','type' => 'text','name' => esc_html__( 'Refresh Rates', 'mbg' ),),
			array('id' => 'per_eye_resolution','type' => 'text','name' => esc_html__( 'Per Eye Resolution', 'mbg' ),),
			array('id' => 'ports','type' => 'text','name' => esc_html__( 'Ports', 'mbg' ),),

array('type' => 'divider'),
			
		array('id' => 'discontinued','type' => 'checkbox','name' => esc_html__( 'Discontinued', 'mbg' ),),
		),
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'setHardwareSpecs' );


// PROFILE METABOXES
function setProfileTaxonomyData( $meta_boxes ) { // this shows the box were 
	$prefix = '';

	$meta_boxes[] = array(
		'id' => 'old_taxonomy_info',
		'title' => esc_html__( 'OLD TAXONOMY', 'omniscience-profiler' ),
		'post_types' => array('profile' ),
		'context' => 'side',
		'priority' => 'low',
		'autosave' => 'false',
		'fields' => array(
			array(
				'id' => 'features',
				'type' => 'textarea',
				'name' => esc_html__( 'Features', 'mbg' ),
			),
			array(
				'id' => 'platform',
				'type' => 'textarea',
				'name' => esc_html__( 'Platform', 'mbg' ),
			),
			array(
				'id' => 'industries',
				'type' => 'textarea',
				'name' => esc_html__( 'Industries', 'mbg' ),
			),
			array(
				'id' => 'industry_subtags',
				'type' => 'textarea',
				'name' => esc_html__( 'Industry Subtags', 'mbg' ),
			),
			array(
				'id' => 'feature_subtags',
				'type' => 'textarea',
				'name' => esc_html__( 'Feature Subtags', 'mbg' ),
			)

		
		),
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'setProfileTaxonomyData' );

// PROFILE METABOXES

function setProfileContactInfo( $meta_boxes ) { // this shows the box were 
	$prefix = '';

	$meta_boxes[] = array(
		'id' => 'contact_info',
		'title' => esc_html__( 'CONTACT INFO', 'omniscience-profiler' ),
		'post_types' => array('profile' ),
		'context' => 'side',
		'priority' => 'low',
		'autosave' => 'false',
		'fields' => array(
				array(
				'id' => 'company',
				'type' => 'text',
				'name' => esc_html__( 'Company', 'mbg' ),
			),
			array(
				'id' => 'solution_name',
				'type' => 'text',
				'name' => esc_html__( 'Solution Name', 'mbg' ),
			),
			array(
				'id' => 'contact_name',
				'type' => 'text',
				'name' => esc_html__( 'Contact Name', 'mbg' ),
			),
			array(
				'id' => 'contact_title',
				'type' => 'text',
				'name' => esc_html__( 'Contact Title', 'mbg' ),
			),
			array(
				'id' => 'contact_email',
				'type' => 'text',
				'name' => esc_html__( '(private) Contact Email', 'mbg' ),
			),
			array(
				'id' => 'profile_email',
				'type' => 'email',
				'name' => esc_html__( '(public) Email Address', 'mbg' ),
			),
			array(
				'id' => 'phone',
				'type' => 'text',
				'name' => esc_html__( 'Phone Number', 'mbg' ),
			),
			array(
				'id' => 'address',
				'type' => 'text',
				'name' => esc_html__( 'Address', 'mbg' ),
			),
			array(
				'id' => 'address2',
				'type' => 'text',
				'name' => esc_html__( 'Address 2', 'mbg' ),
			),
			array(
				'id' => 'city',
				'type' => 'text',
				'name' => esc_html__( 'City', 'mbg' ),
			),
			array(
				'id' => 'state',
				'type' => 'text',
				'name' => esc_html__( 'State / Province', 'mbg' ),
			),
			array(
				'id' => 'postal_code',
				'type' => 'text',
				'name' => esc_html__( 'Postal Code', 'mbg' ),
			),
			array(
				'id' => 'country',
				'type' => 'text',
				'name' => esc_html__( 'Country', 'mbg' ),
			),
		
		),
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'setProfileContactInfo' );


function selectThis( $meta_boxes ) {
	$prefix = '';

	$meta_boxes[] = array(
		'id' => 'hardware',
		'title' => esc_html__( 'HARDWARE!', 'mbg' ),
		'post_types' => array('profile'),
		'context' => 'side',
		'priority' => 'default',
		'autosave' => 'false',
		'fields' => array(
			array(
				'id' => $prefix . 'hardware',
				'type' => 'post',
				'name' => esc_html__( 'Hardware', 'mbg' ),
				'post_type' => 'hardware',
				'field_type' => 'checkbox_list',
				'query_args' => array(
					'post_category' => 'author',
				),
			),
		),
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'selectThis' );

function setProfileURL( $meta_boxes ) { // this shows the box were 
	$prefix = '';

	$meta_boxes[] = array(
		'id' => 'profile_info',
		'title' => esc_html__( 'PROFILE', 'omniscience-profiler' ),
		'post_types' => array('profile' ),
		'context' => 'side',
		'priority' => 'high',
		'autosave' => 'false',
		'fields' => array(
			array(
				'id' => $prefix . 'url',
				'type' => 'url',
				'name' => esc_html__( 'URL', 'omniscience-profiler' ),
				'desc' => esc_html__( 'Enter URL for the Resource to Profile', 'omniscience-profiler' ),
			),
			array(
				'id' => $prefix . 'logo',
				'type' => 'image_advanced',
				'name' => esc_html__( 'Logo', 'omniscience-profiler' ),
				//'desc' => esc_html__( 'Size to 1920x1280', 'mbg' ),
			),
			array(
				'id' => 'screenshot',
				'type' => 'image_advanced',
				'name' => esc_html__( 'Screenshots', 'mbg' ),
				'desc' => esc_html__( 'submitted with', 'mbg' ),
				'force_delete' => false,
				'max_file_uploads' => '10',
				'options' => array(),
				'attributes' => array(),
			),

			array(
				'id' => $prefix . 'use_cases',
				'type' => 'textarea',
				'name' => esc_html__( 'Use Cases', 'mbg' ),
			),
						array(
				'id' => $prefix . 'tagline',
				'type' => 'textarea',
				'name' => esc_html__( 'Tagline', 'mbg' ),
			),
						array(
				'id' => $prefix . 'unique_value_proposition',
				'type' => 'textarea',
				'name' => esc_html__( 'Unique Value Proposition', 'mbg' ),
			),
						array(
				'id' => $prefix . 'collaboration_types',
				'type' => 'textarea',
				'name' => esc_html__( 'Collaboration Types', 'mbg' ),
			),
					
						array(
				'id' => $prefix . 'max_spectators',
				'type' => 'number',
				'name' => esc_html__( 'Max spectators', 'mbg' ),
			),
						array(
				'id' => $prefix . 'max_collaborators',
				'type' => 'number',
				'name' => esc_html__( 'Max Collaborators', 'mbg' ),
			),
					array(
					'id' =>  'demo_video',
					'type' => 'url',
					'name' => esc_html__( 'Demo Video', 'omniscience-profiler' ),
				),



           				array(
					'id' =>  'wikipedia',
					'type' => 'url',
					'name' => esc_html__( 'Wikipedia URL', 'omniscience-profiler' ),
				),

				array(
					'id' =>  'linkedin',
					'type' => 'url',
					'name' => esc_html__( 'LinkedIn URL', 'omniscience-profiler' ),
				),
				array(
					'id' =>  'twitter',
					'type' => 'url',
					'name' => esc_html__( 'Twitter URL', 'omniscience-profiler' ),
				),
				array(
					'id' =>  'facebook',
					'type' => 'url',
					'name' => esc_html__( 'Facebook URL', 'omniscience-profiler' ),
				),
				array(
					'id' =>  'flickr',
					'type' => 'url',
					'name' => esc_html__( 'Flickr URL', 'omniscience-profiler' ),
				),
				array(
					'id' =>  'instagram',
					'type' => 'url',
					'name' => esc_html__( 'Instagram URL', 'omniscience-profiler' ),
				),

			
				array(
					'id' =>  'Tumblr',
					'type' => 'url',
					'name' => esc_html__( 'Tumblr', 'omniscience-profiler' ),
				),
				array(
					'id' =>  'google_plus',
					'type' => 'url',
					'name' => esc_html__( 'Google Plus', 'omniscience-profiler' ),
				),

				array(
					'id' =>  'pinterest',
					'type' => 'url',
					'name' => esc_html__( 'Pinterest', 'omniscience-profiler' ),
				),


					array(
					'id' =>  'GitHub',
					'type' => 'url',
					'name' => esc_html__( 'Github', 'omniscience-profiler' ),
				),
				array(
					'id' =>  'medium',
					'type' => 'url',
					'name' => esc_html__( 'Medium', 'omniscience-profiler' ),
				),

				//comms
				array(
					'id' =>  'telegram',
					'type' => 'url',
					'name' => esc_html__( 'Telegram ', 'omniscience-profiler' ),
				),



				array(
					'id' =>  'slack',
					'type' => 'url',
					'name' => esc_html__( 'Slack', 'omniscience-profiler' ),
				),
				array(
					'id' =>  'skype',
					'type' => 'url',
					'name' => esc_html__( 'Skype', 'omniscience-profiler' ),
				),

				//video
				array(
					'id' =>  'youtube',
					'type' => 'url',
					'name' => esc_html__( 'YouTube Channel', 'omniscience-profiler' ),
				),
				array(
					'id' =>  'vimeo',
					'type' => 'url',
					'name' => esc_html__( 'Vimeo', 'omniscience-profiler' ),
				),

			array(
				'id' =>  'crunchbase',
				'type' => 'url',
				'name' => esc_html__( 'crunchbase URL', 'omniscience-profiler' ),
			),
							array(
					'id' =>  'rss',
					'type' => 'url',
					'name' => esc_html__( 'RSS Feed URL', 'omniscience-profiler' ),
				),
		
				



// URLs
			array(
				'id' => 'logo_url',
				'type' => 'text',
				'name' => esc_html__( 'Logo URL', 'omniscience-profiler' ),
			),
			array(
				'id' => 'logo_svgtag',
				'type' => 'text',
				'name' => esc_html__( 'Logo SVG', 'omniscience-profiler' ),
			),
			array(
				'id' =>  'contact_url',
				'type' => 'url',
				'name' => esc_html__( 'Contact URL', 'omniscience-profiler' ),
			),
			array(
				'id' =>  'blog_url',
				'type' => 'url',
				'name' => esc_html__( 'Blog URL', 'omniscience-profiler' ),
			),
			array(
				'id' =>  'apply_url',
				'type' => 'url',
				'name' => esc_html__( 'Apply URL', 'omniscience-profiler' ),
			),
			array(
				'id' =>  'jobs_url',
				'type' => 'url',
				'name' => esc_html__( 'Jobs URL', 'omniscience-profiler' ),
			),
			array(
				'id' =>  'events_url',
				'type' => 'url',
				'name' => esc_html__( 'Events URL', 'omniscience-profiler' ),
			),
			array(
				'id' =>  'conference_url',
				'type' => 'url',
				'name' => esc_html__( 'Conference URL', 'omniscience-profiler' ),
			),
				array(
				'id' =>  'developers_url',
				'type' => 'url',
				'name' => esc_html__( 'Developers URL', 'omniscience-profiler' ),
			),
			
		),
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'setProfileURL' );




function setProfileResearch( $meta_boxes ) { // this shows the box where the scrape and search results
	$prefix = '';

	$meta_boxes[] = array(
		'id' => 'profiler',
		'title' => esc_html__( 'PROFILE RESEARCH', 'omniscience-profiler' ),
		'post_types' => array('profile' ),
		'context' => 'advanced',
		'priority' => 'high',
		'autosave' => 'false',
		'fields' => array(
			array(
				'id' => $prefix . 'card',
				'type' => 'custom_html',
				 //'std'  => '<div class="alert alert-warning">This is a custom HTML content</div>',
				 'callback' => 'profile_menu',
			),
            array(
				'id' => $prefix . 'profile_results',
				'type' => 'custom_html',
				 //'std'  => '<div class="alert alert-warning">This is a custom HTML content</div>',
				 'callback' => 'profiler',
			),
			array(
				'id' => 'search_content',
				'type' => 'textarea',
				'name' => esc_html__( 'Saved Search', 'mbg' ),
			),
			array(
				'id' => 'scraped_content',
				'type' => 'textarea',
				'name' => esc_html__( 'Saved Scrape', 'mbg' ),
			),
			array(
				'id' => 'lang',
				'type' => 'text',
				'name' => esc_html__( 'Language', 'mbg' ),
				'size' => 5,
			),
		),
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'setProfileResearch' );

function getImg($src){
	@$_GET['addImg'] = $src; // the php way. 
	return addImageToLibrary();
	
}




function addImageToLibrary($title,$path){ // THIS ADDS AN IMAGE TO THE MEDIA LIBRARY FROM A SRC URL.
	global $post;
	$image_url = $path;//strtok(@$_GET['addImg'],"?");

	$upload_dir = wp_upload_dir();

	$image_data = file_get_contents( $image_url );
	$ext = pathinfo($image_url, PATHINFO_EXTENSION);
	if($ext ==  ''){
		$filename = basename($image_url);
	} else {
		$filename = basename( sanitize_file_name($title).".".$ext );
	}
	if ( wp_mkdir_p( $upload_dir['path'] ) ) {
	$file = $upload_dir['path'] . '/' . $filename;
	}
	else {
	$file = $upload_dir['basedir'] . '/' . $filename;
	}

	file_put_contents( $file, $image_data );

	$wp_filetype = wp_check_filetype( $filename, null );
	
	$attachment = array(
		'post_mime_type' => $wp_filetype['type'],
		'post_title' => $title,
		'post_excerpt' => '',
		'post_content' => '',
		'post_status' => 'inherit'
	);

	$attach_id = wp_insert_attachment( $attachment, $file );
	require_once( ABSPATH . 'wp-admin/includes/image.php' );
	$attach_data = wp_generate_attachment_metadata( $attach_id, $file );
	wp_update_attachment_metadata( $attach_id, $attach_data );
	update_post_meta($attach_id, '_wp_attachment_image_alt', $title);
	return $attach_id;
}


function profile_events() {
	if(@$_GET['addImg']){

		addImageToLibrary($_GET['addImg']);
	}

	//THIS IS A HACK, needs to be done right. 
	//Gutternberg doesn't update the dom
	if(@$_GET['updateExcerpt']){
		 $my_post = array(
      'ID'           => @$_GET['POST'],
	  
      'post_excerpt' => json_decode($_GET['updateExcerpt']),
		);

		// Update the post into the database
		wp_update_post( $my_post );
		
	}
	if(@$_GET['updateContent']){

	
	}
	if(@$_GET['updateTitle']){

	
	}


}
add_action( 'admin_init', 'profile_events' );