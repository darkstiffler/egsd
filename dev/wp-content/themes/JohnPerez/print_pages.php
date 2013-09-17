<?php function print_home(){ ?>

<!--==============================home================================-->

    <section id="home" class="slide">

    <article class="home box-content">

        <div id="next_btn"><a  href="#about" title="Lets begin" class="portfolio_btn z3"></a></div>

        <div id="home_txt">

          <?php

          $i=0;

          $home = get_option('sense_home');

          if(isset($home)&&$home!=''){

            foreach (get_option('sense_home') as $value) {

              $i++;

          ?>

            <div data-speed="<?php echo $value['speed']; ?>" id="home<?php echo $i ?>" class="drag<?php if($value['accent_color']=='accent'){echo ' accent_color';} ?>"><?php echo $value['text']; ?></div>

          <?php } 

        } ?>

        </div>

      </article>

      </section>

    <!--home end-->     

<?php };



function print_about(){

	

?>

	<!--==============================about================================-->



    <div class="wrapper">

		<article class="grid_12">

		  <div class="box">

			<div class="grid_7 alpha">

			  <div class="pad_box1">

				<div class="biography">

				  <div class="flexslider">					

					<ul class="slides">

						<?php $icons = get_option('sense_soc'); ?>

						<?php if(isset($icons)&&(!empty($icons))){ ?>

						<?php foreach ($icons as $value) { ?>

							<li><img src="<?php echo $value['icon']; ?>" alt="" /></li>

						<?php }; }; ?>

				  </ul>

				  </div>

					

					<?php if((get_data('sense_about_shortcodes')!='')){ ?>

						<div class="text">

							<ul class="date_list">

								<?php echo get_data('sense_about_shortcodes'); ?>    

							</ul>

						</div>

					<?php } ?> 

					

					

					

				  

				</div> 

			  </div>

			</div>

			<div class="grid_5 omega last-col">

			

			

				<?php if((get_option('sense_my_experience')!='')||(get_data('sense_my_experience_shortcodes')!='')){ ?>

					<div class="pad_box2">

						<h2><?php echo get_option('sense_my_experience'); ?></h2>

						

							<ul class="experience_list">

								<?php echo get_data('sense_my_experience_shortcodes'); ?>    

							</ul>

							<div class="clear"></div>

						

					</div>

				<?php } ?> 

				

		

		

			</div>

			<div class="clear"></div>

			<?php if(get_option('sense_hire_me_button') == "show"): ?>

				<a href="http://<?php echo get_option('sense_hire_me_link'); ?>" target="_blank" class="hire_link"></a>

			<?php endif; ?>

		  </div>

		</article>

	  </div>

    <!--about end--> 

<?php };



function print_portfolio(){



?>



<!--==============================portfolio================================-->

    <div class="wrapper">

		<article class="grid_12">

		  <div class="box">

			<div class="pad_box1">

			  <h2 class="ind"><?php echo get_option('sense_portfolio_title'); ?></h2>

				<div class="filter_box">

				  <div class="portfolio-filter">

					  <ul id="portfolio-filter">

						<li>

							<a href="#all">Filter</a>

							<?php

							$MyWalker = new MyWalker();

							

							$locations_list = wp_list_categories( array(

							  'taxonomy' => 'portfolio-category',

							  'orderby' => 'name',

							  'show_count' => 0,

							  'pad_counts' => 0,

							  'hierarchical' => 0,

							  'echo' => 0,

							  'title_li' => '',

							  'walker' => $MyWalker

							) );

							if ( $locations_list )

							echo '<ul><li><a href="#all" title="">All</a></li>' . $locations_list . '</ul>';

							

							

							  /*<li><a href="#all" title="">All</a></li>

							  <li><a href="#web" title="" rel="web">Web</a></li>

							  <li><a href="#motion" title="" rel="motion">Motion</a></li>

							  <li><a href="#illustration" title="" rel="illustration">Illustration</a></li>

							  <li><a href="#3d" title="" rel="3d">3d</a></li>*/?>

						  </li>

						</ul>

				   </div>

				   

				   

				   

				   <div class="portfolio-item">

					  <ul id="portfolio-list">

						 <?php

							global $post;

							$args = array( 'post_type'=>'portfolio',

											'orderby' => 'menu_order'

										  ,'numberposts' => -1);

							$myposts = get_posts( $args );

							// print_r($myposts);

							$count = 0;

							

							

							foreach( $myposts as $post ) :  setup_postdata($post);
							
							$category = get_portfolio_category($post->ID);
							$nameCategory;
							$nameCategory2 = '';
							$nameCategory3 = '';
							
							if(isset($category[0]))
							{
								$nameCategory = $category[0];
							}else
							{
								$nameCategory = 'all';
							}
							for($i = 0; $i < count($category); $i++)
							{
								$nameCategory = $category[$i];
								$cat_name2 =  preg_replace("/\s{1,}/",'',$nameCategory);
								$cat_name2 = preg_replace('/\W+/', '', $cat_name2);
								$nameCategory2 .= $cat_name2.' ' ;
								$nameCategory3 .= $nameCategory.'</br>' ;
							}
							
							echo '<li class="'.$nameCategory2.'"><div class="portfolio-box"><div class="portoflio-img">';

							  $link = get_post_meta($post->ID, 'portfolio-link', true);

							  $media = 'fancybox';

							  if(get_post_meta($post->ID, 'portfolio-content_type', true)=='video')

							  {

								

								$url = get_post_meta($post->ID, 'portfolio-videoID', true);

							  }else

							  {

									$url = get_post_meta($post->ID, 'portfolio-bigImage', true);

							  }

							  $url_thumb = get_post_meta($post->ID, 'portfolio-thumbImage', true);
								$titles= get_post_meta($post->ID, 'portfolio-description', true);
								
							  if((isset($url)))

							  {

								 ?><a data-title='<?php echo $titles; ?>' class="jackbox" data-group="images" href="<?php echo $url; ?>"><?php

									echo '<img src="'.$url_thumb.'" alt="">

										<span class="description">

											<span class="inner">'.get_the_title().'<br>

												<span>

													'.$nameCategory3.'

											    </span>

											</span>

										</span>

								</a>';

							  }

							?>

							 <?php echo '</div></div></li>';?>

                  <?php endforeach; ?>

					  </ul>

				  </div>      

				</div>

			<div class="clear"></div>

			<?php if(get_option('sense_hire_me_button') == "show"): ?>

				<a href="http://<?php echo get_option('sense_hire_me_link')?>" target="_blank" class="hire_link"></a>

			<?php endif; ?>

			</div>

			</div>

		</article>

	</div>

    <!--portfolio end--> 



<?php };



