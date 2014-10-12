  ///// contact form
  
  function IsEmail(email) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(!regex.test(email)) {
           return false;
        }else{
           return true;
        }
      }
	  
	  jQuery(".contact-form input,.contact-form textarea").focus(function() {
     jQuery(this).attr("placeholder","") ;
    });

	jQuery(".contact-form input#name").blur(function() {
       if ( jQuery(this).attr("placeholder")=="") {
           jQuery(this).attr("placeholder","Name") ;
       }        
   });
	jQuery(".contact-form input#email").blur(function() {
       if ( jQuery(this).attr("placeholder")=="") {
           jQuery(this).attr("placeholder","Email") ;
       }        
   });
	jQuery(".contact-form textarea#message").blur(function() {
       if ( jQuery(this).attr("placeholder")=="") {
           jQuery(this).attr("placeholder","Message") ;
       }        
   });
	jQuery("form.contact-form #submit").click(function(){
	var obj = jQuery(this).parents(".contact-form");
	var Name    = obj.find("input#name").val();
	var Email   = obj.find("input#email").val();
	var Message = obj.find("textarea#message").val();
	var sendto  = obj.find("input#sendto").val();
	Name    = Name.replace('Name','');
	Email   = Email.replace('Email','');
	Message = Message.replace('Message','');
	obj.find(".noticefailed").text("");
   if( !IsEmail( Email ) ) {
	obj.find(".noticefailed").text("Please enter valid email.");
	return false;
	}
	if(Name ===""){
	obj.find(".noticefailed").text("Please enter your name.");
	return false;
	}
	if(Message === ""){
	obj.find(".noticefailed").text("Message is required.");
	return false;
	}
	obj.find(".noticefailed").html("");
	obj.find(".noticefailed").append("<img alt='loading' class='loading' src='"+onetone_params.themeurl+"/images/loading.gif' />");
	
	 jQuery.ajax({type:"POST",dataType:"json",url:onetone_params.ajaxurl,data:"Name="+Name+"&Email="+Email+"&Message="+Message+"&sendto="+sendto+"&action=onetone_contact",success:function(data){	if(data.error==0){obj.find(".noticefailed").addClass("noticesuccess").removeClass("noticefailed");obj.find(".noticesuccess").html(data.msg);}else{obj.find(".noticefailed").html(data.msg);	}jQuery('.loading').remove();obj[0].reset();},error:function(){obj.find(".noticefailed").html("Error.");obj.find('.loading').remove();}});});


  //top menu

  jQuery('.top-nav ul li').hover(function(){
	jQuery(this).find('ul:first').slideDown(100);
	jQuery(this).addClass("hover");
	},function(){
	jQuery(this).find('ul').css('display','none');
	jQuery(this).removeClass("hover");
	});
  jQuery('.top-nav li ul li:has(ul)').find("a:first").append(" <span class='menu_more'>»</span> ");
 
   jQuery(".top-nav > ul > li,.main-nav > li").click(function(){
	jQuery(".top-nav > ul > li,.main-nav > li").removeClass("active");
	jQuery(this).addClass("active");
    });
   
   //
     ////
  var windowWidth = jQuery(window).width(); 
  if(windowWidth > 939){
	  if(jQuery(".site-main .sidebar").height() > jQuery(".site-main .main-content").height()){
		  jQuery(".site-main .main-content").css("height",(jQuery(".site-main .sidebar").height()+140)+"px");
		  }
	}else{
		jQuery(".site-main .main-content").css("height","auto");
		}
	jQuery(window).resize(function() {
	var windowWidth = jQuery(window).width(); 
	 if(windowWidth > 939){
	  if(jQuery(".site-main .sidebar").height() > jQuery(".site-main .main-content").height()){
		  jQuery(".site-main .main-content").css("height",(jQuery(".site-main .sidebar").height()+140)+"px");
		  }
	}		else{
		jQuery(".site-main .main-content").css("height","auto");
		}				 
  });

		
