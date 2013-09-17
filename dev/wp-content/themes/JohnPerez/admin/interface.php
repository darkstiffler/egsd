<?php
function siteoptions_add_admin() {
    global $query_string;
    $of_page = add_theme_page('Site Options', 'Site Options', 'edit_theme_options', 'siteoptions','siteoptions_options_page');
    wp_enqueue_style('admin-style', get_template_directory_uri().'/admin/admin_style.css');
    wp_enqueue_style('admin_options_style', get_template_directory_uri().'/admin/css/admin_options.css');
    wp_enqueue_style('modal', get_template_directory_uri().'/admin/css/jquery-ui.css');
    wp_enqueue_style('color-picker', get_template_directory_uri().'/admin/colorpicker/colorpicker.css');
    wp_enqueue_script('color-picker', get_template_directory_uri().'/admin/colorpicker/colorpicker.js', array('jquery'));
    wp_enqueue_script('ui', get_template_directory_uri().'/admin/js/jquery-ui.js', array('jquery'));
	//wp_enqueue_script('ajaxupload', get_template_directory_uri().'/ajaxupload.js', array('jquery'));
	wp_enqueue_script('modernizr', get_template_directory_uri().'/admin/js/modernizr.custom.js', array('jquery'));
	wp_enqueue_script('blog_scripts', get_template_directory_uri().'/admin/js/blog_scripts.js', array('jquery'));
	
	// Add framework functionaily to the head individually
	// add_action("admin_print_scripts-$of_page", 'of_load_only');
	// add_action("admin_print_styles-$of_page",'of_style_only');
} 
add_action('admin_menu', 'siteoptions_add_admin');
function sense_options_upload_scripts() {
	wp_register_script( 'sense-upload', get_template_directory_uri() .'/admin/js/upload_media.js', array('jquery','media-upload','thickbox') );	
	if ((get_current_screen()->id == 'appearance_page_siteoptions')||(get_current_screen()->id == 'portfolio')) {
		wp_enqueue_script('jquery');
		wp_enqueue_script('thickbox');
		wp_enqueue_style('thickbox');
		wp_enqueue_script('media-upload');
		wp_enqueue_script('sense-upload');
	}
	
}
add_action('admin_enqueue_scripts', 'sense_options_upload_scripts');

// Add shortcode button to redactor
add_action('init', 'add_button');
function add_button() {
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages')){
     add_filter('mce_external_plugins', 'add_plugin');
     add_filter('mce_buttons', 'register_button');
   }
}
function add_plugin($plugin_array) {
   $plugin_array['myShorcode'] = get_template_directory_uri().'/admin/shortcodes.js';
   return $plugin_array;
}
function register_button($buttons) {
   array_push($buttons, "myShorcode");
   return $buttons;
}
// -----------------------------------------------------


function of_style_only() {
	wp_enqueue_style('admin-style', ADMIN_PATH.'/admin_style.css');
}

function the_team(){
	echo do_shortcode(get_option('sense_about_block3_text'));
}

function the_service(){
	$data = get_option('sense_sevices_block1_shortcodes');
	preg_match_all("/\[.*\]/", $data, $shortcodes);
	foreach ($shortcodes[0] as $s) {
		echo do_shortcode(trim($s));
	}
}

function the_slide(){
	$data = get_option('sense_sevices_block3_shortcodes');
	preg_match_all("/\[.*\]/", $data, $shortcodes);
	foreach ($shortcodes[0] as $s) {
		echo do_shortcode(trim($s));
	}
}
function get_data($field){
	return do_shortcode(get_option($field));
}