function print_services(){

	

?>

<!--==============================services================================-->

    <div class="wrapper">

		<article class="grid_12">

		  <div class="box">

			<article class="grid_4 alpha">

			

			<?php if((get_option('sense_services_block1_title')!='')||(get_data('sense_services_block1_shortcodes')!='')){ ?>

			

			  <div class="pad_box1">

				<h2 class="ind1"><?php echo get_option('sense_services_block1_title'); ?></h2>

					<?php echo get_data('sense_services_block1_shortcodes'); ?>   

			  </div>

			  

			  <?php } ?> 

			  

		</article>

			

			

			

		<article class="grid_3">

			

			<?php if((get_option('sense_services_block2_title')!='')||(get_data('sense_services_block2_shortcodes')!='')){ ?>

			

			    <div class="pad_box1">

					<h2 class="ind1"><?php echo get_option('sense_services_block2_title'); ?></h2>

						<ul class="service_list">

							<?php echo get_data('sense_services_block2_shortcodes'); ?>   

						</ul>

						

					<?php if((get_option('sense_services_block2_btn_url')!='') && (get_option('sense_more_services_button')=='show')){ ?>

					<div class="button_wrap2">

					  <a href="<?php echo get_option('sense_services_block2_btn_url'); ?>" class="button"><?php echo get_option('sense_services_block2_btn_text');?></a>

					</div>

					<?php } ?> 

					

			    </div>

			  

			<?php } ?> 

			

		</article>

			

			

			

			

		<article class="grid_5 omega">

		  <?php if((get_option('sense_services_block3_title')!='')||(get_data('sense_services_block3_shortcodes')!='')){ ?>

			

			  <div class="pad_box2">

				<h2 class="ind"><?php echo get_option('sense_services_block3_title'); ?></h2>

				

				<ul class="reference_list">

					<?php echo get_data('sense_services_block3_shortcodes'); ?>   

				</ul>

			  </div>

		  

		  <?php } ?> 

		</article>

			

			

			

			<div class="clear"></div>

			<?php if(get_option('sense_hire_me_button') == "show"): ?>

				<a href="http://<?php echo get_option('sense_hire_me_link')?>" target="_blank" class="hire_link"></a>

			<?php endif; ?>

		  </div>

		</article>

	  </div>

<!--services end--> 

<?php };



