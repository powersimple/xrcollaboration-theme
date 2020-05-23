
         <?php 
            $current_sponsor_parent_id = 684;
            $previous_sponsor_parent_id = 686;
            
         ?>
<div class="row">

              <div class="col-sm-offset-4 col-sm-8">
          <h2 class="font-alt module-title">2019 <?php echo $title?></h2>

          
 <div class="row"><?php

displaySponsors($current_sponsor_parent_id,'Lead');
?>
 <div class="row"><?php
displaySponsors($current_sponsor_parent_id,'Gigabit');
?></div>


</div>

               
                </div>
</div>
<div class="row">
        <div class="col-sm-offset-4 col-sm-8">
            <h3><a href="/wp-content/uploads/2019/09/SH6-Sponshorship.pdf" target="_new">Download Our Sponsorship Presentation</a></h3>
            <div class="sponsors row multi-columns-row post-columns">
                <?php
                 print wpautop($content);
                 ?>
                
                
        </div>

    </div>
</div>
            
