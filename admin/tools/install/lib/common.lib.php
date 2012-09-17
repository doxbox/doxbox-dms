<?php


function fPrintMenu($next_step)
{
   global $install;
  
   $iStep = 0;
 
   print("<br />");
   foreach ($install->menu_steps as $menu_step)
   {
     $iStep++;
     if ($next_step == $iStep)
     {
       $sClassName = "current";
     }
     elseif ($next_step < $iStep)
     {
       $sClassName = "remaining";
     }
     else
     {
       $sClassName = "visited";
     }
     print("<span class=\"$sClassName\">$menu_step</span><br />\n");

   }

}

function fGetBrowserLanguage1()
{
   global $default;

   $sBrowserLanguage =  substr($_SERVER["HTTP_ACCEPT_LANGUAGE"], 0, 2);

   switch ($sBrowserLanguage)
   {
      case "ar":
         $sOwlLang = "Arabic";
         break;
      case "bg":
         $sOwlLang = "Bulgarian";
         break;
      case "bg":
         $sOwlLang = "Catalan";
         break;
      case "cs":
         $sOwlLang = "Czech";
         break;
      case "da":
         $sOwlLang = "Danish";
         break;
      case "de":
         $sOwlLang = "Deutsch";
         break;
      case "el":
         $sOwlLang = "Hellinic";
         break;
      case "en":
         $sOwlLang = "English";
         break;
      case "es":
         $sOwlLang = "Spanish";
         break;
      case "et":
         $sOwlLang = "Estonian";
         break;
      case "fi":
         $sOwlLang = "Finnish";
         break;
      case "fr":
         $sOwlLang = "French";
         break;
      case "hu":
         $sOwlLang = "Hungarian";
         break;
      case "it":
         $sOwlLang = "Italian";
         break;
      case "ja":
         $sOwlLang = "Japanese";
         break;
      case "nl":
         $sOwlLang = "Dutch";
         break;
      case "no":
         $sOwlLang = "Norwegian";
         break;
      case "pl":
         $sOwlLang = "Polish";
         break;
      case "pt":
         if(substr($_SERVER["HTTP_ACCEPT_LANGUAGE"], 0, 5 == "pt-br"))
         {
            $sOwlLang = "Brazilian";
         }
         else
         {
            $sOwlLang = "Portuguese";
         }
         break;
      case "ro":
         $sOwlLang = "Romanian";
         break;
      case "ru":
         $sOwlLang = "Russian";
         break;
      case "sk":
         $sOwlLang = "Slovak";
         break;
      case "sl":
         $sOwlLang = "Slovenian";
         break;
      case "zh":
         $sOwlLang = "Chinese-b5";
         break;
      default:
         $sOwlLang = $default->owl_lang;
         break;
   }

   //if(!file_exists($default->owl_LangDir . "/" . $sOwlLang))
   //{
      //$sOwlLang = $default->owl_lang;
   //}
   return $sOwlLang;
}


?>
