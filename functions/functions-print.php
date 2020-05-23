<?php
    function get_page_properties_print($value){
        return array(
                "title"=>$value->post_title,
                "content"=>do_blocks($value->post_content),
                "slug"=>$value->post_name,
                "print_template"=>get_post_meta($value->ID,"print_template",true),
                "full_bleed"=>get_post_meta($value->ID,"full_bleed",true),
                "hero"=>get_post_meta($value->ID,"hero",true),
                
                

            );
        
    }
	function get_children_print($parent_id){
		$children = get_children( array("post_parent"=>$parent_id,'post_type'=>'page','orderby' => 'menu_order ASC','order' => 'ASC') );
        $child_list = array();
        $counter = 0;
		foreach ($children as $key => $value) {
            
            $child_list[$counter] = get_page_properties_print($value);
			$counter++;
		}
		return $child_list;
    }
    function printable_page($page){
        extract($page);
        if($print_template == "two_columns_sans_header"){
            
            print '<div class="two_columns_sans_header">';
            print $content;
            print '</div>';
        
        }


    }

    // THIS CREATES THE METABOX FOR PRINT STYLES: Requires Meta Box plugin.

    function print_styles( $meta_boxes ) {
        $prefix = '';

        $meta_boxes[] = array(
            'id' => 'print_styles',
            'title' => esc_html__( 'Print Styles', 'ps_metabox' ),
            'post_types' => array( 'page' ),
            'context' => 'side',
            'priority' => 'high',
            'autosave' => true,
            'fields' => array(
            array(
				'id' => $prefix . 'print_template',
				'name' => esc_html__( 'Print Template', 'metabox-online-generator' ),
				'type' => 'select_advanced',
				'desc' => esc_html__( 'Choose Style template for printable page', 'metabox-online-generator' ),
				'placeholder' => esc_html__( 'Select an Item', 'metabox-online-generator' ),
				'options' => array(
                    'no_column' => esc_html__( 'No Columns', 'metabox-online-generator' ),
					'hero' => esc_html__( 'Hero', 'metabox-online-generator' ),
					'two_columns_with_header' => esc_html__( 'Two Columns with Header', 'metabox-online-generator' ),
					'two_columns_sans_header' => esc_html__( 'Two Columns Sans Header', 'metabox-online-generator' ),
					'table_of_contents' => esc_html__( 'Table of Contents', 'metabox-online-generator' )
					
				),
            ),
            
			array(
				'id' => $prefix . 'full_bleed',
				'name' => esc_html__( 'Full Bleed', 'metabox-online-generator' ),
				'type' => 'checkbox',
				'desc' => esc_html__( 'Page has no margins', 'metabox-online-generator' ),
			),
                
            
            ),
        );

        return $meta_boxes;
    }
    add_filter( 'rwmb_meta_boxes', 'print_styles' );
function compileGuide($guide_parent){
    global $wpdb;

    $sql = "select ID, post_title, post_content, post_name from wp_posts where post_parent = $guide_parent and post_status = 'publish' order by menu_order";
    
    return $wpdb->get_results($sql); 

}

function getTOC($content,$slug,$link_type="anchor"){
    $html = str_get_html($content);

    $toc = '';
    $last_level = 0;

    foreach($html->find('h1,h2, h3') as $h){// add back,h4,h5 if needed
        $innerTEXT = trim($h->innertext);
        $id =  str_replace(' ','-',sanitize_title(strtolower($innerTEXT)));
        $h->id= $id; // add id attribute so we can jump to this element
        $level = intval($h->tag[1]);

        if($level > $last_level)
            $toc .= "<ul>";
        else{
            $toc .= str_repeat('</li></ul>', $last_level - $level);
            $toc .= '</li>';
        }
        if($link_type=="anchor"){
        $toc .= "<li><a  class='toc-h".$level."' href='#{$id}'>";
        } else{
             $toc .= "<li><a  class='toc-h".$level."' href='/guide/$slug'>";
        }
        $toc .= "{$innerTEXT}</a>";

        $last_level = $level;
    }

    $toc .= str_repeat('</li></ul>', $last_level);
    $html_with_toc = $toc . "" . $html->save();

    return $toc;
}

