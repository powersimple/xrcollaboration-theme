<?php
 if(@$_GET['publish_specs']){
            header('Content-Type: application/json');
            $content = json_encode(getHardwareFields(),true); // writes the whole shebang into a json packet
            
            writeJSON($server_path."hardware.json",$content);
            print $content;

            
            die();//kills the page load so you can see the endpoint urls
        }
get_header(); 

  


  
  //$spectators = json_encode(getMetaMax('max_spectators'));

 


?>
<script>
   var profile_template = 'hardware'

  var max = {}
/
jQuery(document).ready(function() {
  
   
});

</script>
   
    <div id="profile-template" style="display:none;">
      <div class="row">
          
      </div>
  
    </div><!--template-->

<main role="main">

  <section class="module" id="<?php echo @$slug?>" role="region">
 
<div class="row">
    <div class="container">
    <script>
   
    

</script>
    <h1><?=$post->post_title?></h1>
    <div class="col-sm-3" id="directory-filters">
            <h4>Choose Filters below</h4>
            

            <div id="hardware-accordion" class="hardware-filters"></div>
            

            
        </div>
        <div class="col-sm-9" id="hardware-directory">
        

        <div id="active-profile">
        <?php

       




          print do_blocks($post->post_content);
        ?>
        </div>

        
        
        
      
        
          <div id="psa">          
          <a href="/cleanbox/"><img class="banner-product" src="/wp-content/uploads/2021/01/omniclean-2-1.png"></a>
          <p><img class="banner-logo" src="/wp-content/uploads/2021/01/cleanbox-1.png">Virtual meetings are the new normal, driving the need for reliable device hygiene solutions. Cleanbox Technology makes it easy to decontaminate XR headsets, eyewear, surgical and protective masks, and personal electronics.</p>
          <a class="wp-block-button__link" href="/cleanbox/">LEARN MORE</a>
          </div>
          <div id="active_filters"></div>
          <div id="active_profiles"></div>
        
        
        
        
        </div>
      
  


  


</div>

</div>
</section>
  </main>
  <script>
  var hardware_fields = <?= json_encode(getHardwareFields()); ?>;
jQuery(document).ready(function() {
  
    setHardwareAccordion(hardware_fields); //hardware_hub.js
  var hardware_results = displayAllHardwareResults();
     jQuery("#profile_logos").html(hardware_results)
   //  console.log("hardware",hardware_fields)

});
 
  
  </script>
  <?php 

    get_footer(); 
 
    ?>
    <script>
   

  </script>
