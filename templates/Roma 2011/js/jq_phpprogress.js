//Holds the id from set interval
var interval_id = 0;
var cancel_upload = 0;
        
jQuery(document).ready(function(){

   // If the Browser doesn't support HTML5 Progress bar bail out
   var supportsProgress = (document.createElement('progress').max !== undefined);

   if (!supportsProgress)
   {
      return;
   }

   //jquery form options
   var options = { 
      success:       showResponse, //Once the upload completes stop polling the server
      data: { phpprogressbar: '1', send_file_x: '1'}, // to Let dbmodify know we are using the porgressbar and we Posted
      error:	   showResponse
   };

   //Add the submit handler to the form

   jQuery('#form_upload').on('click', 'input[name=send_file_x]', function(event) {

      var bOneVal = 0;

      jQuery('input[type=file]').each(function (index, element) {
         if (!jQuery(this).val() == '')
         {
            bOneVal++;
         } 
      });

      if (bOneVal == 0)
      { 
         event.preventDefault();
         alert(ERROR_SELECT_FILE);
         return false;
      }
   });

   
   jQuery('#form_upload').submit(function(event){

      jQuery('#bg-overlay').show();
      jQuery('#progress-container').show();
      jQuery('#cancel-upload').show();
      jQuery('#error-container').hide();
   
      jQuery('#progress-txt').html(PROGRESSBAR_UPLOAD_START);
      //Poll the server for progress
      interval_id = setInterval(function() {
   
         jQuery.getJSON('./scripts/Ajax/Owl/getprogress.php?cancel='+ cancel_upload, function(data){
    
            //if there is some progress then update the status
            if (cancel_upload == 1)
            {
               jQuery('#progress').val('1');
               jQuery('#progress-txt').html(PROGRESSBAR_UPLOAD_CANCEL);
               jQuery('#cancel-upload').hide();
               stopProgress();
               cancel_upload = 0; 
            }
            else
            {
               if(data)
               {
                  jQuery('#progress').val(data.bytes_processed / data.content_length);
                  jQuery('#progress-txt').html(PROGRESSBAR_UPLOADING + ' ' + Math.round((data.bytes_processed / data.content_length)*100) + '%');
               }
               //When there is no data the upload is complete
               else
               {
                  jQuery('#progress').val('1');
                  jQuery('#progress-txt').html(PROGRESSBAR_POST_UPLOAD);
                  jQuery('#cancel-upload').hide();
                  stopProgress();
               }
            }
         })
      }, 2000);
         
      jQuery('#form_upload').ajaxSubmit(options); 
    
      event.preventDefault();
   });	
   
   jQuery('#close-error').click( function( event )
   {
      event.preventDefault();
      jQuery('#bg-overlay').hide();
   });
   
   jQuery('#cancel-upload').on( 'click', function( event )
   {
      event.preventDefault();
      cancel_upload = 1; 
   });
   	
});

function stopProgress()
{
   clearInterval(interval_id);
}

// post-submit callback 
function showResponse(responseText, statusText, xhr, $form)  { 
   jQuery('#progress').val('1');
   jQuery('#progress-txt').html(PROGRESSBAR_POST_UPLOAD);
   jQuery('#cancel-upload').hide();
   stopProgress();

   if (xhr.getResponseHeader('doxbox-redirect'))
   {
      window.location.replace(xhr.getResponseHeader('doxbox-redirect'));
   }
   else
   {
      // Find the Error Div and only display that in the JS error box
      jQuery('#error').html(jQuery(jQuery.parseHTML(responseText)).find('.msg_error'));
      jQuery('#progress-container').hide();
      jQuery('#error-container').show();
   }
} 
