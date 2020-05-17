<?php
get_header(); 

function getBlurbs(){
    $start=0;
    $end=10000;
    global $wpdb;
    $limit="";
    if(@$_GET['start']){
        $start = $_GET['start'];
    }
    if(@$_GET['end']){
        $end = $_GET['end'];
    }
    $limit = "$start, $end";
    global $wpdb;

    $sql = "select * from omni_linkedin limit $limit";
    $q = $wpdb->get_results($sql);
    $blurbs = array();
    foreach ($q as $key => $value) {
        array_push($blurbs, (array) $value);
    }
    return $blurbs;
    

}

function getLinkedInURLS($limit){
    global $wpdb;
    $sql = "select * from omni_linkedin limit $limit";
    $q = $wpdb->get_results($sql);
    $blurbs = array();
    print '"';
    foreach ($q as $key => $value) {
        array_push($blurbs, (array) $value->linkedin);
        print  $value->linkedin.'",
        "';
    }
    


 //   return $blurbs;
}

?>

<main id="main" role="main" style="overflow-y:scroll">
<div id="admin">

<?php 
    if(@$_GET['limit']){
        getLinkedInURLS($_GET['limit']);
        $next = explode(",",$_GET['limit']);
        $next_start = $next[0]+15;
    } else if(@$_GET['parse']){
        include "profiler/linkedin.php";
        
    }
    print "<a href='?limit=$next_start,15'>Next $next_start</a>";


// print parseBlurbs(getBlurbs());

?>
</div>
</main>

<?php
wp_footer(); ?>