function auto_id_headings( $content ) {

	$content = preg_replace_callback( '/(\<h[1-6](.*?))\>(.*)(<\/h[1-6]>)/i', function( $matches ) {
		if ( ! stripos( $matches[0], 'id=' ) ) :
			$matches[0] = $matches[1] . $matches[2] . ' id="' . sanitize_title( $matches[3] ) . '">' . $matches[3] . $matches[4];
		endif;
		return $matches[0];
	}, $content );

    return $content;

}

function wp_get_menu_array($current_menu) {
 
    $array_menu = wp_get_nav_menu_items($current_menu);
    $menu = array();
    foreach ($array_menu as $m) {
        if (empty($m->menu_item_parent)) {
            $menu[$m->ID] = array();
            $menu[$m->ID]['ID']      =   $m->object_id;
            $menu[$m->ID]['title']       =   $m->title;
            $menu[$m->ID]['classes']         =   $m->classes;
            $menu[$m->ID]['url'] = get_post_meta($m->object_id,"url",true);
            $menu[$m->ID]['company'] = get_post_meta($m->object_id,"company",true);
            $menu[$m->ID]['logo'] = @wp_get_attachment_image_src(get_post_meta($m->object_id,"logo",true))[0];
            $menu[$m->ID]['thumbnail'] =  getThumbnail(get_post_meta($m->object_id,"_thumbnail_id",true));
            
            $menu[$m->ID]['children']    =   array();
        }
    }
    $submenu = array();
    foreach ($array_menu as $m) {
        if ($m->menu_item_parent) {
            $submenu[$m->ID] = array();
            $submenu[$m->ID]['ID']       =   $m->object_id;
            $submenu[$m->ID]['title']    =   $m->title;
            $submenu[$m->ID]['url']  =  get_post_meta($m->object_id,"url",true);
            $menu[$m->ID]['logo'] =  wp_get_attachment_image_src(get_post_meta($m->object_id,"logo",false));
            $menu[$m->ID]['thumbnail'] =  get_post_meta($m->object_id,"_thumbnail_id",true);
            $menu[$m->menu_item_parent]['children'][$m->ID] = $submenu[$m->ID];

        }
    }
    return $menu;
     
}


function sectionMenu($menu,$image_field,$cols){
        $section_menu = wp_get_menu_array($menu);
        if($cols == 4){
            $default_cols = 'col-sm-3';
        } else if ($cols == 3){
            $default_cols = 'col-sm-4';
        }
        
        ob_start();


        print "<table class='section_menu'><tr>";
        $counter = 1;
        foreach($section_menu as $key){
            $colspan = '';
            if(in_array("lead-sponsor",@$key['classes'])){
                if($cols == 4){
                    $span = 2;
                } else if ($cols ==3){
                    $span = 1;
                }
                $colspan = "colspan = $span";
            }
            extract($key);
            $this_class = trim(implode(" ",@$key['classes']));
            if( $this_class == ''){
                $this_class = "$default_cols";
            }
            if(in_array("left-1-col",@$key['classes'])){
               
                print "<td class='$this_class'></td>";
            }

            print "<td $colspan class='$this_class'>";
            if(@$title){
               
              print "<a href='$url' target='_blank'><img src='$key[$image_field]' alt='$title logo'><BR><strong>$title</strong>";
                   if(@$company){
                        print "<br>".$company;
                        
                        }
             print "</a>";
                    
            }
            print "</td>";
            if(in_array("right-1-col",@$key['classes'])){
               
                print "<td class='$this_class'></td>";
            }
            if($cols == '4' && (($counter/4) == intval($counter/4))){
                print "</tr></tr>";
            } else if($cols == '3' && (($counter/3) == intval($counter/3))){
                print "</tr></tr>";
                

            } 
            if(in_array("lead-sponsor",@$key['classes'])){
                print "</tr></tr>";
                // skips counting for first row.    

            } else{ 
                $counter++;
            }
        }
        print "</tr></table>";
 
        return ob_get_clean();
      
}
function replace_vars($content,$slug,$link_type="link"){
     $author_menu = sectionMenu("authors",'thumbnail','4');
 $sponsor_menu = sectionMenu("sponsors",'logo','4');
    $content = do_blocks($content);
    $content = str_replace("{{TOC}}",getTOC($content,$slug,$link_type),$content);

    $content = auto_id_headings($content);

    $content = str_replace("{{sponsor_menu}}",@$sponsor_menu,$content);
    $content = str_replace("{{authors}}",@$author_menu,$content);
return $content;
}
?>