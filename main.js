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
        menu_links += "<a class='sponsor col-x2-2 col-sm-1' href='" + url + "' target='_new' title='" + menu_data[i].title + "'> "
        menu_links += '<img src="' + logo + '" alt="' + menu_data[i].title + ' logo">'
        menu_links += "</a>"

    }
    jQuery('#sponsor-footer').html(menu_links);
    //    console.log("sponsor-footer", menu_links)



}
// pass the type in the route
// param = url arguments for the REST API
// callback is a dynamic function name 
// Pass the name of a function and it will return the data to that function

var posts = {},
    pages = {},
    profiles = {},
    taxonomies = {},
    categories = {},
    tags = {},
    menus = {},
    media = {},
    posts_nav = {},
    posts_slug_ids = {},
    last_dest = 'outer-nav',
    menu_levels = [],
    menu_slides = [], // an array for all 
    related = {},
    data_score = 7,
    data_loaded = [],
    state = {},
    social = {},
    data_loaded = false

state.featured = {
    'transition': {
        'type': 'flip',
        'face': 'front'
    }
}




function getStaticJSON(filename, callback, dest) {
    // route =  the type 
    // param = url arguments for the REST API
    // callback = dynamic function name 
    // Pass in the name of a function and it will return the data to that function

    // local absolute path to the REST API + routing arguments
    //data_path is configured in header.php
    var json_data = data_path + filename + ".json"
        //console.log("data_path", data_path)
        // console.log("jsonfile", json_data);
    jQuery.ajax({
        url: json_data, // the url
        data: '',
        success: function(data, textStatus, request) {
            console.log("load json", data);
            //      data_loaded.push(callback);
            return data,

                callback(data, dest) // this is the callback that sends the data to your custom function

        },
        error: function(data, textStatus, request) {
            //console.log(endpoint,data.responseText)
        },

        cache: false
    })
}
/*
//THIS SECTION IS DEPRECATED, Data now consolidated into one content packet
getStaticJSON('posts', setPosts) // get posts

// retrieves all projects, with fields from REST API
getStaticJSON('pages', setPosts) // get pages

// retrieves all projects, with fields from REST API
getStaticJSON('project', setPosts) // get the projects

// retrieves all categories for the development category
getStaticJSON('categories', setCategories) // returns the children of a specified parent category

// retrieves all categories for the development category
getStaticJSON('tags', setTags) // returns the tags

// retrieves top menu
getStaticJSON('menus', setMenus) // returns the tags

getStaticJSON('media', setMedia) // returns the tags
*/
if (data_loaded == false) {
    getStaticJSON('content', setData) // returns all content
}

function setData(data) { //sets all content arrays
    // console.log("setData", data)
    posts = setPosts(data.posts)
    pages = setPosts(data.pages)
    profiles = setPosts(data.profile)

    //  setPosts(data.social)
    setCategories(data.categories)
    setTaxonomy(data, "industry")
    setTaxonomy(data, "feature")
    setTaxonomy(data, "collaboration_type")
    setTaxonomy(data, "platform")




    setTags(data.tags)
    setMenus(data.menus)
        //  setMedia(data.media) media embeded into posts 
    initSite()
    data_loaded = true;
}

function setPosts(data) { // special function for the any post type

    var type = 'post'

    //console.log("data", data)
    if (Array.isArray(data)) {

        for (var i = 0; i < data.length; i++) { // loop through the list of data
            //console.log("home", data[i].id)
            /*
              The REST API nests the output of title and content in the rendered variable, 
              so we must unpack and set it our way, which is just .title and .content
            */
            if (data[i].title !== undefined && data[i].title.rendered !== undefined) { // make sure the var is there
                data[i].title = data[i].title.rendered // lose that stupid rendered parameter
            }

            if (data[i].content !== undefined && data[i].content.rendered !== undefined) { // make sure the var is there
                data[i].content = data[i].content.rendered // lose the unnecessary "rendered" parameter
            }


            //console.log(dest,data[i]);
            if (data[i].type !== undefined) { // make sure the var is there
                type = data[i].type // set the type for the log

                posts[data[i].id] = data[i] // adds a key of the post id to address all data in the post as a JSON object
            }

        }
    } else if (data != undefined) {
        console.log("data about to error", data)
        type = data.type // set the type for the log

        posts[data.id] = data // adds a key of the post id to address all data in the post as a JSON object

    }


    // console.log("posts", posts)


    return posts
}
function setMedia(data) {

    for (var m = 0; m < data.length; m++) {
        media[data[m].id] = data[m].data;
    }
    console.log("media", media);
}

