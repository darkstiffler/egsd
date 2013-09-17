<?php



	/*



		Single Post Template: [Descriptive Template Name]



		Description: This part is optional, but helpful for describing the Post Template



	*/



?>











<!DOCTYPE HTML>



<html <?php language_attributes(); $page_type = ''?>><head>







	<meta charset="<?php bloginfo('charset'); ?>" />



	<title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>



	<meta name="description" content="<?php bloginfo('description'); ?>"/>



    



  <?php /*?><link href="<?php echo get_template_directory_uri(); ?>/jackbox/css/jackbox.css" rel="stylesheet" type="text/css" />



  <link href="<?php echo get_template_directory_uri(); ?>/jackbox/css/jackbox_hovers.css" rel="stylesheet" type="text/css" />



  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style.css">

  

  <link href="<?php echo get_template_directory_uri(); ?>/video-js/video-js.css" rel="stylesheet" /><?php */?>





  



  <link rel="icon" href="<?php echo get_option('sense_site_icon'); ?>" type="image/x-icon" />



  <link rel="shortcut icon" href="<?php echo get_option('sense_site_icon'); ?>" type="image/x-icon" />



  

  



    







  <!--[if lt IE 9]>



   		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>



        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo get_template_directory_uri(); ?>/css/ie.css">





        



  <style>



  #content .box, #menu > li > a, .biography, ul#portfolio-filter > li > a, .skill_set, .skill_level, .reference_list blockquote, .button, .button1, #contact-form input, #contact-form textarea, .map_box, .splash_menu > li > a, .footer .social > li > a, .tools_list a{behavior:url(<?php echo get_template_directory_uri(); ?>/js/PIE.htc);position:relative;}



#menu > li > a strong, ul#portfolio-list li a .description, ul#portfolio-filter ul, .icons{behavior:url(<?php echo get_template_directory_uri(); ?>/js/PIE.htc);}



</style>



        



	<![endif]-->



  <!--[if lt IE 7]>



  <div style=' clear: both; text-align:center; position: relative;'>



    <a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">



      <img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." />



   </a>



 </div>



<![endif]-->











	



	

	<?php wp_head(); ?>

</head>







<?php home_css(); ?>











