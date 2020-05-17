<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); 
    $url = wp_upload_dir();
?>
  <script>
      // Wordpress PHP variables to render into JS at outset.
      var active_id = <?=$post->ID?>,
      active_object = "<?=$post->post_type?>",
      home_page = <?=get_option( 'page_on_front' )?>,
      site_title = "<?=get_bloginfo('name')?>",
      xr_path = "<?=get_stylesheet_directory_uri()?>/xr/",
      data_path = "<?=get_stylesheet_directory_uri()?>/data/",
      useWheelNav = false,
      uploads_path =  "<?=$url['baseurl']?>/"
     
      
      <?php
          if(function_exists('icl_object_id')){
              global $sitepress;
              print "var languages = ".json_encode(getLanguageList());
            

          }
      ?>

  </script>
  <link rel="stylesheet" type="text/css" media="print" href="<?=get_stylesheet_directory_uri()?>/print.css">
</head>



  <body data-spy="scroll" data-target=".onpage-navigation" data-offset="60" class="<?php echo $class_bg;?>">


      <div class="page-loader">
        <div class="loader">Loading...</div>
      </div>
            
        <div class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">   
          <div id="pinned-nav"></div>   
          <?php
         if ( is_active_sidebar('register')){
            dynamic_sidebar("register");
            }
         ?>
          <div id="logo" class="onpage-navigation"><img src="<?=get_stylesheet_directory_uri()?>/images/logo/logo.svg"></div> 

                    <div id="site-title" class="onpage-navigation"><?=bloginfo("description");?></div>
                    <div id="main-menu"></div>
                  
            </div>wow
      </div>
      
      
<?php

//$hero = getHero(@$post->ID);
if(@$hero == ''){
  //$hero = '/images/photos/GA-view.jpg';
}
 
?>