function print_contact(){



  $send_mess = get_option('sense_send_message');

  $cont = get_option('sense_contact_form');

  

  

  if(!isset($send_mess)||($send_mess=='')){

    $send_mess = 'Send Message';

  }

  $reset = get_option('sense_reset_form');

  if(!isset($reset)||($reset=='')){

    $reset = 'Reset form';

  }

  $req = get_option('sense_required_mess');

  if(!isset($req)||($req=='')){

    $req = 'Required fields are marked *';

  }



?>



    <!--==============================contact================================-->

    <div class="wrapper">

		<article class="grid_12">

		  <div class="box">

		  <?php if(isset($cont)&&($cont!='')){ 

		  ?>

			<div class="grid_4 alpha">

			  <div class="pad_box1">

			  

				<h2 class="ind"><?php echo get_option('sense_form_title')?></h2>

				

				<form id="contact-form" action="#" method="post" enctype="multipart/form-data">

				<fieldset>

				  <?php

					foreach ($cont as $value) {

				  ?>

				  <?php

					$class = '';

					$star = '*';

					if($value['is_checked']!='checked')
					{
						 $class = ' notRequired'; $star = '';
					};

				  ?>

					<label class="<?php echo $value['label']; echo $class;?>"  ><span class="label">

					  <?php if($value['check_type']=='message'){ ?>

						<textarea><?php echo $value['label']; echo $star; ?></textarea>

					  <?php }else{ ?>

						<input type="text" value="<?php echo $value['label'].$star; ?>" />

					  <?php }; ?>

						<span class="error">*Invalid field.</span><span class="empty">*This field is required.</span>

					</span></label>

				  <?php };?>

				  

				  

				  <div class="buttons2"><a href="#" class="button" data-type="submit"><?php echo $send_mess; ?></a>

						<div class="success">Contact form submitted! <strong>We will be in touch soon.</strong>

						</div>

				  </div>

				  

				  

				</fieldset>

			  </form>

				

				

				

				<?php /**<form id="contact-form">

					<div class="success">Contact form submitted!<br>

						<strong>We will be in touch soon.</strong>

					</div>

					<fieldset>

					  <label class="name">

						<input type="text" value="Your Name*">

						  <span class="error">*This is not a valid name.</span> <span class="empty">*This field is required.</span>

					  </label>

					  <label class="email">

						<input type="text" value="Email*">

						  <span class="error">*This is not a valid email address.</span> <span class="empty">*This field is required.</span>

					  </label>

					  <label class="message notRequired">

						<textarea>Message</textarea>

						  <span class="error">*The message is too short.</span> <span class="empty">*This field is required.</span>

					  </label>

					  <div class="buttons2">

						  <a href="#" data-type="submit" class="button">Send Your Message</a>

					  </div>

					</fieldset>

				</form>

				**/?>

				

				

			  </div>

			</div>

			<?php };?>

			

			

			

			

			

			<div class="grid_8 omega">

			  <div class="pad_box2">

				<div class="ext_box map_box">

				  <figure>

					<div id="map_canvas"></div>

				  </figure>

				  <div>

					<h2><?php echo get_option('sense_contact_title'); ?></h2>

					<p class="p3 gray1"><?php echo get_option('sense_contact_adress1'); ?></p>

					<dl class="address">

						<?php if(get_option('sense_contact_phone') !=""){ ?>

							<dd><span><img src="<?php echo get_template_directory_uri(); ?>/images/ico1.png" alt=""></span><?php echo get_option('sense_contact_phone'); ?></dd>

						<?php }?>

						<?php if(get_option('sense_contact_email_adress') !=""){ ?>

							<dd><span><img src="<?php echo get_template_directory_uri(); ?>/images/ico2.png" alt=""></span><a href="mailto:<?php echo get_option('sense_contact_email_adress');?>"><?php echo get_option('sense_contact_email_adress'); ?></a></dd>

						<?php }?>

						<?php if(get_option('sense_contact_skype') !=""){ ?>

							<dd><span><img src="<?php echo get_template_directory_uri(); ?>/images/ico3.png" alt=""></span><?php echo get_option('sense_contact_skype'); ?></dd>

						<?php }?>

					</dl>

					<dl class="address">

						<?php $icons = get_option('contact_icon'); ?>

						<?php if(isset($icons)&&(!empty($icons))){ ?>

						<?php foreach ($icons as $value) { ?>

							<dd><span><img src="<?php echo $value['icon']; ?>" alt=""></span>

							<?php if($value['url'] != ""){?>

                            	<a href="http://<?php echo $value['url']; ?>"><?php echo $value['name']; ?></a>

							<?php }

							 else {

								  echo $value['name'];

							 }?></dd>

						<?php }; }; ?>

				  </dl>

				  </div>

				</div>

			  </div>

			</div>

			<?php if(get_option('sense_hire_me_button') == "show"): ?>

				<a href="http://<?php echo get_option('sense_hire_me_link')?>" target="_blank" class="hire_link"></a>

			<?php endif; ?>

			<div class="clear"></div>

		  </div>

		</article>

	  </div>

    <!--contact end--> 

<?php };





function print_sample_page(){



?>

<!--==============================================================-->

<div class="wrapper gray1">

	<article class="grid_12">

	  <div class="box p_bot1">

		<div class="grid_12 alpha omega">

		  <div class="pad_box3">

			<h2><?php echo get_option('sense_sample_page'); ?></h2>

			<?php echo get_option('sense_sample_text'); ?>

		  </div>

		</div>

		

		<?php if(get_option('sense_hire_me_button') == "show"): ?>

			<a href="<?php echo get_option('sense_hire_me_link')?>" target="_blank" class="hire_link"></a>

		<?php endif; ?>

		<div class="clear"></div>

	  </div>

	</article>

  </div>

<?php };



function print_blog(){



?>

<!--==============================blog================================-->



		<?php get_template_part('section', 'blog'); ?>



<?php };







