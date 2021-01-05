
function setHardwareAccordion(lists){
 var accordion_filters = '<form id="hardware-filters">'
 //console.log(lists)
     console.log("HH",hardware_specs)
    

    jQuery.each(lists, function(i, v) {
        hardware_filters[v] = {}
       // console.log(i,v)
       if(v.length>0){
            
            accordion_filters += '<h3>' + i + '</h3>';
            accordion_filters += '<div class="accordion-drawer">'
            
            for(i=0;i<v.length;i++){

            if(v[i].active == 1){ 
                    
              //  console.log("boolean field",i,v[i])

                    if(v[i].field_type == 'boolean'){     }
                 //       console.log("boolean field",i)
                        accordion_filters += '<span class="data-filter"><input class="form-checkbox" type="checkbox" name="' +  v[i].field + '" data-tax="' + i + '" data-label="' + v[i].label + '" value="' + v[i].field + '"><span class="data-label">' + v[i].label + '</span></span>'
                    
                }
            }

            if (v != 'collaborators') {
    /*
                accordion_filters += '<h3>' + v.replace("_", " ") + '</h3>';
            
                
                if (v == 'hardware_support') {

                    for (h in hardware) {
                        if (hardware[h].profiles.length > 0) {


                            accordion_filters += '<span class="data-filter"><input class="form-checkbox" type="checkbox" name="' + hardware[h].slug + '" data-tax="' + v + '" value="' + hardware[h].id + '"><span class="data-label">' + hardware[h].title.rendered + '</span></span>'
                        }

                    }
                } else {
                    for (i in taxonomies[v]) {
                        //console.log("tax",v, taxonomies[v])

                        if (taxonomies[v][i].posts.length) {
                            accordion_filters += '<span class="data-filter"><input class="form-checkbox" type="checkbox" name="' + taxonomies[v][i].slug + '" data-tax="' + v + '" value="' + taxonomies[v][i].id + '"><span class="data-label">' + taxonomies[v][i].name + '</span></span>'
                        }

                    }




                }
                */
                accordion_filters += '</div>'
            }
        }
    })
    accordion_filters += '</div>'
    jQuery("#hardware-accordion").html(accordion_filters)


}
function displayHardwareResults() {
     var results = ''
    var count = 4
    var bootstrap_tiles = '' + getResultColumns(count)
    

    results += '<div class="row display-flex">'
    console.log("hardware_posts",hardware_posts)

    for(h in hardware_posts){

        if(!jQuery.isEmptyObject(hardware_posts[h].meta)){
        results += '<div class="' + bootstrap_tiles + '">'
        results += getHardwareCard(h)
        
         results += '</div>'
       }
    }
     results += '</div>'
 console.log("results",results)
    return results
}
function getHardwareCard(id){
    console.log(id, hardware_posts[id])
    hardware_card = '<div class="hardware-card">'

    hardware_card+='<h4>'+hardware_posts[id].title.rendered+'</h4>'
    hardware_card+='';
    hardware_card+='<ul>';
    if(hardware_posts[id] != undefined){
          console.log("hardware_posts",hardware_posts[id])
        if(hardware_posts[id].meta != undefined){
            for(m in hardware_posts[id].meta){
                console.log(m)
                hardware_card+='<li>'+displayHardwareMeta(m,hardware_posts[id].meta);
                hardware_card+='</li>';
            }
        }
    }
    
    hardware_card+='</ul>';
    


    hardware_card+='</div>'
    return hardware_card

}
function displayHardwareMeta(m, meta){

    console.log(hardware_fields)
   // return meta.title.rendered

}

var h_filter = {},
    h_profile_results = {}
function buildHardwareFilters(action, tax, value, label){
    
    var this_max = 2
    var display_filters = {}
     console.log("build", action, tax, value, label)

    
    if (action === 'add') {
     //   h_filter[value] = hardware_specs[value]
       h_filter[value] = {"label":label, 
                            "hardware_profiles":hardware_specs[value]
                        }
       



        if (tax == 'collaborators') {
            //hardware_filters[tax] = []
        } else {
            hardware_filter_count++
        }

//        hardware_filters[tax][value] = sortFilters(tax, value)

        console.log("added", tax, value)
            //       console.log("added", tax, value, hardware_filters)

    } else if (action === 'remove') {
        //    
        
        if (tax != 'collaborators') {
            delete h_filter[value]
            if(hardware_filter_count>0){
                hardware_filter_count--
            }
        }
            //        delete filter_posts[value]
            // console.log(hardware_filters, "removed", tax, value, hardware_filters)
    }


        for (s in hardware_specs[value]){//s = values
            //console.log("spec",s,hardware_specs[value])

            for (k in hardware_specs[value][s]){//loop through to get k= id of hardware
            
            if(action == 'add'){    
                if(h_profile_results[hardware_specs[value][s][k]] == undefined){
                        h_profile_results[hardware_specs[value][s][k]] = 1 //sets count to 1 
                    } else {
                        h_profile_results[hardware_specs[value][s][k]]++ // adds if exists
                    }
                
                } else if(action == 'remove'){
                    if(h_profile_results[hardware_specs[value][s][k]] != undefined){
                
                        if(h_profile_results[hardware_specs[value][s][k]] == 1){
                            delete h_profile_results[hardware_specs[value][s][k]] // removes instead of decrementing to zero
                        } else {
                            h_profile_results[hardware_specs[value][s][k]]-- //decrements if above 1
                        }
                    }

                }
            }
        }











     //console.log( h_profile_results)
}
function getHardwareImage(){



}


