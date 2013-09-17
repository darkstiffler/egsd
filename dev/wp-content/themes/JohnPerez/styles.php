<?php function home_css(){
  $color = get_option('sense_select_color');  if(isset($color)&&($color!='')){$colorRGBtmp = HexToRGB($color);}else{$colorRGBtmp = array('r' => 255, 'g' => 255,'b' => 255);  }
  
  $colorRGB = 'rgba('.$colorRGBtmp['r'].', '.$colorRGBtmp['g'].', '.$colorRGBtmp['b'].', 0.9)';
  $colorRGBborder = 'rgba('.$colorRGBtmp['r'].', '.$colorRGBtmp['g'].', '.$colorRGBtmp['b'].', 0.15)';
  
  
  
  
  
    
  ?>
  <style type="text/css">
    #home{      background: url(<?php echo get_option('sense_home_bgr'); ?>) 50% 0 repeat-y fixed;    }
    #portfolio{      background: url(<?php echo get_option('sense_portfolio_bgr'); ?>) 50% 0 repeat-y fixed;    }    #about{      background: url(<?php echo get_option('sense_about_bgr'); ?>) 50% 0 repeat-y fixed;    }
    #services{      background: url(<?php echo get_option('sense_services_bgr'); ?>) 50% 0 repeat-y fixed;    }
    #contact{      background: url(<?php echo get_option('sense_contacts_bgr'); ?>) 50% 0 repeat-y fixed;    }  <?php $home = get_option('sense_home'); ?>
  <?php $i = 0;   if(isset($home)&&($home!='')){    foreach ($home as $value) { $i++; ?>
      #home_txt #home<?php echo $i; ?>{        font-family: <?php echo $value['font-family'] ?>;        font-size: <?php echo (strval((int)($value['font-size'])*1.5).'px') ?>;        margin-left: <?php echo (strval((int)($value['margin-left'])*1.5-30).'px') ?>;        margin-top: <?php echo (strval((int)($value['margin-top'])*1.5+150).'px') ?>;      }
  <?php } ?>  @media only screen and (min-width: 768px) and (max-width: 995px) {  <?php $i = 0; foreach ($home as $value) { $i++; ?>  #home_txt #home<?php echo $i; ?>{        font-family: <?php echo $value['font-family'] ?>;        font-size: <?php echo $value['font-size'] ?>;        margin-left: <?php echo $value['margin-left'] ?>;        margin-top: <?php echo $value['margin-top'] ?>;    }  <?php }; ?>  }
@media only screen and (min-width: 480px) and (max-width: 767px) {    <?php $i = 0; foreach ($home as $value) { $i++; ?>  #home_txt #home<?php echo $i; ?>{        font-family: <?php echo $value['font-family'] ?>;        font-size: <?php echo (strval((int)($value['font-size'])*0.7).'px') ?>;        margin-left: <?php echo (strval((int)($value['margin-left'])*0.7).'px') ?>;        margin-top: <?php echo (strval((int)($value['margin-top'])*0.7).'px') ?>;    }  <?php }; ?>}
@media only screen and (max-width: 479px) {    <?php $i = 0; foreach ($home as $value) { $i++; ?>  #home_txt #home<?php echo $i; ?>{        font-family: <?php echo $value['font-family'] ?>;        font-size: <?php echo (strval((int)($value['font-size'])*0.5).'px') ?>;        margin-left: <?php echo (strval((int)($value['margin-left'])*0.5).'px') ?>;        margin-top: <?php echo (strval((int)($value['margin-top'])*0.5+100).'px') ?>;    }  <?php };   } ?>}  
<?php  
  if(get_option('sense_select_color')!='')
  {
    ?>  #nav li a:hover, #nav li.current a, .quote-1, .name1, .name1 a, .name1_no-link, .name1_no-link a, .txt-name, .button-1:hover, .button-2:hover, .button-3:hover,           .button-4:hover, #home_txt div.accent_color, #contact-form .empty, #contact-form .error, .flex-direction-nav li a.next:hover, .flex-direction-nav li a.prev:hover, #contact-form .success, #all_portfolio_btn:hover, #reply-title>a, .logged-in-as a:hover{    color: <?php echo get_option('sense_select_color'); ?>;  }  .box-about2, .box-start, .box-tweeter{    background: <?php echo $colorRGB; ?>;  }  .quote-2:before, .quote-2:after{    background: <?php echo $colorRGBborder; ?>;  }
  .block_arrow{    border-color: transparent transparent transparent <?php echo $colorRGB; ?>;  }
  .block-img, .flexslider{    border-color: <?php echo $colorRGBborder; ?>;  }
  .box-img .box-cont{    background: <?php echo get_option('sense_select_color'); ?>;    }
  #qLpercentage{    color: <?php echo get_option('sense_select_color'); ?>!important;  }
  #qLbar{    background-color: <?php echo get_option('sense_select_color'); ?>!important;  }<?php 
  } ?>
  .hide_text{ color: <?php echo get_option('sense_logo_color'); ?> !important;    font-family: <?php echo get_option('sense_logo_font_family'); ?>;    font-size: <?php echo get_option('sense_logo_size'); ?>px;    line-height: normal;  }
  h1 .hide_text span{ color: <?php echo get_option('sense_select_color'); ?> !important;    font-family: <?php echo get_option('sense_slogan_font_family'); ?>; font-size: <?php echo get_option('sense_slogan_size'); ?>px;line-height: normal;}
  
  #logo{ background: url(<?php 
  if(get_option('sense_settings_logo') == 'show_image')
  {
    echo get_option('sense_logo_image');
  }?>) top left no-repeat; width:485px; height:185px; display:block;}
  
  <?php if('theme' == get_option('sense_check_color')){
      $color = get_option('sense_theme_color');
    }else{
      $color = get_option('sense_select_color1');
    }
    if('theme_pattern' == get_option('sense_check_pattern')){
      $pattern = get_option('sense_theme_pattern');
    }else{
      $pattern = get_option('sense_pattern1');
    }
    
    
    if(isset($color)&&($color!=''))
    {
      $colorRGBtmp = HexToRGB($color);  
    }else
    {
      $color = "#16994a";  
      $colorRGBtmp = HexToRGB($color);
      $pattern = get_template_directory_uri().'/images/patterns/pattern1.png';
    } ?>
  
  
body{background-color: <?php echo $color ?>;background-image: url('<?php echo $pattern ?>');}



  
  
  </style>  <!--[if lt IE 9]>  <style>    .box-about2, .box-start, .box-tweeter{      background: <?php echo get_option('sense_select_color'); ?>;    }    .quote-2:before, .quote-2:after{      background: <?php echo get_option('sense_logo_color'); ?>;    }    .block_arrow{      border-color: transparent transparent transparent <?php echo get_option('sense_logo_color'); ?>;    }    .block-img, .flexslider{      border-color: <?php echo get_option('sense_logo_color'); ?>;    }    </style>  <![endif]--><?php }; ?>