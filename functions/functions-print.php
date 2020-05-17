<?php
    function get_page_properties_print($value){
        return array(
                "title"=>$value->post_title,
                "content"=>do_blocks($value->post_content),
                "slug"=>$value->post_name,
                "print_template"=>get_post_meta($value->ID,"print_template",true),
                "full_bleed"=>get_post_meta($value->ID,"full_bleed",true),
                

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

?>