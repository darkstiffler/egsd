<?php
/*------------- content type Portfolio ---------------*/
// create the portfolio content type
add_action('init', 'portfolio_init');

//init function
function portfolio_init() {
	$args = array(
	    'label' => 'Portfolio',
	    'labels' => array(
	    	'all_items' => 'All Items'
	    ),
		    'public' => true,
	    'show_ui' => true,
	    '_builtin' => false,
	    '_edit_link' => 'post.php?post=%d',
	    'capability_type' => 'post',
	    'hierarchical' => false,
	    'supports' => array('title', 'thumbnail')
	);
	register_post_type( 'portfolio' , $args );
}

add_action( 'init', 'create_portfolio_taxonomies', 0 );
function create_portfolio_taxonomies() {
	$args = array(
	    'hierarchical' => true,
	    'labels' => array('name'=>'Categories'), 
	    'public' => true,
	    'query_var' => true,
	    'show_ui' => true,
	    'rewrite' => true
	    );
	register_taxonomy('portfolio-category', 'portfolio', $args);
    
}
add_action("admin_init", 'portfolio_admin_init');

function portfolio_admin_init() {
    add_meta_box("portfolio-meta", "Details", 'portfolio_options', 'portfolio', 'normal', 'low');
}
function portfolio_options() {
	global $post;
	define('THE_POST', $post->ID);
    echo '<input type="hidden" name="portfolio_noncename" id="portfolio_noncename" value="'.wp_create_nonce('portfolio').'"/>';
    $my_fields = array('content_type'=>'', 'bigImage' => '', 'videoID'=>'', 'thumbImage' => '', 'hoverImage' => '', 'description'=>'', 'link'=>'');
    foreach ($my_fields as $key => $value) {
        $my_fields[$key] = get_post_meta($post->ID, 'portfolio-' . $key, true);
    };
    $shortname = 'portfolio';
		$options = array();

		$options[] = array( "name" => "General Settings",
					"type" => "heading");
		$options[] = array( "name" => "Content Type",
					"desc" => "",
					"id" => $shortname.'-'."content_type",
					"std" => $my_fields["content_type"],
					"type" => "select",
					"options" => array("image"=>"Image",
						"video" => "Video"
						)
					);
		$options[] = array( "name" => "Video URL",
					"desc" => "",
					"id" => $shortname.'-'."videoID",
					"std" => $my_fields['videoID'],
					"type" => "text",
					"container" => "big_video");
		$options[] = array( "name" => "Big Work Image",
					"desc" => "",
					"id" => $shortname.'-'."bigImage",
					"std" => get_post_meta($shortname.'-'."bigImage"),
					"type" => "upload",
					"container" => "big_image"
					);
		$options[] = array( "name" => "Thumbnail Image",
					"desc" => "",
					"id" => $shortname.'-'."thumbImage",
					"std" => get_post_meta($shortname.'-'."thumbImage"),
					"type" => "upload",
					"options" => array(
						"image_crop" => true
						)
					);
		$options[] = array( "name" => "Description",
					"desc" => "",
					"id" => $shortname.'-'."description",
					"std" => $my_fields["description"],
					"type" => "textarea");
		
		$return = options_generator($options, $post->ID);
		echo $return[1];
		admin_script();
}

add_action( 'save_post', 'portfolio_save', 1, 2 );

add_action( 'admin_init', 'sense_options_setup' );

function sense_options_setup() {
	global $pagenow;
	if ('media-upload.php' == $pagenow || 'async-upload.php' == $pagenow) {
		add_custom_image_size();
	}
}


add_action( 'after_setup_theme', 'setup_size' );  
function setup_size() {  
    add_theme_support( 'post-thumbnails' );
    add_image_size( 'custom-size8', 218, 160, true );
    //add_image_size( 'custom-size2', 160, 160, true );
	add_image_size( 'custom-size3', 326, 74, true );
	add_image_size( 'custom-size4', 263, 348, true );
	add_image_size( 'custom-size5', 16, 16, true );
	add_image_size( 'custom-size6', 277, 9999 );
	add_image_size( 'custom-size7', 82, 9999 );
}  

add_filter( 'image_size_names_choose', 'custom_image_sizes_choose' );  

function custom_image_sizes_choose( $sizes ) {  
    $custom_sizes = array(  
        'custom-size8' => 'Portfolio',  
        //'custom-size2' => 'About and Service',  
		'custom-size3' => 'Logo',
		'custom-size4' => 'About',
		'custom-size5' => 'Contact Icon',
		//'custom-size6' => 'Blog Image',
		'custom-size7' => 'Sidebar Thumbnail'
    );  
    return array_merge( $sizes, $custom_sizes );  
}  


function add_custom_image_size() {	
	add_action( 'after_setup_theme', 'add_size' );
	add_filter( 'image_size_names_choose', 'custom_image_sizes_choose' );
}

