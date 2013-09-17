<?php
define( 'THEMENAME', 'Perez' ); 
function register_my_menus() {  register_nav_menus();}add_action( 'init', 'register_my_menus' );if ( ! isset( $content_width ) ) $content_width = 900;$data = array(	'before'           => '<p>' .'Pages:',	'after'            => '</p>',	'link_before'      => '',	'link_after'       => '',	'next_or_number'   => 'number',	'nextpagelink'     => 'Next page',	'previouspagelink' => 'Previous page',	'pagelink'         => '%',	'echo'             => 1);wp_link_pages( $data ); wp_list_comments();if ( is_singular() ) wp_enqueue_script( "comment-reply" );

define('ADMIN_PATH', get_template_directory() . '/admin');

$temp = wp_upload_dir();

define('UPLOAD_PATH', $temp['path'].'/');

define('UPLOAD_SUBDIR', $temp['subdir'].'/');

define('UPLOAD_URL', $temp['baseurl'].'/');



require_once(get_template_directory() . '/print_pages.php');

include(get_template_directory() . '/styles.php');

require_once(ADMIN_PATH . '/portfolio.php');

require_once(ADMIN_PATH . '/admin_script.php');

require_once(ADMIN_PATH . '/interface.php');

require_once(ADMIN_PATH . '/other_function.php');











// Add buttons to html editor

add_action('admin_print_footer_scripts','eg_quicktags');

function eg_quicktags() {

?>

<script type="text/javascript" charset="utf-8">

	/* Adding Quicktag buttons to the editor Wordpress ver. 3.3 and above

	 * - Button HTML ID (required)

	 * - Button display, value="" attribute (required)

	 * - Opening Tag (required)

	 * - Closing Tag (required)

	 * - Access key, accesskey="" attribute for the button (optional)

	 * - Title, title="" attribute (optional)

	 * - Priority/position on bar, 1-9 = first, 11-19 = second, 21-29 = third, etc. (optional)

	 */

	QTags.addButton( 'eg_paragraph', 'p', '<p class="blank">', '</p>', 'p' );

	QTags.addButton( 'eg_br', 'br','<br class="blank"/>', '<br class="blank"/>', 'r' );

</script>

<?php

}











define('URL_PATH', get_template_directory_uri().'/');













add_action( 'admin_menu', 'adjust_the_wp_menu', 999 );

function adjust_the_wp_menu() {

  $page = remove_submenu_page( 'themes.php', 'nav-menus.php' );

}















// Add custom field 'Blogpost type' to post type  ////////////////////////////

  add_action('add_meta_boxes','init_metabox_blogposttype');

  

  function init_metabox_blogposttype(){

      add_meta_box('meta_blogposttype', 'Post Type', 'meta_blogposttype_cb', 'post', 'normal');

  }

  

  function meta_blogposttype_cb($post){

      $dispo = get_post_meta($post->ID,'meta_blogposttype',true);

      echo '<label for="meta_blogposttype">Media :</label>';

      echo '<select id="meta_blogposttype" name="meta_blogposttype">';

          echo '<option value="image" '.selected($dispo, 'image').'>Image</option>';

          echo '<option value="video" '.selected($dispo, 'video').'>Video</option>';

      echo '</select>';

  }

  

  add_action('save_post','save_metabox_blogposttype');

  

  function save_metabox_blogposttype($post_id){

      if(isset($_POST['meta_blogposttype']))

          update_post_meta($post_id, 'meta_blogposttype', esc_html($_POST['meta_blogposttype']));

  }

 //////////////////////////////////////////////////////////

 function full_image_metabox(){

  add_meta_box("xxxx_image_box","Full Post Image","image_metabox_","post","normal","high");

}



