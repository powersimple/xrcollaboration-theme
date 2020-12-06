stats
<?php


function getFieldCount($field='name'){
    global $wpdb;
    $sql = "SELECT $field as count_field, COUNT(*) c FROM guide_data GROUP BY $field HAVING c > 0 order by c desc";
    $q = $wpdb->get_results($sql);

    print "<tr><td>$field</td><td>unique =".count($q)."</td><tr>";
    foreach($q as $key=>$value){
        if($value->c>1){
        print "<tr><td>$value->count_field</td><td>$value->c</td>";
        }
    }
  
    
    //SQL GROUP COUNTS
    //SELECT term, COUNT(*) c FROM omni_tax_raw GROUP BY term HAVING c > 1;
}
function getDateCount(){
    global $wpdb;
    $sql_count = "select count(*) as c from guide_data";
    $x = $wpdb->get_var($sql_count);

    $sql = "SELECT
    DATE(downloaded_at) AS Date,
    COUNT(*) AS downloads
FROM guide_data

GROUP BY
    DATE(downloaded_at)";
    $q = $wpdb->get_results($sql);

    print "<tr><td>Downloads</td><td>unique =".$x."</td><tr>";
    foreach($q as $key=>$value){
        print "<tr><td>$value->Date</td><td>$value->downloads</td>";
    }
  
    
    //SQL GROUP COUNTS
    //SELECT term, COUNT(*) c FROM omni_tax_raw GROUP BY term HAVING c > 1;
}
    print "<table>";
print getFieldCount('name');
print getFieldCount('email');
print getFieldCount('industry');
print getDateCount('date');

  print "</table>";
?>