function portfolio_save() {
	global $post;
	if(isset($post->ID)){
		$post_id = $post->ID;
		if(isset($_POST['portfolio_noncename'])){
			if ( !wp_verify_nonce( $_POST['portfolio_noncename'], 'portfolio')) return $post_id;
		}
		if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;
		$post_flag = 'x';
		if ($post->post_type == "portfolio") {
			$my_fields = array('content_type'=>'', 'bigImage' => '', 'videoID'=>'', 'thumbImage' => '', 'description'=>'');
			$post_flag = 'portfolio';
		}
		if ($post_flag != 'x') {
			foreach ($my_fields as $k=>$v){
				$key = $post_flag . '-' . $k;
				$value = $_POST[$key];
				if (empty($value)){
				 	delete_post_meta($post_id, $key);
				 	continue;
				}
				if (!is_array($value)){
					if (!update_post_meta($post_id, $key, $value)){
						add_post_meta($post_id, $key, $value);
					}
				}else{
					delete_post_meta($post_id, $key);
					foreach ($value as $entry)
						add_post_meta($post_id, $key, $entry);
				}
			}
		}
	}
}

function get_portfolio_category($id = null){
	$categories = get_the_terms( $id, 'portfolio-category' );
	$res = array();
	if(!empty($categories)){
		foreach ( $categories as $val ) {
			$res[] = $val->name;
		}
	}
	return  $res;
}


class MyWalker extends Walker {
	/**
	 * @see Walker::$tree_type
	 * @since 2.1.0
	 * @var string
	 */
	var $tree_type = 'category';

	/**
	 * @see Walker::$db_fields
	 * @since 2.1.0
	 * @todo Decouple this
	 * @var array
	 */
	var $db_fields = array ('parent' => 'parent', 'id' => 'term_id');

	/**
	 * @see Walker::start_lvl()
	 * @since 2.1.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of category. Used for tab indentation.
	 * @param array $args Will only append content if style argument value is 'list'.
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		if ( 'list' != $args['style'] )
			return;

		$indent = str_repeat("\t", $depth);
		$output .= "$indent<ul class='children'>\n";
	}

	/**
	 * @see Walker::end_lvl()
	 * @since 2.1.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int $depth Depth of category. Used for tab indentation.
	 * @param array $args Will only append content if style argument value is 'list'.
	 */
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		if ( 'list' != $args['style'] )
			return;

		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
	}

	/**
	 * @see Walker::start_el()
	 * @since 2.1.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $category Category data object.
	 * @param int $depth Depth of category in reference to parents.
	 * @param array $args
	 */
	function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
		extract($args);

		$cat_name = esc_attr( $category->name );
		$cat_name = apply_filters( 'list_cats', $cat_name, $category );
		$cat_name2 =  preg_replace("/\s{1,}/",'',$cat_name);
		$cat_name2 = preg_replace('/\W+/', '', $cat_name2);
		
		
		$link = '<a href="#' .$cat_name2. '" ';
		if ( $use_desc_for_title == 0 || empty($category->description) )
			$link .= 'title=""';
		else
			$link .= 'title=""';
		$link .= '>';
		$link .= $cat_name . '</a><div></div>';

		if ( !empty($feed_image) || !empty($feed) ) {
			$link .= ' ';

			if ( empty($feed_image) )
				$link .= '(';

			$link .= '<a href="' . esc_url( get_term_feed_link( $category->term_id, $category->taxonomy, $feed_type ) ) . '"';

			if ( empty($feed) ) {
				$alt = ' alt="' . sprintf(__( 'Feed for all posts filed under %s' ), $cat_name ) . '"';
			} else {
				$title = ' title="' . $feed . '"';
				$alt = ' alt="' . $feed . '"';
				$name = $feed;
				$link .= $title;
			}

			$link .= '>';

			if ( empty($feed_image) )
				$link .= $name;
			else
				$link .= "<img src='$feed_image'$alt$title" . ' />';

			$link .= '</a>';

			if ( empty($feed_image) )
				$link .= ')';
		}

		if ( !empty($show_count) )
			$link .= ' (' . intval($category->count) . ')';

		if ( 'list' == $args['style'] ) {
			$output .= "\t<li";
			$class = 'cat-item cat-item-' . $category->term_id;
			if ( !empty($current_category) ) {
				$_current_category = get_term( $current_category, $category->taxonomy );
				if ( $category->term_id == $current_category )
					$class .=  ' current-cat';
				elseif ( $category->term_id == $_current_category->parent )
					$class .=  ' current-cat-parent';
			}
			$output .=  ' class="' . $class . '"';
			$output .= ">$link\n";
		} else {
			$output .= "\t$link<br />\n";
		}
	}

	/**
	 * @see Walker::end_el()
	 * @since 2.1.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $page Not used.
	 * @param int $depth Depth of category. Not used.
	 * @param array $args Only uses 'list' for whether should append to output.
	 */
	function end_el( &$output, $page, $depth = 0, $args = array() ) {
		if ( 'list' != $args['style'] )
			return;

		$output .= "</li>\n";
	}

}