function image_metabox_($post){

  $url_image = get_post_meta($post->ID,'_url_image',true);

  ?>

  <label for="url_image">Select an image</label><input id="url_image" style="width: 450px;" type="text" name="url_image" value="<?php echo esc_url( $url_image ); ?>" />

  <input id="upload_image_button" class="button-secondary" type="button" value="Upload an image" />

  <input id="delete_image_button" class="button-secondary" type="button" value="Suppress" />  

  <?php

  

  global $post;

  $fim = get_post_meta($post->ID,'_url_image',true);

  echo '<br/><img id="uploaded-pic" src="'.esc_url($fim).'" width="100" height="100"/>';



  

  ?>

  <?php

}



//add_action('save_post', 'save_custom');



function save_custom($post_ID){

  if ( isset( $_POST['url_image'] ) ) {

    update_post_meta( $post_ID, '_url_image', esc_url_raw( $_POST['url_image'] ) );

  }

}



//add_action('add_meta_boxes','full_image_metabox');





 	// Add custom field 'video type' to blog post type  ////////////////////////////

  add_action('add_meta_boxes','init_metabox_blogvideoservice');

  

  function init_metabox_blogvideoservice(){

      add_meta_box('meta_blogvideoservice', 'Video Service', 'meta_blogvideoservice_cb', 'post', 'normal');

  }

  

  function meta_blogvideoservice_cb($post){

      $dispo1 = get_post_meta($post->ID,'meta_blogvideoservice',true);

      $dispo2 = get_post_meta($post->ID,'meta_blogvideourl',true);

      echo '<label for="meta_blogvideoservice">Service :</label>';

      echo '<select id="meta_blogvideoservice" name="meta_blogvideoservice">';

          echo '<option value="vimeo" '.selected($dispo1, 'vimeo').'>Vimeo</option>';

          echo '<option value="youtube" '.selected($dispo1, 'youtube').'>YouTube</option>';

		  echo '<option value="html5" '.selected($dispo1, 'html5').'>HTML5</option>';

      echo '</select>';

      echo '<br /><label for="meta_blogvideourl">Video ID :</label>';

      echo '<input id="meta_blogvideourl" name="meta_blogvideourl" value="'.$dispo2.'">';

  }

  

  add_action('save_post','save_metabox_blogvideoservice');

  if ( ! function_exists( 'get_page_number' ) ) {
	function get_page_number() {
		if ( get_query_var('paged') ) {
			print ' | ' . __( 'Page ' , THEMENAME) . get_query_var('paged');
		}
	} 
}

