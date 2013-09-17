<!DOCTYPE HTML>
<html <?php language_attributes(); $page_type = ''?>><head>
	
	<meta charset="<?php bloginfo('charset'); ?>" />
	<title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>
	<meta name="description" content="<?php bloginfo('description'); ?>" />
    
  <?php /*?><link href="<?php echo get_template_directory_uri(); ?>/jackbox/css/jackbox.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo get_template_directory_uri(); ?>/jackbox/css/jackbox_hovers.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style.css" />
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
<?php $class = null; ?>
 <?php home_css(); ?>
<body <?php body_class($class); ?> onload="initialize()" >