function displayBreadCrumb(filter){
    console.log("breadcrumb",filter)
    var breadcrumb = '<div class="breadcrumb"><strong>Filters</strong>: '
    for(f in filter){
        breadcrumb += '<span>'+filter[f].label+'</span>'
    }
    breadcrumb += '</div>'
    $("#active_filters").html(breadcrumb)
}
function displayHardwareMeta(meta){
  
    var hardware_meta = ''
    var group_count = 0
    for(g in hardware_fields){// loop through groupings
        group_count = 0
        // hardware_meta+='<h6>'+g+'</h6>'
        for(f in hardware_fields[g]){
            //  console.log(g,hardware_fields[g][f])
            if(meta[hardware_fields[g][f].field] != undefined){
                console.log(f,hardware_fields[g][f])
                if(hardware_fields[g][f].field_type != 'inactive'){ 
                group_count++
                }
            }
        }
        if(group_count>0){
            hardware_meta+='<h6>'+g+'</h6><ul>'
            
            for(f in hardware_fields[g]){
               if(hardware_fields[g][f].field_type != 'inactive'){ 
                 if(meta[hardware_fields[g][f].field] != undefined){
                    hardware_meta+='<li>'
                     hardware_meta+='<strong>'+hardware_fields[g][f].label+'</strong>: '
                    if(hardware_fields[g][f].field_type == 'bool'){
                        if(meta[hardware_fields[g][f].field] == 1){
                        hardware_meta+='✅'
                        }
                       
                    } else {
                        if(hardware_fields[g][f].before_value != ''){
                            hardware_meta += hardware_fields[g][f].before_value
                        }
                            

                        hardware_meta+=meta[hardware_fields[g][f].field]+ ' '
                      
                        if(hardware_fields[g][f].after_value != ''){
                            hardware_meta += ' ' + hardware_fields[g][f].after_value
                        }
                            

                        }
                
                        hardware_meta+='</li>'
                
                    }
                
               }
                }   



                hardware_meta+='</ul>'
            }

       
        //hardware_meta += '<li>'+m+':'+meta[m]+'</li>'
    }


    //hardware_meta += '</ul>'
    return hardware_meta
}



function displayHardwareResult(id){
  console.log("hardware item",id,hardware_posts[id])
    var this_item = hardware_posts[id]
    var image_path = image_path = "/wp-content/uploads/2020/12/placeholder-hmd.jpg"
    if(this_item.featured_media != 0){
      image_path = this_item.post_media._thumbnail_id[0].full_path
    } 

    var hardware_profile = '<h4>'+this_item.title.rendered+'</h4>'
    hardware_profile += '<img src="'+image_path+'" alt="image of '+this_item.title.rendered+'">'
    hardware_profile += displayHardwareMeta(this_item.meta)
       
    return hardware_profile
    
}


function displayHardwareResults(results){
    
// console.log('results', results, hardware_posts )
    var matched = '<div class="hardware-list row display-flex">'
    for(r=0;r<results.length;r++){

           if(hardware_posts[results[r][0]] != undefined){
                matched += '<div class="hardware-item col-xs-12 col-sm-6 col-md-4 col-lg-4">'+displayHardwareResult(results[r][0])+'</div>'
           }
    }
    matched += '</div>'
    $("#active_profiles").html(matched)
}


$(document).on('click', '#hardware-filters :checkbox', function() {
    // code here
    var this_value = jQuery(this).attr('value')
    var this_tax = jQuery(this).data('tax')
    var this_label = jQuery(this).data('label')
    
    console.log(hardware_specs)
    console.log(this_value,hardware_specs[this_value])
    jQuery('#active-harware').html('')
       // console.log("val",this_value)
    if (this.checked) {
        //console.log("checked")
        buildHardwareFilters("add", this_tax, this_value, this_label)
    } else {
        //console.log("unchecked")
        buildHardwareFilters("remove", this_tax, this_value, this_label)

        // the checkbox is now no longer checked
    }
    displayBreadCrumb(h_filter)

    var sorted_results = []
    for (var r in h_profile_results) {
        sorted_results.push([r, h_profile_results[r]]);
    }
    sorted_results.sort(function(a, b) {
        return b[1] - a[1];
    });
   // console.log("sorted",sorted_results)
    displayHardwareResults(sorted_results)
    
 
 //console.log("h",h_filter,"results", h_profile_results)
});