/*--------------------------------------------------------------------------------------------------
	Pagination Functions
--------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'zn_pagination' ) ) {	
	function zn_pagination($pages = '', $range = 2)
	{  
		$showitems = ($range * 2)+1;  

		global $paged;
		if(empty($paged)) $paged = 1;

		if($pages == '')
		{
			global $wp_query;
			$pages = $wp_query->max_num_pages;
			
			if(!$pages)	{	$pages = 1;	}
			
		}   

		if(1 != $pages)
		{
		//__( 'Published in', THEMENAME )
			echo "<div class='pagination'>";
			echo '<ul>';
			
			if(1 == $paged) {
				echo '<li class="pagination-start"><span class="pagenav">'.__( 'Start', THEMENAME ).'</span></li>';
				echo '<li class="pagination-prev"><span class="pagenav">'.__( 'Prev', THEMENAME ).'</span></li>';
			}
			else {
				echo '<li class="pagination-start"><a href="'.get_pagenum_link(1).'">'.__( 'Start', THEMENAME ).'</a></li>';
				echo '<li class="pagination-prev"><a href="'.get_pagenum_link($paged-1).'">'.__( 'Prev', THEMENAME ).'</a></li>';
			}

			for ($i=1; $i <= $pages; $i++)
			{
				if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
				{
					//echo ($paged == $i)? "<span class='current zn_default_color_active'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive zn_default_color' >".$i."</a>";
					echo ($paged == $i)? '<li><span class="pagenav">'.$i.'</span></li>':'<li><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
				}
			}
			
			if($paged < $pages ) {
				echo '<li class="pagination-next"><a href="'.get_pagenum_link($paged+1).'">'.__( 'Next', THEMENAME ).'</a></li>';
				echo '<li class="pagination-end"><a href="'.get_pagenum_link($pages).'">'.__( 'End', THEMENAME ).'</a></li>';
			}
			else {
				echo '<li class="pagination-next"><span class="pagenav">'.__( 'Next', THEMENAME ).'</span></li>';
				echo '<li class="pagination-end"><span class="pagenav">'.__( 'End', THEMENAME ).'</span></li>';
			}
			
			echo '</ul>';
			echo '<div class="clear"></div>';
			echo ''.__( 'Page', THEMENAME ).' '.$paged.' '.__( 'of', THEMENAME ).' '.$pages.'';
			echo "</div>\n";
		}
	}
}


  function save_metabox_blogvideoservice($post_id){

      if(isset($_POST['meta_blogvideoservice']))

          update_post_meta($post_id, 'meta_blogvideoservice', esc_html($_POST['meta_blogvideoservice']));

      if(isset($_POST['meta_blogvideourl']))

          update_post_meta($post_id, 'meta_blogvideourl', esc_html($_POST['meta_blogvideourl']));

  }





function new_excerpt_length($length) {  

    return 20;  

}  

add_filter('excerpt_length', 'new_excerpt_length');  



function new_excerpt_more($more) {  

    return ' <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">.....</a>'; 

}  

add_filter('excerpt_more', 'new_excerpt_more');





function comm_count(){

    $n_comments = wp_count_comments();

    $n_comments_approved = $n_comments->approved;

    echo $n_comments_approved;}









 





/** Latest post 

------------------------------------------------------ 

$post_num (5) = number posts

*/  

function the_recent_posts ($post_num=5){ 

		global $post;

		$tmp_post = $post;

		$myposts = get_posts('numberposts='.$post_num.'&order=DESC&orderby=post_date');

		

		?> <li> <?php

		foreach( $myposts as $post ) : setup_postdata($post);

		?>

		

				<a href="<?php the_permalink();?>">

					<?php if( has_post_thumbnail() ): ?>

					<div class="wid_thumb"><?php the_post_thumbnail('custom-size7');?></div>

					<?php else: ?>

					<div class="wid_thumb"><img src="<?php echo get_template_directory_uri();?>/images/no-image-50x50.png" alt="No Image"/></div>

					<?php endif; ?>

				</a>

			

			

			<?php 

		endforeach;

		?> </li> <?php

		

		$post = $tmp_post; 

}  



/** Popular post

------------------------------------------------------ 

$post_num (5) = number posts

*/  

function the_popular_posts ($post_num=5){ 

		global $post;

		$tmp_post = $post;

		$myposts = get_posts('numberposts='.$post_num.'&order=DESC&orderby=comment_count');

		

		  

		foreach( $myposts as $post ) : setup_postdata($post);

		?>

		<li>

			<figure>	

				<a href="<?php the_permalink();?>">

					<?php if( has_post_thumbnail() ): ?>

					<div class="wid_thumb"><?php the_post_thumbnail('custom-size7');?></div>

					<?php else: ?>

					<div class="wid_thumb"><img src="<?php echo get_template_directory_uri();?>/images/no-image-50x50.png" alt="No Image"/></div>

					<?php endif; ?>

				</a>

			</figure>

			<div>

			    <h3 title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></h3>

				

				<time datetime="<?php echo get_the_date('d M');?>"><?php echo get_the_date('d M');?>,</time><br>

				<a href="#" class="comment_link"><?php comments_popup_link('0 comments', '1 comments', '(%) comments');?></a>

		    </div>



			

		 </li>	

			<?php 

		endforeach;

		 

		

		$post = $tmp_post; 

}



