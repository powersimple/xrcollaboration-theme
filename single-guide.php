<?php get_header();




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


 $properties = get_page_properties_print($post);
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
  <section class="module <?=$print_template?>" id="<?php echo @sanitize_title($post->post_title);?>" role="region">
<div class="row">
<div class="container">
        
    <?php
    echo replace_vars($post->post_content,$post->post_name);
    ?>
    
</div>

</div>
</section>

<?php
    }

    $content = ob_get_clean();



?>


<?php



echo $content;
?>

</main>
<?php

    get_footer();



?>
</body>
</html>