function getMediaID(post_id, attr) {
    //console.log(post_id,attr)
    if (posts[id][attr] != undefined) { //is featured_media defined
        var media_id = posts[post_id][attr]

        if (media_id > 0) { // is it set to a value above zero?

            if (media[media_id] != undefined) {
                return media_id
            } else {
                return 0
            }

            // returns 


        } else {
            return 0
        }

    } else {
        return 0
    }


}

function getImageSRC(id, dest, size) { // id = media id

    //  console.log("set image", id, dest, size, media[id])
    if (media[id] != undefined) {


        var full_path = uploads_path + media[id].path // uploads path is in header
        var src = media[id].file; // this defaults to the basic file



        if (media[id].mime == "image/svg+xml") { // if it's an SVG, let the src pass through
            return full_path + src;
        } else { //for real images

            if (size == 'square' || size == 1) { // if for a square area
                src = getSquareVersion(media[id].meta.sizes, dest) // get the size version of the sq
                    //      console.log('square',src)
            } else if (size == 'thumbnail') {
                src = getSquareVersion(media[id].meta.sizes, dest)
                    //       console.log('thumbnail', src)
            } else {

                src = media[id].meta.sizes[size] // returns specified size
                    //console.log('default', size, media[id].meta.sizes,src)
            }

        }

        if (dest == '') { //set path to '' to return the src only
            //console.log("Src return", full_path + src)
            return full_path + src;




        } else { // if dest is specified, set the src to the id and 

            return full_path + src;
        }
        // show the wrapper

    } else {

        return ''
    }

}

function toggleFace(dest, type) {
    //console.log("toggle-face", dest, type, state[dest])
    if (state[dest].transition.face == 'front') {
        return 'back'
    } else {
        return 'front'
    }
}

function loadTemplate(dest, type) { // dest is name of place to put template, type = transition type
    //console.log("load template",dest,type)
    var template = jQuery('#' + dest + "-template").html(); // gets the empty contents of x-template script tag for this dest
    if (type == "flip") { // requires a front back wraper around template contents
        var front = '<div class="card front">' + template + '</div>' // wraps template in a front class
        var back = '<div class="card back">' + template + '</div>' // wrapte template in a back class
        jQuery('#' + dest).html(front + back); // loads both front and back into template into dest
    } else {
        jQuery('#' + dest).html(template); // defaults to empty template contents
    }

}

function clearImageText() {

}

function getAspect(w, h) {
    if (w == h) {
        return 'square'
    } else {
        return Math.round(w / h)
    }

}

function setImageContent(loc, title, caption, desc, alt, src) {

    //console.log("SET IMAGE CONTENT",loc,title,caption,desc,alt,src)
    setTimeout(function() {
        jQuery(loc + " .title").html(title)
        jQuery(loc + " .caption").html(caption)
        jQuery(loc + " .description").html(desc)
        jQuery(loc + " .image").attr('alt', alt)
        jQuery(loc + " .image").attr('src', src)
    }, 250)

}