register_sidebar(array(

   'name' => 'Menu Sidebar',

   'id' => 'right-sidebar',

   'description' => 'Menu sidebar',

   'before_title' => '<h1>',

   'after_title' => '</h1>'

 ));

//----------------------------------------ON/OFF - Vidgets----------------------------------------------//

function remove_widgets() {

	unregister_widget('WP_Widget_Categories');

	unregister_widget('WP_Widget_Archives');

	unregister_widget('WP_Widget_Text');

}



add_action( 'widgets_init', 'remove_widgets' );





require_once('widgets/widgets.php');





add_theme_support( 'post-thumbnails' );

add_theme_support( 'automatic-feed-links' );



paginate_comments_links( array('prev_text' => '«', 'next_text' => '»') ) ;  














	

	



	function mytheme_fonts() 

		{

		$logo_font = get_option('sense_logo_font_family');

		$slogan_font = get_option('sense_slogan_font_family');

        $protocol = is_ssl() ? 'https' : 'http';

		

		wp_enqueue_style( "mytheme-fontAnton", "$protocol://fonts.googleapis.com/css?family=Anton", false, null, 'all');

		wp_enqueue_style( "mytheme-fontCuprum", "$protocol://fonts.googleapis.com/css?family=Cuprum", false, null, 'all');

		wp_enqueue_style( "mytheme-fontSpicy", "$protocol://fonts.googleapis.com/css?family=Spicy+Rice", false, null, 'all');

		

			if(isset($logo_font)&&($logo_font!='')){

			$logo_font = str_replace(" ", "+", $logo_font);

			wp_enqueue_style( "mytheme-logoFont", "$protocol://fonts.googleapis.com/css?family=$logo_font", false, null, 'all');

			};

			if(isset($slogan_font)&&($slogan_font!='')){

			$slogan_font = str_replace(" ", "+", $slogan_font);

			wp_enqueue_style( "mytheme-sloganFont", "$protocol://fonts.googleapis.com/css?family=$slogan_font", false, null, 'all');

			};

			
			

		}

        add_action( 'wp_enqueue_scripts', 'mytheme_fonts' ); 

		

		

		function add_my_stylesheet() {
			
		wp_register_style( 'custom-style', get_template_directory_uri().'/css/style.css',  array(), '20120208', 'all');
      		wp_enqueue_style( 'custom-style' );
			
			wp_register_style( 'video-js', get_template_directory_uri().'/video-js/video-js.css');
      		wp_enqueue_style( 'video-js' );
			
			wp_register_style( 'jackbox', get_template_directory_uri().'/jackbox/css/jackbox.css');
      		wp_enqueue_style( 'jackbox' );
			
			wp_register_style( 'jackbox_hovers', get_template_directory_uri().'/jackbox/css/jackbox_hovers.css');
      		wp_enqueue_style( 'jackbox_hovers' );
			
			
		}

		

		
		add_action('wp_print_styles', 'add_my_stylesheet');
		

		

		

		function my_scripts_method() {
			
			
			
			
			 ?> <script type="text/javascript"> 
		 window.directory = "<?php echo get_template_directory_uri(); ?>"; 
		 window.admin_email_wp = "<?php echo get_option('admin_email'); ?>"; 
		  window.wnm_custom = "<?php echo get_option('sense_twitter_id'); ?>";
    </script> <?php
			

			if (!is_admin()){

             /*wp_deregister_script( 'jquery' );*/

             wp_register_script( 'jquery.1.8.1', 'http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js');  

             wp_enqueue_script('jquery.1.8.1');

       		 }

			 
  
  

			
			
			

			

			wp_register_script( 'jquery.flexslider', get_template_directory_uri() . '/js/jquery.flexslider.js' );  

			wp_enqueue_script(

				'jquery.flexslider'

			);

			 wp_register_script( 'jquery.easy-pie-chart', get_template_directory_uri() . '/js/jquery.easy-pie-chart.js' );  

			wp_enqueue_script(

				'jquery.easy-pie-chart'

			);

			 wp_register_script( 'jquery.poshytip', get_template_directory_uri() . '/js/jquery.poshytip.js' );  

			wp_enqueue_script(

				'jquery.poshytip'

			);

//			 wp_register_script( 'jquery.tweet', get_template_directory_uri() . '/js/jquery.tweet.js' );  
			

			/*wp_enqueue_script(

				'jquery.tweet'

			);*/

			 wp_register_script( 'jquery.mousewheel-3.0.4.pack', get_template_directory_uri() . '/js/jquery.mousewheel-3.0.4.pack.js' );  

			wp_enqueue_script(

				'jquery.mousewheel-3.0.4.pack'

			);

			 wp_register_script( 'jquery.easytabs.min', get_template_directory_uri() . '/js/jquery.easytabs.min.js' );  

			wp_enqueue_script(

				'jquery.easytabs.min'

			);

			 wp_register_script( 'jquery.easing.1.3', get_template_directory_uri() . '/js/jquery.easing.1.3.js' );  

			wp_enqueue_script(

				'jquery.easing.1.3'

			);

			 wp_register_script( 'jquery.address-1.5.min', get_template_directory_uri() . '/jackbox/js/libs/jquery.address-1.5.min.js' );  

			wp_enqueue_script(

				'jquery.address-1.5.min'

			);

			 wp_register_script( 'jquery.masonry.min', get_template_directory_uri() . '/js/jquery.masonry.min.js' );  

			wp_enqueue_script(

				'jquery.masonry.min'

			);

			 wp_register_script( 'jacked', get_template_directory_uri() . '/jackbox/js/libs/Jacked.js' );  

			wp_enqueue_script(

				'jacked'

			);

			 wp_register_script( 'jackbox-swipe', get_template_directory_uri() . '/jackbox/js/jackbox-swipe.js' );  

			wp_enqueue_script(

				'jackbox-swipe'

			);

			 wp_register_script( 'jackbox', get_template_directory_uri() . '/jackbox/js/jackbox.js' );  

			wp_enqueue_script(

				'jackbox'

			);

			 wp_register_script( 'stackblur', get_template_directory_uri() . '/jackbox/js/libs/StackBlur.js' );  

			wp_enqueue_script(

				'stackblur'

			);

			 wp_register_script( 'superfish', get_template_directory_uri() . '/js/superfish.js' );  

			wp_enqueue_script(

				'superfish'

			);

			 wp_register_script( 'switcher', get_template_directory_uri() . '/js/switcher.js' );  

			wp_enqueue_script(

				'switcher'

			);

			 wp_register_script( 'spin', get_template_directory_uri() . '/js/spin.js' );  

			wp_enqueue_script(

				'spin'

			);

						 wp_register_script( 'excanvas', get_template_directory_uri() . '/js/excanvas.js' );  

			wp_enqueue_script(

				'excanvas'

			);

						 wp_register_script( 'cookies', get_template_directory_uri() . '/js/cookies.js' );  

			wp_enqueue_script(

				'cookies'

			);

						 wp_register_script( 'forms', get_template_directory_uri() . '/js/forms.js' );  

			wp_enqueue_script(

				'forms'

			);

						 wp_register_script( 'filterable.pack', get_template_directory_uri() . '/js/filterable.pack.js' );  

			wp_enqueue_script(

				'filterable.pack'

			);

						 wp_register_script( 'script', get_template_directory_uri() . '/js/script.js' );  

			wp_enqueue_script(

				'script'

			);

			 wp_register_script( 'scripts', get_template_directory_uri() . '/js/scripts.js' );  

			wp_enqueue_script(

				'scripts'

			);

			 wp_register_script( 'video', get_template_directory_uri() . '/video-js/video.js' );  

			wp_enqueue_script(

				'video'

			);

			

			 $wnm_custom = get_option('sense_twitter_id');

  			  wp_localize_script( 'jquery.tweet', 'wnm_custom', $wnm_custom );

			 $directory_uri = get_template_directory_uri();

		    wp_localize_script( 'forms', 'directory_uri', $directory_uri );

			$directory_uri = get_template_directory_uri();

		    wp_localize_script( 'scripts', 'directory_uri', $directory_uri );

		}

		

		add_action( 'wp_enqueue_scripts', 'my_scripts_method' );

		

		

		//----------------------REORDER--------------------------//



	function joonbrandt_print_reorder_scripts() {



		wp_enqueue_script('jquery-ui-sortable');

		wp_enqueue_script('jquery-reorder', get_template_directory_uri().'/js/jquery-reorder.js');



	}





	function joonbrandt_create_reorder_page() {

		$add_submenu = 'add_submenu_page';

		$add_movingimages_reorder_page = $add_submenu('edit.php?post_type=movingimages', 'Reorder Moving Images Items', __('Reorder Items',  'joonbrandt'), 'edit_posts', 'reorder-movingimages-items', 'joonbrandt_movingimages_reorder');

		$add_gallery_reorder_page = $add_submenu('edit.php?post_type=portfolio', 'Reorder Gallery Items', __('Reorder Gallery Items',  'joonbrandt'), 'edit_posts', 'reorder-gallery-items', 'joonbrandt_gallery_reorder');

		

		add_action('admin_print_scripts-' . $add_movingimages_reorder_page, 'joonbrandt_print_reorder_scripts');

		add_action('admin_print_scripts-' .$add_gallery_reorder_page, 'joonbrandt_print_reorder_scripts');

	}



	add_action('admin_menu', 'joonbrandt_create_reorder_page');





