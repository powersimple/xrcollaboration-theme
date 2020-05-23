<?php

get_header(); 
?>

<main role="main">

  <section class="module" id="<?php echo @$slug?>" role="region">
<div class="row">
<div class="container">
  <h1><?=$post->post_title?></h1>
<?php

  print do_blocks($post->post_content);
?>
</section>
</div>

</div>
  </main>
  <?php get_footer(); ?>