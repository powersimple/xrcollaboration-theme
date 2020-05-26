<?php 
   get_header();


 $author_menu = sectionMenu("authors",'thumbnail','4');
 $sponsor_menu = sectionMenu("sponsors",'logo','4');
 $sponsor_menu = sectionMenu("video_conf",'logo','3');
 $guide_parent = 620;
 $guide_content = compileGuide($guide_parent);





?>
<html>
    <head>
<style>

</style>
<head>
    <body>
<main role="main" id="main">

<?php
ob_start();

foreach($guide_content as $key => $value){
 $properties = get_page_properties_print($value);
    extract((array) $properties);

    if($print_template == 'front_page'){
        $bleed = "";
        if(@$full_bleed == "1"){
            $bleed = 'full-bleed';

        }

        ?>
  <section class="<?=$print_template?> <?=$bleed?>" id="<?php echo @sanitize_title($value->post_title);?>" role="region">
        
        <img src="<?php print getThumbnail($hero);?>">
        
    </section>
  <?php

    } else {
?>
  <section class="module <?=$print_template?>" id="<?php echo $value->post_name;?>" role="region">
<div class="row">
<div class="container">

    <?php
    echo do_blocks($value->post_content);
    ?>
    

</div>

</div>
<div class="row page-footer">&copy;2020 XR IGNITE INC - PLEASE SHARE THIS PUBLICATION! - <a href="https://xrcollaboration.com"><strong>XR</strong>COLLABORATION.COM</a><br><span class="dots"><?php include "images/footer-dots-01.svg";?></div>

</section>

<?php
    }
}
echo $content = replace_vars(ob_get_clean(),"compiled");





?>

</main>
<?php

    get_footer();



?>
</body>
</html>