<?php
class description_walker extends Walker_Nav_Menu{
	function start_el(&$output, $item, $depth, $args){
		if((is_object($args))&&(is_object($args))){
			global $wp_query;
			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
			$add_class = '';
			
			if($item->url=='#blog')$add_class = PAGE_TYPE;
			$class_names = $value = '';
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
			$class_names = ' class="'. esc_attr( $class_names ) . $add_class .'"';
			$output .= $indent . '<li class="'  . esc_attr( $item->attr_title ) .'" id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
			$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
			$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
			$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
			$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
			$prepend = '';
			$append = '';
			$description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';
			if($depth != 0){
		        $description = $append = $prepend = "";
			}
			$item_output = $args->before;
			$item_output .= '<a'. $attributes .'><em></em><span>';
			$item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
			$item_output .= $description.$args->link_after;
			$item_output .= '</span></a>';
			$item_output .= $args->after;
			if($item->url=='#about')if(get_option('sense_show_about')!='true')$item_output = '';
			if($item->url=='#portfolio')if(get_option('sense_show_portfolio')!='true')$item_output = '';
			if($item->url=='#services')if(get_option('sense_show_services')!='true')$item_output = '';
			if($item->url=='#blog')if(get_option('sense_show_blog')!='true')$item_output = '';
			if($item->url=='#contact')if(get_option('sense_show_contacts')!='true')$item_output = '';
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}
}

class description_walker_splash extends Walker_Nav_Menu{
	function start_el(&$output, $item, $depth, $args){
		if((is_object($args))&&(is_object($args))){
			global $wp_query;
			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
			$add_class = '';
			
			if($item->url=='#blog')$add_class = PAGE_TYPE;
			$class_names = $value = '';
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			
			$class_names = ' class="'. esc_attr( $class_names ) . $add_class .'"';
			$output .= $indent . '<li class="grid_2" >';
			$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
			$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
			$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
			$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
			$prepend = '';
			$append = '';
			$description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';
			if($depth != 0){
		        $description = $append = $prepend = "";
			}
			$item_output = $args->before;
			
			$path_icon = get_template_directory_uri() . '/images/splash_' . esc_attr( $item->attr_title ) . '.png';
			$item_output .= '<a'. $attributes .'><em class="menu_icon"><img src="'. $path_icon .'" alt=""></em><span>';
			
			
			
			$item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
			$item_output .= $description.$args->link_after;
			$item_output .= '</span></a>';
			$item_output .= $args->after;
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}
}



function show_nav(){
?>
     <nav class="menu">
     
     	<ul id="menu">
        
        
                          <?php if((get_option('sense_show_about')) == 'true'){  ?>
                          <li class="about_link"><a href="#!/about"><em></em><span><?php echo get_option('sense_name_button_about'); ?></span></a></li>
                           <?php } ?>
                           <?php if((get_option('sense_show_portfolio')) == 'true'){  ?>
                          <li class="port_link"><a href="#!/portfolio"><em></em><span><?php echo get_option('sense_name_button_portfolio'); ?></span></a></li> 
                          <?php } ?>
                          <?php if((get_option('sense_show_services')) == 'true'){  ?>
                          <li class="service_link"><a href="#!/services"><em></em><span><?php echo get_option('sense_name_button_services'); ?></span></a></li>
                          <?php } ?>
                           <?php  if((get_option('sense_show_blog')) == 'true'){  ?>
                          <li class="blog_link"><a href="<?php echo home_url();  ?>/blog"><em></em><span><?php echo get_option('sense_name_button_blog'); ?></span></a></li>
                          <?php } ?>
                          <?php if((get_option('sense_show_contacts')) == 'true'){  ?>
                          <li class="contact_link"><a  href="#!/contacts"><em></em><span><?php echo get_option('sense_name_button_contact'); ?></span></a></li>
                          <?php } ?>
                          
                          
        </ul>
     
     
     
     
    
			  </nav>    
<?php
};

function show_nav_blog(){
?>
     <nav class="menu">
     
     	<ul id="menu">
        
        
                          <?php if((get_option('sense_show_about')) == 'true'){  ?>
                          <li class="about_link"><a href="<?php echo home_url();  ?>#!/about"><em></em><span><?php echo get_option('sense_name_button_about'); ?></span></a></li>
                           <?php } ?>
                           <?php if((get_option('sense_show_portfolio')) == 'true'){  ?>
                          <li class="port_link"><a href="<?php echo home_url();  ?>#!/portfolio"><em></em><span><?php echo get_option('sense_name_button_portfolio'); ?></span></a></li> 
                          <?php } ?>
                          <?php if((get_option('sense_show_services')) == 'true'){  ?>
                          <li class="service_link"><a href="<?php echo home_url();  ?>#!/services"><em></em><span><?php echo get_option('sense_name_button_services'); ?></span></a></li>
                          <?php } ?>
                           <?php  if((get_option('sense_show_blog')) == 'true'){  ?>
                          <li class="blog_link"><a href="<?php echo home_url();  ?>/blog"><em></em><span><?php echo get_option('sense_name_button_blog'); ?></span></a></li>
                          <?php } ?>
                          <?php if((get_option('sense_show_contacts')) == 'true'){  ?>
                          <li class="contact_link"><a  href="<?php echo home_url();  ?>#!/contacts"><em></em><span><?php echo get_option('sense_name_button_contact'); ?></span></a></li>
                          <?php } ?>
                          
                          
        </ul>
			  </nav>    
<?php
};



function show_nav_splash(){
?>
     <nav class="splashHolder">
   
     <ul class="splash_menu">
     				<?php if((get_option('sense_show_about')) == 'true'){  ?>
                        <li>
                            <a href="#!/about">
                              <em class="menu_icon"><img src="<?php echo get_template_directory_uri(); ?>/images/splash_about_icon.png" alt=""></em>
                              <span><?php echo get_option('sense_name_button_about'); ?></span>
                            </a>
                        </li>
                     <?php } ?>
                     
                     <?php if((get_option('sense_show_portfolio')) == 'true'){  ?>
                        <li>
                            <a href="#!/portfolio">
                                <em class="menu_icon"><img src="<?php echo get_template_directory_uri(); ?>/images/splash_portfolio_icon.png" alt=""></em>
                                <span><?php echo get_option('sense_name_button_portfolio'); ?></span>
                            </a>
                        </li> 
                      <?php } ?>
                     <?php if((get_option('sense_show_services')) == 'true'){  ?>
                        <li>
                            <a href="#!/services">
                              <em class="menu_icon"><img src="<?php echo get_template_directory_uri(); ?>/images/splash_services_icon.png" alt=""></em>
                              <span><?php echo get_option('sense_name_button_services'); ?></span>
                            </a>
                        </li>
                      <?php } ?>
                     <?php  if((get_option('sense_show_blog')) == 'true'){  ?>
                         <li>
                            <a href="<?php echo home_url();  ?>/blog">
                              <em class="menu_icon"><img src="<?php echo get_template_directory_uri(); ?>/images/splash_blog_icon.png" alt=""></em>
                              <span><?php echo get_option('sense_name_button_blog'); ?></span>
                            </a>
                        </li>
                      <?php } ?>
                     <?php if((get_option('sense_show_contacts')) == 'true'){  ?>
                        <li class="last-col">
                            <a  href="#!/contacts">
                              <em class="menu_icon"><img src="<?php echo get_template_directory_uri(); ?>/images/splash_contact_icon.png" alt=""></em>
                              <span><?php echo get_option('sense_name_button_contact'); ?></span>
                            </a>
                        </li>
		 			 <?php } ?>
        
        </ul>
			  </nav>    
<?php
};


function HexToRGB($hex) {
	$hex = ereg_replace("#", "", $hex);
	$color = array();
	if(strlen($hex) == 3) {
		$color['r'] = hexdec(substr($hex, 0, 1) . $r);
		$color['g'] = hexdec(substr($hex, 1, 1) . $g);
		$color['b'] = hexdec(substr($hex, 2, 1) . $b);
	}
	else if(strlen($hex) == 6) {
		$color['r'] = hexdec(substr($hex, 0, 2));
		$color['g'] = hexdec(substr($hex, 2, 2));
		$color['b'] = hexdec(substr($hex, 4, 2));
	}
	return $color;
}

function my_start_lvl(&$output, $depth) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul class=\"sub-menu\">\n";
}
function my_end_lvl(&$output, $depth) {
    $indent = str_repeat("\t", $depth);
    $output .= "$indent</ul>\n";
}

add_filter('start_lvl', 'my_start_lvl');
add_filter('end_lvl', 'my_end_lvl');


function sense_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
         			<figure><?php $avatar_size = 68; ?>
						<?php echo get_avatar( $comment, $avatar_size ); ?>
                    </figure>
                <div>
                   <div class="author"><strong><?php comment_author($comment->comment_ID);?></strong> says:</div>
                      <div class="date_reply"><time><?php comment_date('F j, Y'); ?>,</time> <a href="#"><?php echo get_comment_reply_link(array( 'reply_text' => 'Reply', 'depth'=>1, 'max_depth'=>5)); ?></a></div>
                      <?php comment_text(); ?>
                      
                      
                </div> 
          </li>
				<?php // comment_reply_link( array_merge( $args, array( 'reply_text' => 'Reply <span>&darr;</span>'), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
<?php } ?>