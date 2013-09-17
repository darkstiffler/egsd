<?php  get_header();?>
<div id="main_bg">
<div class="glow"></div>
  <div class="spinner"><span></span></div>  
  	<div class="main_container">
   		 <div class="container_12">
          <!--header -->
			<header>
              <div class="grid_12">
			  
			  <h1><a class="hide_text" href="#!/splash" id="logo"><?php $logo = get_option('sense_settings_logo');
			 
				if($logo == 'show_image'){
					//$logo = '<img alt="" src="'.get_data('sense_logo_image').'"/>';
				}else{
					echo get_data('sense_logo_text');
					?><span><br><?php echo get_option('sense_slogan_text')?></span><?php
				}
			?></a></h1>
				
                 <?php if((get_option('sense_show_about')) != 'true' && (get_option('sense_show_portfolio')) != 'true'
				 && (get_option('sense_show_services')) != 'true'  && (get_option('sense_show_blog')) != 'true'  && (get_option('sense_show_contacts')) != 'true')
				{  
				?><h1><?php
				 echo  bloginfo('name'); 
				?></h1><?php
				}?>
			  
			  
	   			<div class="menuHolder">
				   <?php show_nav(); ?>
                    
                </div>
				
				
				
				<div class="description">
                  <div class="inner"><?php  echo stripslashes_deep(get_option('sense_header_text')); ?></div>
                </div>
                <div class="clear"></div>
				
				
      		  </div>
              	<div class="clear"></div>
            </header>
        <!--header end-->       
        
		 <!--splashHolder-->   
		 
			<?php show_nav_splash(); ?>
            
            <?php if((get_option('sense_show_about')) != 'true' && (get_option('sense_show_portfolio')) != 'true'
			 && (get_option('sense_show_services')) != 'true'  && (get_option('sense_show_blog')) != 'true'  && (get_option('sense_show_contacts')) != 'true')
			{  
			 print_blog(); 
			}?>
           
		 
		  <div class="clear"></div>
		  
		<!--splashHolder-->  
		
		
		
		
		<!--content -->
		 <?php 
			?>
		 <section id="content">
            <ul>
                <li id="splash"></li>
                    <li id="about">
						<?php print_about(); ?>
                    </li>
                    <li id="portfolio">
						<?php print_portfolio(); ?>
                    </li>
                    <li id="services">
						<?php print_services(); ?>
                    </li>
                    <li id="contacts">
						<?php print_contact(); ?>
                    </li>
					
                    
                    <li id="sample">
						<?php print_sample_page(); ?>
                    </li>
              </ul>
            </section>
		<!--content -->

		<!--footer -->
			<footer>
              <div class="splash_footer">
                 <?php echo get_option('sense_footer_text')?>
              </div>
              <div class="footer">
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
                    <a href="http://<?php echo get_option('sense_cv_button_link'); ?>" target="_blank" title="Download my resume" class="soc2"><img src="<?php echo get_template_directory_uri(); ?>/images/soc2.png" alt=""></a>
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
	$(window).load(function()
	{
		<?php if(get_option('sense_default_option') == 'opened'):?>
		$(".icons").toggle('slow');
		<?php endif; ?>
		$("#show_icons").click(function()
		{
			$(".icons").toggle('slow');
		})
		$('.spinner').fadeOut();
		$('body').css({overflow:'auto', 'min-height':'820px'});
		$('#contact-form').forms();
		$('.skill_set').each(function()
		{
				var skill = $(this);
				var skill_width = $(this).attr('data-skill');  
			 // skill.css('width', skill_width+'%');
				skill.animate({
						width: skill_width+'%'
				},1000);
		});
		$(function()
		{
			var li=$('.tweet_list li')
			 ,n=0
			 ,activeClass="active"
		   
			function fu()
			{
				 li.removeClass(activeClass)
				 li.eq(n++).addClass(activeClass)
				 n=n<li.length?n:0
				 setTimeout(fu,10000)
			}
			fu();
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
