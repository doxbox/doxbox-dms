//  author: Marco Chillemi
//  mail: marco.chillemi [at] gmail [dot] com
//  URL: http://www.killodesign.com   
//



// Online Help Functions
//
//
//
var popupStatus = 0;

//loading popup with jQuery magic!
function loadPopup(){
	//loads popup only if it is disabled
	if(popupStatus==0){
		jQuery("#HelpPopup").css({
			"opacity": "0.7"
		});
		//jQuery("#HelpPopup").fadeIn("slow");
		//jQuery("#popupHelp").fadeIn("slow");
		jQuery("#HelpPopup").show();
		jQuery("#popupHelp").show();
		popupStatus = 1;
	}
}

//disabling popup with jQuery magic!
function disablePopup(){
	//disables popup only if it is enabled
	if(popupStatus==1){
		jQuery("#HelpPopup").fadeOut("slow");
		jQuery("#popupHelp").fadeOut("slow");
		popupStatus = 0;
	}
}

//centering popup
function centerPopup(){
	//request data for centering
	var windowWidth = document.documentElement.clientWidth;
	var windowHeight = document.documentElement.clientHeight;
	var popupHeight = jQuery("#popupHelp").height();
	var popupWidth = jQuery("#popupHelp").width();
//console.log("Wind W: " + windowWidth);
//console.log("Wind H: " + windowHeight);
//console.log("Pop W: " + popupWidth);
//console.log("Pop H: " + popupHeight);

        if (popupHeight > windowHeight)
        {
           var popupTopPos = 50;
        }
        else
        {
           var popupTopPos = windowHeight/2-popupHeight/2;
        }

        if (popupWidth > windowWidth)
        {
           var popupLeftPos = 50;
        }
        else
        {
           var popupLeftPos = windowWidth/2-popupWidth/2;
        }
	//centering
	jQuery("#popupHelp").css({
		"position": "absolute",
		"top": popupTopPos,
		"left": popupLeftPos
	});

	//only need force for IE6
  if (jQuery.browser.msie) {
    var wHeight = jQuery(document).height();
  	jQuery("#HelpPopup").css({
  		"height": wHeight
  	});  
  }	

}

