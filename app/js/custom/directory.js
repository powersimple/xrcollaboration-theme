var directory_list = []
var active_filters = {}

function displayDirectory(display_filters, filter_posts) {
    // console.log("FILTERS", display_filters, filter_posts)
    var bootstap_tiles = 'col-xs-6 col-sm-4 col-md-3 col-lg-2'
    var logo_display = '<div>'
    for (p in filter_posts) {
        logo_display += '<div class="' + bootstap_tiles + '">'
        logo_display += '<a href = "' + filter_posts[p].url + '" target="_new ">'

        logo_display += '<img src="' + filter_posts[p].logo + '" alt="' + filter_posts[p].title + ' logo"></a><span class="profile-label"' +
            filter_posts[p].title + '</span></div>'
    }
    logo_display += '</div>'
    jQuery("#profile_logos").html(logo_display)


}

function setFilterAccordion(lists) {
    var accordion_filters = '<form id="filters">'
    jQuery.each(lists.split(','), function(i, v) {
        active_filters[v] = {}
        accordion_filters += '<h3>' + v.replace("_", " ") + '</h3>';
        accordion_filters += '<div class="accordion-drawer">'
        for (i in taxonomies[v]) {
            if (taxonomies[v][i].posts.length) {
                // console.log("tax", taxonomies[v])
                accordion_filters += '<span class="data-filter"><input class="form-checkbox" type="checkbox" name="' + taxonomies[v][i].slug + '" data-tax="' + v + '" value="' + taxonomies[v][i].id + '"><span class="data-label">' + taxonomies[v][i].name + '</span></span>'
            }
        }

        accordion_filters += '</div>'


    })
    accordion_filters += '</div>'
    jQuery("#filter-accordion").html(accordion_filters)



}

function buildFilters(action, tax, value) {
    var this_object = active_filters[tax]
    var filter_posts = {}
    var display_filters = {}

    if (action === 'add') {
        this_object[value] = value
            //console.log("added", tax, value, active_filters, )

    } else if (action === 'remove') {
        //    
        delete this_object[value]
            //console.log(active_filters, "removed", tax, value, active_filters)
    }
    for (a in active_filters) {
        var isEmpty = $.isEmptyObject(active_filters[a]);
        var this_post;
        var post_data;
        display_filters[a] = {}
        if (isEmpty === false) {
            for (f in active_filters[a]) {
                display_filters[a][f] = taxonomies[a][f].name
                    //console.log("filter", f, taxonomies[a][f].posts);
                for (var p = 0; p < taxonomies[a][f].posts.length; p++) {
                    this_post = taxonomies[a][f].posts[p]
                    console.log(p, profile_posts[this_post])
                    if (profile_posts[this_post].post_media.logo[0] != undefined) {


                        filter_posts[this_post] = getFilterPosts(this_post)
                    }
                }

            }
        }
    }
    displayDirectory(display_filters, filter_posts)


}

function getFilterPosts(this_post) {
    return post_data = {
        'logo': profile_posts[this_post].post_media.logo[0].full_path,
        'title': profile_posts[this_post].title,
        'url': profile_posts[this_post].info.url
    }
}

function getStatPosts() {
    //console.log("profile posts", profile_posts)
    var spectator_lists = [];
    var lists_lists = [];
    for (i in spectators) {
        //  console.log(spectators[i]);

        for (p = 0; p < spectators[i].length; p++) {
            filter_posts[this_post] = getFilterPosts(spectators[i][p])
            console.log("spectator_posts", i, profile_posts[spectators[i][p]].title)
        }
    }
    for (i in collaborators) {
        //  console.log(collaboratorsi]);

        for (p = 0; p < collaborators[i].length; p++) {

            console.log("collaborators_posts", i, profile_posts[collaborators[i][p]].title)
        }
    }

}





$(document).on('click', '#filters :checkbox', function() {
    // code here
    var this_value = jQuery(this).attr('value')
    var this_tax = jQuery(this).data('tax')
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