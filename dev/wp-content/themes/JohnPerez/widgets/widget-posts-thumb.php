<?php

add_action( 'widgets_init', 'pt_posts_thumb_widget' );

function pt_posts_thumb_widget() {
	register_widget( 'Posts_Widget' );
	register_widget( 'Posts_Widget2' );
}


class Posts_Widget extends WP_Widget {
	
	function Posts_Widget() {
		global $themename;
		
		$widget_ops = array( 'classname' => 'widget-posts-latest', 'description' => __('Latest Work commented posts with thumbnails', 'premitheme') );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'posts-widget-latest' ); //default width = 250
		$this->WP_Widget( 'posts-widget-latest', $themename.' - '.__('Latest Work', 'premitheme'), $widget_ops, $control_ops );
	}




/*-------------------------------/
	UPDATE & SAVE SETTINGS
/-------------------------------*/
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['type'] = strip_tags( $new_instance['type'] );
		$instance['count'] = strip_tags( $new_instance['count'] );
		
		return $instance;
	}
	
	
/*-------------------------------/
	RENDER WIDGET
/-------------------------------*/
	function widget($args, $instance) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		
		$count = $instance['count'];
		
		//echo $before_widget;
		
		?> <div class="white_box"> <?php
		if ( $title )?><h2  class="ind"> <?php echo $title; ?></h2>
		
		<ul class="latest_works" >
        
        
        
		<?php
		global $post;
		$tmp_post = $post;
		
		
		$args = array( 'post_type'=>'portfolio'
										  ,'numberposts' => $count);
							$myposts = get_posts( $args );
		
		
	
		
		?> <li><?php
		
		
		foreach( $myposts as $post ) : setup_postdata($post);
		 
		 $url_thumb = get_post_meta($post->ID, 'portfolio-thumbImage', true);
		  if(get_post_meta($post->ID, 'portfolio-content_type', true)=='video')
		  {
			
			$url = get_post_meta($post->ID, 'portfolio-videoID', true);
		  }else
		  {
				$url = get_post_meta($post->ID, 'portfolio-bigImage', true);
		  }
		?>
		
      
                <a data-title="<?php echo get_post_meta($post->ID, 'portfolio-description', true)?>" class="jackbox" data-group="images" href="<?php echo $url ?>">
					
					<div class="wid_thumb"><img src="<?php echo get_post_meta($post->ID, 'portfolio-thumbImage', true);?>" alt=""></div>
					
				</a>
         
		<?php 
		
		endforeach;
		
		?> </li>
		<?php
		
		$post = $tmp_post; ?>
		</ul>
		</div>
		<?php 
		//echo $after_widget;
	}
	
	
/*-------------------------------/
	WIDGET SETTINGS
/-------------------------------*/
	function form($instance) {
		$defaults = array( 'title' => '', 'type' => 'recent', 'count' => '5');
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
		
		<p>
			<label><?php _e('Title', 'premitheme');?>:
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
			</label>
		</p>
		
		<p>
			<label><?php _e('Posts to show', 'premitheme');?>:
			
			</label>
		</p>
		
		<p>
			<label><?php _e('No. of posts', 'premitheme');?>:
			<input id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" value="<?php echo $instance['count']; ?>" type="text" size="3"/>
			</label>
		</p>
		
		<?php		
	}
}







class Posts_Widget2 extends WP_Widget {
	
	function Posts_Widget2() {
		global $themename;
		
		$widget_ops = array( 'classname' => 'widget-posts-thumbs', 'description' => __('Popular commented posts', 'premitheme') );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'posts-widget' ); //default width = 250
		$this->WP_Widget( 'posts-widget', $themename.' - '.__('Popular Posts', 'premitheme'), $widget_ops, $control_ops );
	}




/*-------------------------------/
	UPDATE & SAVE SETTINGS
/-------------------------------*/
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['type'] = strip_tags( $new_instance['type'] );
		$instance['count'] = strip_tags( $new_instance['count'] );
		
		return $instance;
	}
	
	
/*-------------------------------/
	RENDER WIDGET
/-------------------------------*/
	function widget($args, $instance) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$type = $instance['type'];
		$count = $instance['count'];
		
		//echo $before_widget;
		
		?> <div class="white_box"> <?php
		if ( $title )?><h2  class="ind"> <?php echo $title; ?></h2>
	
        <ul class="ext_list p_post" >
        
        
		<?php
		global $post;
		$tmp_post = $post;
		
		
		$myposts = get_posts('numberposts='.$count.'&order=DESC&orderby=comment_count');
		

		foreach( $myposts as $post ) : setup_postdata($post);
		?>
        
		<li>
			
			<div class="popular-post-comment">
			 <div class="popular-post"> <a href="<?php the_permalink();?>">  <h3 title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></h3></a></div>
				
				<time datetime="<?php echo get_the_date('d M');?>"><?php echo get_the_date('d M');?>,</time>
				<a href="#" class="comment_link"><?php comments_popup_link('0 comments', '1 comments', '(%) comments');?></a>
		    </div>

			
		</li>	
		<?php 
		
		endforeach;

		$post = $tmp_post; ?>
		</ul>
		</div>
		<?php 
		//echo $after_widget;
	}
	
	
/*-------------------------------/
	WIDGET SETTINGS
/-------------------------------*/
	function form($instance) {
		$defaults = array( 'title' => '', 'type' => 'recent', 'count' => '5');
		$instance = wp_parse_args( (array) $instance, $defaults );
		?>
		
		<p>
			<label><?php _e('Title', 'premitheme');?>:
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" type="text" />
			</label>
		</p>
		
		<p>
			<label><?php _e('Posts to show', 'premitheme');?>:
			
			</label>
		</p>
		
		<p>
			<label><?php _e('No. of posts', 'premitheme');?>:
			<input id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" value="<?php echo $instance['count']; ?>" type="text" size="3"/>
			</label>
		</p>
		
		<?php		
	}
}
