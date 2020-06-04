<?php


/*WP REST API CUSTOM ENDPOINTS. RETURNS SPECIFIC THUMBNAIL URL*/ 


/*
	CUSTOM MENU ROUTING
*/

function get_menu() {
    # Change 'menu' to your own navigation slug.
    return wp_get_nav_menu_items('menu');
}

add_action( 'rest_api_init', function () {
		register_rest_route( 'myroutes', '/menu', array(
		'methods' => 'GET',
		'callback' => 'get_menu',
		'schema' => null
		) 


	);
} );


/* 
	media
*/

add_action( 'rest_api_init', 'register_post_media' );
 function register_post_media() {
 

	register_rest_field( ['post','page','profile'], 'post_media', array(
		'get_callback' => 'get_post_media'

		)
	);
}

function get_post_media( $object ) { 

	$postmeta_media_fields = "hero,_thumbnail_id,featured_video,screen_image,logo";

	
	foreach(explode(",",$postmeta_media_fields) as $key  => $field){
		$media_id = get_post_meta($object['id'],$field,false);// returns Array, not string!!
		$post_media_data = array();
		foreach($media_id as $key => $value){
			array_push($post_media_data,get_media_data_by_id($value));
			
		}

		$post_media_urls[$field] = $post_media_data;
	
	}

	return $post_media_urls;


}







add_action( 'rest_api_init', 'register_media_data' );
 function register_media_data() {
 

	register_rest_field( 'attachment', 'data', array(//THE ROUTE IS MEDIA/the type is attachment
		'get_callback' => 'get_media_data'

		)
	);
}

function get_media_data_by_id($id){//this function builds the data for a lean json packet of media
		$data = array();   
	$url = wp_upload_dir();
	$upload_path = $url['baseurl']."/";
	$file_path = str_replace($upload_path,'',wp_get_attachment_url($id));
	$file = basename($file_path);
	$path = str_replace($file,"",$file_path);
	$mime = get_post_mime_type( $id );
	$meta  = (array) wp_get_attachment_metadata( $id,true);
	$full_path = wp_upload_dir();


	$meta_data = array();
	/*
	
		The meta data properties are only accessible inside a loop for some dumb reason.
	*/
	if(strpos($mime,'mage/') && !strpos($mime,'svg')){ // the i is left of so the strpos returns a postive value
		$meta_data = array();
		foreach($meta as $key => $value){
			if($key == 'width'){
				$meta_data['w'] = $value;
			} else if($key == 'height'){
				$meta_data['h'] = $value;
			} else if($key == 'sizes'){
				$meta_data['sizes'] = array();

				if(get_post_mime_type( $id ) != 'image/svg+xml'){// no need to size
					foreach($meta[$key] as $size_name => $props){
						$meta_data['sizes'][$size_name] = $meta[$key][$size_name]['file'];
					}
				}
			}

			//
		}
	} else {
		//let non image mimetypes pass their full metadata
		$meta_data = $meta;
	}
	$data = array(
	
		'alt' => get_post_meta($id,"_wp_attachment_image_alt",true),
		'caption' => wp_get_attachment_caption($id),
		'title'=> get_the_title($id),
		'desc' => wpautop(get_the_content($id)),
		'path'=> $path,
		'file' => $file,
		'mime' => $mime,
		'meta' => $meta_data,
		'full_path' => "/wp-content/uploads/".$path.$file
		
	);

 return $data;//from functions.php,

}

function get_media_data( $object ) { 
   
	return get_media_data_by_id($object['id']); // because this is a callback which passes in the full object and we want to be able to get the data elsewhere with just the id. 
}


 
/* 
Social_url
*/
add_action( 'rest_api_init', 'register_social_url' );
function register_social_url() {
 

	register_rest_field( ['social'], 'social_url', array(
		'get_callback' => 'get_social_url',
		'schema' => null,
		)
	);
}
 
function get_social_url( $object ) {
	
 return get_post_meta($object['id'],"social_url",true);//from functions.php,
}

/* 
Social_url
*/
add_action( 'rest_api_init', 'register_hardware_profiles' );
function register_hardware_profiles() {
 

	register_rest_field( ['hardware'], 'profiles', array(
		'get_callback' => 'get_hardware_profiles',
		'schema' => null,
		)
	);
}
 
function get_hardware_profiles( $object ) {
	
global $wpdb;
	$q = $wpdb->get_results("select post_id from wp_postmeta where meta_value = $object[id] order by post_id");
	$posts = array();
	foreach($q as $key=>$value){
		array_push($posts,$value->post_id);
	}


 return $posts;//from functions.php,
}



