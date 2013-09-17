<?php function admin_script(){ ?>
<script type="text/javascript">
    var upload_dir = '<?php echo UPLOAD_SUBDIR; ?>';
	var our_dir = '<?php echo get_template_directory_uri(); ?>';
    console.log(upload_dir);
    jQuery(document).ready(function() {
        var item;
        var saved_status = jQuery('#save_status');
// -------------Add functions -------------
        jQuery('#add_item').click(function(){
             var new_str = jQuery('<span class="drag">New String</span>');
            new_str.data('speed', 1);
            new_str.appendTo('#home_text');
            jQuery( ".drag" ).click(function(){
                var _this = jQuery(this);
                jQuery('#str_value').val(_this.html());
                jQuery('#font_size').val(_this.css('font-size').match(/\d+/));
                jQuery('#font_family').val(_this.css('font-family'));
                jQuery('#speed').val(_this.data('speed'));
                if(_this.hasClass('accent_color')){
                    jQuery('#accent_color').attr('checked', 'checked');
                }else{
                    jQuery('#accent_color').removeAttr('checked');
                }
                jQuery( ".drag" ).css('border-color', 'transparent');
                _this.css('border-color', '#000000');
                item = _this;
            });
            jQuery( ".drag" ).draggable({
                containment: "#home_text",
                scroll: false
            });        
            return false;
        });
		
        jQuery('#add_soc2').click(function(){
            var str = '';
            var name = jQuery('#soc_name2').val();
            if(name||(name!=='')){
                var _this = jQuery(this);
                str+='<div class="soc_item"><span class="soc_name">'+name+'</span>' +
                    '<div class="sense_upload_block">'+
                    '<input class="sense_upload_url" type="hidden" value="" />'+
                    '<a class="button sense_upload_image_button add-field">Upload Image</a> '+
                    '<a class="hiden button sense_delete_image_button remove-field">Delete Image</a>'+
                    '<div class="image_preview"></div>'+
                    '</div>'+
                    '<span class="delete_icon button remove-field">Delete title</span>'+
                    '</div>';
                item = jQuery(str);
                item.appendTo('#soc_items');
                var btn_upl = item.find('.sense_upload_block').find('.sense_upload_image_button');
                var btn_del = item.find('.sense_upload_block').find('.sense_delete_image_button');
                btn_upl.click(function() {
                    upload_block = jQuery(this).parent();
                    tb_show('Upload Image', 'media-upload.php?referer=siteoptions&amp;type=image&amp;TB_iframe=true&amp;post_id=0', false);
                    return false;
                });
                btn_del.click(function() {
                    var delete_block = jQuery(this).parent();
                    delete_block.find('.sense_upload_url').val('');
                    delete_block.find('.image_preview').html('');
                    jQuery(this).fadeOut();    
                    return false;
                });
                jQuery('.delete_icon').click(function(){
                    jQuery(this).parent().remove();
                });
            }else{
                alert('Please, enter the field name');
            }
            return false;
        });
		
		jQuery('#add_contact_icon').click(function(){
            var str = '';
            var name = jQuery('#contact_icon_name').val();
            if(name||(name!=='')){
                var _this = jQuery(this);
                str+='<div class="contact_icon_item"><span class="icon_name">'+name+'</span> link: '+
                    '<input class="soc_url" value=""/>'+
                    '<div class="sense_upload_block">'+
                    '<input class="sense_upload_url" type="hidden" value="" />'+
                    '<a class="button sense_upload_image_button add-field">Upload Image</a> '+
                    '<a class="hiden button sense_delete_image_button remove-field">Delete Image</a>'+
                    '<div class="image_preview"></div>'+
                    '</div>'+
                    '<span class="delete_icon button remove-field">Delete title</span>'+
                    '</div>';
                item = jQuery(str);
                item.appendTo('#contact_icon_items');
                var btn_upl = item.find('.sense_upload_block').find('.sense_upload_image_button');
                var btn_del = item.find('.sense_upload_block').find('.sense_delete_image_button');
                btn_upl.click(function() {
                    upload_block = jQuery(this).parent();
                    tb_show('Upload Image', 'media-upload.php?referer=siteoptions&amp;type=image&amp;TB_iframe=true&amp;post_id=0', false);
                    return false;
                });
                btn_del.click(function() {
                    var delete_block = jQuery(this).parent();
                    delete_block.find('.sense_upload_url').val('');
                    delete_block.find('.image_preview').html('');
                    jQuery(this).fadeOut();    
                    return false;
                });
                jQuery('.delete_icon').click(function(){
                    jQuery(this).parent().remove();
                });
            }else{
                alert('Please, enter the field name');
            }
            return false;
        });
		
		
        jQuery('#add_new_field').click(function(){
            var field_name = jQuery('#field_name').val();
            if(field_name===''){
                alert('Please, enter the field name');
                return false;
            };
            var field_label = jQuery('#field_label').val();
            var new_str = jQuery('<span class="contact_item"><input class="data" name="'
                +field_name+
                '" value="'+
                field_label+
                '"/><input type="checkbox" class="is_required"/> Required <a class="delete_item remove-field">delete</a>'+
                '<select class="check_type" name="check_type">'+
                    '<option value="text" selected="selected">Text</option>'+
                    '<option value="name">Name</option>'+
                    '<option value="email">Email</option>'+
                    '<option value="phone">Phone</option>'+
                    '<option value="message">Message</option>'+
                '</select>');
            new_str.appendTo('#new_contact_form');
            jQuery('.contact_item .delete_item').click(function(){
                jQuery(this).parent().remove();
            });
            jQuery('#new_contact_form').sortable();
            return false;
        });
    
// -------------Bind Clicks--------------
        jQuery('#edit_str #delete_item').click(function(){
            item.remove();
            jQuery('#home_text').find('.drag').eq(0).click();
        });
        jQuery('.font_size_edit .big').click(function(){
            var val = parseInt(jQuery('#font_size').val().match(/\d+/))+1;
            jQuery('#font_size').val(val);
            item.css('font-size', val+'px');
        });
        jQuery('.font_size_edit .litle').click(function(){
            var val = parseInt(jQuery('#font_size').val().match(/\d+/))-1;
            jQuery('#font_size').val(val);
            item.css('font-size', val+'px');
        });
        jQuery('.speed .big').click(function(){
            var val = (parseFloat(jQuery('#speed').val())+0.1).toFixed(1);
            jQuery('#speed').val(val);
            item.data('speed', val);
        });
        jQuery('.speed .litle').click(function(){
            var val = (parseFloat(jQuery('#speed').val())-0.1).toFixed(1);
            jQuery('#speed').val(val);
            item.data('speed', val);
        });
        jQuery('.contact_item .delete_item').click(function(){
            jQuery(this).parent().remove();
        });
        jQuery('#new_contact_form').sortable();
        jQuery('#str_value').keyup(function(e){
            item.html(jQuery('#str_value').val());
        });
        jQuery('#font_size').keyup(function(e){
            item.css('font-size', jQuery('#font_size').val()+'px');
        });
        jQuery('#font_family').change(function(){
            jQuery('head').append('<link href="http://fonts.googleapis.com/css?family='+jQuery('#font_family').val()+'" rel="stylesheet" />');
            item.css('font-family', jQuery('#font_family option:selected').text());
        });
        jQuery('#speed').keyup(function(e){
            item.data('speed', jQuery('#speed').val());
        });
        jQuery('.delete_icon').click(function(){
            jQuery(this).parent().remove();
        });
        var r = new RegExp("\x27+","g");
        var r1 = new RegExp("\x22+","g");
        jQuery( ".drag" ).click(function(){
            var _this = jQuery(this);
            jQuery('#str_value').val(_this.html());
            jQuery('#font_size').val(_this.css('font-size').match(/\d+/));
            console.log(_this.css('font-family').replace(r, ""));
            jQuery('#font_family').val(_this.css('font-family').replace(r, "").replace(r1, ""));
            jQuery('#speed').val(_this.data('speed'));
            if(_this.hasClass('accent_color')){
                jQuery('#accent_color').attr('checked', 'checked');
            }else{
                jQuery('#accent_color').removeAttr('checked');
            }
            jQuery( ".drag" ).css('border-color', 'transparent');
            _this.css('border-color', '#000000');
            item = _this;
        });
        jQuery( ".drag" ).eq(0).click();
        jQuery( ".drag" ).draggable({
                containment: "#home_text",
                scroll: false
            });        

        jQuery('.delete_services').click(function(){
            var id = jQuery(this).parent().attr('id');
            jQuery('#show_services1 option[value="'+id+'"]').remove();
            jQuery(this).parent().remove();
            jQuery('.services_item').eq(0).fadeIn();            
            return false;
        });
        jQuery('.delete_team').click(function(){
            var id = jQuery(this).parent().attr('id');
            jQuery('#show_teams option[value="'+id+'"]').remove();
            jQuery(this).parent().remove();
            jQuery('.team_item').eq(0).fadeIn();
            return false;
        });
        
        jQuery('#accent_color').change(function(){
            if(jQuery(this).attr('checked')){
                item.addClass('accent_color');
            }else{
                item.removeClass('accent_color');
            }
        });
        jQuery('#show_home_flag').change(function(){
            if(jQuery(this).attr('checked')){
                jQuery('#show_home').val('true');
            }else{
                jQuery('#show_home').val('false');
            }
        });
        jQuery('#show_about_flag').change(function(){
            if(jQuery(this).attr('checked')){
                jQuery('#show_about').val('true');
            }else{
                jQuery('#show_about').val('false');
            }
        });
        jQuery('#show_portfolio_flag').change(function(){
            if(jQuery(this).attr('checked')){
                jQuery('#show_portfolio').val('true');
            }else{
                jQuery('#show_portfolio').val('false');
            }
        });
        jQuery('#show_services_flag').change(function(){
            if(jQuery(this).attr('checked')){
                jQuery('#show_services').val('true');
            }else{
                jQuery('#show_services').val('false');
            }
        });
		jQuery('#show_blog_flag').change(function(){
            if(jQuery(this).attr('checked')){
                jQuery('#show_blog').val('true');
            }else{
                jQuery('#show_blog').val('false');
            }
        });
        jQuery('#show_contacts_flag').change(function(){
            if(jQuery(this).attr('checked')){
                jQuery('#show_contacts').val('true');
            }else{
                jQuery('#show_contacts').val('false');
            }
        });
    // ------------Portfolio------------ 
        if(jQuery('#portfolio-content_type').val()==='image'){
            jQuery('.big_video').fadeOut();
        }else{
            jQuery('.big_image').fadeOut();
        }
        jQuery('#portfolio-content_type').change(function(){
            if(jQuery(this).val()==='image'){
                jQuery('.big_video').fadeOut();
                jQuery('.big_image').fadeIn();
            }else{
                jQuery('.big_video').fadeIn();
                jQuery('.big_image').fadeOut();
            }
        });
        function get_contact_form(){
            var items = [];
            var i = 0;
            jQuery('#new_contact_form .contact_item').each(function(){
                var _this = jQuery(this);
                var _this_input = _this.find('.data');
                var _this_check_type = _this.find('.check_type');
                var _name = _this_input.attr('name');
                var _this_required = _this.find('.is_required');
                var _this_type = _this.find('.type_textarea');
                var item_data = {'label': _this_input.val(), 
                                'name': _this_input.attr('name'), 
                    'check_type': _this_check_type.val(),
                    'is_checked': '',
                    'input_type': 'text'
                };
                (_this_required.prop("checked")===true)?(item_data.is_checked = 'checked'):(item_data.is_checked = '');
                (_this_type.prop("checked")===true)?(item_data.input_type = 'textarea'):(item_data.input_type = 'text');
                items.push(item_data);
                i++;
            });
            return items;
        }
        function save_contact_form(){
            var items = get_contact_form();
            var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';
            var data = {
                type: 'save_contact_form',
                action: 'of_ajax_post_action',
                data: items
            };
            jQuery.post(ajax_url, data, function() {
                var success = jQuery('#of-popup-save');
                var loading = jQuery('.ajax-loading-img');
                loading.fadeOut();  
                success.fadeIn();
                window.setTimeout(function(){
                    success.fadeOut(); 
                }, 2000);
            });
            return false;
        }

        function get_home(){
            var items = [];
            var i = 0;
            var r = new RegExp("\x27+","g");
            var r1 = new RegExp("\x22+","g");
            jQuery('#home_text .drag').each(function(){
                var _this = jQuery(this);
            var item_data = {'text': _this.html(), 
                'margin-top': _this.css('top'),
                'margin-left': _this.css('left'),
                'font-size': _this.css('font-size'),
                'font-family': _this.css('font-family').replace(r, "").replace(r1, ""),
                'speed': _this.data('speed'),
                'accent_color': ''
            };
                (_this.hasClass('accent_color'))?(item_data.accent_color = 'accent'):(item_data.accent_color = '');
                items.push(item_data);
                i++;
            });
            return items;
        }

        function save_home(){
            var items = get_home();
            var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';
            var data = {
                type: 'save_home',
                action: 'of_ajax_post_action',
                data: items
            };
            console.log(data);
            jQuery.post(ajax_url, data, function() {
                var success = jQuery('#of-popup-save');
                var loading = jQuery('.ajax-loading-img');
                loading.fadeOut();  
                success.fadeIn();
                window.setTimeout(function(){
                    success.fadeOut(); 
                }, 2000);
                
            });
            return false;
        };

        function get_soc(){
            var items = [];
            var i = 0;
            jQuery('#soc_items .soc_item').each(function(){
                var _this = jQuery(this);
                var item_data = {'name': _this.find('.soc_name').html(),
                'url': _this.find('.soc_url').val(), 
                'icon': _this.find('.sense_upload_block').find('.sense_upload_url').val()
                };
                items.push(item_data);
            });
            return items;
        }

        function save_soc(){
            
            var items = get_soc();
            var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';
            var data = {
                type: 'save_soc',
                action: 'of_ajax_post_action',
                data: items
            };
            jQuery.post(ajax_url, data, function() {
                var success = jQuery('#of-popup-save');
                var loading = jQuery('.ajax-loading-img');
                loading.fadeOut();  
                success.fadeIn();
                window.setTimeout(function(){
                    success.fadeOut(); 
                }, 2000);
            });
            return false;
        }
		function get_contact_icon(){
            var items = [];
            var i = 0;
            jQuery('#contact_icon_items .contact_icon_item').each(function(){
                var _this = jQuery(this);
                var item_data = {'name': _this.find('.icon_name').html(),
                'url': _this.find('.soc_url').val(), 
                'icon': _this.find('.sense_upload_block').find('.sense_upload_url').val()
                };
                items.push(item_data);
            });
            return items;
        }

        function save_contact_icon(){
            
            var items = get_contact_icon();
            var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';
            var data = {
                type: 'save_contact_icon',
                action: 'of_ajax_post_action',
                data: items
            };
            jQuery.post(ajax_url, data, function() {
                var success = jQuery('#of-popup-save');
                var loading = jQuery('.ajax-loading-img');
                loading.fadeOut();  
                success.fadeIn();
                window.setTimeout(function(){
                    success.fadeOut(); 
                }, 2000);
            });
            return false;
        }

        function get_services(){
            var items = [];
            jQuery('#services .services_item').each(function(){
                var _this = jQuery(this);
                var item_data = {'title': _this.find('.services_title').val(),
                'text': _this.find('.services_text').val(),
                'link': _this.find('.services_link').val(), 
                'img': _this.find('.sense_upload_block').find('.sense_upload_url').val()
                };
                items.push(item_data);
            });
            return items;
        }

        function save_services(){
            var items = get_services();
            var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';
            var data = {
                type: 'save_services',
                action: 'of_ajax_post_action',
                data: items
            };
            jQuery.post(ajax_url, data, function(){});
            return false;
        }

        function get_team(){
            var items = [];
            jQuery('#teams .team_item').each(function(){
                var _this = jQuery(this);
                var item_data = {'name': _this.find('.team_name').val(),
                'position': _this.find('.team_position').val(), 
                'text': _this.find('.team_text').val(),
                'link': _this.find('.team_link').val(),
                'img': _this.find('.sense_upload_block').find('.sense_upload_url').val()
                };
                items.push(item_data);
            });
            return items;
        }

        function save_teams(){
            var items = get_team();
            var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';
            var data = {
                type: 'save_teams',
                action: 'of_ajax_post_action',
                data: items
            };
            jQuery.post(ajax_url, data, function(){});
            return false;
        }

        jQuery('.team_item').eq(0).fadeIn();
        jQuery('#show_teams').change(function(){
            jQuery('.team_item').fadeOut();
            jQuery('#'+jQuery('#show_teams').val()).fadeIn();    
        });

        jQuery('.services_item').eq(0).fadeIn();
        jQuery('#show_services1').change(function(){
            jQuery('.services_item').fadeOut();
            jQuery('#'+jQuery('#show_services1').val()).fadeIn();    
        });


// -----------Import/Export-------------
        jQuery('#import_btn').click(function(){
            var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';            
            var data = {
                type: 'import',
                action: 'of_ajax_post_action',
                data: jQuery('#import').val()
            };
        
            jQuery.post(ajax_url, data, function() {
                window.location = window.location.href;
            });
            return false;
        });

        jQuery('#export_btn').click(function(){
            jQuery('#home_hiden').val(JSON.stringify(get_home()));
            jQuery('#soc_hiden').val(JSON.stringify(get_soc()));
            jQuery('#form_hiden').val(JSON.stringify(get_contact_form()));
            jQuery('#teams_hiden').val(JSON.stringify(get_team()));
            jQuery('#services_hiden').val(JSON.stringify(get_services()));
            jQuery('#theme_url_hiden').val('<?php echo UPLOAD_URL ?>');
            var data = jQuery('#ofform :not(#export, #import, #edit_str input, #edit_str select, #soc_items input, #soc_name, #option-contactForm input, #option-contactForm select)').serialize();
            jQuery('#export').val(data);
            return false;
        });


// --------------Color----------
        <?php get_option('sense_select_color')?$color=get_option('sense_select_color') : $color = 'ffffff'; ?>
        jQuery('#select_color_picker').ColorPicker({
            color: <?php echo '"'.$color.'"'; ?>,
            onShow: function (colpkr) {
                jQuery(colpkr).fadeIn(500);
                return false;
            },
            onHide: function (colpkr) {
                jQuery(colpkr).fadeOut(500);
                return false;
            },
            onChange: function (hsb, hex, rgb) {
                saved_status.fadeIn();    
                jQuery('#select_color_picker').css('background-color', '#' +hex);
                jQuery('#select_color').attr('value','#' +hex);
                
            }
        });

        <?php get_option('sense_logo_color')?$color=get_option('sense_logo_color') : $color = 'ffffff'; ?>
        jQuery('#logo_color_picker').ColorPicker({
            color: <?php echo '"'.$color.'"'; ?>,
            onShow: function (colpkr) {
                jQuery(colpkr).fadeIn(500);
                return false;
            },
            onHide: function (colpkr) {
                jQuery(colpkr).fadeOut(500);
                return false;
            },
            onChange: function (hsb, hex, rgb) {
                saved_status.fadeIn();    
                jQuery('#logo_color_picker').css('background-color', '#' +hex);
                jQuery('#logo_color').attr('value','#' +hex);
                
            }
        });
		
		<?php get_option('sense_select_color1')?$color=get_option('sense_select_color1') : $color = 'ffffff'; ?>
        jQuery('#select_color1_picker').ColorPicker({
            color: <?php echo '"'.$color.'"'; ?>,
            onShow: function (colpkr) {
                jQuery(colpkr).fadeIn(500);
                return false;
            },
            onHide: function (colpkr) {
                jQuery(colpkr).fadeOut(500);
                return false;
            },
            onChange: function (hsb, hex, rgb) {
                saved_status.fadeIn();    
                jQuery('#select_color1_picker').css('background-color', '#' +hex);
                jQuery('#select_color1').attr('value','#' +hex);
                
            }
        });
		


        jQuery('#ofform input, #ofform textarea, #ofform select').change(function(){
            saved_status.fadeIn();
        });
        jQuery('#ofform nav li').click(function(){
            jQuery('#ofform nav li').removeClass('current');
            jQuery(this).addClass('current');
            link = jQuery(this).find('a').attr('href');
            jQuery('#ofform .group').fadeOut();
            jQuery(link).fadeIn();
            return false;
        });

        var shorcode = '';
		var shorcode2 = '';
		
        jQuery( "#dialog-form1" ).dialog({
            autoOpen: false,
            height: 400,
            width: 500,
            // modal: true,
            buttons: {
                "Add shortcode": function() {
                    var team_name = jQuery( "#team_name" ).val(),
                        team_pos = jQuery( "#team_pos" ).val(),
                        team_text = jQuery( "#team_text" ).val(),
                        team_link = jQuery( "#team_link" ).val();
                        team_img = '<?php echo UPLOAD_URL ?>'+jQuery( "#team_img" ).val();
                    var str = '<div id="select'+team_name+'" class="team_item"><h4>Name</h4>'+
                    '<input type="text" class="team_name" name="team_name" value="'+team_name+'" />'+
                    '<h4>Position</h4>'+
                    '<input type="text" class="team_position" name="team_position" value="'+team_pos+'" />'+
                    '<h4>Description</h4>'+
                    '<textarea class="team_text" name="team_text">'+team_text+'</textarea>'+
                    '<h4>Link</h4>'+
                    '<input type="text" class="team_link" name="team_link" value="'+team_link+'" />'+
                    '<div class="sense_upload_block">'+
                    '<input class="sense_upload_url" type="hidden" value="" />'+
                    '<a class="button sense_upload_image_button add-field">Upload Image</a>'+
                    '<a class="hiden button sense_delete_image_button remove-field">Delete Image</a>'+
                    '<div class="image_preview"></div>'+
                    '</div></div>';
                    var item = jQuery(str);
                    jQuery('#teams .team_item').fadeOut();
                    item.appendTo(jQuery('#teams'));
                    var btn_upl = item.find('.sense_upload_block').find('.sense_upload_image_button');
                    var btn_del = item.find('.sense_upload_block').find('.sense_delete_image_button');
                    btn_upl.click(function() {
                        upload_block = jQuery(this).parent();
                        tb_show('Upload Image', 'media-upload.php?referer=siteoptions&amp;type=image&amp;TB_iframe=true&amp;post_id=0', false);
                        return false;
                    });
                    btn_del.click(function() {
                        var delete_block = jQuery(this).parent();
                        delete_block.find('.sense_upload_url').val('');
                        delete_block.find('.image_preview').html('');
                        jQuery(this).fadeOut();    
                        return false;
                    });
                    jQuery(this).dialog( "close" );
                    jQuery( "#team_name" ).val(''),
                    jQuery( "#team_pos" ).val(''),
                    jQuery( "#team_text" ).val(''),
                    jQuery( "#team_link" ).val('');
                    var sel = '<option value="select'+team_name+'">'+team_name+'</option>';
                    jQuery(sel).appendTo(jQuery('#show_teams'));
                    jQuery('#show_teams option:last').attr('selected', 'selected');
                },
                Cancel: function() {
                    jQuery(this).dialog( "close" );
                }
            },
        });


        jQuery( "#dialog-form2" ).dialog({
            autoOpen: false,
            height: 400,
            width: 500,
            // modal: true,
            buttons: {
                "Add shortcode": function() {
                    var services_title = jQuery( "#services_title" ).val(),
                        services_text = jQuery( "#services_text" ).val(),
                        services_link = jQuery( "#services_link" ).val();
                        services_img = '<?php echo UPLOAD_URL ?>'+jQuery( "#services_img" ).val();
                    var str = '<div id="select'+services_title+'" class="services_item"><h4>Title</h4>'+
                    '<input type="text" class="services_title" name="services_title" value="'+services_title+'" />'+
                    '<h4>Description</h4>'+
                    '<textarea class="services_text" name="services_text">'+services_text+'</textarea>'+
                    '<h4>Link</h4>'+
                    '<input type="text" class="services_link" name="services_link" value="'+services_link+'" />'+
                    '<div class="sense_upload_block">'+
                    '<input class="sense_upload_url" type="hidden" value="" />'+
                    '<a class="button sense_upload_image_button add-field">Upload Image</a>'+
                    '<a class="hiden button sense_delete_image_button remove-field">Delete Image</a>'+
                    '<div class="image_preview"></div>'+
                    '</div></div>';
                    var item = jQuery(str);
                    jQuery('#services .services_item').fadeOut();
                    item.appendTo(jQuery('#services'));
                    var btn_upl = item.find('.sense_upload_block').find('.sense_upload_image_button');
                    var btn_del = item.find('.sense_upload_block').find('.sense_delete_image_button');
                    btn_upl.click(function() {
                        upload_block = jQuery(this).parent();
                        tb_show('Upload Image', 'media-upload.php?referer=siteoptions&amp;type=image&amp;TB_iframe=true&amp;post_id=0', false);
                        return false;
                    });
                    btn_del.click(function() {
                        var delete_block = jQuery(this).parent();
                        delete_block.find('.sense_upload_url').val('');
                        delete_block.find('.image_preview').html('');
                        jQuery(this).fadeOut();    
                        return false;
                    });

                    jQuery(this).dialog( "close" );
                    jQuery( "#services_title" ).val(''),
                    jQuery( "#services_text" ).val(''),
                    jQuery( "#services_link" ).val('');
                    var sel = '<option value="select'+services_title+'">'+services_title+'</option>';
                    jQuery(sel).appendTo(jQuery('#show_services1'));
                    jQuery('#show_services1 option:last').attr('selected', 'selected');
                },
                Cancel: function() {
                    jQuery(this).dialog( "close" );
                }
            },
        });

        jQuery('#add_new_team').click(function(){
            jQuery( "#dialog-form1" ).dialog( "open" );    
            return false;
        });
        jQuery('#add_new_services').click(function(){
            jQuery( "#dialog-form2" ).dialog( "open" );    
            return false;
        });

        
		
		
    

		
		jQuery( "#dialog-form4" ).dialog({
            autoOpen: false,
            height: 400,
            width: 500,
            modal: true,
            buttons: {
                "Add shortcode": function() {
                    var item_author = jQuery( "#item_author2" ).val(),
						item_company = jQuery( "#item_company" ).val(),
                        item_date = jQuery( "#item_date" ).val(),
                        item_text = jQuery( "#item_text2" ).val();
                        shorcode = shortcode_ed.getContent()+'[item author="'+item_author+'" company= "'+item_company+'" date= "'+item_date+'"]'+item_text+'[/item]';
                    shortcode_ed.setContent(shorcode);
                    jQuery(this).dialog( "close" );
                },
                Cancel: function() {
                    jQuery(this).dialog( "close" );
                }
            },
        });
		
		jQuery( "#dialog-form5" ).dialog({
            autoOpen: false,
            height: 400,
            width: 500,
            modal: true,
            buttons: {
                "Add shortcode": function() {
                    var item_author = jQuery( "#item_author3" ).val(),
                        item_text = jQuery( "#item_text3" ).val();
                        shorcode = shortcode_ed.getContent()+'[item2 author="'+item_author+'"]'+item_text+'[/item2]';
                    shortcode_ed.setContent(shorcode);
                    jQuery(this).dialog( "close" );
                },
                Cancel: function() {
                    jQuery(this).dialog( "close" );
                }
            },
        });
		
		
		//services block1
		jQuery( "#dialog-form7" ).dialog({
            autoOpen: false,
            height: 400,
            width: 500,
            modal: true,
            buttons: {
                "Add shortcode": function() {
                    var item_label = jQuery( "#item_label" ).val(),
                        item_num = jQuery( "#item_num" ).val(),
                        item_set = jQuery( "#item_set" ).val();
                        shorcode = shortcode_ed.getContent()+'[item_services1 label="'+item_label+'" num = "'+item_num+'"]'+item_set+'[/item_services1]';
                    shortcode_ed.setContent(shorcode);
                    jQuery(this).dialog( "close" );
                },
                Cancel: function() {
                    jQuery(this).dialog( "close" );
                }
            },
        });
		
		//services block2
		jQuery( "#dialog-form6" ).dialog({
            autoOpen: false,
            height: 400,
            width: 500,
            modal: true,
            buttons: {
                "Add shortcode": function() {
                    var item_author = jQuery( "#item_author4" ).val(),
                        item_text = jQuery( "#item_text4" ).val();
                        shorcode = shortcode_ed.getContent()+'[item_services2 author="'+item_author+'"]'+item_text+'[/item_services2]';
                    shortcode_ed.setContent(shorcode);
                    jQuery(this).dialog( "close" );
                },
                Cancel: function() {
                    jQuery(this).dialog( "close" );
                }
            },
        });
		
		//services block3
		jQuery( "#dialog-form3" ).dialog({
            autoOpen: false,
            height: 400,
            width: 500,
            modal: true,
            buttons: {
                "Add shortcode": function() {
                    var item_author = jQuery( "#item_author" ).val(),
                        item_text = jQuery( "#item_text" ).val();
                        shorcode = shortcode_ed.getContent()+'[item_services3 author="'+item_author+'"]'+item_text+'[/item_services3]';
                    shortcode_ed.setContent(shorcode);
                    jQuery(this).dialog( "close" );
                },
                Cancel: function() {
                    jQuery(this).dialog( "close" );
                }
            },
        });
		
		
		
		
		
		
        jQuery('.publish-to a').click(function(){
            jQuery('.wp-switch-editor.switch-html').click();
            function newValues() {
                var serializedValues = jQuery("#ofform").serialize();
                    return serializedValues;
            }
            jQuery(":checkbox, :radio").click(newValues);
            jQuery("select").change(newValues);
			jQuery("select_color").change(newValues);
		
		
            jQuery('.ajax-loading-img').fadeIn();
            var serializedReturn = newValues();
            var ajax_url = '<?php echo admin_url("admin-ajax.php"); ?>';
            var data = {
                <?php if(isset($_REQUEST['page']) && $_REQUEST['page'] === 'siteoptions'){ ?>
                type: 'options',
                <?php } ?>
                action: 'of_ajax_post_action',
                data: serializedReturn
            };
            save_home();
            save_soc();
            save_contact_form();
            save_teams();
			save_contact_icon()
            save_services();
            jQuery.post(ajax_url, data, function() {
                jQuery('#save_status').fadeOut();
            });
            // window.location = window.location;
            return false;
        });
		
		
		jQuery('.color1').click(function(){
			jQuery( ".form_select_color" ).css('background', '#16994a');
		});
		jQuery('.color2').click(function(){
			jQuery( ".form_select_color" ).css('background', '#e95d5d');
		});
		jQuery('.color3').click(function(){
			jQuery( ".form_select_color" ).css('background', '#008eb4');
		});
		jQuery('.color4').click(function(){
			jQuery( ".form_select_color" ).css('background', '#77479b');
		});
		jQuery('.color5').click(function(){
			jQuery( ".form_select_color" ).css('background', '#1352a2');
		});
		jQuery('.color6').click(function(){
			jQuery( ".form_select_color" ).css('background', '#45a38d');
		});
		jQuery('.color7').click(function(){
			jQuery( ".form_select_color" ).css('background', '#f16c47');
		});
		jQuery('.color8').click(function(){
			jQuery( ".form_select_color" ).css('background', '#999999');
		});
		
		
		
		jQuery('.pattern1').click(function(){
			jQuery( ".pattern" ).css('background-image', 'url('+our_dir+'/images/pattern1.png)');
		});
		jQuery('.pattern2').click(function(){
			jQuery( ".pattern" ).css('background-image', 'url('+our_dir+'/images/pattern2.png)');
		});
		jQuery('.pattern3').click(function(){
			jQuery( ".pattern" ).css('background-image', 'url('+our_dir+'/images/pattern3.png)');
		});
		jQuery('.pattern4').click(function(){
			jQuery( ".pattern" ).css('background-image', 'url('+our_dir+'/images/pattern4.png)');
		});
		jQuery('.pattern5').click(function(){
			jQuery( ".pattern" ).css('background-image', 'url('+our_dir+'/images/pattern5.png)');
		});
		jQuery('.pattern6').click(function(){
			jQuery( ".pattern" ).css('background-image', 'url('+our_dir+'/images/pattern6.png)');
		});
		jQuery('.pattern7').click(function(){
			jQuery( ".pattern" ).css('background-image', 'url('+our_dir+'/images/pattern7.png)');
		});
		jQuery('.pattern8').click(function(){
			jQuery( ".pattern" ).css('background-image', 'url('+our_dir+'/images/pattern8.png)');
		});

    });
</script>
<?php } ?>