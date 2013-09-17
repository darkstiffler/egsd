//--------global------------- 
var isSplash = true;
var isAnim = true;
var spinner;
var mapSpinner;
var MSIE = ($.browser.msie) && ($.browser.version <= 8);
//------DocReady-------------
$(document).ready(function(){


    if(location.hash.length == 0){
        location.hash="!/"+$('#content > ul > li:first-child').attr('id');
    }
    ///////////////////////////////////////////////////////////////////
        loaderInit();
function loaderInit(){
        var opts = {
              lines: 8,
              length: 0, 
              width: 16, 
              radius: 17, 
              rotate: 0, 
              color: '#fff', 
              speed: 1.3, 
              trail: 60, 
              shadow: false,
              hwaccel: false, 
              className: 'spinner', 
              zIndex: 2e9, 
              top: 'auto', 
              left: 'auto' 
        };
        var target = $(".spinner > span");
        spinner = new Spinner(opts).spin();
        target.append(spinner.el) 
        ///////////////////////////////////////
            var opts2 = {
              lines: 12,
              length: 6, 
              width: 3, 
              radius: 8, 
              rotate: 0, 
              color: '#000', 
              speed: 1.3, 
              trail: 60, 
              shadow: false,
              hwaccel: false, 
              className: 'spinner', 
              zIndex: 2e9, 
              top: 'auto', 
              left: 'auto' 
        };
} 
});
  
 //------WinLoad-------------  
$(function(){
   $(".button, .button1, .load-more a").hover(
    function(){
    $(this).css(
      {"margin-top":"6px", "margin-left":"7px", "box-shadow":"none", "background": "#c7c1cb"}), 
    $(this).css({"margin-top":"auto", "margin-left":"auto", "box-shadow":"4px 4px 0 rgba(0, 0, 0, 0.25)", "background": "#fff"})
  })


$('.zoomSp').fadeTo(500, 0)
    $('.zoomSp').hover(function(){ $(this).stop().fadeTo(500, 0.6)	}, function(){$(this).stop().fadeTo(500, 0)})

var menuItems = $('#menu >li'); 

var currentIm = 0;
var lastIm = 0;

//setTimeout(navInit, 1000)
navInit();

function navInit(){
    $('.menuHolder').fadeTo(0, 1);
    $('header .description').fadeTo(0, 1);
    $("header").stop(true).animate({top:'0px'}, 800, 'easeOutCubic');
}

///////////////////////////////////////////////
    var navItems = $('.menu > ul >li');

   
	var content=$('#content'),
		nav=$('.menu');
		navSplash=$('.splashHolder');
		
		
		
		
		
		

    	$('#content').tabs({
		preFu:function(_){
				
			_.li.css({left:"-1700px"});
			
		}
		,actFu:function(_){		
			if(_.curr){
				_.curr.css({'display':'block', left:'1700px'}).stop().delay(400).animate({left:"0px"},700,'easeOutCubic');
                cont_resize();
                if ((_.n == 0) && ((_.pren>0) || (_.pren==undefined))){
					splashMode();}
                if (((_.pren == 0) || (_.pren == undefined)) && (_.n>0) ){
					contentMode(); }
            }
			if(_.prev){
			     _.prev.stop().animate({left:'-1700px'},700,'easeInOutCubic',function(){_.prev.css({'display':'none'});} );
             }
		}
	})






	
    function splashMode(){
        isSplash = true;
        
         $(".splash_menu > li").each( function(index){
            _delay = (index*100)+200;
            $(this).css({left:"1700px"}).stop().delay(_delay).animate({left:"0px"}, 900, 'easeOutCubic');
         });
         
         $('.splashHolder').css({'z-index':2})
         $('#content').css({'z-index':1})
         
         $('.menuHolder').stop().fadeTo(500, 0, function(){$('.menuHolder').css({display:'none'})} );
         $('header .description').stop().css({display:'block'}).fadeTo(500, 1);
         
         if(isSplash == true)
         {
            $('.splash_footer').css({display:'block'});
            $('.footer').css({display:'none'});
            $("#logo").removeClass("logo_content");
         }
    }
    
    function contentMode(){  
        isSplash = false;
        
        $(".splash_menu > li").each( function(index){
            _delay = (index*50);
            $(this).stop().delay(_delay).animate({left:"-1700px"}, 900, 'easeInOutCubic');
			
         });
         
         $('.splashHolder').css({'z-index':1});
         $('#content').css({'z-index':2});
         
         $('.menuHolder').stop().css({display:'block'}).fadeTo(500, 1);
         $('header .description').stop().fadeTo(500, 0, function(){$('header .description').css({display:'none'})} );
         if(isSplash == false)
         {
            $('.splash_footer').css({display:'none'});
            $('.footer').css({display:'block'});
            $("#logo").addClass("logo_content");
         }
    }
    
   
	nav.navs({
			useHash:true,
          hoverIn:function(li){},
          hoverOut:function(li){
              if ((!li.hasClass('with_ul')) || (!li.hasClass('sfHover'))) {} 
          } 
		}).navs(function(n){
			$('#content').tabs(n);
		})
        
    navSplash.navs({
			useHash:true,
             hoverIn:function(li){},
             hoverOut:function(li){} 
		}).navs(function(n){
			$('#content').tabs(n);
		})    
    } //window function
    
) //window load

 function cont_resize(){
    var page = location.hash;
		page='#'+page.slice(3);
		var li_W = $('#content > ul').find(page).height();
    if(li_W < 360){li_W = 360}
            $('#content>ul').css({height:li_W+"px"}, 600, 'easeInOutCubic').css({'overflow':'visible'})
 }
$(window).load(function() {
		$('.flexslider').flexslider({
      animation: "fade"
    });
	
	$(window).resize(cont_resize)	
	
  $(".splash_menu a, #menu a").append("<strong></strong>")
  /*================================>> Slide Panel <<=====================================*/
    $('.panel_button').toggle(
       function() {
         $("#panel").animate({left:0})
       },
       function() {
         $("#panel").animate({left:-160})
       }
    );
	$('.social a').poshytip({
		className: 'tooltip',
		alignX: 'center',
		alignY: 'top',
	});

});

function set_bg_color(val)
{
  jQuery.cookie("bgcolor", val);
  $("body, .skill_set").css("background-color", val);
}
function set_bg_image(val)
{
  jQuery.cookie("bgimage", val);
  $("body").css("background-image", 'url('+directory_uri+'/images/patterns/'+val+'.png)');
}

function reset()
{
  $("body").css("background-image", 'url(images/patterns/pattern4.png)');
  $("body, .skill_set").css("background-color", '#1352a2');
}


$(document).ready(function()
{ 
	$('.blog_content').masonry({
	
	itemSelector: '.post',
	columnWidth: function( containerWidth )
		   {
    return containerWidth / 3;
  },
	
		  animationOptions: { 
		  queue: false, 
		  duration: 500 
		}
	});
	
});	


$(window).load(function() {
$(function(){
    var li=$('.tweet_list li')
     ,n=0
     ,activeClass="active"
   
    function fu(){
     li.removeClass(activeClass)
     li.eq(n++).addClass(activeClass)
     n=n<li.length?n:0
     setTimeout(fu,4000)
    }
    fu()
   })

})
