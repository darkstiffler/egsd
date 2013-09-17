<?php
/**
 * @package WordPress
 * @subpackage Theme_Compat
 * @deprecated 3.0
 *
 * This file is here for Backwards compatibility with old themes and will be removed in a future version
 *
 */
 

  
 
//_deprecated_file( sprintf( __( 'Theme without %1$s' ), basename(__FILE__) ), '3.0', null, sprintf( __('Please include a %1$s template in your theme.'), basename(__FILE__) ) );
?>



	<div id="sidebar" role="complementary">
	
	
	 <div class="white_box">
        <h2 class="ind1">Categories</h2>
	    <ul class="list1" >
			<?php wp_list_categories(array('show_count' => 1, 'title_li' => '')); ?>
		</ul>
      </div>
	  
	  
		 <div class="white_box">
            <h2 class="ind">Latest Work</h2>
			 <ul class="latest_works" >
				<?php the_recent_posts (6); ?>  
			 </ul>
		 </div>
		 
		
		 <div class="white_box">
		  <h2 class="ind">Popular Posts</h2>
		  <ul class="ext_list p_post">
			    <?php the_popular_posts(3); ?>
		  </ul>
		</div>	
		
	</div>
