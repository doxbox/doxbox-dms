// Function that based on button type
// Sets the correct down class

function fGetDownClass (oInput)
{
   var downclass = 'fbuttondown1';

   var sInputType = jQuery(oInput).prop('type')

   if (sInputType == 'reset')
   {
      downclass = 'fbuttondown_green';
   }
   else if (sInputType == 'submit')
   {
      if (jQuery(oInput).prop('name').indexOf('del') >= 0 || 
          jQuery(oInput).prop('name').indexOf('empty') >= 0)
      {
         downclass = 'fbuttondown_red';
      }
   }
   return downclass
}