/* 
	IMAGES
*/
add_action( 'rest_api_init', 'register_thumbnail_url' );
function register_thumbnail_url() {
 

	register_rest_field( ['profile','page','post'], 'thumbnail_url', array(
		'get_callback' => 'get_thumbnail_url',
		'schema' => null,
		)
	);
}
 
function get_thumbnail_url( $object ) {
	
 return getThumbnailVersions($object['featured_media']);//from functions.php,
}


/* 
	IMAGE VERSIONS
*/

add_action( 'rest_api_init', 'register_thumbnail_url_versions' );
 function register_thumbnail_url_versions() {
 

	register_rest_field( array('profile','page','post'), 'thumbnail_versions', array(
		'get_callback' => 'get_thumbnail_versions',
		'schema' => null,
		)
	);
}
 
function get_thumbnail_versions( $object ) {

 return getThumbnailVersions( $object['id'] );//from functions.php,
}

/*
	Screen Images

*/
add_action( 'rest_api_init', 'register_screen_images' );
 function register_screen_images() {
 

	register_rest_field( array('profile','page','post'), 'screen_images', array(
		'get_callback' => 'get_screen_images'

		)
	);
}
 
function get_screen_images( $object ) {

 return get_post_meta($object['id'],"screen_image") ;//from functions.php,
}


/* 
	FEATURED VIDEO
*/

add_action( 'rest_api_init', 'register_featured_video' );
 function register_featured_video() {
 

	register_rest_field( array('profile','post','page'), 'featured_video', array(
		'get_callback' => 'get_featured_video',
		'schema' => null,
		)
	);
}
 
function get_featured_video( $object ) {
	$post_id = $object['id'];
	$video_id = get_post_meta($post_id,"featured_video",true);
	$url = wp_upload_dir();
	$path = $url['baseurl']."/";
		
		 
		$video = array(
			"video_id"=>$video_id,
			"video_url"=>get_post_meta($post_id,"featured_video_url",true),
			"video_aspect"=>get_post_meta($post_id,"video_aspect",true),
		);


	return @$video;//from functions.php,
}

/*
	REGISTER POST CATEGORIES		
*/

add_action( 'rest_api_init', 'register_post_cats' );

function register_post_cats() {

		register_rest_field( array('profile','post','page'), 'cats', array(
			'get_callback' => 'get_post_cats',
			'schema' => null,
		)
	);
}
function get_post_cats($object){
	$post_id = $object['id'];
	return wp_get_post_categories( $post_id,array( 'fields' => 'ids' ));
}

/*
	REGISTER POST TAGS		
*/
add_action( 'rest_api_init', 'register_post_tags' );

function register_post_tags() {

		register_rest_field( array('profile','post','page'), 'tags', array(
			'get_callback' => 'get_post_tags',
			'schema' => null,
		)
	);
}
function get_post_tags($object){
	$post_id = $object['id'];
	return wp_get_post_tags( $post_id,array( 'fields' => 'ids' ));
}


	add_action( 'rest_api_init', 'register_profile_info' );
		
	function register_profile_info() {
		
		register_rest_field( 'profile', 'info', array(
			'get_callback' => 'get_profile_info',
			'schema' => null,
			)
		);
	}
		
    function get_profile_info( $object ) {
        $post_id = $object['id'];
        $fields = "company,solution_name, unique_value_proposition,tagline,use_cases,max_spectators,max_collaborators,demo_video,url, description,email,facebook,flickr,GitHub,google_plus,instagram,linkedin,location,medium,pinterest,rss,skype,slack,telegram,Tumblr,twitter,vimeo,website,wikipedia,youtube,acronym,name,apply_url,blog_url,conference_url,contact_url,events_url,jobs_url,logo_svgtag,logo_url";

        $profile_info = array();

        foreach(explode(",",$fields) as $key =>$value){
            if(@get_post_meta($post_id,$value,true)  != ''){
                $profile_info[$value] = get_post_meta($post_id,$value,true);
            }
        }

        return $profile_info;
	}
	

add_action( 'rest_api_init', 'register_support_hardware' );
		
	function register_support_hardware() {
		
		register_rest_field( 'profile', 'support_hardware', array(
			'get_callback' => 'get_profile_hardware',
			'schema' => null,
			)
		);
	}
		
    function get_profile_hardware( $object ) {
        $post_id = $object['id'];
        $fields = "hardware";

        $profile_info = array();

        foreach(explode(",",$fields) as $key =>$value){
            if(@get_post_meta($post_id,$value,true)  != ''){
               
            }
        }

        return  $profile_info[$value] = get_post_meta($post_id,$value);
    }




