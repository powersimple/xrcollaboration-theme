<?php

get_header(); 
$postmeta = get_post_meta($post->ID);
$screenshots = $postmeta['screenshot'];
 
$logo = $postmeta['logo'];

$company = $postmeta['company'];
 $solution_name = $postmeta['solution_name'];



$screenshot_array = array();
foreach($screenshots as $key => $image_id){
  array_push($screenshots,getThumbnail($image_id,"hero"));

}
//print json_encode($screenshot_array);
?>

<main role="main">

  <section class="module" id="<?php echo @$slug?>" role="region">
<div class="row">
<div class="container">
 
  <div class="col-xs-12 col-sm-offset-2 col-sm-8 col-offset-3 col-md-6 ">

   <h1><?=$post->post_title?></h1>
<?php

var_dump($logo);
//var_dump($screenshots)."<br>";
  print do_blocks(do_shortcode($post->post_content));
   $postmeta = get_post_meta($post->ID);
  foreach($postmeta as $key => $value){
    print "<BR>$key".var_dump($value)."<br>";
  }
?>
</div>
</section>
</div>

</div>
  </main>
  <?php get_footer(); ?>