<body>



	<div id="main_bg">



		<div class="glow"></div>



		<div class="spinner"><span></span></div>  



		<div class="main_container">



   		 <div class="container_12">



          <!--header -->



			<header class="blog">



              <div class="grid_12">



			  



			  <h1><a class="hide_text" href="<?php  echo home_url(); ?>" id="logo"><?php $logo = get_option('sense_settings_logo');



			 



				if($logo == 'show_image'){



					//$logo = '<img alt="" src="'.get_data('sense_logo_image').'"/>';



				}else{



					echo get_data('sense_logo_text');



					?><span><br><?php echo get_option('sense_slogan_text')?></span><?php



				}



			?></a></h1>



				



			  



			  



	   			<div class="menuHolder"  id="menuHolder" >



				   <?php show_nav_blog(); ?>



                    



                </div>



				



				



				



				



                <div class="clear"></div>



				



				



      		  </div>



              	<div class="clear"></div>



            </header>



        <!--header end-->       



   



		<section id="content">



		



		<ul id="single_blog2">



        	<li id="single_blog">



             </li>



		</ul>		  



       



            



              <div class="wrapper">



                        <article class="grid_12">



                          <div class="box">



                            <div class="pad_box4">



                              <h2 class="ind2"><?php echo get_option( 'sense_blog_title' ); ?></h2>



                              <div class="wrapper">



                                <div class="single_blog_col1 f_left">



                                  <div id="post-<?php the_ID(); ?>" <?php post_class(); ?> >



                                    <div class="inner">



                                     <?php

 									global $post;

                                    $meta_blogposttype = get_post_meta($post->ID,'meta_blogposttype',true);
                                    if ($meta_blogposttype == 'image') {
                                      $fullimage = get_post_meta($post->ID,'_url_image',true);
										?>
                                        		<figure> <?php the_post_thumbnail('custom-size8');?> </figure>
										<?php 
										  }
                                    else {



                                          $meta_blogvideoservice = get_post_meta($post->ID,'meta_blogvideoservice',true);



                                          $meta_blogvideourl = get_post_meta($post->ID,'meta_blogvideourl',true); 



										  



                                          if ($meta_blogvideoservice == 'vimeo') {  



                                           ?>



                                            <p><iframe src="http://player.vimeo.com/video/<?php echo $meta_blogvideourl; ?>?js_api=1&amp;js_onLoad=player<?php echo $meta_blogvideourl; ?>_1798970533.player.moogaloopLoaded" width="100%" height="424"  allowFullScreen></iframe></p>



                                           <?php                                 



                                            }



                                          else if ($meta_blogvideoservice =='youtube')  { 



                                          ?>



                                            <p><iframe width="100%" height="424" src="http://www.youtube.com/embed/<?php echo $meta_blogvideourl; ?>" allowfullscreen></iframe></p>



                                          <?php



                                          } 



										   else if ($meta_blogvideoservice =='html5')  { 



                                          ?>



                                          <?php $img_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "custom-size8" ); ?>



										  <video id="my_video_1" class="video-js vjs-default-skin" controls



											  preload="auto" width="100%" height="424" poster="<?php echo $img_url[0]; ?>"



											  data-setup="{}">



											  <source src="<?php echo $meta_blogvideourl; ?>" type='video/mp4'>



											  <source src="<?php echo $meta_blogvideourl; ?>" type='video/webm'>



                                              <source src="<?php echo $meta_blogvideourl; ?>" type='video/ogg' />



											</video>



                                            



										  <?php



										   }



                                      }



                    ?>







                                      <div class="blog_text">



                                        <h2 class="post"><?php the_title(); ?></h2>



                                        <div class="blog_info"> <?php printf("<time datetime=\"2013-01-01\">%s <span>%s, %s</span></time>", 



                                			mysql2date('M',$post->post_date), mysql2date('d',$post->post_date), mysql2date('Y',$post->post_date)) ?>,



                                



                                



                                 <?php comments_popup_link('0 comments', '1 comments', '(%) comments');?> , in <?php the_category(', '); ?></div>

								<!-- Blog Content -->

								<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>  	
								<p class="p2"><?php the_content(); ?></p>
                                <?php endwhile; ?>  
								<?php endif; ?>

                                



                      <?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', THEMENAME ) . '</span>', 'after' => '</div>' ) );?>

                      



                                        



                                        



                                          <div class="social_btns">



                                              <!-- AddThis Button BEGIN -->



                                              <div class="addthis_toolbox addthis_default_style "> <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a> <a class="addthis_button_tweet"></a> <a class="addthis_button_pinterest_pinit"></a> <a class="addthis_counter addthis_pill_style"></a> </div>



                                              <script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=xa-506f325f57fbfc95"></script>



                                              <!-- AddThis Button END -->   



                                          </div>



                                      </div>



                                    </div>



                                    <div class="cat_links"><?php the_tags(('<b>Tags:</b>') . ' ', ', ', '<br />'); ?></div>



                                  </div>



                                   <?php comments_template(); ?>



                                </div>



								



								



								



								<div class="single_blog_col2 f_left">



								



                                <?php dynamic_sidebar( 'Menu Sidebar' ); ?>



								</div>



                          



                              </div>



                            </div>



                          </div>



                        </article>



                      </div>



			



       </section>



       



        



        



        



        



        











		<!--footer -->



			<footer>



             



              <div class="footer-blog">



                <div class="last-tweet twitter"  id="twitter">
                        
                        <div class="tweet_list">
                
                          <?php 
                            $tw_username = get_option('sense_twitter_id');
                            $tw_ck = get_option('sense_tw_ck'); 
                            $tw_cs = get_option('sense_tw_cs');
                            $tw_ut = get_option('sense_tw_ut');
                            $tw_us = get_option('sense_tw_us');
                            $tw_num = get_option('sense_tw_num');
                          
                            echo wp_dez_get_twitter_timeline ($tw_username,$tw_num,$tw_ck,$tw_cs,$tw_ut,$tw_us);
                          ?>

                          

                        </div>
                    </div>



                <div class="clear"></div>



                <div class="privacy">



					<?php echo get_option('sense_footer_text')?>



                </div>



                <ul class="social">



				<?php if(get_option('sense_soc_icons') == "show"): ?>



                  <li>



                    <a href="javascript:;" id="show_icons" title="Network" class="soc1"><img src="<?php echo get_template_directory_uri(); ?>/images/soc1.png" alt=""></a>



                    <div class="icons">



						<ul class="social-buttons">



					



							<?php if(get_option('sense_facebook') != ""): ?>



							<li>



								<a href="http://<?php echo get_option('sense_facebook'); ?>" title="Facebook"><img src="<?php echo get_template_directory_uri(); ?>/images/socico1.png" alt=""></a>



							</li>



							<?php endif; ?>



							<?php if(get_option('sense_tweeter') != ""): ?>



							<li>



								<a href="http://<?php echo get_option('sense_tweeter'); ?>" title="Twitter"><img src="<?php echo get_template_directory_uri(); ?>/images/socico2.png" alt=""></a>



							</li>



							<?php endif; ?>



							<?php if(get_option('sense_google') != ""): ?>



							<li>



								<a href="http://<?php echo get_option('sense_google'); ?>" title="Google+"><img src="<?php echo get_template_directory_uri(); ?>/images/socico3.png" alt=""></a>



							</li>



							<?php endif; ?>



							<?php if(get_option('sense_linkedin') != ""): ?>



							<li>	



								<a href="http://<?php echo get_option('sense_linkedin'); ?>" title="LinkedIn"><img src="<?php echo get_template_directory_uri(); ?>/images/socico4.png" alt=""></a>



							</li>



							<?php endif; ?>



							<?php if(get_option('sense_flikr') != ""): ?>



							<li>	



								<a href="http://<?php echo get_option('sense_flikr'); ?>" title="Flickr"><img src="<?php echo get_template_directory_uri(); ?>/images/socico5.png" alt=""></a>



							</li>



							<?php endif; ?>



							<?php if(get_option('sense_pinterest') != ""): ?>



							<li>	



								<a href="http://<?php echo get_option('sense_pinterest'); ?>" title="Pinterest"><img src="<?php echo get_template_directory_uri(); ?>/images/socico6.png" alt=""></a>



							</li>



							<?php endif; ?>



							<?php if(get_option('sense_vimeo') != ""): ?>



							<li>	



								<a href="http://<?php echo get_option('sense_vimeo'); ?>" title="Vimeo"><img src="<?php echo get_template_directory_uri(); ?>/images/socico7.png" alt=""></a>



							</li>



							<?php endif; ?>



							<?php if(get_option('sense_youtube') != ""): ?>



							<li>	



								<a href="http://<?php echo get_option('sense_youtube'); ?>" title="YouTube"><img src="<?php echo get_template_directory_uri(); ?>/images/socico8.png" alt=""></a>



							</li>



							<?php endif; ?>



							<?php if(get_option('sense_dribble') != ""): ?>



							<li>	



								<a href="http://<?php echo get_option('sense_dribble'); ?>" title="Dribble"><img src="<?php echo get_template_directory_uri(); ?>/images/socico9.png" alt=""></a>



							</li>



							<?php endif; ?>



						



						



						</ul>



                    </div>



                  </li>



				  <?php endif; ?>



                  <li>



				 <?php if(get_option('sense_cv_button') == "show"): ?>



                    <a href="http://<?php echo get_option('sense_cv_button_link'); ?>" title="Download my resume" class="soc2"><img src="<?php echo get_template_directory_uri(); ?>/images/soc2.png"" alt=""></a>



				<?php endif; ?>



                  </li>



                </ul>



                <div class="clear"></div>



              </div>



            </footer>



		<!--footer -->



			



			



		</div>



	</div>



