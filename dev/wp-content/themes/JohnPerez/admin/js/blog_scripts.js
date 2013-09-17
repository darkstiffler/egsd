jQuery(document).ready(function() {
//tinyMCE.activeEditor.getContent();


  jQuery('#meta_blogvideoservice').hide();
  jQuery('#meta_workvideoservice').hide();
  
if (jQuery("#meta_workposttype option[value='video']").attr('selected')) {
      jQuery('#meta_workvideoservice').show();
}


if (jQuery("#meta_blogposttype option[value='video']").attr('selected')) {
      jQuery('#xxxx_image_box').hide();
      jQuery('#meta_blogvideoservice').show();
}



jQuery('#meta_blogposttype').change(function() {
    var selectVal = jQuery('#meta_blogposttype :selected').val();

    
    if (selectVal=='video') {
      jQuery('#xxxx_image_box').hide('slow', function() {});
      jQuery('#meta_blogvideoservice').show('slow', function() {});
    }

    if (selectVal=='image') {
      jQuery('#meta_blogvideoservice').hide('slow', function() {});
      jQuery('#xxxx_image_box').show('slow', function() {});
    }    
    
});




jQuery('#meta_workposttype').change(function() {
    var selectVal = jQuery('#meta_workposttype :selected').val();

    
    if (selectVal=='video') {
      jQuery('#meta_workvideoservice').show('slow', function() {});
    }

    if (selectVal=='image') {
      jQuery('#meta_workvideoservice').hide('slow', function() {});
    }    
    
});







  var formfield = null;
  jQuery('#upload_image_button').click(function() {
    jQuery('html').addClass('image');
    formfield = jQuery('#url_image').attr('name');
    tb_show('', 'media-upload.php?type=image&TB_iframe=true');
    return false;
  });
  
  jQuery('#delete_image_button').click(function() {
    jQuery("img#uploaded-pic").attr('src','');
    jQuery("input#url_image").val('');
  });
  

window.original_send_to_editor = window.send_to_editor;
window.send_to_editor = function(html){
var fileurl;
if (formfield != null) {
  fileurl = jQuery(html).filter('a').attr('href');
  jQuery('#url_image').val(fileurl);
  tb_remove();
  jQuery('html').removeClass('image');
  formfield = null;
} else {
  window.original_send_to_editor(html);
}
};

});


















/*jQuery(document).ready(function() {

  jQuery('#meta_blogvideoservice').hide();
  jQuery('#meta_workvideoservice').hide();
  
if (jQuery("#meta_workposttype option[value='video']").attr('selected')) {
      jQuery('#meta_workvideoservice').show();
}


if (jQuery("#meta_blogposttype option[value='video']").attr('selected')) {
      jQuery('#xxxx_image_box').hide();
      jQuery('#meta_blogvideoservice').show();
}



jQuery('#meta_blogposttype').change(function() {
    var selectVal = jQuery('#meta_blogposttype :selected').val();

    
    if (selectVal=='video') {
      jQuery('#xxxx_image_box').hide('slow', function() {});
      jQuery('#meta_blogvideoservice').show('slow', function() {});
    }

    if (selectVal=='image') {
      jQuery('#meta_blogvideoservice').hide('slow', function() {});
      jQuery('#xxxx_image_box').show('slow', function() {});
    }    
    
});




jQuery('#meta_workposttype').change(function() {
    var selectVal = jQuery('#meta_workposttype :selected').val();

    
    if (selectVal=='video') {
      jQuery('#meta_workvideoservice').show('slow', function() {});
    }

    if (selectVal=='image') {
      jQuery('#meta_workvideoservice').hide('slow', function() {});
    }    
    
});







  var formfield = null;
  jQuery('#upload_image_button').click(function() {
    jQuery('html').addClass('image');
    formfield = jQuery('#url_image').attr('name');
    tb_show('', 'media-upload.php?type=image&TB_iframe=true');
    return false;
  });
  
  jQuery('#delete_image_button').click(function() {
    jQuery("img#uploaded-pic").attr('src','');
    jQuery("input#url_image").val('');
  });
  

window.original_send_to_editor = window.send_to_editor;
window.send_to_editor = function(html){
var fileurl;
if (formfield != null) {
  fileurl = jQuery(html).filter('a').attr('href');
  jQuery('#url_image').val(fileurl);
  tb_remove();
  jQuery('html').removeClass('image');
  formfield = null;
} else {
  window.original_send_to_editor(html);
}
};

});*/