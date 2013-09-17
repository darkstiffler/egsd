<!--==============================================Blog================================================================-->
<div class="wrapper">
	<article class="grid_12">
    	<div class="box">
        	<div class="pad_box4">           
            	<h2 class="ind"><?php echo get_option( 'sense_blog_title' ); ?></h2>
            	<div class="contentBlog">
                	<div class="wrapper blog_content">
                    	
                        <?php
						    $format = get_post_format();
                        	$ppp = get_option( 'posts_per_page' );
                            if ($ppp == '') { $ppp == 9;};
                         	if (have_posts()) : while (have_posts()) : the_post();  
                        ?>
                        <div class="blog_col"> 
                        	<div class="post">
                            	<div class="inner">
                                
                                 <?php
                                    $meta_blogposttype = get_post_meta($post->ID,'meta_blogposttype',true); 

                                    if ($meta_blogposttype == 'image') {  

                                      global $post;
                                      $fullimage = get_post_meta($post->ID,'_url_image',true);
              
									
                                        if (has_post_thumbnail()) {
                                    ?>
                    				<figure><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('custom-size6'); ?></a></figure>
                                     <?php } ?>
                                     
								<?php           
            
                                  }
                                    
                                    else {
                                          $meta_blogvideoservice = get_post_meta($post->ID,'meta_blogvideoservice',true); 
                                          $meta_blogvideourl = get_post_meta($post->ID,'meta_blogvideourl',true); 
										  
                                          if ($meta_blogvideoservice == 'vimeo') { 
                                           ?> 
                                            <p><iframe src="http://player.vimeo.com/video/<?php echo $meta_blogvideourl; ?>?js_api=1&amp;js_onLoad=player<?php echo $meta_blogvideourl; ?>_1798970533.player.moogaloopLoaded" width="277" height="203" allowFullScreen></iframe></p>
                                           <?php                                 
                                            }										  
                                          else if ($meta_blogvideoservice =='youtube')  { 
                                          ?>
                                            <p><iframe width="277" height="203" src="http://www.youtube.com/embed/<?php echo $meta_blogvideourl; ?>"  allowfullscreen></iframe></p>
                                          <?php
                                          } 
										   else if ($meta_blogvideoservice =='html5')  { 
                                          ?>
                                           <?php $img_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "custom-size8" ); ?>
										  <video id="my_video_1" class="video-js vjs-default-skin" controls
											  preload="auto" width="277" height="203" poster="<?php echo $img_url[0]; ?>"
											  data-setup="{}">
											  <source src="<?php echo $meta_blogvideourl; ?>" type='video/mp4' />
											  <source src="<?php echo $meta_blogvideourl; ?>" type='video/webm' />
                                              <source src="<?php echo $meta_blogvideourl; ?>" type='video/ogg' />
											</video>
										  <?php
										   }
                                      }
                    ?> 
                    
                                                <div class="blog_text">
                                        <h2><a class="testid" href="<?php the_permalink(); ?>" ><?php the_title(); ?></a></h2>
                                            <div class="blog_info">
                                                <time datetime="2013-01-01"><?php the_time('M'); ?> <?php the_time('d'); ?>, <?php the_time('Y') ?>,</time>
                                                <?php comments_popup_link('0 comments', '1 comments', '(%) comments'); ?>
                                            </div>
                                            <?php the_excerpt(); ?>
                                    </div>    
                                </div>
                                <div class="cat_links">in <?php
									$categories = get_the_category();
									$separator = ', ';
									$output = '';
									if($categories){
										foreach($categories as $category) {
											$output .= '<a href="'.get_category_link($category->term_id ).'#chapter_4" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '">'.$category->cat_name.'</a>'.$separator;
										}
									echo trim($output, $separator);
									}
									?> 
                                </div>
							</div>
						</div>	
						    <?php endwhile; ?>
                            <?php else : ?>
                            <?php endif; ?>   
                    	 
                	</div>
                    
            	</div>
        	</div>
    	</div>
	</article>
</div>      

<!--==============================================end Blog============================================================-->