function transitionImage(dest, type, media_id) {

    if (jQuery('#' + dest).html() == '' || state[dest].transition != type) { // load the template, only if you need to
        state[dest].transition.type = type // if transition type has changed, set it
        loadTemplate(dest, type)
    }
    var aspect = getAspect(parseInt(jQuery("#" + dest).width()), parseInt(jQuery("#" + dest).height())) // pass the sizes of the destination to get the aspect
    var src = getImageSRC(media_id, dest + ' .image', aspect) //returns appropriate image sice.
    if (type == 'flip') {
        var next_face = toggleFace(dest, type) // flip requires front and back, will return opposite based on state
        console.log("FLIP", next_face, dest, type, media_id, src)
        if (next_face == 'back') {
            //  jQuery('#featured').css("transform", "rotateY(180deg)")
        }
        if (media[media_id] != undefined) {
            /*
            //console.log('next face', next_face)
            var flip_chain = {
                flip_out: function () {
                        jQuery(dest).css('transform', 'rotateY(90deg)')
                        console.log('flipout')
                        return flip_chain
                    },
                set_content: function () {
                    setImageContent( '#' + dest + " ." + next_face, //uses "loc" instead of dest to allow for card faces.
                        media[media_id].title,
                        media[media_id].caption,
                        media[media_id].desc,
                        media[media_id].alt,
                        src)
                                            return flip_chain

                },
                flip_in: function() {
                    //jQuery(dest).css('transform', 'rotateY(90deg)')
                    console.log('flipin')

                    return flip_chain
                }
            }
            flip_chain.flip_out().set_content().flip_in()
            */


            setImageContent('#' + dest + " ." + next_face, //uses "loc" instead of dest to allow for card faces.
                media[media_id].title,
                media[media_id].caption,
                media[media_id].desc,
                media[media_id].alt,
                src)

            state[dest].transition.face = next_face
                /*jQuery(function () {
                    jQuery("#"+dest).flip({
                        axis: "y", // y or x
                        reverse: false, // true and false
                        trigger: "hover", // click or hover
                        speed: '250',
                        autoSize: false
                    });
                })*/
                //   console.log('next face', next_face)

        } else {
            setImageContent('#' + dest + " ." + next_face, '', '', '', '', '')
        }
        jQuery('#' + dest).toggleClass('is-flipped')

    }





}




/* GET FEATURED IMAGE BY POST ID */
function setImage(post_id, dest, attr, type, size) {
    //console.log("set image", post_id, size)
    var transition_type = "flip"
    if (posts[post_id] != undefined) { //you passed a post ID, is it there?
        var media_id = getMediaID(post_id, attr) //returns zero if doesn't exist

        if (media_id > 0) { //is media_id
            jQuery('#' + dest).fadeIn()

            // var src = getImageSRC(media_id, dest + '-image', 'square')
            // setMediaText(media_id, dest + '-image')
            // jQuery("#" + dest + '-image').attr("src", src)
            transitionImage(dest, transition_type, media_id)

            //console.log("set", media_id, src)


        } else {
            //console.log("media off", media_id)
            jQuery('#' + dest).fadeOut()
        }

    }


}


function wrapTag(tag, str) {
    return "<" + tag + ">" + str + "</" + tag + ">"
}

function setMediaText(id, dest) { // old

    if (media[id] != undefined) {
        // console.log("caption",media[id]);
        jQuery('#' + dest + "-title").html(media[id].title)
        jQuery('#' + dest + "-caption").html(media[id].caption)
        jQuery('#' + dest + "-description").html(media[id].desc)
        jQuery('#' + dest).attr("alt", media[id].alt);
    } else {
        //console.log("clear media text",dest);
        jQuery('#' + dest + "-title").html('')
        jQuery('#' + dest + "-caption").html('')
        jQuery('#' + dest + "-description").html('')
        jQuery('#' + dest).attr("alt", '');
    }

}

function getSquareVersion(sizes, dest) {

    box = { // object getting the container dimensions
            w: jQuery(dest + "-container").width(),
            h: jQuery(dest + "-container").height()
        }
        // console.log("box",box,"dest"+dest,sizes)

    if (box.w > 1280 || box.h > 1280) { //over 1500 use large
        //    console.log("sq-lg")
        return sizes['sq-lg']
    } else if ((box.w > 250 || box.h > 250) && (box.w <= 1280 || box.h <= 1280)) {
        // console.log("sq-med")
        return sizes['sq-med']
    } else {
        //  console.log("sq-sm")
        return sizes['sq-sm']
    }


}

function setVideo(id, dest) {


    if (media[id] != undefined) {

        var full_path = uploads_path + media[id].path // uploads path is in header
        var src = media[id].file; // this defaults to the basic file

        var video = jQuery(dest + ' video source').attr("src", full_path + src);

        //    console.log("unhide video player")

        jQuery(dest + ' video')[0].load();

        video = jQuery(dest + ' video source').attr("src", full_path + src);
        jQuery(dest).fadeIn()
    } else {
        //    console.log("no video, hide player")
        jQuery(dest).fadeOut();
    }

}

