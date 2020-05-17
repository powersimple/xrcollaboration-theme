<?php get_header(); 


$countries = getCountriesTags();
$country_array = array();
foreach($countries as $iso2 =>$country){
    extract((array) $country);
    print "$name";    
 
    
    $provinces_array=array();
    $province_cities = array();
    foreach($provinces as $key => $province){
        if(trim($province['abbr']) != ''){
            $provinces_array[$province['abbr']] = $province['name'];
            $province_cities[$province['abbr']] = array();


        } else {
        array_push($provinces_array,$province['name']);
        }
    }
   
    $cities_array=array();
    $city_state_array=array();
    
    foreach($cities as $key => $city){
       

        if($city['abbr'] != ''){
            array_push($province_cities[$city['abbr']],$city['name']);
        } else {
             array_push($cities_array,$city['name']);
        }

    }


    $country_array[$tid] = array(
        "id"=>$tid,
        "slug"=>$iso2,
        "name"=>$name,
        "official"=>$official,
        "iso3" => $iso3,
        "provinces" => $provinces_array,
        "cities" => $cities_array,
        "province_cities" => $province_cities
        
           
    );


}

$server_path = get_template_directory();
 $json_path = "/app/json/locations.json";
 $json = json_encode($country_array);
    writeJSON($json,$server_path."".$json_path);
get_footer(); ?>