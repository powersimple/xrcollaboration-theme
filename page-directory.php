<?php

get_header(); 

  function getMetaMax($field){
    global $wpdb;
    $sql = "SELECT distinct meta_value  FROM `wp_postmeta` WHERE `meta_key` LIKE '%$field%' order by meta_value";
    $q = $wpdb->get_results($sql);
    $results = array();
    foreach($q as $key => $value){
      if($value->meta_value <> NULL){
      $ids = "SELECT post_id  FROM `wp_postmeta` WHERE `meta_key` LIKE '%$field%' and meta_value = $value->meta_value order by post_id";
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
  
  $spectators = json_encode(getMetaMax('max_spectators'));
  $collaborators = json_encode(getMetaMax('max_collaborators'));

  

?>
<script>
  var max = {}
  max.spectators = <?=$spectators?>;
  max.collaborators = <?=$collaborators?>;

  console.log("spectators",max.spectators)

  console.log("collaborators",max.collaborators)

jQuery(document).ready(function() {
  getStatPosts()
});

</script>


<main role="main">

  <section class="module" id="<?php echo @$slug?>" role="region">
<div class="row">
    <div class="container">
        <div class="col-sm-3 bg-dark" id="directory-filters">
            <h4>Choose Filters below</h4>
            <div class="slider-container"><div id="collaborators">Collaborators</div>
            <div id="max-collaborators" class="slider"></div>
</div>
<div class="slider-container"><div id="spectators">Spectators</div>
              <div id="max-spectators" class="slider"></div>
</div>
            <div id="filter-accordion" class="filters"></div>
        </div>
        <div class="col-sm-9">
        <h1><?=$post->post_title?></h1>

        <div id="active-profile"></div>

        <?php

       




          print do_blocks($post->post_content);
        ?>
        
        
        
        <div>
<script>
          <?php



 


?>
</script>

        </div>
        
          <div id="active_filters"></div>
          <div id="profile_logos"></div>
        
        
        
        
        </div>
        





  


</div>

</div>
</section>
  </main>
  <?php get_footer(); ?>
