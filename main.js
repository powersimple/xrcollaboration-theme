jQuery(document).ready(function() {
    console.log("loaded");
});
jQuery(window).resize(function() {

});

(function() {
    'use strict';
    // this function is strict...
}());
var menu = {},
    this_item = {}

function setVideo(url) {
    jQuery('#video-player').attr("src", url);
}

function initSite() {
    megaMenu();

    if (menus == undefined) {
        window.setTimeout(initSite(), 100);
    }
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




jQuery(document).ready(function() {
    jQuery("#resource-accordion").accordion({
        header: "h3",
        collapsible: true,
        autoHeight: false,
        navigation: true
    });
});
function megaMenu(){
    var classes = ''
    var megamenu = '<nav id="megamenu" class="content">'
    megamenu += '<ul class="exo-menu">';
    
     megamenu += getMegaMenu(menus.megamenu.menu_levels,classes);
     
    megamenu += '<a href="#" class="toggle-menu visible-xs-block"><i class="fa fa-bars"></i></a>'


    megamenu += '</ul></nav>'
//    console.log(megamenu)
    jQuery("#main-menu").html(megamenu);
}
function getMegaMenu(items,parent_classes){
    
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
    for(var i=0; i<items.length;i++){
        
        this_item = items[i]
        headwrap = ''
        footwrap = ''
        classes = ''
        link = ''
        outer = 'li'

        if(this_item.classes != ''){
            classes = ' class="' + this_item.classes + '"'
            ulclass = this_item.classes + '-ul'
                
        }
           
           
        if(this_item.classes.indexOf('mega-drop-down')){
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
        if(this_item.parent_classes == 'mega-drop-down'){
            outer = 'div'
        }
        if(this_item.object == 'gradelevel'){
        console.log("obj",this_item)
        }
        switch(this_item.object) {
            case "page": link = this_item.url
            break
            case "category" : link = this_item.url
            break
            case "gradelevel" : link = this_item.url
            break
              case "custom": link = this_item.url
              
              break

            case "conference": link = this_item.url
            break
            case "award": link = this_item.url
            break

            // default: link = '#';
        }
    //    console.log(this_item)
    
        if(this_item.target != ''){
            target = ' target="_blank"'
        } 
        if(link == ''){
            //menu_items += '<' + outer + ' ' + classes + '><span>' + this_item.title + '</span>' this needs to open the dropdown
             menu_items += '<' + outer + ' ' + classes + '><a href="' + link + '"' + target + '>' + this_item.title + '</a>'
        } else {
         menu_items += '<' + outer + ' ' + classes + '><a href="' + link + '"'+target+'>' + this_item.title + '</a>'
        }

        if (this_item.children != undefined) {
        
            if(this_item.children.length>0){
                menu_items += headwrap
           //     console.log("wrap",headwrap,footwrap)
                menu_items += getMegaMenu(this_item.children, this_item.classes)
                
                menu_items += footwrap

            }
        }
        menu_items += '</li>'


    }
  
    return menu_items;
}
