

<?php
global $year;
$year = "2019";
global $conf_year;
$conf_year = "6th";
//global $conf_year = "6th";

get_header(); 


                    
?>

<section class="home-section home-parallax home-fade home-full-height" id="home">
<div id="particles-js"></div>
      <div id="bg-video" class="hero-video">
          <video id="video" controls="true " autoplay="autoplay" muted="muted" preload="auto" loop="loop">
              <source src="#" type="video/mp4">
          </video>
          
      </div>

        <div class="hero-slider">
       
          <ul class="slides">
          <?php
          
    $slides = get_slides($post->ID);
    foreach ($slides as $key => $media_id) {
       $src= wp_get_attachment_image_src( $media_id,"Full");
       //var_dump($src);//var_dump(get_media_data($media_id));
       $media_data = get_media_data($media_id);
      // var_dump($media_data);
        extract((array) get_media_data($media_id));
        
        ?>

          
            <li id="slide-<?=$key?>" class="bg-dark-30 bg-dark">
              <!--
              <div class="titan-caption">
                <div class="caption-content">
                 <div class="font-alt mb-30 titan-title-size-2"></div>
                  <div class="font-alt mb-40 titan-title-size-4"><?php echo $title?></div><a class="section-scroll btn btn-border-w btn-round" href="#about"><?php echo wpautop($desc) ?></a>

                </div>
              </div>-->
            </li>
            <?php
            }
          ?>


          </ul>
          
        </div>
      </section>
      <main class="main" role="main">

  <section class="module" id="<?php echo @$slug?>" role="region">
<div class="row">
<div class="container">
  <div class="col-sm-2 col md-3"></div>
  <div class="col-xs-12 col-sm-8 col md-6">
  <h1><?=$post->post_title?></h1>
<?php

  print do_blocks($post->post_content);
?>
</div>
</div>

</div>
</section>

        
      <?php
 //require_once('lava.html');
$pages = array();// get_home_children();
foreach($pages as $key => $value){
  //var_dump($value);
  extract((array)$value);

  if(!get_post_meta($ID,"redirect",true)){ //don't render if external url.

  

  ?>
      <section class="module" id="<?php echo $slug?>">
          <div class="container">
            <?php
            if(file_exists (get_stylesheet_directory()."/page-$slug.php") ){
         //     var_dump($value);
              require_once(get_stylesheet_directory()."/page-$slug.php"); // includes page-slug.php if it exists
            } else {
            ?>
            <div class="row cols-sm-8 col-sm-offset-4">
              <div class="section-thumbnail col-sm-4"></div>
              <div class="section-content  col-sm-8">

                <h2 class="module-title font-alt"><?php echo $title?></h2>
                  <?php echo wpautop($content);?>
                  

                </div> <img  src="<?=$thumbnail?>">
              </div>
            
            </div>
            
            <?php 
              } 
            ?>

          </div>
         
           <?php
          }
          ?>
        </section>
        <?php 
          
          if(trim(@$section_foot) != ''){
            ?><div class="section-foot">
              <img  src="<?php echo getThumbnail($section_foot,"Full");?>">

        </div>
       

<?php
    }
  }
  ?>
  </main>
  <?php get_footer(); ?>