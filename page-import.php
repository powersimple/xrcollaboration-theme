<?php


   




get_header(); ?>

<table>

    <tr>
        <td width="20%">
            <h3>UNIMPORTED</h3>
            <div style="height:400px; overflow-y:scroll">
            <?=listProjects("resource","scraped = 1 and wp_post_id = 0")?>
            </div>
            <BR><BR>
            <h3>IMPORTED</h3>
            <div style="height:400px; overflow-y:scroll">
            <?=listProjects("resource","scraped = 1 and wp_post_id > 0")?>
            </div>
        </td>
        <td valign="top" width="30%">

            <h3>SELECTED</h3>

            <?php 
                if(@$_GET['resource']){
                    $vars = listResource($_GET['resource']);
                    extract($vars);
                }

                ?>
            
        </td>
        <td>
            
        <?php 
                 if(@$_GET['import'] && $_POST){
                    print " <h3>IMPORT</h3>";
                    extract($_POST);
                    $wp_post_id = insertPost($_GET['resource'],$post_title,$post_content);
                    //print "inserted $wp_post_id <BR>";
                    
                   
                     foreach(explode(",",$field_list) as $key => $value){
                        add_post_meta($wp_post_id, $value, $_POST[$value]); 
                    }
                }



                if(@$_GET['resource']){
                    ?>
                    <a href="/admin/scrape/?scrape=1&key=<?=$_GET['resource']?>&url=<?=$URL?>" target="_blank">Scrape again</a>

                    <?php

                
                if(@$wp_post_id == 0){
                    
                    ?>

                    <p>This resource has not been imported yet.</p>
                    <form method="post" action="?resource=<?=$_GET['resource']?>&import=1">
                    <?php
                
                 ?>
                    
                                  
                        
                        
                            <table>
                            <tr>
                                <td>Title</td>
                                <td>
                                    <input type="text" name="post_title" value="<?=$title?>">
                                </td>
                            </tr>
                            <tr>
                                <td>Content</td>
                                <td>
                                    <textarea name="post_content"><?=@$description?></textarea>
                                </td>
                            </tr>
                           

                      
                    
                    
                    <?php
                    
                    $fields = "URL,keywords,language,logo_url,share_image_url,contact_url,blog_url,twitter,facebook,linkedin,github,tumblr,google_plus,medium,telegram,slack,skype,instagram,youtube,vimeo,pinterest,behance,rss,email,phone,address,address2,city,state,postal_code,country";
                    $filled_fields = array();
                    foreach(explode(",",$fields) as $key => $field){
                        if(@$vars[$field] != ""){
                            print "<tr><td>$field</td><td>".$vars[$field]."</td></tr>";
                            print "<input type=\"hidden\" name=\"$field\" value=\"$vars[$field]\">";
                            array_push($filled_fields,$field);
                        }
                    }
                    $field_list = implode(",",$filled_fields);
?>
 <tr>
                        <input type="hidden" name="field_list" value="<?=$field_list?>">
                                <td><input type="submit" value="IMPORT">
                            </tr>
                              </form>
                    <?php 
                  }
}
                ?>
        </td>

    </tr>

</table>
           
	<?php get_footer(); ?>