<?php if(get_option('sense_settings_panel') == "show"): ?>



 <div id="panel">



      <a href="#" class="panel_button"></a>



      <div class="inner">



        <h3>Theme settings</h3>



        <h4>Background color:</h4>



        <ul class="tools_list">



          <li>



            <a href="javascript:set_bg_color('#16994a');" class="color1"></a>



            <a href="javascript:set_bg_color('#e95d5d');" class="color2"></a>



            <a href="javascript:set_bg_color('#008eb4');" class="color3"></a>



            <a href="javascript:set_bg_color('#77479b');" class="color4"></a>



          </li>



          <li>



            <a href="javascript:set_bg_color('#1352a2');" class="color5"></a>



            <a href="javascript:set_bg_color('#45a38d');" class="color6"></a>



            <a href="javascript:set_bg_color('#f16c47');" class="color7"></a>



            <a href="javascript:set_bg_color('#999999');" class="color8"></a>



          </li>



        </ul>



        <h4>Background pattern:</h4>



        <ul class="tools_list">



          <li>



            <a href="javascript:set_bg_image('pattern1');" class="pattern1"></a>



            <a href="javascript:set_bg_image('pattern2');" class="pattern2"></a>



            <a href="javascript:set_bg_image('pattern3');" class="pattern3"></a>



            <a href="javascript:set_bg_image('pattern4');" class="pattern4"></a>



          </li>



          <li>



            <a href="javascript:set_bg_image('pattern5');" class="pattern5"></a>



            <a href="javascript:set_bg_image('pattern6');" class="pattern6"></a>



            <a href="javascript:set_bg_image('pattern7');" class="pattern7"></a>



            <a href="javascript:set_bg_image('pattern8');" class="pattern8"></a>



          </li>



        </ul>



        <div class="button_wrap1">



          <a href="javascript:reset();" class="button1">Reset</a>



        </div>



      </div>



    </div>



     <?php endif; ?>



    



	</div>



