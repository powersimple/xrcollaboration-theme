<?php 
   get_header();


 $author_menu = sectionMenu("authors",'thumbnail','4');
 $sponsor_menu = sectionMenu("sponsors",'logo','4');

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
  <section class="module <?=$print_template?>" id="<?php echo @sanitize_title($value->post_title);?>" role="region">
<div class="row">
<div class="container">

    <?php
    echo do_blocks($value->post_content);
    ?>

</div>

</div>
</section>

<?php
    }
}
$content = ob_get_clean();


$content = str_replace("{{TOC}}",getTOC($content,"compiled","anchor"),$content,);

$content = auto_id_headings($content);

$content = str_replace("{{sponsor_menu}}",$sponsor_menu,$content);
$content = str_replace("{{authors}}",$author_menu,$content);

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