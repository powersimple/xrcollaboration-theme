<?php




    function parseTaxonomyList($field,$delimiter=","){
        global $wpdb;
        $sql = "select id, $field from xr_profiles";
        $q = $wpdb->get_results($sql);
        $tax = array();
        foreach($q as $key => $value){
            extract((array) $value);
            $results = explode($delimiter,$$field);
            foreach ($results as $item => $result) {
                $result = str_replace("\"","",$result);
                if(!array_key_exists($result,$tax) && $result != ''){
                    $tax[stripLabel($result)] = array();
                   // print "<strong>$result</strong><BR>";
                    }
                   // $tax[$result] = array_push($tax,$id);
//                    print 
            }
//            print "</ol>";
        }
        return $tax;
    }
    function displayTaxList($label,$results){
        print "<strong>$label</strong>
        <ol>";
        foreach ($results as $item => $result) {
            print "<li>$item</li>";
        }
        print "</ol>";
    }

function stripLabel($string){
    $string = str_replace("\"","",$string);
    $string = str_replace(")","",$string);
    $string = str_replace("{","",$string);
    $string = str_replace("\"","",$string);
    
    return $string;
} 






 function getTable($table,$sort){
        global $wpdb;
        $sql = "select * from $table where wp_post = 0 order by $sort";
        $q = $wpdb->get_results($sql);
        $profiles = array();
        foreach($q as $key => $value){
            
            array_push($profiles,(array) $value);

         }
        return $profiles;
    }


    function alignProfiles($profiles){
         global $wpdb;
         print "<ul>";
        foreach($profiles as $key => $profile){
            extract((array) $profile);
            $sql = "select * from omni_data where xrc_profile_id = 0 and lower(trim(name)) = '".trim(strtolower(str_replace("'","\'",$solution_name)))."'";
            $q = $wpdb->get_results($sql);
            $profiles = array();
            if(count($q) == 0){
               print "<strong>$company not found<BR>";
            }
            foreach($q as $key => $result){


//            print "<li>$result->id $company</li>";
                
       // print   $update = "update omni_data set xrc_profile_id = $id where id = $result->id;<BR>";
            }
    //       print "$company<br>";
        }
         print "</ul>";


    }
    
   
 function reconcile(){
        global $wpdb;
        $sql = "select id, xrc_profile_id, company, solution_name from xrc_profiles where omni_id = 0";
        $q = $wpdb->get_results($sql);
  //      $profiles = array();
        foreach($q as $key => $value){
  
        
        }
       // return $profiles;
    }
   // reconcile();

   function getMediaArray($media){
            $images = array();
          //  print $media;
            if(trim($media) != ''){
                $media_array = explode(",",$media);
                foreach($media_array as $key => $value){
                    $value = str_replace(")","",$value);
                    $value = str_replace(" (","|",$value);
                    $value = explode("|",$value);
                   
                    array_push($images,array("title"=>$value[0],
                        "path"=>$value[1]
                ));
               
                }
            }
            return $images;

   }
   function getDirContents($dir){
        
    //$dir = scandir("/Users/benerwin/Clients/XRIgnite/XRCollaboration/ PrintedGuide/logosforimport");
    foreach(scandir($dir) as $key => $value){
        print "$value<BR>";
    }


   }

        
    function importTaxonomy(){
           global $wpdb;
         $sql = "select * from xr_terms where id>1";
        $q = $wpdb->get_results($sql);
        print "<ol>";
        foreach($q as $key => $value){
            extract((array) $value);
      print "<li>$id $term<";
            if(is_taxonomy_hierarchical($taxonomy )){
            var_dump(wp_insert_term($term,$taxonomy,array('description'=>"$description",'parent'=>$parent)));
            } else {
            var_dump(wp_insert_term($term,$taxonomy,array('description'=>"$description")));
                
            }
            print "</li>";
      //print "$term added$parent</li>";
        }
        print "</ol>";

    }
    if(@$_GET['import_tax']){
     //   importTaxonomy();
    }




    function getProfile($profile_id){
        global $wpdb;
         $sql = "select * from xr_profiles where id = $profile_id order by company";
        $q = $wpdb->get_row($sql);
        return (array) $q;
    }


   if(@$_GET['profile_id']){
       $profile = getProfile($_GET['profile_id']);

      
           importProfile($profile);
    
   }

 //  getProfiles($profiles);
   $profiles_array = array();

   function matchTax($tax,$data){
        global $wpdb;
        //print "<BR><strong>Taxonomy $tax</strong><BR>";
        $matches = array();
        foreach(explode(",",$data) as $key=>$value){
            if($value != NULL){

                $sql = "select term_taxonomy_id as id from wp_term_taxonomy where description = '".str_replace("'","\'",$value)."'";
                
                $q = $wpdb->get_row($sql);
                if($q){
                    array_push($matches,$q->id);
                }
//                print "$value|<BR>";
            }

        }
        return implode(",",$matches);
        
       // $sql = "select * from wp where id = $profile_id order by company";
      //  $q = $wpdb->get_row($sql);
       // return (array) $q;

   }

   function insert_term_rel($id,$post_categories){
       global $wpdb;
        $insert_rel = "INSERT INTO `wp_term_relationships` (`object_id`, `term_taxonomy_id`, `term_order`) VALUES ";
        $values_array = array();
        foreach($post_categories as $key => $value){
            array_push($values_array,"('".$id."', '$value','0')");
        }
        $insert_rel.=implode(",",$values_array).";";
        print $insert_rel;
       $q = $wpdb->query($insert_rel);
   }


   function importProfile($profile){       
          global $wpdb;

           extract($profile);
           $omni_meta = $wpdb->get_row("select * from omni_data where id = $omni_id");
            extract((array) $omni_meta) ;

            print "<br><strong>$company</strong><br>";
            print "$tagline<br>";
            print "$description<br>";

            

          
            $profile_meta = array(
                // from xr_profiles table
                "use_cases" => $use_cases,
                "company" => $profile['company'],
                
                "solution_name" => $solution_name,
                "unique_value_proposition" => $unique_value_proposition,
                "collaboration_types" => $collaboration_types,
                "demo_video" => $short_video,
                "max_spectators" => $max_spectators,
                "max_collaborators" => $max_collaborators,
                "profile_logo" => @$profile_logo,
                "description" => $description,
                "url" => $website,
                
                //contact
                "contact_name" => "$contact_name",
                "contact_title" => "$contact_title",
                "contact_email" => "$contact_email",

                "profile_email" => @$profile_email,

                "phone" => "$phone",

                 "address" => "$address",
                "address2" => "$address2",
                "city" => "$city",
                "state" => "$state",
                "postal_code" => "$postal_code",
                "country" => "$country",
                "email" => "$email",
                //social
                "twitter" => "$twitter",
                "facebook" => "$facebook",
                "linkedin" => "$linkedin",
                "github" => "$github",
                "medium" => "$medium",
                "slack" => "$slack",
                "telegram" => "$telegram",
                "skype" => "$skype",
                "instagram" => "$instagram",
                "snapchat" => "$snapchat",
                "foursquare" => "$foursquare",
                "youtube" => "$youtube",
                "vimeo" => "$vimeo",
                "tumblr" => "$tumblr",
                "google_plus" => "$google_plus",
                "pinterest" => "$pinterest",
                "dribbble" => "$dribbble",
                "behance" => "$behance",
                "flickr" => "$flickr",
                "rss" => "$rss",
                "crunchbase" => "$crunchbase",
         
                "contact_url" => "$contact_url",
                "jobs_url" => "$jobs_url",
                "apply_url" => "$apply_url",
                "events_url" => "$events_url",
                "conference_url" => "$conference_url",

                // taxonomy captured [to be retired]
                "features" => "$features",
                "platform" => "$platform",
                "hardware" => "$hardware",
                "industries" => "$industries",
                "industry_subtags" => "$industry_subtags",
                "feature_subtags" => "$feature_subtags",
                
                //SEO
                "_yoast_wpseo_focuskw" => substr($use_cases,0,185)."..",
                "_yoast_wpseo_twitter-description" => "$tagline",
                "_yoast_wpseo_twitter-title" => "$company $solution_name | XR Collaboration",
                "_yoast_wpseo_opengraph-description" => "$description",
                "_yoast_wpseo_metadesc" => "$tagline",
                "_yoast_wpseo_opengraph-title" => "$company $solution_name | XR Collaboration"

                
                
            );
            
            // PREPARES TAXONOMY
            $cats = array();
            array_push($cats,matchTax('feature',$profile_meta['feature_subtags']));
            array_push($cats,matchTax('industry',$profile_meta['industry_subtags']));
            array_push($cats,matchTax('platform',$profile_meta['platform']));
            array_push($cats,matchTax('collaboration_types',$profile_meta['collaboration_types'])); 
            $post_categories = explode(",",implode(",",$cats)); //RETURNS ARRAY OF CONCATENATED KEYS FOR INSERT
            var_dump($post_categories);
         $profile_post = array(
                'post_title'    => wp_strip_all_tags( $company ),
                'post_content'  => $description,
                'post_excerpt'  => $tagline,
                'post_status'   => 'publish',
                'post_author'   => 1,
                //  'post_category' => array( 8,39 )
                'post_type' => 'profile'
            );

            //insert_term_rel(0,$post_categories);

            foreach($post_categories as $key => $value){
             //   print "insert into wp_term_relationships (object_id, term_taxonomy_id) values (0,$value);<BR>";
            }

            // var_dump($profile_post);
            print "<BR>";
           // var_dump($profile_meta);
            print "<BR>";

          if(@$_GET['import'] && $wp_post == 0){

            $logo_array = getMediaArray($logo);

            foreach($logo_array as $key => $value){
                print "$value[path]<br>";
                addImageToLibrary($company."-logo $key",$value['path']);
                }
                
            $media_array = getMediaArray($media);
           $media_ids = array();



            foreach($media_array as $key => $value){
                print "$value[path]<br>";
                $attach_id = addImageToLibrary($company."image$key",$value['path']);


                array_push($media_ids, $attach_id);
               
                $versions = getThumbnailVersions($attach_id);
//                var_dump($versions);

                if($key == 0){
                    $seo_images = array(
                        "_yoast_wpseo_twitter-image-id" => "$attach_id",
                        "_yoast_wpseo_twitter-image" => @$versions['tw'],
                        "_yoast_wpseo_opengraph-image" =>@$versions['og'],
                    );
                    //var_dump($seo_images);

                }
            }

// Insert the post into the database

print "NEW POST ID =".$new_post = wp_insert_post( $profile_post );

               insert_term_rel($new_post,$post_categories);

          if($svg_url != ''){ // svg logo
                $logo = addImageToLibrary($company."svg-logo",$svg_url);
                 add_post_meta( $new_post,'profile_logo',$logo, false );
            }

            foreach($profile_meta as $meta_key => $meta_value){ // profile info
              add_post_meta( $new_post,$meta_key,$meta_value, false );
            }

            foreach($seo_images as $meta_key => $meta_value){ // share images for FB and TGwitter
              add_post_meta( $new_post,$meta_key,$meta_value, false );
            }
            
//            var_dump($media_ids);
            foreach($media_ids as $key=>$value){
  //              print "<BR>screenshot".$value;
                //var_dump($value);
               
              add_post_meta( $new_post,"screenshot", $value, false );
            }
   
                $q = $wpdb->query("update xr_profiles set wp_post = $new_post where id = $_GET[profile_id]");

            //var_dump($profile);
}
            print "<br>";
       

   }
   function updateImported($id){
       $sql = "update xr_profiles set imported = 1 where 1=$id";
                
                $q = $wpdb->query($sql);
              
   }


 function getProfileTaxonomy($profiles){
        $profile_array = array();
        $lists = "features,platform,hardware,industries,feature_subtags,industry_subtags";
        foreach($profiles as $item =>$profile){
        foreach(explode(",",$lists) as $key =>$tax){
                print "<BR><strong>$tax</strong> <BR>";
                print $profile[$tax]." <BR>";   
            }
        break;
            }
        
     
 }    
 
   $profile_list = getTable("xr_profiles","company");
   displayProfileList($profile_list);
   function displayProfileList($profileList){
        print "<ul>";
            foreach($profileList as $key=> $value){
                print "<li><a href='?profile_id=$value[id]'>$value[company]</a> <a href='?profile_id=$value[id]&import=1'>import</a></li>";
            }

        print "</ul>";

    }
 /*
 $taxonomy = getProfileTaxonomy($profile_list);
    $lists = "features,platform,hardware,industries,feature_subtags,industry_subtags";
    $taxonomies = array();
    foreach(explode(",",$lists) as $key=>$item){
       
        $taxonomies[$item] = displayTaxList(ucfirst($item),parseTaxonomyList($item,","));
    }
*/
  
?>