</body>







<script>















 



$(window).load(function() {







<?php if(get_option('sense_default_option') == 'opened'):?>



 $(".icons").toggle('slow');



<?php endif; ?>











$('.menuHolder').stop().css({display:'block'}).fadeTo(500, 1);



  $("#show_icons").click(function(){



    $(".icons").toggle('slow');



   })



	$('.spinner').fadeOut();



	$('body').css({overflow:'auto', 'min-height':'820px'});







	



  $(function(){



    var li=$('.tweet_list li')







     ,n=0



     ,activeClass="active"



   



    function fu(){



     li.removeClass(activeClass)



     li.eq(n++).addClass(activeClass)



     n=n<li.length?n:0



     setTimeout(fu,10000)



    }



    fu()



   })



  jQuery(".jackbox[data-group]").jackBox("init", {deepLinking: false, useThumbs:false});



  filter_start();



})















</script>





  

  

  <script src="http://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>

   <script>

		var map;

		var brooklyn = new google.maps.LatLng(<?php echo get_option('sense_contact_urlmaps1')?>);

		var MY_MAPTYPE_ID = 'hiphop';

		function initialize() {

			var stylez = [

				{

					"stylers": [

						{ "saturation": -97 }

					]

				},{

				}

			] 

			var mapOptions = {

				zoom: 12,

				center: brooklyn,

				mapTypeControlOptions: {

					mapTypeIds: [google.maps.MapTypeId.ROADMAP, MY_MAPTYPE_ID]

				},

				mapTypeId: MY_MAPTYPE_ID

			};

			map = new google.maps.Map(document.getElementById('map_canvas'),

					mapOptions);

			var styledMapOptions = {

				name: 'GrayScale'

			};

			var jayzMapType = new google.maps.StyledMapType(stylez, styledMapOptions);

			map.mapTypes.set(MY_MAPTYPE_ID, jayzMapType);

		}

    </script>





  <?php echo str_replace("\\", "", stripslashes_deep(get_option('sense_google_analytics'))); ?>







    <?php wp_footer(); ?>



</html>