/*


  function getMaxSpectators(){
    global $wpdb;
    $sql = "SELECT distinct meta_value  FROM `wp_postmeta` WHERE `meta_key` LIKE '%$max_spectators%' order by meta_value";
    $q = $wpdb->get_results($sql);
    $results = array();
    foreach($q as $key => $value){
      if($value->meta_value <> NULL){
      $ids = "SELECT post_id  FROM `wp_postmeta` WHERE `meta_key` LIKE '%$max_spectators%' and meta_value = $value->meta_value order by post_id";
      $r = $wpdb->get_results($ids);
        $post_ids = array();
        foreach($r as $meta => $post_results){
          array_push($post_ids,$post_results->post_id);
        }
      
      
      
      $results[$value->meta_value] = $post_ids;
        }


    }

    return  $results;
  }

/* COLLABORATORS */
/*
 
add_action( 'rest_api_init', function () {
		

register_rest_route( 'collaborators', '/collaborators(?:/(?P<id>\d+))?', [
   'methods' => WP_REST_Server::READABLE,
   'callback' => 'getMaxCollaborators',
   'args' => [
        'max_collaborators'
    ],
] );
	
} );

 

add_action( 'rest_api_init', 'register_max_collaborators' );
function register_max_collaborators() {
 

	register_rest_field( ['profile'], 'max_collaborators', array(
		'get_callback' => 'getMaxCollaborators',
		'schema' => null,
		)
	);
}
 
  function getMaxCollaborators(){
    global $wpdb;
    $sql = "SELECT distinct meta_value  FROM `wp_postmeta` WHERE `meta_key` LIKE '%$max_collaborators%' order by meta_value";
    $q = $wpdb->get_results($sql);
    $results = array();
    foreach($q as $key => $value){
      if($value->meta_value <> NULL){
      $ids = "SELECT post_id  FROM `wp_postmeta` WHERE `meta_key` LIKE '%$max_collaborators%' and meta_value = $value->meta_value order by post_id";
      $r = $wpdb->get_results($ids);
        $post_ids = array();
        foreach($r as $meta => $post_results){
          array_push($post_ids,$post_results->post_id);
        }
      
      
      
      $results[$value->meta_value] = $post_ids;
        }


    }

    return  $results;
  }

*/




	add_action( 'rest_api_init', 'register_seo_info' );
		
	function register_seo_info() {
		
		register_rest_field( 'seo', 'seo', array(
			'get_callback' => 'get_seo_info',
			'schema' => null,
			)
		);
	}
		
    function get_seo_info( $object ) {
        $post_id = $object['id'];
       

        $seo = array(
			
			"keyword"=>get_post_meta($post_id,"_yoast_wpseo_focuskw", true),
            "tw-desc" =>get_post_meta($post_id,"_yoast_wpseo_twitter-description", true),
                "tw-title" =>get_post_meta($post_id,"_yoast_wpseo_twitter-title", true),
                "og-desc" =>get_post_meta($post_id,"_yoast_wpseo_opengraph-description", true),
                "og-title" =>get_post_meta($post_id,"_yoast_wpseo_opengraph-title",  true),
                "tw-image" =>get_post_meta($post_id,"_yoast_wpseo_twitter-image",  true),
                "og-image" =>get_post_meta($post_id,"_yoast_wpseo_opengraph-image",  true),

			);

      

        return $seo;
    }





















   





/*WP REST API CUSTOM ENDPOINT. RETURNS SPECIFIC OBJECT OF profile INFO*/ 

	add_action( 'rest_api_init', 'register_project_info' );
		
	function register_project_info() {
		
		register_rest_field( 'project', 'project_info', array(
			'get_callback' => 'get_project_info',
			'schema' => null,
			)
		);
	}
		
		function get_project_info( $object ) {
		$post_id = $object['id'];
			$project_info = array(
				"title"=>get_post_meta($post_id,"project_title",true),
				"url"=>get_post_meta($post_id,"project_url",true),
				"client"=>get_post_meta($post_id,"project_client",true),
				"agency"=>get_post_meta($post_id,"project_agency",true),
				"era"=>get_post_meta($post_id,"project_era",true)
			);



		return $project_info;
		}
/*
		/project info endpoint
*/
//without this the widgets and menus options in wp-admin disappear.
if ( function_exists('register_sidebars') ){
    register_sidebar( array(
        'name' => __( 'Footer', 'powersimple' ),
        'id' => 'footer',
        'description' => __( '', 'powersimple' ),
        'before_widget' => '',
	'after_widget'  => '',
	'before_title'  => '',
	'after_title'   => '',
    ) );
}


?>