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
      jQuery.imgpreload('templates/Roma 2012/img/ajax-loader.gif', function(){
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
  		  jQuery(this).parents('.wrap_thumb').append('<div class="monitor"><img src="templates/Roma 2012/img/ajax-loader.gif" title="ajaxloader" /></div>');
  		  here = jQuery(this).parents('.wrap_thumb').find('.monitor');
  		  jQuery(this).parents('.wrap_thumb').find('.monitor').css({opacity: 0});
  		  var altezzaSmall = jQuery(this).outerHeight(true);
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
       jQuery.imgpreload(imgURL, {
                each: function()
                {
                   // Was the image Loaded?
                   if (jQuery(this).data('loaded'))
                   {
                      var MedImgHeight = jQuery(this).data('dimensions').height;
                      var MedImgWidth = jQuery(this).data('dimensions').width;

                      if (offset.left < halfWindow)
                      {
                         jQuery(here).animate({
                                               height: MedImgHeight,
                                               width: MedImgWidth,
                                               top: -((MedImgHeight - altezzaSmall)/2),
                                               right: - (MedImgWidth+25)
                                               },200, function() {
                                                                 jQuery(here).find('img').attr({
                                                                                                src: imgURL
                                                                                                });
                                                                 });
                                               } else {
                                               jQuery(here).animate({
                                                                    height: MedImgHeight,
                                                                    width: MedImgWidth,
                                                                    top: -((MedImgHeight - altezzaSmall)/2),
                                                                    left: - (MedImgWidth+25)
                                                                    },200, function() {
                                                                                      jQuery(here).find('img').attr({
                                                                                                                    src: imgURL
                                                                                                                   });
                                                                                     });
                                              }
                   }
                }
        });
      }, //rollout function
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
    imageLoading: 'templates/Roma%202012/img/lightbox/lightbox-ico-loading.gif',
    imageBtnClose:'templates/Roma%202012/img/lightbox/lightbox-btn-close.gif',
    imageBtnPrev: 'templates/Roma%202012/img/lightbox/lightbox-btn-prev.png',
    imageBtnNext: 'templates/Roma%202012/img/lightbox/lightbox-btn-next.png',
    imageBlank:   'templates/Roma%202012/img/lightbox/lightbox-blank.gif'
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
        var left = jQuery(this).find('a').outerWidth(true);
        jQuery(this).find('a:first-child').addClass('HoverDx');                        
        menu.css({left: left, top: '-5px', left: jQuery(this).find('a:first-child').width() + 9 });
      } else {
        var left = menu.outerWidth(true);
        jQuery(this).find('a:first-child').addClass('HoverSx');        
        menu.css({left: -left+1, top: '-5px'});
      }
      menu.css({display:'block'});
      var offset = menu.offset();
      var wOffset = jQuery(window).scrollTop();       
      menu.css({display:'none'});
   
      if (jQuery.browser.msie && jQuery.browser.version < 9)
      {
        var menuHeight =  menu.outerHeight();
      }
      else
      {
        var menuHeight =  menu.outerHeight(true);
      }

      var ySize = (offset.top+menuHeight)-wOffset;                        
      if ( ySize > windowHeight) 
      {
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
                        buttonImage: "templates/Roma 2012/ui_icons/calendar_day.png",
                        buttonImageOnly: true,
                        onClose: function(date) {
                        },
                        beforeShow: function()
                        {
                             setTimeout(function()
                             {
                                 jQuery(".ui-datepicker").css("z-index", 11);
                             }, 10); 
                        }
                });

                jQuery( "#news_expires" ).datetimepicker({
                        showOn: "button",
                        dateFormat: 'yy/mm/dd',
                        timeFormat: 'hh:mm:ss',
                        showButtonPanel: false,
                        buttonImage: "../templates/Roma 2012/ui_icons/calendar_day.png",
                        buttonImageOnly: true,
                        onClose: function(date) {
                        },
                        beforeShow: function()
                        {
                             setTimeout(function()
                             {
                                 jQuery(".ui-datepicker").css("z-index", 11);
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

jQuery(document.body).on('mouseenter', 'input.fbuttonup1', function() {
         jQuery(this).removeClass('fbuttonup1');
         jQuery(this).addClass(fGetDownClass(this));
      })

jQuery(document.body).on('mouseleave', 'input[class^=fbuttondown]', function() {
         jQuery(this).removeClass(fGetDownClass(this));
         jQuery(this).addClass('fbuttonup1');
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




// SET FOLDER ACL

   var fuseraclhtml = '<tr class="file1"> \
            <td align="center"><a class="title1 viewgroups" href="U%UID%"><img src="templates/Roma 2012/ui_misc/membership.png" /></a></td> \
            <td align="center"><a class="title1 fdelrow" href="#"><img src="templates/Roma 2012/ui_misc/remove_acl.png" /></a></td> \
            <td><img src="templates/Roma 2012/ui_misc/user.png" style="padding-right: 5px"/>&nbsp;<a class="title1 togglerow" href="#">%UNAME%</a></td> \
            <td align="center"><b><input type="checkbox" name="facl_owlread_%UID%" value="%UID%" /></b></td> \
            <td align="center"><b><input type="checkbox" name="facl_owlwrite_%UID%" value="%UID%" /></b></td> \
            <td align="center"><b><input type="checkbox" name="facl_owldelete_%UID%" value="%UID%"  /></b></td> \
            <td align="center"><b><input type="checkbox" name="facl_owlcopy_%UID%" value="%UID%"  /></b></td> \
            <td align="center"><b><input type="checkbox" name="facl_owlmove_%UID%" value="%UID%"  /></b></td> \
            <td align="center"><b><input type="checkbox" name="facl_owlproperties_%UID%" value="%UID%" /></b></td> \
            <td align="center"><b><input type="checkbox" name="facl_owlsetacl_%UID%" value="%UID%"  /></b></td> \
            <td align="center"><b><input type="checkbox" name="facl_owlmonitor_%UID%" value="%UID%" /></b></td> \
            <td align="center"><b><input type="checkbox" name="facl_owlupdate_%UID%" value="%UID%"  /></b></td> \
            <td align="center"><b><input type="checkbox" name="facl_owlviewlog_%UID%" value="%UID%" /></b></td> \
            <td align="center"><b><input type="checkbox" name="facl_owlcomment_%UID%" value="%UID%" /></b></td> \
            <td align="center"><b><input type="checkbox" name="facl_owlcheckin_%UID%" value="%UID%" /></b></td> \
            <td align="center"><b><input type="checkbox" name="facl_owlemail_%UID%" value="%UID%" /></b></td> \
            <td align="center"><b><input type="checkbox" name="facl_owlrelsearch_%UID%" value="%UID%" /></b></td> \
         </tr>';

   var fgroupaclhtml = '<tr class="file1"> \
            <td align="center"><a class="title1 viewmembers" href="G%GID%"><img src="templates/Roma 2012/ui_misc/membership.png" /></a></td> \
            <td align="center"><a class="title1 fdelrow" href="#"><img src="templates/Roma 2012/ui_misc/remove_acl.png" /></a></td> \
            <td><img src="templates/Roma 2012/ui_misc/group.png" style="padding-right: 5px" />&nbsp;<a class="title1 togglerow" href="#">%GNAME%</a></td> \
            <td align="center"><b><input type="checkbox" name="fgacl_owlread_%GID%" value="%GID%" /></b></td> \
            <td align="center"><b><input type="checkbox" name="fgacl_owlwrite_%GID%" value="%GID%" /></b></td> \
            <td align="center"><b><input type="checkbox" name="fgacl_owldelete_%GID%" value="%GID%" /></b></td> \
            <td align="center"><b><input type="checkbox" name="fgacl_owlcopy_%GID%" value="%GID%" /></b></td> \
            <td align="center"><b><input type="checkbox" name="fgacl_owlmove_%GID%" value="%GID%" /></b></td> \
            <td align="center"><b><input type="checkbox" name="fgacl_owlproperties_%GID%" value="%GID%" /></b></td> \
            <td align="center"><b><input type="checkbox" name="fgacl_owlsetacl_%GID%" value="%GID%" /></b></td> \
            <td align="center"><b><input type="checkbox" name="fgacl_owlmonitor_%GID%" value="%GID%" /></b></td> \
            <td align="center"><b><input type="checkbox" name="fgacl_owlupdate_%GID%" value="%GID%" /></b></td> \
            <td align="center"><b><input type="checkbox" name="fgacl_owlviewlog_%GID%" value="%GID%" /></b></td> \
            <td align="center"><b><input type="checkbox" name="fgacl_owlcomment_%GID%" value="%GID%" /></b></td> \
            <td align="center"><b><input type="checkbox" name="fgacl_owlcheckin_%GID%" value="%GID%" /></b></td> \
            <td align="center"><b><input type="checkbox" name="fgacl_owlemail_%GID%" value="%GID%" /></b></td> \
            <td align="center"><b><input type="checkbox" name="fgacl_owlrelsearch_%GID%" value="%GID%" /></b></td> \
         </tr>';

// SET FOLDER ACL ADD User ACL Row

  jQuery('#fadduseracl').click( function( event )
  {
       event.preventDefault();

       if (jQuery('#fuseracl option:selected').val())
       {
          var uid = fuseraclhtml.replace(/\%UID\%/g, jQuery('#fuseracl option:selected').val());
          var finalhtml = uid.replace(/\%UNAME\%/g, jQuery('#fuseracl option:selected').text());
          jQuery('#fuseracl option:selected').remove();

          if (jQuery('#fuseracl option').length == 0)
          {
             jQuery("#fuseracl").append('<option value="">' + ACL_NO_USERS_AVAILABLE + '</option>');
             jQuery('#fadduseracl').hide();
          }
          jQuery('#faddacl_btn').before(finalhtml);
      }
      else
      {
         return false;
      }
   });

// SET FOLDER ACL  ADD Group ACL Row

  jQuery('#faddgroupacl').click( function( event )
   {
       event.preventDefault();

       if (jQuery('#fgroupacl option:selected').val())
       {
          var gid = fgroupaclhtml.replace(/\%GID\%/g, jQuery('#fgroupacl option:selected').val());
          var finalhtml = gid.replace(/\%GNAME\%/g, jQuery('#fgroupacl option:selected').text());
          jQuery('#fgroupacl option:selected').remove();

          if (jQuery('#fgroupacl option').length == 0)
          {
             jQuery("#fgroupacl").append('<option value="">' + ACL_NO_GROUPS_AVAILABLE + '</option>');
             jQuery('#faddgroupacl').hide();
          }
          jQuery('#faddacl_btn').before(finalhtml);
       }
       else
       {
          return false;
       }
   });

// SET FOLDER ACL  Delete Row

   jQuery(document).on('click', '.fdelrow', function(event) {
       event.preventDefault();

       var optionvalue = jQuery(this).closest('tr').find('input[type=checkbox]:first').val();
       var optioncaption = jQuery(this).closest('tr').find('.togglerow').text();

       if ( jQuery(this).closest('tr').find('input[type=checkbox]:first').prop('name').indexOf('fgacl'))
       {
          jQuery('#fuseracl option[value=""]').remove();
          jQuery("#fuseracl").append('<option value="' + optionvalue + '">' + optioncaption +'</option>');
       }
       else
       {
          jQuery('#fgroupacl option[value=""]').remove();
          jQuery("#fgroupacl").append('<option value="' + optionvalue + '">' + optioncaption +'</option>');
       }

       if (jQuery('#fuseracl option').length > 0)
       {
          jQuery('#fuseracl option').sort(SortSelectOptions).appendTo('#fuseracl');
          jQuery("#fuseracl").val($("#fuseracl option:first").val());
          jQuery('#fadduseracl').show();
       }

       if (jQuery('#fgroupacl option').length > 0)
       {
          jQuery('#fgroupacl option').sort(SortSelectOptions).appendTo('#fgroupacl');
          jQuery('#fgroupacl').val(jQuery('#fgroupacl option:first').val());
          jQuery('#faddgroupacl').show();
       }

       jQuery(this).closest('tr').remove();
   });

// SET FILE ACL

   var useraclhtml = '<tr class="file1"> \
            <td align="center"><a class="title1 viewgroups" href="U%UID%"><img src="templates/Roma 2012/ui_misc/membership.png" /></a></td> \
            <td align="center"><a class="title1 delrow" href="#"><img src="templates/Roma 2012/ui_misc/remove_acl.png" /></a></td> \
            <td><img src="templates/Roma 2012/ui_misc/user.png" style="padding-right: 5px"/>&nbsp;<a class="title1 togglerow" href="#">%UNAME%</a></td> \
            <td align="center"><b><input type="checkbox" name="acl_owlread_%UID%" value="%UID%" /></b></td> \
            <td align="center"><b><input type="checkbox" name="acl_owlupdate_%UID%" value="%UID%"  /></b></td> \
            <td align="center"><b><input type="checkbox" name="acl_owlsetacl_%UID%" value="%UID%"  /></b></td> \
            <td align="center"><b><input type="checkbox" name="acl_owldelete_%UID%" value="%UID%"  /></b></td> \
            <td align="center"><b><input type="checkbox" name="acl_owlcopy_%UID%" value="%UID%"  /></b></td> \
            <td align="center"><b><input type="checkbox" name="acl_owlmove_%UID%" value="%UID%"  /></b></td> \
            <td align="center"><b><input type="checkbox" name="acl_owlproperties_%UID%" value="%UID%" /></b></td> \
            <td align="center"><b><input type="checkbox" name="acl_owlviewlog_%UID%" value="%UID%" /></b></td> \
            <td align="center"><b><input type="checkbox" name="acl_owlcomment_%UID%" value="%UID%" /></b></td> \
            <td align="center"><b><input type="checkbox" name="acl_owlcheckin_%UID%" value="%UID%" /></b></td> \
            <td align="center"><b><input type="checkbox" name="acl_owlemail_%UID%" value="%UID%" /></b></td> \
            <td align="center"><b><input type="checkbox" name="acl_owlrelsearch_%UID%" value="%UID%" /></b></td> \
            <td align="center"><b><input type="checkbox" name="acl_owlmonitor_%UID%" value="%UID%" /></b></td> \
         </tr>';

   var groupaclhtml = '<tr class="file1"> \
            <td align="center"><a class="title1 viewmembers" href="G%GID%"><img src="templates/Roma 2012/ui_misc/membership.png" /></a></td> \
            <td align="center"><a class="title1 delrow" href="#"><img src="templates/Roma 2012/ui_misc/remove_acl.png" /></a></td> \
            <td><img src="templates/Roma 2012/ui_misc/group.png" style="padding-right: 5px" />&nbsp;<a class="title1 togglerow" href="#">%GNAME%</a></td> \
            <td align="center"><b><input type="checkbox" name="gacl_owlread_%GID%" value="%GID%" /></b></td> \
            <td align="center"><b><input type="checkbox" name="gacl_owlupdate_%GID%" value="%GID%" /></b></td> \
            <td align="center"><b><input type="checkbox" name="gacl_owlsetacl_%GID%" value="%GID%" /></b></td> \
            <td align="center"><b><input type="checkbox" name="gacl_owldelete_%GID%" value="%GID%" /></b></td> \
            <td align="center"><b><input type="checkbox" name="gacl_owlcopy_%GID%" value="%GID%" /></b></td> \
            <td align="center"><b><input type="checkbox" name="gacl_owlmove_%GID%" value="%GID%" /></b></td> \
            <td align="center"><b><input type="checkbox" name="gacl_owlproperties_%GID%" value="%GID%" /></b></td> \
            <td align="center"><b><input type="checkbox" name="gacl_owlviewlog_%GID%" value="%GID%" /></b></td> \
            <td align="center"><b><input type="checkbox" name="gacl_owlcomment_%GID%" value="%GID%" /></b></td> \
            <td align="center"><b><input type="checkbox" name="gacl_owlcheckin_%GID%" value="%GID%" /></b></td> \
            <td align="center"><b><input type="checkbox" name="gacl_owlemail_%GID%" value="%GID%" /></b></td> \
            <td align="center"><b><input type="checkbox" name="gacl_owlrelsearch_%GID%" value="%GID%" /></b></td> \
            <td align="center"><b><input type="checkbox" name="gacl_owlmonitor_%GID%" value="%GID%" /></b></td> \
         </tr>';

  // change the TR class on hover

   jQuery(document).on({
      mouseenter: function () {
         jQuery(this).removeClass('file1');
         jQuery(this).addClass('file2');
      },
      mouseleave: function () {
         jQuery(this).removeClass('file2');
         jQuery(this).addClass('file1');
      }
   }, 'tr.file1, tr.file2');

  // SET ACL TOGGLE Column checkboxes

  jQuery('.togglecol').click( function( event ) {
     event.preventDefault();

     var index = jQuery(this).parent().index();

     jQuery('tr.file1').each(function(i, val){
        // is the checkbox already checked
        var checked = jQuery(val).children().eq(index).find('input[type=checkbox]').prop('checked');

        jQuery(val).children().eq(index).find('input[type=checkbox]').prop('checked', !checked);
     });
  });

// SET ACL  TOGGLE Row Checkboxes

   jQuery(document).on('click', '.togglerow', function(event) {
       event.preventDefault();

       jQuery(this).closest('tr').find('input[type=checkbox]').each(function(i, val){
          var checked = jQuery(val).prop('checked');
          jQuery(val).prop('checked', !checked);
       });
   });

// SET FILE ACL  Delete Row

   jQuery(document).on('click', '.delrow', function(event) {
       event.preventDefault();

       var optionvalue = jQuery(this).closest('tr').find('input[type=checkbox]:first').val();
       var optioncaption = jQuery(this).closest('tr').find('.togglerow').text();

       if ( jQuery(this).closest('tr').find('input[type=checkbox]:first').prop('name').indexOf('gacl'))
       {
          jQuery('#useracl option[value=""]').remove();
          jQuery('#useracl').append('<option value="' + optionvalue + '">' + optioncaption +'</option>');
       }
       else
       {
          jQuery('#groupacl option[value=""]').remove();
          jQuery('#groupacl').append('<option value="' + optionvalue + '">' + optioncaption +'</option>');
       }

       if (jQuery('#useracl option').length > 0)
       {
          jQuery('#useracl option').sort(SortSelectOptions).appendTo('#useracl');
          jQuery('#useracl').val(jQuery('#useracl option:first').val());
          jQuery('#adduseracl').show();
       }

       if (jQuery('#groupacl option').length > 0)
       {
          jQuery('#groupacl option').sort(SortSelectOptions).appendTo('#groupacl');
          jQuery('#groupacl').val(jQuery('#groupacl option:first').val());
          jQuery('#addgroupacl').show();
       }
       jQuery(this).closest('tr').remove();
   });



// SET FILE ACL  ADD User ACL Row

  jQuery('#adduseracl').click( function( event )
  {
       event.preventDefault();

       if (jQuery('#useracl option:selected').val())
       {
          var uid = useraclhtml.replace(/\%UID\%/g, jQuery('#useracl option:selected').val());
          var finalhtml = uid.replace(/\%UNAME\%/g, jQuery('#useracl option:selected').text());
          jQuery('#useracl option:selected').remove();

          if (jQuery('#useracl option').length == 0)
          {
             jQuery('#useracl').append('<option value="">' + ACL_NO_USERS_AVAILABLE + '</option>');
             jQuery('#adduseracl').hide();
          }
          jQuery('#addacl_btn').before(finalhtml);
      }
      else
      {
         return false;
      }
   });

// SET ACL  ADD Group ACL Row

  jQuery('#addgroupacl').click( function( event )
   {
       event.preventDefault();

       if (jQuery('#groupacl option:selected').val())
       {
          var gid = groupaclhtml.replace(/\%GID\%/g, jQuery('#groupacl option:selected').val());
          var finalhtml = gid.replace(/\%GNAME\%/g, jQuery('#groupacl option:selected').text());
          jQuery('#groupacl option:selected').remove();

          if (jQuery('#groupacl option').length == 0)
          {
             jQuery('#groupacl').append('<option value="">' + ACL_NO_GROUPS_AVAILABLE + '</option>');
             jQuery('#addgroupacl').hide();
          }
          jQuery('#addacl_btn').before(finalhtml);
       }
       else
       {
          return false;
       }
   });

   jQuery('input:reset').click( function( event ) {
      location.reload();
   });

   jQuery(document).on('click', '.viewmembers, .viewgroups', function(event) {
      event.preventDefault();
   });

   jQuery(document).tooltip({
       items:'.viewmembers, .viewgroups',
       position: { my: "left+15 top", at: "right center" },
       content:function(callback) {
         jQuery.ajax({
         url: 'scripts/Ajax/Owl/getmembership.php?get=' + jQuery(this).attr('href') + '&sess=' + jQuery('#sess').val(),
         success: function( data ) {
           // If the First 6 letters of the resonse is not <table Then there was an issue
           // display an error.  Maybe the Owl session is timed out?
           if (data.substring(0,6) == '<table')
           {
              callback( data );
           }
           else
           {
              callback( 'An Error Occured Retreiving Group Information' );
           }
         }
       })
      }
   }); // end of document.tooltip

/**
 * Admin Delete user and Group Delete Buttons
 */

/** USERS **/

   if (jQuery('[name=owluser]').val() == '1')
   {
      jQuery('[name=bdeleteuser_x]').hide();
   }

   jQuery('[name=owluser]').on('change', function() {
     if (this.value == '1')
     {
       jQuery('[name=bdeleteuser_x]').hide();
     }
     else
     {
       jQuery('[name=bdeleteuser_x]').show();
      }
   });

/** GROUPS **/

   /** 4 Predefiend groups that should be left alone
    * so hide the delete button if its one of these 
    * groups
    */

   if (jQuery('[name=group]').val() < 4)
   {
      jQuery('[name=bdeletegroup_x]').hide();
   }

   jQuery('[name=group]').on('change', function() {
     if (this.value < 4)
     {
       jQuery('[name=bdeletegroup_x]').hide();
     }
     else
     {
       jQuery('[name=bdeletegroup_x]').show();
     }
   });

}) // end of document.ready