function joonbrandt_movingimages_reorder() {

		$args = array( 

			'post_type' => 'movingimages',

			'order' => 'ASC',

			'orderby' => 'menu_order',

			'posts_per_page' => -1,

			'post_status' => 'publish'

		);



		$newmovingimages = new WP_Query($args);

	?>

		<div class="wrap">

			<div id="icon-tools" class="icon32"><br /></div>

			<h2><?php _e('Reorder Moving Images Items',  'joonbrandt'); ?></h2>

			<p class="wp-reorder-message"><?php _e('Drag the moving images items to reorder the them.',  'joonbrandt'); ?></p>

			<ul id="movingimages-reorder-lists" class="wp-reorder-lists clearfix">

            

			<?php while( $newmovingimages->have_posts() ) : $newmovingimages->the_post(); ?>

			<?php if( get_post_status() == 'publish' ) { ?>

				<li id="<?php the_id(); ?>" class="menu-item">

					<?php 

						$thumb = get_post_thumbnail_id();

						$img_url = wp_get_attachment_url( $thumb,'full'); //get img URL

						$image = aq_resize( $img_url, 150, 150, true ); //resize & crop img	

						if ( has_post_thumbnail() ) {

					?>

							<img src="<?php echo $image ?>" alt="<?php the_title();?>" />

					<?php 

						} else { 

							echo __('No featured image',  'joonbrandt'); 

						} 

					?>

					<span class="menu-item-title"><?php the_title(); ?></span>

				</li>

			<?php } ?>

			<?php endwhile; ?>

			<?php wp_reset_query(); ?>

			</ul>

		</div>

	<?php

	}

	

		

		

		

		function joonbrandt_save_movingimages_order() {

		global $wpdb;

		

		$order = explode(',', $_POST['order']);

		$counter = 0;

		

		foreach($order as $movingimages_id) {

			$wpdb->update($wpdb->posts, array('menu_order' => $counter), array('ID' => $movingimages_id));

			$counter++;

		}

		die(1);

	}



	add_action('wp_ajax_movingimages_reorder', 'joonbrandt_save_movingimages_order');

	

	

	

	function joonbrandt_gallery_reorder() {

		$args = array( 

			'post_type' => 'portfolio',

			'order' => 'ASC',

			'orderby' => 'menu_order',

			'posts_per_page' => -1,

			'post_status' => 'publish'

		);



		$newgallery = new WP_Query($args);

	?>

		<div class="wrap">

			<div id="icon-tools" class="icon32"><br /></div>

			<h2><?php _e('Reorder Gallery Items',  'joonbrandt'); ?></h2>

			<p class="wp-reorder-message"><?php _e('Drag the gallery items to reorder the them.',  'joonbrandt'); ?></p>

			<ul id="gallery-reorder-lists" class="wp-reorder-lists clearfix">

			<?php while( $newgallery->have_posts() ) : $newgallery->the_post(); ?>

			<?php if( get_post_status() == 'publish' ) { ?>

				<li id="<?php the_id(); ?>" class="menu-item">

					<?php 

						$thumb = get_post_thumbnail_id();

						$img_url = wp_get_attachment_url( $thumb,'full'); //get img URL

//						$image = aq_resize( $img_url, 150, 150, true ); //resize & crop img	

						$url_thumb = get_post_meta(get_the_ID(), 'portfolio-thumbImage', true);

						if ( (isset($url_thumb)) ) {

					?>

							<img src="<?php echo $url_thumb ?>" alt="<?php the_title();?>" />

					<?php 

						} else { 

							echo __('No image',  'joonbrandt'); 

						} 

					?>

					<span class="menu-item-title"><?php the_title(); ?></span>

					<span class="menu-item-gallery">

						<?php if (has_term('', 'portfolio-category', get_the_ID())) {  

								$cur_terms = get_the_terms( get_the_ID(), 'portfolio-category' );

								foreach($cur_terms as $cur_term){

									echo $cur_term->name .'<br>';

								}							

							} 

						?>

					</span>

				</li>

			<?php } ?>

			<?php endwhile;?>

			<?php wp_reset_query(); ?>

			</ul>

		</div>

	<?php

	}

	

	function joonbrandt_save_gallery_order() {

		global $wpdb;

		

		$order = explode(',', $_POST['order']);

		$counter = 0;

				foreach($order as $gallery_id) {

			$wpdb->update($wpdb->posts, array('menu_order' => $counter), array('ID' => $gallery_id));

			$counter++;

			

		}

	}



	add_action('wp_ajax_gallery_reorder', 'joonbrandt_save_gallery_order');
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
//////////////////////////////////////////////////////////////////
//// function to display tweets with api 1.1
//////////////////////////////////////////////////////////////////
if( !function_exists('wp_dez_get_twitter_timeline') ):
function wp_dez_get_twitter_timeline (
$twitter_id,
$max_tweets,
$consumer_key,
$consumer_secret,
$user_token,
$user_secret
) {

$transient_name = 'new_twitter_cache_' . strtolower($twitter_id);
$twitter_cache = get_transient($transient_name);

require_once( get_template_directory() . '/twitter/tmhOAuth.php' );

$tmhOAuth = new tmhOAuth(array(
        'consumer_key' => $consumer_key, //Add your Twitter Consumer Key here
        'consumer_secret' => $consumer_secret, //Add your Twitter Consumer Secret here
        'user_token' => $user_token, //Add your Twitter User Token here
        'user_secret' => $user_secret //Add your Twitter User Secret here
    ));

$twitter_data = $tmhOAuth->request('GET', $tmhOAuth->url('1.1/statuses/user_timeline'), array(
        'screen_name' => $twitter_id,
        'count' => $max_tweets,
        'include_rts' => true,
        'include_entities' => true
    ));


//this will store in transient
$data  = $tmhOAuth->response['response'];
$twitter_array = json_decode($data, true);

if( !$twitter_cache ) {
set_transient($transient_name, $twitter_array, 60 * 60); // 1 hour cache
}
//print_r( $twitter_cache );

/*== uncomment this and refresh to delete transient ==*/
//delete_transient($transient_name);
//delete_option($transient_name);

 $twitter = '';
        if($twitter_cache):
        foreach ( $twitter_cache as $tweet ) {	
			
			
            $pubDate        = $tweet['created_at'];
            $tweet_text          = $tweet['text'];
            $tweet_permalink  = $tweet['id_str'];

            $today          = time();
            $time           = substr($pubDate, 11, 5);
            $day            = substr($pubDate, 0, 3);
            $date           = substr($pubDate, 7, 4);
            $month          = substr($pubDate, 4, 3);
            $year           = substr($pubDate, 25, 5);
            $english_suffix = date('jS', strtotime(preg_replace('/\s+/', ' ', $pubDate)));
            $full_month     = date('F', strtotime($pubDate));


            #pre-defined tags
            $default   = $full_month . $date . $year;
            $full_date = $day . $date . $month . $year;
            $ddmmyy    = $date . $month . $year;
            $mmyy      = $month . $year;
            $mmddyy    = $month . $date . $year;
            $ddmm      = $date . $month;

            #Time difference
            $timeDiff = dateDiff($today, $pubDate, 1);

            # Turn URLs into links
            $tweet_text = preg_replace('@(https?://([-\w\.]+)+(:\d+)?(/([\w/_\./-]*(\?\S+)?)?)?)@', '<a target="blank" title="$1" href="$1">$1</a>', $tweet_text);

            #Turn hashtags into links
             $tweet_text = preg_replace('/#([0-9a-zA-Z_-]+)/', "<a target='blank' title='$1' href=\"http://twitter.com/search?q=%23$1\">#$1</a>",  $tweet_text);

            #Turn @replies into links
             $tweet_text = preg_replace("/@([0-9a-zA-Z_-]+)/", "<a target='blank' title='$1' href=\"http://twitter.com/$1\">@$1</a>",  $tweet_text);


            $twitter .= "<li><span class='twittext'>" . $tweet_text . "</span>";


				$when  = '';

                 $twitter .= '<span class="twittime"><i class="icon-twitter"></i><a target="_blank" class="time" href="https://twitter.com/'. $twitter_id . '/status/'. $tweet_permalink . '">';


            $twitter .= $timeDiff . "&nbsp;ago";

            $twitter .= "</a></span></li>"; //end of List

        //echo $twitter;

        } //end of foreach

        //store the tweets in options string
        update_option($transient_name,$twitter);

        endif;

        echo stripcslashes( get_option($transient_name) );

}
endif;