function setScreenImages(screen_images, dest, callback) {
    var images = []
    for (var i = 0; i < screen_images.length; i++) {
        //  console.log("screen image",screen_images[i])
        images.push({
            "src": getImageSRC(screen_images[i], '#screen-image', "square"),
            "data": media[screen_images[i]]
        })

    }
    state.screen_images = images
        //console.log("set ScreenImages", screen_images, dest, images, callback);
        //callback(dest)
        //initParticleTranstion(dest)
    if (images.length > 0 && callback == 'circleViewer') {
        circleViewer(dest, state.screen_images) // buggy
    }
    //  callback(dest,images)



}
function megaMenu() {
    var classes = ''
    var megamenu = '<nav id="megamenu" class="content">'
    megamenu += '<ul class="exo-menu">';

    megamenu += getMegaMenu(menus.megamenu.menu_levels, classes);

    megamenu += '<a href="#" class="toggle-menu visible-xs-block"><i class="fa fa-bars"></i></a>'


    megamenu += '</ul></nav>'
        //console.log("megamenu=", megamenu)
    jQuery("#main-menu").html(megamenu);
}

function getMegaMenu(items, parent_classes) {
    //console.log(items, parent_classes)

    var this_item = 0,
        menu_items = '',
        classes = '',
        ulclass = '',
        headwrap = '',
        footwrap = '',
        link = "#",
        outer = 'li',
        level = 0,
        target = ''
    for (var i = 0; i < items.length; i++) {

        this_item = items[i]
        headwrap = ''
        footwrap = ''
        classes = ''
        link = ''
        outer = 'li'

        if (this_item.classes != '') {
            classes = ' class="' + this_item.classes + '"'
            ulclass = this_item.classes + '-ul'

        }
        //console.log(this_item)

        if (this_item.classes != undefined) {
            if (this_item.classes.indexOf('mega-drop-down')) {
                //      console.log(this_item.title, "mega")

                headwrap = '<div class="animated fadeIn mega-menu">'
                headwrap += '<div class="mega-menu-wrap">'
                headwrap += '<div class="row">'
                headwrap = '<ul class="' + ulclass + ' animated fadeIn">'
                footwrap = '</ul></div></div></div>'

            } else if (this_item.classes.indexOf('drop-down')) {

                headwrap = '<ul class="' + ulclass + ' animated fadeIn">'
                footwrap = '</ul>'


            } else {
                headwrap = '<ul class="' + ulclass + ' animated fadeIn">'
                footwrap = '</ul>'
            }
            if (this_item.parent_classes == 'mega-drop-down') {
                outer = 'div'
            }
            if (this_item.object == 'gradelevel') {
                //   console.log("obj", this_item)
            }
            switch (this_item.object) {
                case "feature":
                    link = this_item.url
                    break
                case "category":
                    link = this_item.url
                    break
                case "industry":
                    link = this_item.url
                    break
                case "custom":
                    link = this_item.url

                    break

                case "conference":
                    link = this_item.url
                    break
                case "award":
                    link = this_item.url
                    break

                    // default: link = '#';
            }
            //    console.log(this_item)

            if (this_item.target != '') {
                target = 'target="_blank"'
            }
            if (this_item.url == '') {
                //menu_items += '<' + outer + ' ' + classes + '><span>' + this_item.title + '</span>' this needs to open the dropdown
                menu_items += '<' + outer + ' ' + classes + '><a href="' + link + '"' + target + '>' + this_item.title + '</a>'
            } else {
                menu_items += '<' + outer + ' ' + classes + '><a href="' + this_item.url + '">' + this_item.title + '</a>'
            }

            if (this_item.children != undefined) {

                if (this_item.children.length > 0) {
                    menu_items += headwrap
                        //     console.log("wrap",headwrap,footwrap)
                    menu_items += getMegaMenu(this_item.children, this_item.classes)

                    menu_items += footwrap

                }
            }
            menu_items += '</li>'
        }

    }

    return menu_items;
}
var menu_config = {
    'megamenu': {
        'menu_type': 'megamenu',
        'location': '#main-menu'
    },
    'sponsor-footer': {
        'menu_type': 'profile',
        'location': '#sponsor-footer'
    },
    'social-links': {
        'menu_type': 'social',
        'location': '#social'
    }
}

function setMenus(data) {
    //console.log("raw menu data",data)

    for (var i = 0; i < data.length; i++) {
        menus[data[i].slug] = {}
        menus[data[i].slug].menu_array = []
        menus[data[i].slug].name = data[i].name
        menus[data[i].slug].slug = data[i].slug
        menus[data[i].slug].items = setMenu(data[i].slug, data[i].items)

        //console.log("slug", data[i].slug)
    }
    buildMenuData();
    //   console.log("raw menu data", menus)

}

