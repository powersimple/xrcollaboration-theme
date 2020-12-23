
function setHardwareAccordion(lists){
 var accordion_filters = '<form id="hardware-filters">'
 //console.log(lists)
    jQuery.each(lists, function(i, v) {
        active_filters[v] = {}
       // console.log(i,v)
        accordion_filters += '<h3>' + i + '</h3>';
           accordion_filters += '<div class="accordion-drawer">'
        for(i=0;i<v.length;i++){
          // console.log("field",v[i].field,v[i].field_type)
            if(v[i].field_type == 'checkbox'){     
                  accordion_filters += '<span class="data-filter"><input class="form-checkbox" type="checkbox" name="' +  v[i].field + '" data-tax="' + v + '" value="' + v[i].field + '"><span class="data-label">' + v[i].label + '</span></span>'
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

    console.log(meta)
    return meta.title.rendered

}

$(document).on('click', '#hardware-filters :checkbox', function() {
    // code here
    var this_value = jQuery(this).attr('value')
    var this_tax = jQuery(this).data('tax')
    jQuery('#active-profile').html('')
        //console.log(taxonomies[this_tax][this_value].posts)
    if (this.checked) {
        //console.log("checked")
        buildFilters("add", this_tax, this_value)
    } else {
        //console.log("unchecked")
        buildFilters("remove", this_tax, this_value)

        // the checkbox is now no longer checked
    }


});