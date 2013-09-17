/*
* Copyright (C) 2009 Joel Sutherland.
* Liscenced under the MIT liscense
*/
function filter_start(){
  (function($){$.fn.filterable=function(settings){settings=$.extend({useHash:true,animationSpeed:1000,show:{width:'show',opacity:'show'},hide:{width:'hide',opacity:'hide'},useTags:true,tagSelector:'#portfolio-filter a',selectedTagClass:'current',allTag:'all'},settings);return $(this).each(function(){$(this).bind("filter",function(e,tagToShow){if(settings.useTags){$(settings.tagSelector).removeClass(settings.selectedTagClass);$(settings.tagSelector+'[href='+tagToShow+']').addClass(settings.selectedTagClass)}$(this).trigger("filterportfolio",[tagToShow.substr(1)])});$(this).bind("filterportfolio",function(e,classToShow){if(classToShow==settings.allTag){$(this).trigger("show")}else{$(this).trigger("show",['.'+classToShow]);$(this).trigger("hide",[':not(.'+classToShow+')'])}if(settings.useHash){}});$(this).bind("show",function(e,selectorToShow){$(this).children(selectorToShow).animate(settings.show,settings.animationSpeed)});$(this).bind("hide",function(e,selectorToHide){$(this).children(selectorToHide).animate(settings.hide,settings.animationSpeed)});if(settings.useHash)if(settings.useTags){
    $(settings.tagSelector).click(function(){
    $('#portfolio-list').trigger("filter",[$(this).attr('href')]);$(settings.tagSelector).removeClass('current');$(this).addClass('current');$.when($('#portfolio-list li')).then(function(){
  var new_h=$('#portfolio-list').height();
  var li_W = new_h + 139;
    if(li_W < 360){li_W = 360}
            $('#content>ul').css({height:li_W+"px"}, 600, 'easeInOutCubic').css({'overflow':'visible'})
})
    return false})}})}})(jQuery);$(document).ready(function(){$('#portfolio-list').filterable()});
}