function setMenu(slug, items) {
    menu = {}
        //console.log("setMenu",dest,slug,items)
    for (var i = 0; i < items.length; i++) {
        menu[items[i].ID] = setMenuItem(slug, items[i])
            // console.log("setMenu", items[i].ID, slug, items)
        if (items[i].menu_item_parent != 0) { //recursive
            menu[items[i].menu_item_parent].children.push(items[i].ID) //children empty array is created in setMenuItem

        } else {

        }
        menus[slug].menu_array.push(menu[items[i].ID])

    }
    // console.log("MENU ARRAY",menus[dest].menu_array)
    // console.log("SetMenu", slug, menu)
    return menu
}

function setMenuItem(slug, item) {
    //console.log("setMenuItem",item)
    this_item = {}
    this_item.menu_id = item.ID
    this_item.title = item.title

    this_item.menu_order = item.menu_order
    this_item.object = item.object
    this_item.object_id = item.object_id
    this_item.parent = item.menu_item_parent
    this_item.classes = item.classes
    this_item.url = item.url
    this_item.description = item.description
    this_item.slug = slug


    this_item.children = [] //this array is populated in Set Menu

    return this_item
}


function menu_order(a, b) {
    if (a.menu_order < b.menu_order)
        return -1;
    if (a.menu_order > b.menu_order)
        return 1;
    return 0;
}

function setLinearNav(m) {
    var counter = 0
    menus[m].linear_nav = [];
    var id = 0
    for (var i in menus[m].items) {


        // menu.items[i].post = posts[menu.items[i].object_id]
        menus[m].items[i].slug = i


        id = menus[m].items[i].object_id
        menus[m].linear_nav.push(menus[m].items[i])


        counter++;
    }
    menus[m].linear_nav.sort(menu_order);


    //console.log("linear_nav", menus[m].linear_nav);
    // console.log("posts_nav", posts_nav);

}

function setLinearDataNav(m, data) { // sets local data into linear array for wheel
    menus[m].data_nav = []
    menus[m].slug_nav = []
    var counter = 0,
        outer_counter = 0,
        inner_counter = 0,
        inner_subcounter = 0,
        grandparent = 0,
        next_parent = 0,
        dest = 'outer-nav'

    // THESE 3 NESTED LOOPS POPULATE THE data_nav array WITH WHAT IT NEEDS TO BUILD THE WHEEL AND HAVE IT BE CONTROLLED BY THE ORDERED NOTCHES FROM THE NAV
    //console.log(m,data)
    for (var d = 0; d < data.length; d++) { //outer
        dest = 'outer-nav'
        data[d].dest = dest;
        data[d].slice = outer_counter;
        data[d].notch = counter;
        grandparent = counter;
        menus[m].data_nav.push(data[d])
        menus[m].slug_nav[data[d].slug] = counter
        counter++;
        for (var c = 0; c < data[d].children.length; c++) { //children
            data[d].children[c].dest = "inner-nav"
            data[d].children[c].slice = c
            data[d].children[c].notch = counter
            data[d].children[c].parent = grandparent
            next_parent = counter
            menus[m].data_nav.push(data[d].children[c])
            menus[m].slug_nav[data[d].children[c].slug] = counter;
            counter++
            for (var g = 0; g < data[d].children[c].children.length; g++) { //grandchildren
                data[d].children[c].children[g].dest = "inner-subnav"
                data[d].children[c].children[g].slice = g
                data[d].children[c].children[g].notch = counter
                data[d].children[c].children[g].grandparent = grandparent
                data[d].children[c].children[g].parent = next_parent

                menus[m].data_nav.push(data[d].children[c].children[g])
                menus[m].slug_nav[data[d].children[c].children[g].slug] = counter;
                counter++
            }
            // console.log("dataNav", data);
        }

        outer_counter++;

    }
    //console.log("dataNav",m, menus[m].data_nav);
    //console.log("slug_nav",m, menus[m].slug_nav);
}

function getSlug(item, _of, _array, _it) {
    var slug = ''
    if (item != undefined) {
        slug = item.slug
        if (posts[item.object_id] != undefined) {
            slug = posts[item.object_id].slug
        }
    } else {
        //  console.log("get slug item undefined",slug,item.object_id,item,_of,_array,_it)
    }
    return slug

}