jQuery(document).ready(function() {

// LocalScroll assignment
  jQuery('#motd').localScroll();
  jQuery('#motd_bottom').localScroll();   

// Online Help
//
//
//
	//LOADING POPUP
	//Click the button event!
	jQuery("#help_button, #help_button_btm").click(function(){
		//centering with css
		centerPopup();
		//load popup
		loadPopup();
    jQuery('.scroll-pane').jScrollPane();
    var offset = jQuery("#popupHelp").offset();
    jQuery('applet').hide();        
	});
				
	//CLOSING POPUP
	//Click the x event!
	jQuery("#popupHelpClose").click(function(){
	   disablePopup();
	   jQuery('applet').show();
	});
	//Click out event!
	jQuery("#HelpPopup").click(function(){
		disablePopup();
		jQuery('applet').show();
	});
	//Press Escape event!
	jQuery(document).keypress(function(e){
		if(e.keyCode==27 && popupStatus==1){
			disablePopup();
			jQuery('applet').show();
		}
	});
//
//
// END Online Help

//Infopanels Tabs
	//When page loads...
	jQuery(".tab_content").hide(); //Hide all content
	jQuery("ul.tabs li:first").addClass("active").show(); //Activate first tab
	jQuery(".tab_content:first").show(); //Show first tab content

	//On Click Event
	jQuery("ul.tabs li").click(function() {

		jQuery("ul.tabs li").removeClass("active"); //Remove any "active" class
		jQuery(this).addClass("active"); //Add "active" class to selected tab
		jQuery(".tab_content").hide(); //Hide all tab content

		var activeTab = jQuery(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		jQuery(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});
	
//Controls when content = 100% and removes left & right borders
	if ((jQuery("#content").width()*100)/jQuery(window).width() >= 99) {
	   jQuery("#content").css("border", "none"); 
  }
  
//Admin Tools Bottom & User Tools Bottom position manager
  var at_xpos = -(jQuery('#admin_tools_bottom').height())-10;
  var ut_xpos = -(jQuery('#user_tools_bottom').height())-10;
  jQuery('#down_menu .li_father').mouseover(function() {
    var xpos = -(jQuery(this).find('ul').height())-10;
    jQuery(this).find('ul').css('top',xpos);    
  });  
  
//Tools Panels Toggler
  var actv = jQuery('.tools_panels').length;
  if (actv > 0) {
    jQuery('.switch').show();
    jQuery('.switch').click(function() {
      if (jQuery('.tools_panels').is(":visible")) {
        jQuery('.switch').toggleClass('down_arrow');
        jQuery('.tools_panels').each(function () {
          jQuery(this).hide(200);
        });
      } else {
        jQuery('.switch').toggleClass('down_arrow');
        jQuery('.tools_panels').each(function () {
          jQuery(this).show(200);
        });      
      }
    }); 
  } else {}
  
//Medium Thumbs functions
  jQuery('.img_thumb img').wrap('<div class="wrap_thumb" />');
  jQuery('.wrap_thumb').css({"position":"relative"});
  jQuery('.img_thumb img').each(function() {
      jQuery.imgpreload('templates/Roma 2011/img/ajax-loader.gif', function(){
        mediumThumb();  
      });
  });	
  function mediumThumb() {
  	jQuery('.img_thumb img').hoverIntent(
  	  //rollover function
  		function() {
  		  var imgURL = jQuery(this).attr("src");
                  if (imgURL.indexOf('_small') > -1)
                  {
  		     imgURL = imgURL.replace('_small','_med');
                  }
                  else
                  {
  		     imgURL = imgURL.replace('_med','_large');
                  }
  		  jQuery(this).parents('.wrap_thumb').append('<div class="monitor"><img src="templates/Roma 2011/img/ajax-loader.gif" title="ajaxloader" /></div>');
  		  here = jQuery(this).parents('.wrap_thumb').find('.monitor');
  		  jQuery(this).parents('.wrap_thumb').find('.monitor').css({opacity: 0});
  		  var altezzaSmall = jQuery(this).outerHeight();
  		  jQuery(this).parents('.wrap_thumb').find('.monitor').height(13);
  		  var windowWidth = jQuery(window).width();
  		  var halfWindow = windowWidth/2;
        var offset = jQuery(this).offset();
        if (offset.left < halfWindow) {
    		  jQuery(this).parents('.wrap_thumb').find('.monitor').css({top: altezzaSmall/2-15, right: -200});
    		  jQuery(this).parents('.wrap_thumb').find('.monitor').animate({opacity:1,right:-50},200);        
        }else {
    		  jQuery(this).parents('.wrap_thumb').find('.monitor').css({top: altezzaSmall/2-15, left: -200});
    		  jQuery(this).parents('.wrap_thumb').find('.monitor').animate({opacity:1,left:-50},200);        
        }
   		  //preload med-size thumb img
        jQuery.imgpreload(imgURL,function() { 
          var altezzaMed = jQuery(this).attr('height');
          var lunghezza = jQuery(this).attr('width');
          if (offset.left < halfWindow) {
            jQuery(here).animate({
                                 height: altezzaMed,
                                 width: lunghezza,
                                 top: -((altezzaMed - altezzaSmall)/2),
                                 right: - (lunghezza+25)
                                 },200, function() {
                                                    jQuery(here).find('img').attr({ 
                                                                              src: imgURL
                                                                             });                             
                                                   });
          } else {
            jQuery(here).animate({
                                 height: altezzaMed,
                                 width: lunghezza,
                                 top: -((altezzaMed - altezzaSmall)/2),
                                 left: - (lunghezza+25)
                                 },200, function() {
                                                    jQuery(here).find('img').attr({ 
                                                                              src: imgURL
                                                                             });                             
                                                   });          
          }
          
        });		  
  		},
  		//rollout function
      function() {
  		  jQuery(this).parents('.wrap_thumb').find('.monitor').animate({opacity:0,top:-200}, 200, function(){jQuery(this).remove()});	
    });
  }
  
//Lightbox plugin Implementations
  jQuery('.img_thumb img').each(function () {
    var bigImgURL = jQuery(this).attr("src");
    if (bigImgURL.indexOf("_small") > -1)
    {
       bigImgURL = bigImgURL.replace('_small','_large');
    }
    else
    {
       bigImgURL = bigImgURL.replace('_med','_large');
    }
    jQuery(this).wrap('<a href="'+bigImgURL+'" class="lightbox" />');
  });
  
  jQuery('a.lightbox').lightBox({
    imageLoading: 'templates/Roma%202011/img/lightbox/lightbox-ico-loading.gif',
    imageBtnClose: 'templates/Roma%202011/img/lightbox/lightbox-btn-close.gif',
    imageBtnPrev: 'templates/Roma%202011/img/lightbox/lightbox-btn-prev.png',
    imageBtnNext: 'templates/Roma%202011/img/lightbox/lightbox-btn-next.png'
  });
  
//jqLayerMenu 
  jQuery('.layerMenuAnchor').hoverIntent(
    //rollover function
    function() {
      var windowWidth = jQuery(window).width();
  		var halfWindow = windowWidth/2;
  		var offset = jQuery(this).offset();
      var menu = jQuery(this).find('.jqLayerMenu');
      var windowHeight = jQuery(window).height();
      if (offset.left < halfWindow) {
        var left = jQuery(this).find('a').outerWidth();
        jQuery(this).find('a:first-child').addClass('HoverDx');                        
        menu.css({left: left, top: '-6px'});
      } else {
        var left = menu.outerWidth();
        jQuery(this).find('a:first-child').addClass('HoverSx');        
        menu.css({left: -left+1, top: '-6px'});
      }
      menu.css({display:'block'});
      var offset = menu.offset();
      var wOffset = jQuery(window).scrollTop();       
      menu.css({display:'none'});
      var menuHeight =  menu.outerHeight();
      var ySize = (offset.top+menuHeight)-wOffset;                        
      if ( ySize > windowHeight) {
        newYpos = ySize - windowHeight; 
        menu.css({top:-newYpos-10}); 
      }
      menu.fadeIn(100);
    },
    //rollout function
    function() {
      jQuery(this).find('.jqLayerMenu').fadeOut(200);
      jQuery(this).find('a:first-child').removeClass('HoverDx HoverSx');
  });  

//status icons manager
/*  jQuery('.status_icons').each(function () {
    jQuery(this).find('li').each(function() {
      var img_width = jQuery(this).find('img').width();
      if (img_width == null ){
        jQuery(this).remove();
      }
    });
  }); 
*/

// IE FIXES
  if (jQuery.browser.msie) {
  // IE z-index bug fix for jqLayerMenu    
    jQuery('.layerMenuAnchor').mouseover(function() {
      jQuery(this).parents().find('.layerMenuAnchor').removeClass('zindex_fix');
      jQuery(this).parents().find('.med_thumbnail').removeClass('zindex_fix');
      jQuery(this).addClass('zindex_fix');
      //console.log(jQuery('.wrap_thumb').css('z-index'));
      //console.log(jQuery('.wrap_thumb img').attr('src'));
    });
  // IE z-index bug fix for thumbnails  
    jQuery('.img_thumb').mouseover(function() {
      jQuery(this).addClass('zindex_fix');
    }).mouseout(function() {
      jQuery(this).removeClass('zindex_fix');
    });
  // IE z-index bug fix for thumbnails in thumb view
    jQuery('.med_thumbnail').mouseover(function() {
      jQuery(this).parents().find('.layerMenuAnchor').removeClass('zindex_fix');
      jQuery(this).parents().find('.med_thumbnail').removeClass('zindex_fix');
      jQuery(this).addClass('zindex_fix');
    });
  // IE hover fix
    jQuery('.li_father').hoverIntent(
    // rollover func
    function() {
      jQuery(this).find('ul').css('display','block');
      jQuery(this).addClass('blu');
    },
    // rollout func
    function() {
      jQuery(this).find('ul').css('display','none');
      jQuery(this).removeClass('blu');
    });
  // IE last-child fix for .log_table classes
    jQuery('.table_inside td:last-child').addClass('the_last');
  // IE tables width fix
    if ((jQuery('.log_table').width() < 500) && (jQuery(window).width() > 900)) {
      jQuery('.log_table').css('width','900');
    }
    // tables width fix on window resize event
    jQuery(window).resize(function() {
      if ((jQuery('.log_table').width() < 500) && (jQuery(window).width() > 900)) {
        jQuery('.log_table').css('width','900');
      }      
    });
  // IE fix on inputfields focus (login)
    jQuery(".input_field input").focusin(
      function () {
        jQuery(this).css('background-color','#FFF8BC');
      }
    );
    jQuery(".input_field input").focusout(       
      function () {
        jQuery(this).css('background-color','#E9EEF4');
      }
    );
            
  }
  
//Adapt navBars lenght to browse table lenght on PAGE LOAD
  if (jQuery.browser.msie) {
    jQuery('#folder_tools_top').width(jQuery('.width_driver').width()-20);
    jQuery('#folder_tools_bottom').width(jQuery('.width_driver').width()-20);
    jQuery('#nav_bar').width(jQuery('.width_driver').width()+1);
    jQuery('#nav_bar_bottom').width(jQuery('.width_driver').width()+1);
  } else {
    jQuery('#folder_tools_top').width(jQuery('.width_driver').width()-11);
    jQuery('#folder_tools_bottom').width(jQuery('.width_driver').width()-11);
    jQuery('#nav_bar').width(jQuery('.width_driver').width()-11);
    jQuery('#nav_bar_bottom').width(jQuery('.width_driver').width()-11);
  }
  
//Adapt navBars lenght to browse table lenght on Window RESIZE
  jQuery(window).resize(function() {
    if (jQuery.browser.msie) {
      jQuery('#folder_tools_top').width(jQuery('.width_driver').width()-20);
      jQuery('#folder_tools_bottom').width(jQuery('.width_driver').width()-20);
      jQuery('#nav_bar').width(jQuery('.width_driver').width()+1);
      jQuery('#nav_bar_bottom').width(jQuery('.width_driver').width()+1);
    } else {
      jQuery('#folder_tools_top').width(jQuery('.width_driver').width()-11);
      jQuery('#folder_tools_bottom').width(jQuery('.width_driver').width()-11);
      jQuery('#nav_bar').width(jQuery('.width_driver').width()-11);
      jQuery('#nav_bar_bottom').width(jQuery('.width_driver').width()-11);
    }
  });        

                jQuery( "#expires" ).datetimepicker({
                        showOn: "button",
                        dateFormat: 'yy/mm/dd',
                        timeFormat: 'hh:mm:ss',
                        showButtonPanel: false,
                        buttonImage: "templates/Roma 2011/ui_icons/calendar_day.png",
                        buttonImageOnly: true,
                        onClose: function(date) {
                        },
                        beforeShow: function()
                        {
                             setTimeout(function()
                             {
                                 $(".ui-datepicker").css("z-index", 11);
                             }, 10); 
                        }
                });

                jQuery( "#news_expires" ).datetimepicker({
                        showOn: "button",
                        dateFormat: 'yy/mm/dd',
                        timeFormat: 'hh:mm:ss',
                        showButtonPanel: false,
                        buttonImage: "../templates/Roma 2011/ui_icons/calendar_day.png",
                        buttonImageOnly: true,
                        onClose: function(date) {
                        },
                        beforeShow: function()
                        {
                             setTimeout(function()
                             {
                                 $(".ui-datepicker").css("z-index", 11);
                             }, 10); 
                        }
                });

// main menu
  jQuery('#top_mainmenu h3').css('cursor','pointer');
  if (jQuery.cookie('the_uncle_cookie') == 'open' || jQuery.cookie('the_uncle_cookie') == null){
    jQuery.cookie('the_uncle_cookie', 'open', { expires: 365, path: '/' });
    jQuery('#menu_container').show();
  } 
  else {
    jQuery('#menu_container').hide();
    jQuery('#menu_container_toggler').find('a').removeClass('slide_up').addClass('slide_down');
  }
  jQuery('#menu_container_toggler, #top_mainmenu h3').click(function (){
    if( jQuery.cookie('the_uncle_cookie') == 'open' ) {
      jQuery.cookie('the_uncle_cookie', 'closed');
      jQuery('#menu_container').slideUp();
      jQuery('#menu_container_toggler').find('a').removeClass('slide_up').addClass('slide_down');      
    }
    else {
      jQuery.cookie('the_uncle_cookie', 'open');
      jQuery('#menu_container').slideDown(100);
      jQuery('#menu_container_toggler').find('a').removeClass('slide_down').addClass('slide_up'); 
    }
  });

// Button Hover effect

jQuery('input.fbuttonup1').on({

      mouseenter: function () {
         jQuery(this).removeClass('fbuttonup1');
         jQuery(this).addClass(fGetDownClass(this));
      },
      mouseleave: function () {
         jQuery(this).removeClass(fGetDownClass(this));
         jQuery(this).addClass('fbuttonup1');
      }
   });

// Image Swap on Hover effect

   jQuery('img.hover_swap').on({
      mouseenter: function () {
         jQuery(this).prop('src', jQuery(this).prop('src').replace(/\.png/, '_hover.png' ));
      },
      mouseleave: function () {
         jQuery(this).prop('src', jQuery(this).prop('src').replace(/_hover/, '' ));
      }
   }); 

  
}) // end of document.ready
