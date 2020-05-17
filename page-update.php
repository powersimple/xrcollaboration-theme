<?php

require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php' );
if ($_SERVER['SERVER_ADDR'] != $_SERVER['REMOTE_ADDR']){
   // header('HTTP/1.1 401 Unauthorized', true, 401);
 // exit; //just for good measure
} else {

}
    if(@$_POST['id']){
        global $wpdb;
      
        $set = 'UPDATE omni_data set ';
        $sets = array();
        foreach($_POST as $k => $value){
          //  $value = str_replace("'","\'",$value);
            if($k == 'id'){

            } else {
            array_push($sets,$k.'=\''.$value.'\'');
            }

        }
        $set .= implode(",",$sets);
        $set .= ' where id = '.$_POST['id'];
       
        $q = $wpdb->query($set);
        
        if($q == false){
            $wpdb->print_error();
        } else {
            print 'success';
        }

    }



?>