function buildMenuData() {

    // needs post variable
    if (posts == undefined) {
        //console.log("No Posts Data Yet",  posts)
        window.setTimeout(buildMenuData(), 10);
    } else {




        for (var m in menus) { // 
            var data = [];
            //console.log('menu loop',m)
            if (menu_config[m] != undefined) {
                var items = ''

                //menus[m].items.sort(function(a,b){return a.menu_order-b.menu_order})



                menus[m].menu_array = [];
                for (var i in menus[m].items) {
                    // console.log('menu item', menus[m].items[i], menu_config[m].location)
                    if (menus[m].items[i].parent == 0) {
                        // console.log("menu", menus[m].items[i].title)

                        menus[m].menu_array.push(menus[m].items[i]);
                    }
                    // items += '<a href="#" class="">' + menus[m].items[i].title + '</a>'

                }
                menus[m].menu_array.sort(menu_order);


                var children = [];
                var this_menu = menus[m].menu_array
                var slug = ''
                for (var a = 0; a < this_menu.length; a++) {
                    children = [];

                    for (var c = 0; c < this_menu[a].children.length; c++) {
                        var grandchildren = [];
                        var nested_children = menus[m].items[this_menu[a].children[c]].children;
                        for (var g = 0; g < nested_children.length; g++) {
                            slug = getSlug(menus[m].items[nested_children[g]], g, "g", nested_children, g)
                            grandchildren.push( // data for childe menus
                                {
                                    "title": menus[m].items[nested_children[g]].title,
                                    "url": menus[m].items[nested_children[g]].url,
                                    "slug": slug,
                                    "object": menus[m].items[nested_children[g]].object,
                                    "object_id": menus[m].items[nested_children[g]].object_id, // the post id
                                    "classes": menus[m].items[nested_children[g]].classes,
                                    "description": menus[m].items[nested_children[g]].description
                                }
                            )

                        }

                        slug = getSlug(menus[m].items[this_menu[a].children[c]], "c", this_menu[a].children[c], c)
                            //console.log('bad slug', menus[m].items[this_menu[a].children[c]])
                        children.push( // data for child menus
                            {
                                "title": menus[m].items[this_menu[a].children[c]].title,
                                "slug": slug,
                                "url": menus[m].items[this_menu[a].children[c]].url,
                                "object": menus[m].items[this_menu[a].children[c]].object,
                                "object_id": menus[m].items[this_menu[a].children[c]].object_id, // the post id
                                "classes": menus[m].items[this_menu[a].children[c]].classes,
                                "description": menus[m].items[this_menu[a].children[c]].description,
                                "children": grandchildren,

                            }
                        )

                    }
                    //console.log('outer', this_menu[a].object_id,  this_menu[a])
                    slug = getSlug(this_menu[a], "o", this_menu, a)
                        //  console.log(this_menu[a])
                    data.push({ // data for top level
                        "title": this_menu[a].title,
                        //"id": this_menu[a].id,
                        "slug": slug,
                        "url": this_menu[a].url,
                        "object": this_menu[a].object,
                        "object_id": this_menu[a].object_id, //the post_id
                        "children": children,
                        "classes": this_menu[a].classes,
                        "description": this_menu[a].description
                    })

                }
                menus[m].menu_levels = data
                menu_levels = data;
                setLinearDataNav(m, data);
                setLinearNav(m)
                    // console.log('data', menus);





                //circleMenu('.circle a')
            }

        }

    }

}
function setChildCategories(data) {
    for (var i = 0; i < data.length; i++) {
        categories[data[i].id] = data[i]
    }
    // console.log('categories', categories)

    return data
}

function setCategories(data) {
    // console.log("categories json", data)
    if (data != null) {
        for (var i = 0; i < data.length; i++) { //creates object of categories by key
            categories[data[i].id] = data[i]
        }
    }
    //  console.log('categories', categories)

    return data
}

function setTaxonomy(data, tax) {
    taxonomies[tax] = {}
    if (data[tax] != null) {
        for (var i = 0; i < data[tax].length; i++) { //creates object of categories by key
            taxonomies[tax][data[tax][i].id] = data[tax][i]
        }
    }
    console.log(tax, taxonomies[tax])

    return data
}

function setTags(data) {
    for (var i = 0; i < data.length; i++) {
        tags[data[i].id] = data[i]
    }
    //console.log('tags', tags)

    return data
}