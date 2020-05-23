<?php

get_header(); 
?>

<main role="main">

  <section class="module" id="<?php echo @$slug?>" role="region">
<div class="row">
    <div class="container">
        <div class="col-sm-3 bg-dark">
            <div id="filter-accordion" class="filters"></div>
        </div>





  <h1><?=$post->post_title?></h1>
<?php

  print do_blocks($post->post_content);
?>

</div>

</div>
</section>
  </main>
  <?php get_footer(); ?>