/*!
/* Mobile Menu
*/
(function($) {

	var current = $('.top-nav li.current-menu-item a').html();
	if( $('span').hasClass('custom-mobile-menu-title') ) {
		current = $('span.custom-mobile-menu-title').html();
	}
	else if( typeof current == 'undefined' || current === null ) {
		if( $('body').hasClass('home') ) {
			if( $('.onetone-logo span').hasClass('site-name') ) {
				current = $('.onetone-logo .site-name').html();
			}
			else {
				current = $('.onetone-logo img').attr('alt');
			}
		}
		else{
			if( $('body').hasClass('woocommerce') ) {
				current = $('h1.page-title').html();
			}
			else if( $('body').hasClass('archive') ) {
				current = $('h6.title-archive').html();
			}
			else if( $('body').hasClass('search-results') ) {
				current = $('h6.title-search-results').html();
			}
            else if( $('body').hasClass('page-template-blog-excerpt-php') ) {
                current = $('.current_page_item').text();
            }
            else if( $('body').hasClass('page-template-blog-php') ) {
                current = $('.current_page_item').text();
            }
			else {
				current = $('h1.post-title').html();
			}
		}
	};
	
    if(typeof current == 'undefined' || current === null){current = "GO TO";}
	$('.top-nav').append('<a id="responsive_menu_button"></a>');
	$('.top-nav').prepend('<div id="responsive_current_menu_item">' + current + '</div>');
	$('a#responsive_menu_button, #responsive_current_menu_item,.navbar').click(function(){	
																	
		$('body .top-nav ul').slideToggle( function() {
			if( $(this).is(':visible') ) {
				$('a#responsive_menu_button,.navbar').addClass('responsive-toggle-open');
			}
			else {
				$('a#responsive_menu_button,.navbar').removeClass('responsive-toggle-open');
				$('body .top-nav ul').removeAttr('style'); 
			}
		});
});


	
})(jQuery);



// sticky menu

(function($){
	$.fn.sticky = function( options ) {
		// adding a class to users div
		$(this).addClass('sticky-header')
		var settings = $.extend({
            'scrollSpeed '  : 500
            }, options);

		return $('.sticky-header .home-navigation ul li.onetone-menuitem a').each( function() {
			
			if ( settings.scrollSpeed ) {

				var scrollSpeed = settings.scrollSpeed

			}
			
			
			  if(jQuery("body.admin-bar").length){
		if(jQuery(window).width() < 765) {
				stickyTop = 46;
				
			} else {
				stickyTop = 32;
			}
	  }
	  else{
		  stickyTop = 0;
		  }
		  $(this).css({'top':stickyTop});

			var stickyMenu = function(){
				
				
		  
				var scrollTop = $(window).scrollTop(); 
				if (scrollTop > stickyTop) { 
					$('.sticky-header').css({ 'position': 'fixed'/*, 'top':stickyTop*/ }).addClass('fxd');
					} else {
						$('.sticky-header').css({ 'position': 'absolute'/*, 'top':0*/ }).removeClass('fxd'); 
					}   
			};
			stickyMenu();
			$(window).scroll(function() {
				 stickyMenu();
			});
			  $(this).on('click', function(e){
				var selectorHeight = $('.sticky-header').height();   
				e.preventDefault();
		 		var id = $(this).attr('id');
				if(typeof $('section.'+ id).offset() !== 'undefined'){
				var goTo =  $('section.'+ id).offset().top -selectorHeight;
				$("html, body").animate({ scrollTop: goTo }, scrollSpeed);
				}

			});	
					
		});

	}

})(jQuery);

jQuery(document).ready(function(){
								
					
/* ------------------------------------------------------------------------ */
/*  sticky header             	  								  	    */
/* ------------------------------------------------------------------------ */
	
 jQuery('.home-header').sticky({'scrollSpeed' : 1000 });						
				
//slider
 if(jQuery("section.homepage-slider").length){
  if(window.chrome) {
				jQuery('section.homepage-slider li').css('background-size', '100% 100%');
			}

			jQuery('section.homepage-slider').unslider({
				arrows: true,
				fluid: true,
				dots: true,
				delay:slide_time,
				
			});
}
//video background
								
if(typeof onetone_bigvideo !== 'undefined' && onetone_bigvideo!=null){
for(var i=0;i<onetone_bigvideo.length;i++){
jQuery(onetone_bigvideo[i].video_section_item).tubular(onetone_bigvideo[i].options);
   }
  }
  
  jQuery(".home-wrapper .section").each(function(){
	if(jQuery(this).find("#tubular-container").length > 0){
		
		jQuery(this).css({"height":(jQuery(window).height()-jQuery("header").height())+"px"});
		jQuery(this).find("#tubular-container,#tubular-player").css({"height":(jQuery(window).height()-jQuery("header").height())+"px"});

		}						
 });
 });