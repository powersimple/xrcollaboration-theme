jQuery(document).ready(function() {



});
jQuery(window).resize(function() {

});

(function() {
    'use strict';
    // this function is strict...
}());
var menu = {},
    this_item = {}



function getVideo() {

    if (pages[active_id] != undefined) {

        var featured_video = pages[active_id].post_media.featured_video
        if (featured_video.length > 0) {
            for (i = 0; i < featured_video.length; i++) {
                setVideoPath(pages[active_id].post_media.featured_video[0].full_path);
            }
        }

    }

}

function setVideoPath(video_path) {
    console.log('set video', video_path)
    jQuery("#bg-video" + ' video source').attr("src", video_path);
}

function initSite() {
    megaMenu()
    sponsorFooter()

    getVideo();

    if (menus == undefined) {
        window.setTimeout(initSite(), 100);
    }

    setFilterAccordion("feature,industry,collaboration_type,platform");



    jQuery("#filter-accordion").accordion({
        header: "h3",
        collapsible: true,
        autoHeight: false,
        navigation: true
    });
}
jQuery(function() {
    jQuery('#main-menu').on("click", "a.toggle-menu", function() {

        jQuery('.exo-menu').toggleClass('display');

    });

});

var winTop = jQuery(window).scrollTop();
// Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
jQuery(function() {
    jQuery(window).scroll(function() {

        if (winTop >= 30) {
            jQuery("#site-title").addClass("sticky-header");
            //     jQuery("#sdg-nav").addClass("sticky-header");
            jQuery("#main-menu").addClass("sticky-header");
            jQuery("#pinned-nav").addClass("sticky-header");
        } else {
            jQuery("#site-title").removeClass("sticky-header");
            //      jQuery("#sdg-nav").removeClass("sticky-header");
            jQuery("#main-menu").removeClass("sticky-header");
            jQuery("#pinned-nav").removeClass("sticky-header");
        } //if-else
    }); //win func.
}); //ready func.


function setFilterAccordion(lists) {
    var accordion_filters = ''
    jQuery.each(lists.split(','), function(i, v) {
        //   console.log("tax", taxonomies[v])
        accordion_filters += '<h3>' + v + '</h3>';
        accordion_filters += '<div>'
        for (i in taxonomies[v]) {
            accordion_filters += '<span class="data-filter"><input class="form-checkbox" type="checkbox" value=""><span class="data-label">' + taxonomies[v][i].name + '</span></span>'
        }

        accordion_filters += '</div>'


    })

    jQuery("#filter-accordion").html(accordion_filters)



}

jQuery(document).ready(function() {



});

function sponsorFooter() {


    var menu_data = menus['sponsor-footer'].menu_array
    var menu_links = ''
    var url = '';
    var logo = '';
    // console.log(menu_data, menu_data.length)
    //  console.log("profiles", profiles);
    for (var i = 0; i < menu_data.length; i++) {

        //     console.log("profile =" + menu_data[i].title, menu_data[i].object_id, profiles[menu_data[i].object_id])
        logo = profiles[menu_data[i].object_id].post_media.logo[0].full_path
        url = profiles[menu_data[i].object_id].url
        menu_links += "<a class='sponsor col-xs-2 col-sm-1' href='" + url + "' target='_new' title='" + menu_data[i].title + "'> "
        menu_links += '<img src="' + logo + '" alt="' + menu_data[i].title + ' logo">'
        menu_links += "</a>"

    }
    jQuery('#sponsor-footer').html(menu_links);
    //    console.log("sponsor-footer", menu_links)



}