//////////////////////////////////////////////////////////////////
//// function for counting date
//////////////////////////////////////////////////////////////////
if( !function_exists('dateDiff') ):
function dateDiff($time1, $time2, $precision = 6) {
        if (!is_int($time1)) {
            $time1 = strtotime($time1);
        }
        if (!is_int($time2)) {
            $time2 = strtotime($time2);
        }
        if ($time1 > $time2) {
            $ttime = $time1;
            $time1 = $time2;
            $time2 = $ttime;
        }
        $intervals = array(
            'year',
            'month',
            'day',
            'hour',
            'minute',
            'second'
        );
        $diffs     = array();
        foreach ($intervals as $interval) {
            $diffs[$interval] = 0;
            $ttime            = strtotime("+1 " . $interval, $time1);
            while ($time2 >= $ttime) {
                $time1 = $ttime;
                $diffs[$interval]++;
                $ttime = strtotime("+1 " . $interval, $time1);
            }
        }
        $count = 0;
        $times = array();
        foreach ($diffs as $interval => $value) {
            if ($count >= $precision) {
                break;
            }
            if ($value > 0) {
                if ($value != 1) {
                    $interval .= "s";
                }
                $times[] = $value . " " . $interval;
                $count++;
            }
        }
        return implode(", ", $times);
    }
endif;

?>