function siteoptions_options_page(){
	$options = array();
		$options[] = array( "name" => "General",
			"type" => "heading");
		$options[] = array( "name" => "Title",
					"type" => "text",
					"id" => "title",
					"std" => get_option('sense_title')
					);
	
		$options[] = array( "name" => "Favicon",
					"type" => "upload",
					"id" => "site_icon",
					"std" => get_option('sense_site_icon')
					);
		$options[] = array( "name" => "Show Pages",
					"type" => "custom_type",
					"function" => "show_pages",
					);
		$options[] = array( "name" => "Settings Logo",
					"type" => "radio",
					"id" => "settings_logo",
					"std" => get_option('sense_settings_logo'),
					"options" => array(
						"show_image"=>"Image Logo",
						"show_text"=>"Text Logo"
						)
					);
		$options[] = array( "name" => "Text Logo",
					"type" => "text",
					"id" => "logo_text",
					"std" => get_option('sense_logo_text')
					);
		$options[] = array( "name" => "Logo Font Size",
					"type" => "text",
					"id" => "logo_size",
					"std" => get_option('sense_logo_size')
					);
		$options[] = array( "name" => "Logo Color",
					"type" => "color",
					"id" => "logo_color",
					"std" => "#ffffff"
					);
		$options[] = array( "name" => "Logo Font Family",
					"type" => "select",
					"id" => "logo_font_family",
					"std" => get_option('sense_logo_font_family'),
					"options" => get_fonts()
					);
		$options[] = array( "name" => "Slogan Text",
					"type" => "text",
					"id" => "slogan_text",
					"std" => get_option('sense_slogan_text')
					);
		$options[] = array( "name" => "Slogan Font Size",
					"type" => "text",
					"id" => "slogan_size",
					"std" => get_option('sense_slogan_size')
					);
		$options[] = array( "name" => "Slogan Color",
					"type" => "color",
					"id" => "select_color",
					"std" => "#ffffff"
					);
		$options[] = array( "name" => "Slogan Font Family",
					"type" => "select",
					"id" => "slogan_font_family",
					"std" => get_option('sense_slogan_font_family'),
					"options" => get_fonts()
					);
		$options[] = array( "name" => "Logo Image (326 x 74)",
					"type" => "upload",
					"id" => "logo_image",
					"std" => get_option('sense_logo_image'),
					);
		$options[] = array( "name" => "Theme settings panel",
					"type" => "radio",
					"id" => "settings_panel",
					"std" => get_option('sense_settings_panel'),
					"options" => array(
						"show"=>"Show",
						"hide"=>"Hide"
						)
					);
					
		$options[] = array( "name" => "Header Text",
					"type" => "textarea",
					"id" => "header_text",
					"std" => stripslashes_deep(get_option('sense_header_text'))
					);			
					
	
		$options[] = array( "name" => "Footer Text",
					"type" => "textarea",
					"id" => "footer_text",
					"std" => get_option('sense_footer_text')
					);
					
					
					
					
		$options[] = array( "name" => "Twitter ID",
					"type" => "text",
					"id" => "twitter_id",
					"std" => get_option('sense_twitter_id')
					);
					
					
					
					
					
					
		$options[] = array( "name" => "Consumer key",
					"type" => "text",
					"id" => "tw_ck",
					"std" => get_option('sense_tw_ck')
					);
		$options[] = array( "name" => "Consumer secret",
					"type" => "text",
					"id" => "tw_cs",
					"std" => get_option('sense_tw_cs')
					);
		$options[] = array( "name" => "Access token",
					"type" => "text",
					"id" => "tw_ut",
					"std" => get_option('sense_tw_ut')
					);
		$options[] = array( "name" => "Access token secret",
					"type" => "text",
					"id" => "tw_us",
					"std" => get_option('sense_tw_us')
					);
		$options[] = array( "name" => "Number of twitts",
					"type" => "text",
					"id" => "tw_num",
					"std" => get_option('sense_tw_num')
					);
					
					
					
					
					
					
					
					
					
					
					
		$options[] = array( "name" => "Google Analytics",
					"type" => "other_text",
					"id" => "google_analytics",
					"std" => get_option('sense_google_analytics')
					);
		$options['export'] = array( "name" => "Export",
					"type" => "other_text",
					"id" => "export",
					"std" => ''
					);
		$options[] = array( "name" => "Get Export Text",
					"type" => "button",
					"id" => "export_btn",
					"std" => ''
					);
		$options[] = array( "name" => "Import",
					"type" => "other_text",
					"id" => "import",
					"std" => ''
					);
		$options[] = array( "name" => "Import Data",
					"type" => "button",
					"id" => "import_btn",
					"std" => ''
					);
					
					
					
					
		
		$options[] = array( "name" => "Settings",
					"type" => "heading"
					);
		$options[] = array( "name" => "",
					"type" => "radio",
					"id" => "check_color",
					"std" => get_option('sense_check_color'),
					"options" => array(
						"theme"=>"Theme Color Scheme",
						"custom"=>"Custom Color Scheme"
						)
					);
		$options[] = array( "name" => "Theme Color Scheme",
					"type" => "select_color",
					"id" => "theme_color",
					"std" => get_option('sense_theme_color'),
					"options" => get_theme_color()
					);
		$options[] = array( "name" => "Custom Color Scheme",
					"type" => "color",
					"id" => "select_color1",
					"std" => "#16994a"
					);
					
		$options[] = array( "name" => "",
					"type" => "radio",
					"id" => "check_pattern",
					"std" => get_option('sense_check_pattern'),
					"options" => array(
						"theme_pattern"=>"Theme Pattern Scheme",
						"custom_pattern"=>"Custom Pattern Scheme"
						)
					);
		$options[] = array( "name" => "Theme Pattern Scheme",
					"type" => "select_pattern",
					"id" => "theme_pattern",
					"std" => get_option('sense_theme_pattern'),
					"options" => get_theme_pattern()
					);
		$options[] = array( "name" => "Custom Pattern Scheme",
					"type" => "upload",
					"id" => "pattern1",
					"std" => get_option('sense_pattern1')
					);
		$options[] = array( "name" => "CV Button",
					"type" => "radio",
					"id" => "cv_button",
					"std" => get_option('sense_cv_button'),
					"options" => array(
						"show"=>"Show CV button",
						"hide"=>"Hide CV button"
						)
					);
		$options[] = array( "name" => "CV Button Link",
					"type" => "text",
					"id" => "cv_button_link",
					"std" => get_option('sense_cv_button_link')
					);
		$options[] = array( "name" => "Hire me button",
					"type" => "radio",
					"id" => "hire_me_button",
					"std" => get_option('sense_hire_me_button'),
					"options" => array(
						"show"=>"Show Hire me button",
						"hide"=>"Hide Hire me button"
						)
					);
		$options[] = array( "name" => "Hire me button Link",
					"type" => "text",
					"id" => "hire_me_link",
					"std" => get_option('sense_hire_me_link ')
					);
		
		
		
					
					
					
					
		$options[] = array( "name" => "About",
					"type" => "heading"
					);
		$options[] = array( "name" => "Button name",
					"type" => "text",
					"id" => "name_button_about",
					"std" => get_option('sense_name_button_about')
					);
		$options[] = array( "name" => "About text",
					"type" => "textarea",
					"id" => "about_shortcodes",
					"std" => get_option('sense_about_shortcodes')
					);
					
					
		$options[] = array( "name" => "My experience",
					"type" => "text",
					"id" => "my_experience",
					"std" => get_option('sense_my_experience')
					);
		$options[] = array( "name" => "My experience Shortcodes",
					"type" => "textarea",
					"id" => "my_experience_shortcodes",
					"std" => get_option('sense_my_experience_shortcodes')
					);
		$options[] = array( "name" => "Load Image",
					"type" => "imageabout"
					);
					
					
					

					
					
					
		$options[] = array( "name" => "Portfolio",
					"type" => "heading"
					);
		$options[] = array( "name" => "Button name",
					"type" => "text",
					"id" => "name_button_portfolio",
					"std" => get_option('sense_name_button_portfolio')
					);
		$options[] = array( "name" => "Portfolio Title",
					"type" => "text",
					"id" => "portfolio_title",
					"std" => get_option('sense_portfolio_title')
					);
					
					
					
					
					
		$options[] = array( "name" => "Services",
					"type" => "heading"
					);
		$options[] = array( "name" => "Button name",
					"type" => "text",
					"id" => "name_button_services",
					"std" => get_option('sense_name_button_services')
					);
		$options[] = array( "name" => "Services Block 1 Title",
					"type" => "text",
					"id" => "services_block1_title",
					"std" => get_option('sense_services_block1_title')
					);
		$options[] = array( "name" => "Services Block 1 Text",
					"type" => "textarea",
					"id" => "services_block1_shortcodes",
					"std" => get_option('sense_services_block1_shortcodes')
					);
					
					

		$options[] = array( "name" => "Services Block 2 Title",
					"type" => "text",
					"id" => "services_block2_title",
					"std" => get_option('sense_services_block2_title')
					);
		$options[] = array( "name" => "Services Block 2 Text",
					"type" => "textarea",
					"id" => "services_block2_shortcodes",
					"std" => get_option('sense_services_block2_shortcodes')
					);
					
		$options[] = array( "name" => "More Services Button URL",
					"type" => "text",
					"id" => "services_block2_btn_url",
					"std" => get_option('sense_services_block2_btn_url')
					);
		$options[] = array( "name" => "Show/Hide More Services Button",
					"type" => "radio",
					"id" => "more_services_button",
					"std" => get_option('sense_more_services_button'),
					"options" => array(
						"show"=>"Show",
						"hide"=>"Hide"
						)
					);
		$options[] = array( "name" => "More Services Button Text",
					"type" => "text",
					"id" => "services_block2_btn_text",
					"std" => get_option('sense_services_block2_btn_text')
					);	
		
		$options[] = array( "name" => "Services Block 3 Title",
					"type" => "text",
					"id" => "services_block3_title",
					"std" => get_option('sense_services_block3_title')
					);
		$options[] = array( "name" => "Services Block 3 Shortcodes",
					"type" => "textarea",
					"id" => "services_block3_shortcodes",
					"std" => get_option('sense_services_block3_shortcodes')
					);
				
		$options[] = array( "name" => "Sample Text Page",
					"type" => "text",
					"id" => "sample_page",
					"std" => get_option('sense_sample_page')
					);
		$options[] = array( "name" => "Sample Text",
					"type" => "textarea",
					"id" => "sample_text",
					"std" => get_option('sense_sample_text')
					);
				
					
				
					
					
					
					
					
		$options[] = array( "name" => "Social",
					"type" => "heading");
		$options[] = array( "name" => "Social Icons",
					"type" => "radio",
					"id" => "soc_icons",
					"std" => get_option('sense_soc_icons'),
					"options" => array(
						"show"=>"Show",
						"hide"=>"Hide"
						)
					);
		$options[] = array( "name" => "Default option",
					"type" => "radio",
					"id" => "default_option",
					"std" => get_option('sense_default_option'),
					"options" => array(
						"opened"=>"Opened",
						"closed"=>"Closed"
						)
					);
		$options[] = array( "name" => "<b>Please insert full URL to your social profile</b><br><br>Facebook",
					"type" => "text",
					"id" => "facebook",
					"std" => get_option('sense_facebook')
					);
		$options[] = array( "name" => "Tweeter",
					"type" => "text",
					"id" => "tweeter",
					"std" => get_option('sense_tweeter')
					);
		$options[] = array( "name" => "Google+",
					"type" => "text",
					"id" => "google",
					"std" => get_option('sense_google')
					);
		$options[] = array( "name" => "LinkedIn",
					"type" => "text",
					"id" => "linkedin",
					"std" => get_option('sense_linkedin')
					);
		$options[] = array( "name" => "Flikr",
					"type" => "text",
					"id" => "flikr",
					"std" => get_option('sense_flikr')
					);
		$options[] = array( "name" => "Pinterest",
					"type" => "text",
					"id" => "pinterest",
					"std" => get_option('sense_pinterest')
					);
		$options[] = array( "name" => "Vimeo",
					"type" => "text",
					"id" => "vimeo",
					"std" => get_option('sense_vimeo')
					);
		$options[] = array( "name" => "YouTube",
					"type" => "text",
					"id" => "youtube",
					"std" => get_option('sense_youtube')
					);
		$options[] = array( "name" => "Dribble",
					"type" => "text",
					"id" => "dribble",
					"std" => get_option('sense_dribble')
					);
					
					
					
					
		$options[] = array( "name" => "Blog",
					"type" => "heading");
		$options[] = array( "name" => "Button name",
					"type" => "text",
					"id" => "name_button_blog",
					"std" => get_option('sense_name_button_blog')
					);

		$options[] = array( "name" => "Blog Title",
					"type" => "text",
					"id" => "blog_title",
					"std" => get_option('sense_blog_title')
					);
					
					
					
		$options[] = array( "name" => "Contact",
					"type" => "heading");
		$options[] = array( "name" => "Button name",
					"type" => "text",
					"id" => "name_button_contact",
					"std" => get_option('sense_name_button_contact')
					);
		

		$options[] = array( "name" => "Get In Touch Title",
					"type" => "text",
					"id" => "form_title",
					"std" => get_option('sense_form_title')
					);
		$options[] = array( "name" => "Contact Info Title",
					"type" => "text",
					"id" => "contact_title",
					"std" => get_option('sense_contact_title')
					);
					
		$options[] = array( "name" => "Send Message Button",
					"type" => "text",
					"id" => "send_message",
					"std" => get_option('sense_send_message')
					);
		$options[] = array( "name" => "Contact Info Text",
					"type" => "textarea",
					"id" => "contact_adress1",
					"std" => get_option('sense_contact_adress1')
					);
		$options[] = array( "name" => "Email Address",
					"type" => "text",
					"id" => "contact_email_adress",
					"std" => get_option('sense_contact_email_adress')
					);
		$options[] = array( "name" => "Phone",
					"type" => "text",
					"id" => "contact_phone",
					"std" => get_option('sense_contact_phone')
					);
		$options[] = array( "name" => "Skype",
					"type" => "text",
					"id" => "contact_skype",
					"std" => get_option('sense_contact_skype')
					);			
		$options[] = array( "name" => "Google Map",
					"type" => "text",
					"id" => "contact_urlmaps1",
					"std" => get_option('sense_contact_urlmaps1')
					);
		$options[] = array( "name" => "Load Image",
					"type" => "contacticon"
					);
					
				
		
		
					
					
					
		
				?><style type="text/css">
					.form_select_color{background-color: <?php echo get_option('sense_theme_color') ?>}
					div.pattern{background-image: url('<?php
					$path = substr(get_option('sense_theme_pattern'), -5, 1);
					echo get_template_directory_uri().'/images/pattern'.$path.'.png' ?>')}
				</style>
				<?php
				
		
		$export_data = '';
        // $return = options_generator($options);

		$home = get_option('sense_home');
		if(isset($home)&&($home!='')){
	        foreach (get_option('sense_home') as $value) { ?>
	        	<?php $font = str_replace(" ", "+", stripslashes_deep($value['font-family'])); ?>
	        	<?php $font = str_replace("'", "", $font); ?>
	            <link href="http://fonts.googleapis.com/css?family=<?php echo $font; ?>" rel="stylesheet" />
	  <?php }; 
    	}; ?>
<div class="admin-main clearfix" id="truethemes_container">

  <form action="" enctype="multipart/form-data" id="ofform">
  	<input type="hidden" name="sense_home" id="home_hiden" value="" />
  	<input type="hidden" name="sense_soc" id="soc_hiden" value="" />
  	<input type="hidden" name="sense_teams" id="teams_hiden" value="" />
  	<input type="hidden" name="sense_services" id="services_hiden" value="" />
  	<input type="hidden" name="sense_contact_form" id="form_hiden" value="" />
  	<input type="hidden" name="theme_url" id="theme_url_hiden" value="" />

	<aside class="admin-aside">
		<div id="admin-logo">
			<a href="#"><img src="<?php echo URL_PATH ?>admin/images/admin-logo.png" alt="" /></a>
		</div><!--/ #cms-logo-->
		<nav id="admin-nav" class="admin-nav">
			<ul>
				<li class="current option-general"><a href="#option-general" title="General">General</a></li>
				<li class="option-settings"><a href="#option-settings" title="Settings">Theme Settings</a></li>
               			<li class="option-about"><a href="#option-about" title="About">About</a></li>
                		<li class="option-portfolio"><a href="#option-portfolio" title="Portfolio">Portfolio</a></li>
				<li class="option-services"><a href="#option-services" title="Services">Services</a></li>
               			<li class="option-blog"><a href="#option-blog" title="Blog">Blog</a></li>
				<li class="option-contact"><a href="#option-contact" title="Contact">Contact</a></li>
               			<li class="option-social"><a href="#option-social" title="Social">Social Icons</a></li>
               			<li class="option-contactForm"><a href="#option-contactForm" title="Contact Form">Contact Form</a></li>
			</ul>
		</nav><!--/ .admin-nav-->
		<div id="save_status">Please save your changes.</div>
	</aside><!--/ .admin-aside-->
	<section class="admin-content">
		<div class="heading-holder clearfix">
			
			<h3 class="heading-title">Theme Options</h3>

			<ul class="optional-links">
				<li class="publish-to"><a href="#">Save All Changes</a></li>
			</ul><!--/ .optional-links-->
		</div><!--/ .heading-holder-->
		<div class="container">
			<div id="option-home" class="group">
				<div class="sub-heading clearfix">
					<h4 class="sub-heading-title">Home</h4>
				</div>
				<div class="main-holder clearfix">
				<?php
					$bgr = array();
					$bgr[] = array( "name" => "Home Background",
						"type" => "upload",
						"id" => "home_bgr",
						"std" => get_option('sense_home_bgr'),
						);
					options_generator($bgr); 
				?>
				
			      <div id="home_text">
			      	<?php
			      		if(isset($home)&&($home!='')){
			      			foreach ($home as $value) {
			      	?>
			      	<div data-speed="<?php echo $value['speed']; ?>" style="left: <?php echo $value['margin-left'] ?>; top: <?php echo $value['margin-top'] ?>; font-family: <?php echo $value['font-family'] ?>; font-size: <?php echo $value['font-size']?>"  class="drag<?php if($value['accent_color']=='accent'){echo ' accent_color';} ?>"><?php echo $value['text']; ?></div>
			      	<?php		
			      			}
			      		}
					?>
				</div>
			      <div id="edit_str">
			      	<label for="str_value">Edit text:</label>
			      	<input type="text" id="str_value" name="str_value" value="" />
			      	<span class="font_size_edit">
			      		<span class="input_title">Font size(px):</span>
			      		<a class="litle"><</a>
			      		<input type="text" id="font_size" name="font_size" value="" />
			      		<a class="big">></a>
			      	</span>
			      	<span class="speed">
			      		<span class="input_title">Scroll speed:</span>
			      		<a class="litle"><</a>
				      	<input type="text" id="speed" name="speed" value="" />
			      		<a class="big">></a>
			      	</span>
			      	<span class="input_title">Font Family:</span>
			      	<select id="font_family" name="font_family">
			      		<?php 
			      			$fonts = get_fonts();
			      			foreach ($fonts as $key => $value) {
			      				echo '<option value = "'.$key.'">'.$value.'</option>';
			      			}
			      		 ?>
			      	</select>


			      	<input type="checkbox" id="accent_color" name="accent_color" value="accent_color">Accent color
			      	<br/><br/>
					<a class="add-field" id="add_item">Add New String</a>
					<a class="remove-field" id="delete_item">Delete String</a>
					<br/><br/>
			      </div>
			      <?php/*<div id="soc_items">
			      	<h4>Social Icons</h4>
			      	<?php
			      	$icons = get_option('sense_soc');
			      	if(isset($icons)&&(!empty($icons))){
			      		foreach ($icons as $value) {
			      	?>
						<div class="soc_item">
							<span class="soc_name"><?php echo $value['name']; ?></span> link: 
							<input class="soc_url" value="<?php echo $value['url']?>"/>
							<?php echo siteoptions_uploader_function($value['name'], $value['name'], $value['icon'], 'services_img');?>
							<span class="delete_icon button remove-field">Delete icon</span>
						</div>

			      	<?php		
			      		}
			      	}
					?>
					</div>*/?>
					<h5 class="title">Add new icon</h5>
					<label for="soc_name">Icon name: </label>
			      <input name="soc_name" id="soc_name" />
			      <a class="add-field"  id="add_soc">Add new icon</a>
				</div>
			</div>
		</div>
	    <?php 
    		options_generator($options);
		?>
		</div>
	</div>
	</div>
	
		<div class="container">
			<div id="option-contactForm" class="group">
				<div class="sub-heading clearfix">
					<h4 class="sub-heading-title">Contact Form</h4>
				</div>
				<div class="main-holder clearfix">
				<div id="new_contact_form">
		 	      	<?php
		 	      		$cont = get_option('sense_contact_form');
		 	      		if(isset($cont)&&$cont!=''){
				      		foreach ($cont as $value) {
				      	?>
				      		<span class="contact_item">
				      			<input class="data" name="<?php echo $value['name']; ?>" value="<?php echo $value['label']; ?>"/>
				      			<input <?php if($value['is_checked']){echo 'checked';} ?> type="checkbox" class="is_required"/> Required 
				      			<a class="delete_item button remove-field">delete</a>
								<select class="check_type" name="check_type">
									<option value="text" <?php if($value['check_type']=='text'){echo 'selected="selected"';} ?> >Text</option>
									<option value="name" <?php if($value['check_type']=='name'){echo 'selected="selected"';} ?> >Name</option>
									<option value="email" <?php if($value['check_type']=='email'){echo 'selected="selected"';} ?> >Email</option>
									<option value="phone" <?php if($value['check_type']=='phone'){echo 'selected="selected"';} ?> >Phone</option>
									<option value="message" <?php if($value['check_type']=='message'){echo 'selected="selected"';} ?> >Message</option>
								</select>
				      		</span>
				      	<?php		
				      		}
			      		}
					?>
		 		</div>
					<div id="item">
						<label for="field_name">Label: </label>
						<input type="text" name='field_label' value="" id="field_label" />
						<label for="field_name">Name: </label>
						<input type="text" name='field_name' value="" id="field_name" />
						<a class="add-field button" id="add_new_field">Add New Field</a>
					</div>		
				</div>
			</div>
		</div>
		<div class="footer-holder clearfix">
			Copyright &copy; 2012 <a href="#">ClickCMS</a>. All rights reserved.
		</div>
	</section>
	
  </form>
	
	<div class="group" id="dialog-form1" title="Add New Worker" style="display:none;">
	    <form>
		    <fieldset id="team">
		    	<h5>Team</h5>
		        <label for="team_name">Name</label>
		        <input type="text" name="team_name" id="team_name" class="text ui-widget-content ui-corner-all" />
		        <label for="team_pos">Position</label>
		        <input type="text" name="team_pos" id="team_pos" value="" class="text ui-widget-content ui-corner-all" />
		        <label for="team_text">Description</label>
		        <textarea type="text" name="team_text" id="team_text" class="text ui-widget-content ui-corner-all"></textarea>
		        <label for="team_link">Link</label>
		        <input type="text" name="team_link" id="team_link" value="" class="text ui-widget-content ui-corner-all" />
		    </fieldset>
		</form>
	</div>
  
  	<div class="group" id="dialog-form2" title="Add New Services" style="display:none;">
	    <form>
		    <fieldset id="services">
		    	<h5>Services</h5>
		        <label for="services_title">Title</label>
		        <input type="text" name="services_title" id="services_title" class="text ui-widget-content ui-corner-all" />
		        <label for="services_text">Description</label>
		        <textarea type="text" name="services_text" id="services_text" class="text ui-widget-content ui-corner-all"></textarea>
		        <label for="services_link">Link</label>
		        <input type="text" name="services_link" id="services_link" value="" class="text ui-widget-content ui-corner-all" />
		    </fieldset>
		</form>
	</div>  
	
	
	
	
  	
	
	<div class="group" id="dialog-form3" title="Add shortcode" style="display:none;">
	    <form>
		    <fieldset id="slider_item">
		    	<h5></h5>
		        <label for="item_author">Client</label>
		        <input type="text" name="item_author" id="item_author" class="text ui-widget-content ui-corner-all" />
		        <label for="item_text">Testimonial Text</label>
		        <textarea name="item_text" id="item_text" class="text ui-widget-content ui-corner-all"></textarea>
		    </fieldset>
	    </form>
	</div>
	
	
	<div class="group" id="dialog-form4" title="Add shortcode" style="display:none;">
	    <form>
		    <fieldset id="slider_item">
		    	<h5></h5>
		        <label for="item_author2">Position</label>
		        <input type="text" name="item_author2" id="item_author2" class="text ui-widget-content ui-corner-all" />
				<label for="item_company">Company</label>
		        <input type="text" name="item_company" id="item_company" class="text ui-widget-content ui-corner-all" />
		        <label for="item_date">Date</label>
		        <input type="text" name="item_date" id="item_date" value="" class="text ui-widget-content ui-corner-all" />
		        <label for="item_text2">Text</label>
		        <textarea name="item_text2" id="item_text2" class="text ui-widget-content ui-corner-all"></textarea>
		    </fieldset>
	    </form>
	</div>
	<div class="group" id="dialog-form5" title="Add shortcode" style="display:none;">
	    <form>
		    <fieldset id="slider_item">
		    	<h5></h5>
		        <label for="item_author3">Title</label>
		        <input type="text" name="item_author3" id="item_author3" class="text ui-widget-content ui-corner-all" />
		        <label for="item_text3">Text</label>
		        <textarea name="item_text3" id="item_text3" class="text ui-widget-content ui-corner-all"></textarea>
		    </fieldset>
	    </form>
	</div>
	
	<div class="group" id="dialog-form6" title="Add shortcode" style="display:none;">
	    <form>
		    <fieldset id="slider_item">
		        <label for="item_author4">Title</label>
		        <input type="text" name="item_author4" id="item_author4" class="text ui-widget-content ui-corner-all" />
		        <label for="item_text4">Text</label>
		        <textarea name="item_text4" id="item_text4" class="text ui-widget-content ui-corner-all"></textarea>
		    </fieldset>
	    </form>
	</div>
	
	<div class="group" id="dialog-form7" title="Add shortcode" style="display:none;">
	    <form>
		    <fieldset id="slider_item">
		    	<h5></h5>
		        <label for="item_label">Title</label>
		        <input type="text" name="item_label" id="item_label" class="text ui-widget-content ui-corner-all" />
		        <label for="item_num">Percents</label>
		        <input type="text" name="item_num" id="item_num" value="" class="text ui-widget-content ui-corner-all" />
		        <label for="item_set">Bar(10/10)</label>
		        <textarea name="item_set" id="item_set" class="text ui-widget-content ui-corner-all"></textarea>
		    </fieldset>
	    </form>
	</div>
	
	
	
	
	
	
</div>
<!--wrap-->
<?php admin_script(); ?>
<?php
}




function options_generator($options, $postId = null){
	$output = '';
	$menu = '';                                 
	$counter = 0;
	foreach ($options as $value) {
		$counter++;
		$val = '';
		$select_value = ''; 
		$output = '';
		if(isset($value['container'])){
			$output .= '<div class="'.$value['container'].'">';
		} 
		if($value['type']!='heading'){
			$output .= '<h5 class="title">'.$value['name'].'</h5>';
		}
		switch ( $value['type'] ) {
		case 'imageabout':
			$icons = get_option('sense_soc');
			$output = '';
			$output = ' <div id="soc_items"> ';
			if(isset($icons)&&(!empty($icons)))
			{
			    foreach ($icons as $value) 
				{
			      	$output .= '<div class="soc_item">
								<span class="soc_name">'. $value['name'] .'</span>
								<div class="sense_upload_block">
										<input class="sense_upload_url" type="hidden" id="'. $value['name'] .'" name="'. $value['name'] .'" value="'. $value['icon'] .'" />
										<a id="upload_'. $value['name'] .'_button" class="button sense_upload_image_button add-field">Upload Image</a>
										<a id="delete_'. $value['name'] .'_button" class="hide button sense_delete_image_button remove-field">Delete Image</a>
										<div class="image_preview"><img alt="" src="'.$value['icon'].'" />
										</div>
									</div>
								<span class="delete_icon button remove-field">Delete title</span>
							</div>';
				}
			}
			$output .= ' </div>
			<div class = "image_about">
							<label for="soc_name">Image Name: </label>
							<input name="soc_name2" id="soc_name2" />
							<a class="add-field"  id="add_soc2">Load Image</a>
						</div>';
						
						
						
		break;
		case 'contacticon':
			$icons_contact = get_option('contact_icon');
			$output = '';
			$output = ' <div id="contact_icon_items"> ';
			if(isset($icons_contact)&&(!empty($icons_contact)))
			{
			    foreach ($icons_contact as $value) 
				{
			      	$output .= '<div class="contact_icon_item">
								<span class="icon_name">'. $value['name'] .'</span> link: 
								<input class="soc_url" value="'. $value['url'] .'"/>
								<div class="sense_upload_block">
										<input class="sense_upload_url" type="hidden" id="'. $value['name'] .'" name="'. $value['name'] .'" value="'. $value['icon'] .'" />
										<a id="upload_'. $value['name'] .'_button" class="button sense_upload_image_button add-field">Upload Image</a>
										<a id="delete_'. $value['name'] .'_button" class="hide button sense_delete_image_button remove-field">Delete Image</a>
										<div class="image_preview"><img alt="" src="'.$value['icon'].'" />
										</div>
									</div>
								<span class="delete_icon button remove-field">Delete title</span>
							</div>';
				}
			}
			$output .= ' </div>
			<div class = "image_about">
							<label for="icon_name">Field Text: </label>
							<input name="contact_icon_name" id="contact_icon_name" />
							<a class="add-field"  id="add_contact_icon">Load Image</a>
						</div>';
						
						
						
		break;
		case 'text':
			$val = $value['std'];
			$std = get_option($value['id']);
			if ( $std != "") { $val = $std; }
			$output .= '<input class="form_input" name="'. $value['id'] .'" id="'. $value['id'] .'" type="'. $value['type'] .'" value="'. $val .'" /><br/>';
		break;
		case 'select':
			$output .= '<select class="form_select" name="'. $value['id'] .'" id="'. $value['id'] .'">';
			$select_value = get_option($value['id']);
			foreach ($value['options'] as $val => $option) {
				$selected = '';
				 if($select_value != '') {
					 if ( $select_value == $val) { $selected = ' selected="selected"';} 
			     } else {
					 if ( isset($value['std']) )
						 if ($value['std'] == $val) { $selected = ' selected="selected"'; }
				 }
				 $output .= '<option '. $selected . ' value="'.$val.'"'.'>';
				 $output .= $option;
				 $output .= '</option>';
			 } 
			 $output .= '</select></br></br>';
		break;
		case 'select_pattern':
			$output .= '<select class="form_select_pattern" name="'. $value['id'] .'" id="'. $value['id'] .'">';
			$select_value = get_option($value['id']);
			$tt = 1;
			foreach ($value['options'] as $val => $option) {
				$selected = '';
				 if($select_value != '') {
					 if ( $select_value == $val) { $selected = ' selected="selected"';} 
			     } else {
					 if ( isset($value['std']) )
						 if ($value['std'] == $val) { $selected = ' selected="selected"'; }
				 }
				 $output .= '<option '. $selected . 'class="pattern'.$tt.'"'.' value="'.$val.'"'.'>';
				 $output .= $option;
				 $output .= '</option>';
				 $tt++;
			 } 
			 $output .= '</select><div class="pattern"></div></br></br>';
		break;
		case 'select_color':
			$output .= '<select class="form_select_color" name="'. $value['id'] .'" id="'. $value['id'] .'">';
			$select_value = get_option($value['id']);
			$tt = 1;
			foreach ($value['options'] as $val => $option) {
				$selected = '';
				 if($select_value != '') {
					 if ( $select_value == $val) { $selected = ' selected="selected"';} 
			     } else {
					 if ( isset($value['std']) )
						 if ($value['std'] == $val) { $selected = ' selected="selected"'; }
				 }
				 $output .= '<option '. $selected . ' class="selected_color color'.$tt.'"'.' value="'.$val.'"'.'>';
				 $output .= $option;
				 $output .= '<div></div>';
				 $output .= '</option>';
				 $tt++;
			 } 
			 $output .= '</select></br></br>';
		break;
		case 'button':
			$output = '<a id="'.$value['id'].'">'.$value['name'].'</a>';
		break;
		case 'other_text':
			$val = $value['std'];
			$std = get_option($value['id']);
			if ( $std != "") { $val = $std; }
			$output .= '<textarea name="'. $value['id'] .'" id="'. $value['id'] .'">'.stripslashes($val).'</textarea><br/>';
		break;
		case 'textarea':
			echo $output;
			$output = '';
			if($postId==null){$std = get_option($value['id']);}else{$std = get_post_meta($postId, $value['id'], true);};
			if( $std != "") { $ta_value = stripslashes( $std );};
			wp_editor($value['std'], $value['id'], array('media_buttons'=>false));
			// $output .= '<textarea id="'.$value['id'].'" name="'.$value['id'].'">'.$std.'</textarea>';
		break;
		case "radio":
			$output .='<div class="radio-holder">';
			 $select_value = get_option( $value['id']);
			 foreach ($value['options'] as $key => $option) { 
				 $checked = '';
				   if($select_value != '') {
						if ( $select_value == $key) { $checked = ' checked'; } 
				   } else {
					if ($value['std'] == $key) { $checked = ' checked'; }
				   }
				$output .='<label><input class="of-input of-radio" type="radio" name="'. $value['id'] .'" value="'. $key .'" '. $checked .' />' . $option .'</label>';
			}
			$output .='</div>';
		break;
		case "checkbox": 
		   $std = $value['std'];  
		   $saved_std = get_option($value['id']);
		   $checked = '';
			if(!empty($saved_std)) {
				if($saved_std == 'true') {
				$checked = 'checked="checked"';
				}
				else{
				   $checked = '';
				}
			}
			elseif( $std == 'true') {
			   $checked = 'checked="checked"';
			}
			else {
				$checked = '';
			}
			$output .= '<input type="checkbox" class="checkbox form_check" name="'.  $value['id'] .'" id="'. $value['id'] .'" value="true" '. $checked .' />'.$value['name'].'<br/>';

		break;
		case "upload":
			echo $output;
			$std="";
			$class = "";
			$output = ''; 
			if(isset($value['class'])){$cl1 = ' '.$value['class'];}
			if($postId==null){$std = get_option('sense_'.$value['id']);}else{$std = get_post_meta($postId, $value['id'], true);};
			siteoptions_uploader_function($value['id'],$value['name'],$std, $class);
		break;
		case "color":
			$val = $value['std'];
			$stored  = get_option( 'sense_'.$value['id'] );
			if ( $stored != "") { $val = $stored; }
			$output .= '<div class="color">';
			$output .= '<input class="form_color" name="'. $value['id'] .'" id="'. $value['id'] .'" type="text" value="'. $val .'" />';
			$output .= '<div style="background: '.$val.';" id="' . $value['id'] . '_picker" class="colorSelector"></div>';
			$output .= '</div>';
		break;   
		case "info":
			$default = $value['std'];
			$output .= $default;
		break;
		case "custom_type":
			echo $output;
			$output = '';
			$func = $value['function'];
			// echo ($func);
			$func();
		break;
		case "heading":

			if($counter >= 2){
			   $output .= '</div></div></div>'."\n";
			}
			$jquery_click_hook = ereg_replace("[^A-Za-z0-9]", "", strtolower($value['name']) );
			$jquery_click_hook = "option-" . $jquery_click_hook;
			$menu .= '<li class="'.$jquery_click_hook.'" ><a title="'.  $value['name'] .'" href="#'.  $jquery_click_hook  .'">'.  $value['name'] .'</a></li>';
			$output .= '<div class="container">'."\n";
			$output .= '<div class="group" id="'. $jquery_click_hook  .'"><div class="sub-heading clearfix"><h4 class="sub-heading-title">'.$value['name'].'</h4></div><div class="main-holder clearfix">'."\n";
			
		break;                                  
		}
		if(isset($value['container'])){
			$output .= '</div>';
		} 
		echo $output;

	}
	$output = '';
		echo $output;	

    return array($menu, $output);
}


function show_pages(){
		$about = get_option('sense_show_about');
		$portfolio = get_option('sense_show_portfolio');
		$services = get_option('sense_show_services');
		$blog = get_option('sense_show_blog');
		$contacts = get_option('sense_show_contacts');
		$checked_h = '';
		$checked_a = '';
		$checked_p = '';
		$checked_s = '';
		$checked_c = '';
		if(!empty($blog)) {if($blog == 'true') {$checked_h = 'checked="checked"';}else{$checked_h = '';}}
		if(!empty($about)) {if($about == 'true') {$checked_a = 'checked="checked"';}else{$checked_a = '';}}
		if(!empty($portfolio)) {if($portfolio == 'true') {$checked_p = 'checked="checked"';}else{$checked_p = '';}}
		if(!empty($services)) {if($services == 'true') {$checked_s = 'checked="checked"';}else{$checked_s = '';}}
		if(!empty($contacts)) {if($contacts == 'true') {$checked_c = 'checked="checked"';}else{$checked_c = '';}}
?>
<?php /*?><input type="checkbox" class="checkbox form_check" id="show_home_flag" <?php echo $checked_h ?>/>Show Home<br/>
<input type="hidden" id="show_home"  name="show_home" value="<?php echo $home ?>"/><?php */?>
<input type="checkbox" value="true" class="checkbox form_check" name="show_about_flag" id="show_about_flag" <?php echo $checked_a ?>/>Show About<br/>
<input type="hidden" id="show_about"  name="show_about" value="<?php echo $about ?>"/>
<input type="checkbox" value="true" class="checkbox form_check" name="show_portfolio_flag" id="show_portfolio_flag" <?php echo $checked_p ?>/>Show Portfolio<br/>
<input type="hidden" id="show_portfolio"  name="show_portfolio" value="<?php echo $portfolio ?>"/>
<input type="checkbox" value="true" class="checkbox form_check" name="show_services_flag" id="show_services_flag" <?php echo $checked_s ?>/>Show Services<br/>
<input type="hidden" id="show_services"  name="show_services" value="<?php echo $services ?>"/>
<input type="checkbox" value="true" class="checkbox form_check" name="show_blog_flag" id="show_blog_flag" <?php echo $checked_c ?>/>Show Blog<br/>
<input type="hidden" id="show_blog"  name="show_blog" value="<?php echo $blog ?>"/>
<input type="checkbox" value="true" class="checkbox form_check" name="show_contacts_flag" id="show_contacts_flag" <?php echo $checked_c ?>/>Show Contacts<br/>
<input type="hidden" id="show_contacts"  name="show_contacts" value="<?php echo $contacts ?>"/>
<?php
}

function print_team(){
	?>
	<h5 class="title">Team Block</h5>
	<div id="teams">
	<?php
	$teams = get_option('sense_teams');

	if(isset($teams)&&($teams!='')){
		?>
		<select id="show_teams">
			<?php 
			foreach ($teams as $value) {
				$id = preg_replace('|[^a-z0-9]*|i', '', $value['name']);
				?>
					<option value="<?php echo 'select'.$id ?>" ><?php echo $value['name'] ?></option>
				<?php
			}
			?>			
		</select>
		<?php

		foreach ($teams as $value) {
			$id = preg_replace('|[^a-z0-9]*|i', '', $value['name']);
			?>
			<div id="<?php echo 'select'.$id ?>" class="team_item" style="display: none">
				<h4>Name</h4>
				<input type="text" class="team_name" name="team_name" value="<?php echo $value['name'] ?>" />
				<h4>Position</h4>
				<input type="text" class="team_position" name="team_position" value="<?php echo $value['position'] ?>" />
				<h4>Description</h4>
				<textarea class="team_text" name="team_text"><?php echo $value['text'] ?></textarea>
				<h4>Link</h4>
				<input type="text" class="team_link" name="team_link" value="<?php echo $value['link'] ?>" />
				<h4>Image</h4>
				<?php
				echo siteoptions_uploader_function($id, $id, $value['img'], 'team_img');
				?>
				<a href="#" class="delete_team button remove-field">Delete Item</a>
			</div>
		<?php
		}
	}
	?>
	</div>
	<a href="#" id="add_new_team" class="button add-field">Add New Worker</a></br></br>
	<?php
}

function admin_print_services(){
	?>
	<h5 class="title">Services Block</h5>
	<div id="services">
	<?php
	$services = get_option('sense_services');
	if(isset($services)&&($services!='')){
		?>
		<select id="show_services1">
			<?php 
			foreach ($services as $value) {
				$id = preg_replace('|[^a-z0-9]*|i', '', $value['title']);
				?>
					<option value="<?php echo 'select'.$id ?>" ><?php echo $value['title'] ?></option>
				<?php
			}
			?>			
		</select>
		<?php

		foreach ($services as $value) {
			$id = preg_replace('|[^a-z0-9]*|i', '', $value['title']);
			?>
			<div id="<?php echo 'select'.$id ?>" class="services_item" style="display: none">
				<h4>Title</h4>
				<input type="text" class="services_title" name="services_title" value="<?php echo $value['title'] ?>" />
				<h4>Description</h4>
				<textarea class="services_text" name="services_text"><?php echo $value['text'] ?></textarea>
				<h4>Link</h4>
				<input type="text" class="services_link" name="services_link" value="<?php echo $value['link'] ?>" />
				<h4>Image</h4>
				<?php
				echo siteoptions_uploader_function($id, $id, $value['img'], 'services_img');
				?>
				<a href="#" class="delete_services button remove-field">Delete Item</a>
			</div>
		<?php
		}
	}
	?>
	</div>
	<a href="#" id="add_new_services" class="add-field">Add New Services</a></br></br>
	<?php
}



function siteoptions_uploader_function($id, $name, $std, $cl){
	$uploader = '';
    $upload = get_option($id);
	$val = $std;
	$img = '';
	$hidden_class = 'hide ';
	?>
		<div class="sense_upload_block">
	    	<input class="sense_upload_url" type="hidden" id="<?php echo $id; ?>" name="<?php echo $id; ?>" value="<?php echo $std; ?>" />
			<a id="upload_<?php echo $id; ?>_button" class="button sense_upload_image_button add-field">Upload Image</a>
			<?php if ( $std!='' ): ?>
				<?php $img = '<img alt="" src="'.$std.'" />';
					  $hidden_class = '';
				?>
			<?php endif; ?>
			<a id="delete_<?php echo $id; ?>_button" class="<?php echo $hidden_class; ?>button sense_delete_image_button remove-field">Delete Image</a>
			<div class="image_preview"><?php echo $img; ?></div>
		</div>
	<?php
}

add_action('wp_ajax_of_ajax_post_action', 'of_ajax_callback');

	function of_ajax_callback() {
	global $wpdb;
	global $post;
	$save_type = $_POST['type'];
	//Uploads
	if($save_type == 'image_reset'){
			$id = 'sense_'.$_POST['data']; // Acts as the name
			global $wpdb;
			$query = "DELETE FROM $wpdb->options WHERE option_name LIKE '$id'";
			$wpdb->query($query);
	}elseif($save_type == 'save_home'){
		$home_data = $_POST['data'];
		update_option('sense_home', stripslashes_deep($home_data));
	}elseif($save_type == 'save_services'){	
		$home_data = $_POST['data'];
		update_option('sense_services', $home_data);
	}elseif($save_type == 'save_teams'){	
		$home_data = $_POST['data'];
		update_option('sense_teams', $home_data);
	}elseif($save_type == 'save_contact_form'){
		$form_data = $_POST['data'];
		update_option('sense_contact_form', $form_data);
	}elseif($save_type == 'save_soc'){
		$form_data = $_POST['data'];
		update_option('sense_soc', $form_data);
	}elseif($save_type == 'save_contact_icon'){
		$form_data = $_POST['data'];
		update_option('contact_icon', $form_data);
	}elseif($save_type == 'import'){
		$data = $_POST['data'];
		if(isset($data)&&($data!='')){
		parse_str($data,$output);
			$test; $test1; $test2; $test3; $test4;
			$upload = $output['theme_url'];
			$home = json_decode(stripslashes_deep($output['sense_home']));
			foreach ($home as $value) {
				$test[] = (array)$value;
			}
			$output['home'] = $test;
			unset($output['sense_home']);

			$contact_icon = json_decode(stripslashes_deep($output['contact_icon']));
			foreach ($contact_icon as $value) {
				$value->icon = str_replace( $upload, UPLOAD_URL, $value->icon);
				$test2[] = (array)$value;
			}
			$output['contact_icon'] = $test2;
			
			$soc = json_decode(stripslashes_deep($output['sense_soc']));
			foreach ($soc as $value) {
				$value->icon = str_replace( $upload, UPLOAD_URL, $value->icon);
				$test1[] = (array)$value;
			}
			$output['soc'] = $test1;
			
			$form = json_decode(stripslashes_deep($output['sense_contact_form']));
			foreach ($form as $value) {
				$test2[] = (array)$value;
			}
			$output['contact_form'] = $test2;
			
			$teams = json_decode(stripslashes_deep($output['sense_teams']));
			foreach ($teams as $value) {
				$value->img = str_replace( $upload, UPLOAD_URL, $value->img);
				$test3[] = (array)$value;
			}
			$output['teams'] = $test3;
			
			$services = json_decode(stripslashes_deep($output['sense_services']));
			foreach ($services as $value) {
				$value->img = str_replace( $upload, UPLOAD_URL, $value->img);
				$test4[] = (array)$value;
			}
			$output['services'] = $test4;
			
			unset($output['sense_home']);
			unset($output['sense_soc']);
			unset($output['contact_icon']);
			unset($output['sense_soc_about']);
			unset($output['sense_teams']);
			unset($output['sense_contact_form']);
			unset($output['sense_contact_form']);
			unset($output['sense_services']);
			foreach ($output as $key => $value) {
				$value = str_replace($upload, UPLOAD_URL, $value);
				update_option('sense_'.$key, $value);
			}
			print_r($data);
			echo "Import Success";
		}else{
			echo "Import Error!";
		}
	}elseif ($save_type == 'options' OR $save_type == 'framework') {
		$data = $_POST['data'];
		parse_str($data,$output);
		foreach ($output as $key => $value) {
			update_option('sense_'.$key, trim(stripslashes_deep($value)));
		}
		
	}elseif($save_type=='send_email'){
		$owner_email = get_option('admin_email');
		$headers = 'From:' . $_POST['data']["header_email"];
		$subject = 'A message from your site visitor ' . $_POST['data']["name"];
		$messageBody = "";
		foreach (get_option('sense_contact_form') as $value) {
			$messageBody .= $value['label'].': ' . $_POST['data'][$value['name']] . "\n";
		}
		try{
			if(!mail($owner_email, $subject, $messageBody, $headers)){
				throw new Exception('mail failed');
			}else{
				echo 'mail sent';
			}
		}catch(Exception $e){
			echo $e->getMessage() ."\n";
		}
	}

  die();

}

function slide_shortcode( $atts, $content ) {
    extract(shortcode_atts(array(
        'author' => 'Marta Healy',
		'company' => 'Company',
		'date' => 'Date'
    ), $atts));
    return '
	<li>
	<div class="ext_box experience">
		<figure>
			<strong>'.$author.'</strong><br>'.$company.'
		</figure>
		<div>
			'.$date.'
		</div> 
    </div>'.$content.'</li>';
}

function slide_shortcode2( $atts, $content ) {
    extract(shortcode_atts(array(
        'author' => 'Marta Healy'
    ), $atts));
    return '
	<li>
		<strong>
			'.$author.'
		</strong><br>
		'.$content.'
	</li>';
}





function slide_services1( $atts, $content ) {
    extract(shortcode_atts(array(
        'label' => 'Title',
		'num' => 'Num'
    ), $atts));
    return '
	<div class="skill_box">
		<div class="skill_label">'.$label.'<span class="skill_num">'.$num.'</span></div>
		<div class="skill_level"><div class="skill_set" data-skill="'.$content.'"></div></div>
	</div>';
}

function slide_services2( $atts, $content ) {
    extract(shortcode_atts(array(
        'author' => 'Marta Healy'
    ), $atts));
    return '
	<li>
		<h3>
			'.$author.'
		</h3>
		'.$content.'
	</li>';
}

function slide_services3( $atts, $content ) {
    extract(shortcode_atts(array(
        'author' => 'Marta Healy'
    ), $atts));
    return '
	<li>
		<blockquote>
			'.$content.'
		</blockquote>
			<div class="author">
				'.$author.'
			</div>
	</li>';
}

add_shortcode( 'item', 'slide_shortcode' );
add_shortcode( 'item2', 'slide_shortcode2' );


add_shortcode( 'item_services1', 'slide_services1' );
add_shortcode( 'item_services2', 'slide_services2' );
add_shortcode( 'item_services3', 'slide_services3' );


function get_theme_pattern(){
return array(
	get_template_directory_uri()."/images/patterns/pattern1.png"=>"pattern1",
	get_template_directory_uri()."/images/patterns/pattern2.png"=>"pattern2",
	get_template_directory_uri()."/images/patterns/pattern3.png"=>"pattern3",
	get_template_directory_uri()."/images/patterns/pattern4.png"=>"pattern4",
	get_template_directory_uri()."/images/patterns/pattern5.png"=>"pattern5",
	get_template_directory_uri()."/images/patterns/pattern6.png"=>"pattern6",
	get_template_directory_uri()."/images/patterns/pattern7.png"=>"pattern7",
	get_template_directory_uri()."/images/patterns/pattern8.png"=>"pattern8"
	  
);
}

function get_theme_color(){
return array(
	"#16994a"=>"",
	"#e95d5d"=>"",
	"#008eb4"=>"",
	"#77479b"=>"",
	"#1352a2"=>"",
	"#45a38d"=>"",
	"#f16c47"=>"",
	"#999999"=>""
);
}
function get_fonts(){
return array(
	"Abel"=>"Abel",
	"Abril Fatface"=>"Abril Fatface",
	"Aclonica"=>"Aclonica",
	"Acme"=>"Acme",
	"Actor"=>"Actor",
	"Adamina"=>"Adamina",
	"Advent Pro"=>"Advent Pro",
	"Aguafina Script"=>"Aguafina Script",
	"Aladin"=>"Aladin",
	"Aldrich"=>"Aldrich",
	"Alex Brush"=>"Alex Brush",
	"Alfa Slab One"=>"Alfa Slab One",
	"Alice"=>"Alice",
	"Alike Angular"=>"Alike Angular",
	"Alike"=>"Alike",
	"Allan"=>"Allan",
	"Allerta Stencil"=>"Allerta Stencil",
	"Allerta"=>"Allerta",
	"Allura"=>"Allura",
	"Almendra SC"=>"Almendra SC",
	"Almendra"=>"Almendra",
	"Amaranth"=>"Amaranth",
	"Amatic SC"=>"Amatic SC",
	"Amethysta"=>"Amethysta",
	"Andada"=>"Andada",
	"Andika"=>"Andika",
	"Annie+Use+Your+Telescope"=>"Annie Use Your Telescope",
	"Anonymous Pro"=>"Anonymous Pro",
	"Antic Didone"=>"Antic Didone",
	"Antic Slab"=>"Antic Slab",
	"Antic"=>"Antic",
	"Anton"=>"Anton",
	"Arapey"=>"Arapey",
	"Arbutus"=>"Arbutus",
	"Architects Daughter"=>"Architects Daughter",
	"Arimo"=>"Arimo",
	"Arizonia"=>"Arizonia",
	"Armata"=>"Armata",
	"Artifika"=>"Artifika",
	"Arvo"=>"Arvo",
	"Asap"=>"Asap",
	"Asset"=>"Asset",
	"Astloch"=>"Astloch",
	"Asul"=>"Asul",
	"Atomic Age"=>"Atomic Age",
	"Aubrey"=>"Aubrey",
	"Average"=>"Average",
	"Averia Gruesa Libre"=>"Averia Gruesa Libre",
	"Averia Libre"=>"Averia Libre",
	"Averia Sans Libre"=>"Averia Sans Libre",
	"Averia Serif Libre"=>"Averia Serif Libre", 
	"Bad Script"=>"Bad Script",
	"Balthazar"=>"Balthazar",
	"Bangers"=>"Bangers",
	"Basic"=>"Basic",
	"Baumans"=>"Baumans",
	"Belgrano"=>"Belgrano",
	"Bentham"=>"Bentham",
	"Berkshire Swash"=>"Berkshire Swash",
	"Bevan"=>"Bevan",
	"Bigshot One"=>"Bigshot One",
	"Bilbo Swash Caps"=>"Bilbo Swash Caps",
	"Bilbo"=>"Bilbo",
	"Bitter"=>"Bitter",
	"Black Ops One"=>"Black Ops One",
	"Bonbon"=>"Bonbon",
	"Boogaloo"=>"Boogaloo",
	"Bowlby One SC"=>"Bowlby One SC",
	"Bowlby One"=>"Bowlby One",
	"Brawler"=>"Brawler",
	"Bree Serif"=>"Bree Serif",
	"Bubblegum Sans"=>"Bubblegum Sans",
	"Buenard"=>"Buenard",
	"Butcherman"=>"Butcherman",
	"Butterfly Kids"=>"Butterfly Kids",
	"Cabin Condensed"=>"Cabin Condensed",
	"Cabin Sketch"=>"Cabin Sketch",
	"Cabin"=>"Cabin",
	"Caesar Dressing"=>"Caesar Dressing",
	"Cagliostro"=>"Cagliostro",
	"Calligraffitti"=>"Calligraffitti",
	"Cambo"=>"Cambo",
	"Candal"=>"Candal",
	"Cantarell"=>"Cantarell",
	"Cantata One"=>"Cantata One",
	"Cardo"=>"Cardo",
	"Carme"=>"Carme",
	"Carter One"=>"Carter One",
	"Caudex"=>"Caudex",
	"Cedarville Cursive"=>"Cedarville Cursive",
	"Ceviche One"=>"Ceviche One",
	"Changa One"=>"Changa One",
	"Chango"=>"Chango",
	"Chelsea Market"=>"Chelsea Market",
	"Cherry Cream Soda"=>"Cherry Cream Soda",
	"Chewy"=>"Chewy",
	"Chicle"=>"Chicle",
	"Chivo"=>"Chivo",
	"Coda"=>"Coda",
	"Codystar"=>"Codystar",
	"Comfortaa"=>"Comfortaa",
	"Coming Soon"=>"Coming Soon",
	"Concert One"=>"Concert One",
	"Condiment"=>"Condiment",
	"Contrail One"=>"Contrail One",
	"Convergence"=>"Convergence",
	"Cookie"=>"Cookie",
	"Copse"=>"Copse",
	"Corben"=>"Corben",
	"Cousine"=>"Cousine",
	"Coustard"=>"Coustard",
	"Covered By Your Grace"=>"Covered By Your Grace",
	"Crafty Girls"=>"Crafty Girls",
	"Creepster"=>"Creepster",
	"Crete Round"=>"Crete Round",
	"Crimson Text"=>"Crimson Text",
	"Crushed"=>"Crushed",
	"Cuprum"=>"Cuprum",
	"Cutive"=>"Cutive",
	"Damion"=>"Damion",
	"Dancing Script"=>"Dancing Script",
	"Dawning of a New Day"=>"Dawning of a New Day",
	"Days One"=>"Days One",
	"Delius Swash Caps"=>"Delius Swash Caps",
	"Delius Unicase"=>"Delius Unicase",
	"Delius"=>"Delius",
	"Devonshire"=>"Devonshire",
	"Didact Gothic"=>"Didact Gothic",
	"Diplomata SC"=>"Diplomata SC",
	"Diplomata"=>"Diplomata",
	"Doppio One"=>"Doppio One",
	"Dorsa"=>"Dorsa",
	"Dr Sugiyama"=>"Dr Sugiyama",
	"Droid Sans Mono"=>"Droid Sans Mono",
	"Droid Sans"=>"Droid Sans",
	"Droid Serif"=>"Droid Serif",
	"Duru Sans"=>"Duru Sans",
	"Dynalight"=>"Dynalight",
	"EB Garamond"=>"EB Garamond",
	"Eater"=>"Eater",
	"Economica"=>"Economica",
	"Electrolize"=>"Electrolize",
	"Emblema One"=>"Emblema One",
	"Emilys Candy"=>"Emilys Candy",
	"Engagement"=>"Engagement",
	"Enriqueta"=>"Enriqueta",
	"Erica One"=>"Erica One",
	"Esteban"=>"Esteban",
	"Euphoria Script"=>"Euphoria Script",
	"Ewert"=>"Ewert",
	"Exo"=>"Exo",
	"Expletus Sans"=>"Expletus Sans",
	"Fanwood Text"=>"Fanwood Text",
	"Fascinate Inline"=>"Fascinate Inline",
	"Fascinate"=>"Fascinate",
	"Federant"=>"Federant",
	"Federo"=>"Federo",
	"Felipa"=>"Felipa",
	"Fjord One"=>"Fjord One",
	"Flamenco"=>"Flamenco",
	"Flavors"=>"Flavors",
	"Fondamento"=>"Fondamento",
	"Fontdiner Swanky"=>"Fontdiner Swanky",
	"Forum"=>"Forum",
	"Francois One"=>"Francois One",
	"Fredoka One"=>"Fredoka One",
	"Fresca"=>"Fresca",
	"Frijole"=>"Frijole",
	"Fugaz One"=>"Fugaz One",
	"Galdeano"=>"Galdeano",
	"Gentium Basic"=>"Gentium Basic",
	"Gentium Book Basic"=>"Gentium Book Basic",
	"Geo"=>"Geo",
	"Geostar Fill"=>"Geostar Fill",
	"Geostar"=>"Geostar",
	"Germania One"=>"Germania One",
	"Give You Glory"=>"Give You Glory",
	"Glass Antiqua"=>"Glass Antiqua",
	"Glegoo"=>"Glegoo",
	"Gloria Hallelujah"=>"Gloria Hallelujah",
	"Goblin One"=>"Goblin One",
	"Gochi Hand"=>"Gochi Hand",
	"Gorditas"=>"Gorditas",
	"Goudy Bookletter 1911"=>"Goudy Bookletter 1911",
	"Graduate"=>"Graduate",
	"Gravitas One"=>"Gravitas One",
	"Gruppo"=>"Gruppo",
	"Gudea"=>"Gudea",
	"Habibi"=>"Habibi",
	"Hammersmith One"=>"Hammersmith One",
	"Handlee"=>"Handlee",
	"Happy Monkey"=>"Happy Monkey",
	"Henny Penny"=>"Henny Penny",
	"Herr Von Muellerhoff"=>"Herr Von Muellerhoff",
	"Holtwood One SC"=>"Holtwood One SC",
	"Homemade Apple"=>"Homemade Apple",
	"Homenaje"=>"Homenaje",
	"IM Fell DW Pica SC"=>"IM Fell DW Pica SC",
	"IM Fell DW Pica"=>"IM Fell DW Pica",
	"IM Fell Double Pica SC"=>"IM Fell Double Pica SC",
	"IM Fell Double Pica"=>"IM Fell Double Pica",
	"IM Fell English SC"=>"IM Fell English SC",
	"IM Fell English"=>"IM Fell English",
	"IM Fell French Canon SC"=>"IM Fell French Canon SC",
	"IM Fell French Canon"=>"IM Fell French Canon",
	"IM Fell Great Primer SC"=>"IM Fell Great Primer SC",
	"IM Fell Great Primer"=>"IM Fell Great Primer",
	"Iceberg"=>"Iceberg",
	"Iceland"=>"Iceland",
	"Imprima"=>"Imprima",
	"Inconsolata"=>"Inconsolata",
	"Inder"=>"Inder",
	"Indie Flower"=>"Indie Flower",
	"Inika"=>"Inika",
	"Irish Grover"=>"Irish Grover",
	"Irish Growler"=>"Irish Growler",
	"Istok Web"=>"Istok Web",
	"Italiana"=>"Italiana",
	"Italianno"=>"Italianno",
	"Jim Nightshade"=>"Jim Nightshade",
	"Jockey One"=>"Jockey One",
	"Jolly Lodger"=>"Jolly Lodger",
	"Josefin Sans"=>"Josefin Sans Regular 400",
	"Josefin Slab"=>"Josefin Slab Regular 400",
	"Judson"=>"Judson",
	"Julee"=>"Julee",
	"Junge"=>"Junge",
	"Jura"=>" Jura Regular",
	"Just Another Hand"=>"Just Another Hand",
	"Just Me Again Down Here"=>"Just Me Again Down Here",
	"Kameron"=>"Kameron",
	"Karla"=>"Karla",
	"Kaushan Script"=>"Kaushan Script",
	"Kelly Slab"=>"Kelly Slab",
	"Kenia"=>"Kenia",
	"Knewave"=>"Knewave",
	"Kotta One"=>"Kotta One",
	"Kranky"=>"Kranky",
	"Kreon"=>"Kreon",
	"Kristi"=>"Kristi",
	"Krona One"=>"Krona One",
	"La Belle Aurore"=>"La Belle Aurore",
	"Lancelot"=>"Lancelot",
	"League Script"=>"League Script",
	"Leckerli One"=>"Leckerli One",
	"Ledger"=>"Ledger",
	"Lekton"=>" Lekton",
	"Lemon"=>"Lemon",
	"Lilita One"=>"Lilita One",
	"Limelight"=>" Limelight",
	"Linden Hill"=>"Linden Hill",
	"Lobster Two"=>"Lobster Two",
	"Lobster"=>"Lobster",
	"Londrina Outline"=>"Londrina Outline",
	"Londrina Shadow"=>"Londrina Shadow",
	"Londrina Sketch"=>"Londrina Sketch",
	"Londrina Solid"=>"Londrina Solid",
	"Lora"=>"Lora",
	"Love Ya Like A Sister"=>"Love Ya Like A Sister",
	"Loved by the King"=>"Loved by the King",
	"Luckiest Guy"=>"Luckiest Guy",
	"Lusitana"=>"Lusitana",
	"Lustria"=>"Lustria",
	"Macondo Swash Caps"=>"Macondo Swash Caps",
	"Macondo"=>"Macondo",
	"Magra"=>"Magra",
	"Maiden Orange"=>"Maiden Orange",
	"Mako"=>"Mako",
	"Marck Script"=>"Marck Script",
	"Marko One"=>"Marko One",
	"Marmelad"=>"Marmelad",
	"Marvel"=>"Marvel",
	"Mate SC"=>"Mate SC",
	"Mate"=>"Mate",
	"Maven Pro"=>" Maven Pro",
	"Meddon"=>"Meddon",
	"MedievalSharp"=>"MedievalSharp",
	"Medula One"=>"Medula One",
	"Megrim"=>"Megrim",
	"Merienda One"=>"Merienda One",
	"Merriweather"=>"Merriweather",
	"Metamorphous"=>"Metamorphous",
	"Metrophobic"=>"Metrophobic",
	"Michroma"=>"Michroma",
	"Miltonian Tattoo"=>"Miltonian Tattoo",
	"Miltonian"=>"Miltonian",
	"Miniver"=>"Miniver",
	"Miss Fajardose"=>"Miss Fajardose",
	"Miss Saint Delafield"=>"Miss Saint Delafield",
	"Modern Antiqua"=>"Modern Antiqua",
	"Molengo"=>"Molengo",
	"Monofett"=>"Monofett",
	"Monoton"=>"Monoton",
	"Monsieur La Doulaise"=>"Monsieur La Doulaise",
	"Montaga"=>"Montaga",
	"Montez"=>"Montez",
	"Montserrat"=>"Montserrat",
	"Mountains of Christmas"=>"Mountains of Christmas",
	"Mr Bedford"=>"Mr Bedford",
	"Mr Dafoe"=>"Mr Dafoe",
	"Mr De Haviland"=>"Mr De Haviland",
	"Mrs Saint Delafield"=>"Mrs Saint Delafield",
	"Mrs Sheppards"=>"Mrs Sheppards",
	"Muli"=>"Muli Regular",
	"Mystery Quest"=>"Mystery Quest",
	"Neucha"=>"Neucha",
	"Neuton"=>"Neuton",
	"News Cycle"=>"News Cycle",
	"Niconne"=>"Niconne",
	"Nixie One"=>"Nixie One",
	"Nobile"=>"Nobile",
	"Nokora"=>"Nokora",
	"Norican"=>"Norican",
	"Nosifer"=>"Nosifer",
	"Noticia Text"=>"Noticia Text",
	"Nova Cut"=>"Nova Cut",
	"Nova Flat"=>"Nova Flat",
	"Nova Mono"=>"Nova Mono",
	"Nova Oval"=>"Nova Oval",
	"Nova Round"=>"Nova Round",
	"Nova Script"=>"Nova Script",
	"Nova Slim"=>"Nova Slim",
	"Nova Square"=>"Nova Square",
	"Numans"=>"Numans",
	"Nunito"=>" Nunito Regular",
	"OFL Sorts Mill Goudy TT"=>"OFL Sorts Mill Goudy TT",
	"Old Standard TT"=>"Old Standard TT",
	"Oldenburg"=>"Oldenburg",
	"Open Sans Condensed"=>"Open Sans Condensed",
	"Orbitron"=>"Orbitron Regular (400)",
	"Original Surfer"=>"Original Surfer",
	"Oswald"=>"Oswald",
	"Over the Rainbow"=>"Over the Rainbow",
	"Overlock SC"=>"Overlock SC",
	"Overlock"=>"Overlock",
	"Ovo"=>"Ovo",
	"PT Mono"=>"PT Mono",
	"PT Sans Caption"=>"PT Sans Caption",
	"PT Sans Narrow"=>"PT Sans Narrow",
	"PT Sans"=>"PT Sans",
	"PT Serif Caption"=>"PT Serif Caption",
	"PT Serif"=>"PT Serif",
	"Pacifico"=>"Pacifico",
	"Parisienne"=>"Parisienne",
	"Passero One"=>"Passero One",
	"Passion One"=>"Passion One",
	"Patrick Hand"=>"Patrick Hand",
	"Patua One"=>"Patua One",
	"Paytone One"=>"Paytone One",
	"Permanent Marker"=>"Permanent Marker",
	"Petrona"=>"Petrona",
	"Philosopher"=>"Philosopher",
	"Piedra"=>"Piedra",
	"Pinyon Script"=>"Pinyon Script",
	"Plaster"=>"Plaster",
	"Play"=>"Play",
	"Playball"=>"Playball",
	"Playfair Display"=>" Playfair Display",
	"Podkova"=>" Podkova",
	"Poiret One"=>"Poiret One",
	"Poller One"=>"Poller One",
	"Poly"=>"Poly",
	"Pompiere"=>"Pompiere",
	"Pontano Sans"=>"Pontano Sans",
	"Port Lligat Sans"=>"Port Lligat Sans",
	"Port Lligat Slab"=>"Port Lligat Slab",
	"Prata"=>"Prata",
	"Princess Sofia"=>"Princess Sofia",
	"Prociono"=>"Prociono",
	"Prosto One"=>"Prosto One",
	"Puritan"=>"Puritan",
	"Quantico"=>"Quantico",
	"Quattrocento Sans"=>"Quattrocento Sans",
	"Quattrocento"=>"Quattrocento",
	"Questrial"=>"Questrial",
	"Quicksand"=>"Quicksand",
	"Qwigley"=>"Qwigley",
	"Radley"=>"Radley",
	"Rammetto One"=>"Rammetto One",
	"Rancho"=>"Rancho",
	"Rationale"=>"Rationale",
	"Redressed"=>"Redressed",
	"Reenie Beanie"=>"Reenie Beanie",
	"Revalia"=>"Revalia",
	"Ribeye Marrow"=>"Ribeye Marrow",
	"Ribeye"=>"Ribeye",
	"Righteous"=>"Righteous",
	"Rochester"=>"Rochester",
	"Rock Salt"=>"Rock Salt",
	"Rokkitt"=>"Rokkitt",
	"Ropa Sans"=>"Ropa Sans",
	"Rosario"=>"Rosario",
	"Rouge Script"=>"Rouge Script",
	"Ruda"=>"Ruda",
	"Ruge Boogie"=>"Ruge Boogie",
	"Ruluko"=>"Ruluko",
	"Ruslan Display"=>"Ruslan Display",
	"Ruthie"=>"Ruthie",
	"Sail"=>"Sail",
	"Salsa"=>"Salsa",
	"Sancreek"=>"Sancreek",
	"Sansita One"=>"Sansita One",
	"Sarina"=>"Sarina",
	"Satisfy"=>"Satisfy",
	"Schoolbell"=>"Schoolbell",
	"Seaweed Script"=>"Seaweed Script",
	"Sevillana"=>"Sevillana",
	"Shadows Into Light Two"=>"Shadows Into Light Two",
	"Shadows Into Light"=>"Shadows Into Light",
	"Shanti"=>"Shanti",
	"Share"=>"Share",
	"Shojumaru"=>"Shojumaru",
	"Short Stack"=>"Short Stack",
	"Sigmar One"=>"Sigmar One",
	"Signika Negative"=>"Signika Negative",
	"Signika"=>"Signika",
	"Simonetta"=>"Simonetta",
	"Sirin Stencil"=>"Sirin Stencil",
	"Six Caps"=>"Six Caps",
	"Slackey"=>"Slackey",
	"Smokum"=>"Smokum",
	"Smythe"=>"Smythe",
	"Snippet"=>"Snippet",
	"Sofia"=>"Sofia",
	"Sonsie One"=>"Sonsie One",
	"Sorts Mill Goudy"=>"Sorts Mill Goudy",
	"Special Elite"=>"Special Elite",
	"Spicy Rice"=>"Spicy Rice",
	"Spinnaker"=>"Spinnaker",
	"Spirax"=>"Spirax",
	"Squada One"=>"Squada One",
	"Stardos Stencil"=>"Stardos Stencil",
	"Stint Ultra Condensed"=>"Stint Ultra Condensed",
	"Stint Ultra Expanded"=>"Stint Ultra Expanded",
	"Stoke"=>"Stoke",
	"Sue Ellen Francisco"=>"Sue Ellen Francisco",
	"Sunshiney"=>"Sunshiney",
	"Supermercado One"=>"Supermercado One",
	"Swanky and Moo Moo"=>"Swanky and Moo Moo",
	"Syncopate"=>"Syncopate",
	"Tangerine"=>"Tangerine",
	"Telex"=>"Telex",
	"Tenor Sans"=>" Tenor Sans",
	"Terminal Dosis Light"=>"Terminal Dosis Light",
	"Terminal Dosis"=>"Terminal Dosis Regular",
	"The Girl Next Door"=>"The Girl Next Door",
	"Tinos"=>"Tinos",
	"Titan One"=>"Titan One",
	"Trade Winds"=>"Trade Winds",
	"Trochut"=>"Trochut",
	"Trykker"=>"Trykker",
	"Tulpen One"=>"Tulpen One",
	"Ubuntu Condensed"=>"Ubuntu Condensed",
	"Ubuntu Mono"=>"Ubuntu Mono",
	"Ubuntu"=>"Ubuntu",
	"Ultra"=>"Ultra",
	"Uncial Antiqua"=>"Uncial Antiqua",
	"UnifrakturMaguntia"=>"UnifrakturMaguntia",
	"Unkempt"=>"Unkempt",
	"Unlock"=>"Unlock",
	"Unna"=>"Unna",
	"VT323"=>"VT323",
	"Varela Round"=>"Varela Round",
	"Varela"=>"Varela",
	"Vast Shadow"=>"Vast Shadow",
	"Vibur"=>"Vibur",
	"Vidaloka"=>"Vidaloka",
	"Viga"=>"Viga",
	"Voces"=>"Voces",
	"Volkhov"=>"Volkhov",
	"Vollkorn"=>"Vollkorn",
	"Voltaire"=>"Voltaire",
	"Waiting for the Sunrise"=>"Waiting for the Sunrise",
	"Wallpoet"=>"Wallpoet",
	"Walter Turncoat"=>"Walter Turncoat",
	"Wellfleet"=>"Wellfleet",
	"Wire One"=>"Wire One",
	"Yanone Kaffeesatz"=>"Yanone Kaffeesatz",
	"Yellowtail"=>"Yellowtail",
	"Yeseva One"=>"Yeseva One",
	"Yesteryear"=>"Yesteryear",
	"Zeyada"=>"Zeyada",
);
}?>