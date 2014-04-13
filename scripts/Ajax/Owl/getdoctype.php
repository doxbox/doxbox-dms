<?php

/**
 * getdoctype.php
 *
 * Author: Steve Bourgeois <owl@bozzit.com>
 *
 * Copyright (c) 2006-2009 Bozz IT Consulting Inc
 *
 * Licensed under the GNU GPL. For full terms see the file LICENSE.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *
 */

require_once(dirname(dirname(dirname(dirname(__FILE__))))."/config/owl.php");
require_once($default->owl_fs_root ."/lib/disp.lib.php");
require_once($default->owl_fs_root ."/lib/owl.lib.php");
require_once($default->owl_fs_root ."/lib/security.lib.php");

if (isset($sess) and (!$sess == 0))
{
   if (isset($readonly) and $readonly == 'RO')
   {
      $readonly = 'readonly="readonly"';
   }
   else
   {
      $readonly = '';
   }
   if (isset($doctype) and is_numeric($doctype))
   {
      if (isset($fileid) and is_numeric($fileid))
      {
         $iFileID = $fileid;
      }
      else
      {
         $iFileID = 0;
      }
      print("<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\" width=\"100%\">\n");
      $sql->query("SELECT * from $default->owl_docfields_table where doc_type_id = '$doctype' order by field_position");
   
      $qFieldLabel = new Owl_DB;
   
      $bPrintInitialHeading = true;
   
   
      while ($sql->next_record())
      {
         $qFieldLabel->query("SELECT field_label from $default->owl_docfieldslabel_table where locale = '$language' and doc_field_id='" . $sql->f('id') . "'");
         $qFieldLabel->next_record();
   
         if($bPrintInitialHeading)
         {
            if ($sql->f("field_position") == 1 and $sql->f("field_type") == "seperator")
            {
               print("<tr><td class=\"browse0\" width=\"100%\" colspan=\"2\">" . $qFieldLabel->f("field_label") ."</td></tr>\n");
            }
            else
            {
               print("<tr><td class=\"browse0\" width=\"100%\" colspan=\"2\">$owl_lang->doc_specific</td></tr>\n");
            }
            $bPrintInitialHeading = false;
         }
   
   
         if ($sql->f("required") == "1")
         {
            $required = "<font color=red><b>&nbsp;*&nbsp;</b></font>";
         }
         else
         {
            $required = "<font color=red><b>&nbsp;&nbsp;&nbsp;</b></font>";
         }
   
         $sCurrentValue = fGetDoctypeFieldValue($iFileID, $sql->f("field_name"), $sql->f("field_values"));
         switch ($sql->f("field_type"))
         {
            case "seperator":
               if ($sql->f("field_position") > 1)
               {
                  print("<tr><td class=\"browse0\" width=\"100%\" colspan=\"2\" align=\"middle\">" . $qFieldLabel->f("field_label") ."</td></tr>\n");
               }
               break;
            case "text":
               print("<tr><td  class=\"form1\">". $qFieldLabel->f("field_label") .":");
               print("$required</td>\n");
               print("<td  class=\"form1\" width=\"100%\">");
               print("<input class=\"finput1\" type=\"text\" name=\"" . $sql->f("field_name") . "\" size=\"" . $sql->f("field_size") ."\" value= \"" .  $sCurrentValue ."\" $readonly />");
               print("</td>\n</tr>\n");
               print("</td></tr>");
               break;
            case "picklist":
              $aPickListValues = array();;
              $aPickList = array();
   
              $aPickList = split("\|",  $sql->f("field_values"));
              $i = 0;
              foreach ($aPickList as $sValues)
              {
                 $aPickListValues[$i][0] = $sValues;
                 $aPickListValues[$i][1] = $sValues;
                 $i++;
              }
              fPrintFormSelectBox($qFieldLabel->f("field_label") .": $required", $sql->f("field_name"), $aPickListValues, $sCurrentValue);
              break;
//****************************************************************************************************
// BEGIN ADD Filipe Lima (filipe.aclima@gmail.com) - March 2009
//****************************************************************************************************
                        case "table":
                            $aPickListValues = array();
                            $table = $sql->f("field_values");
                            $qTablePickValue = new Owl_Db;
                            $qTablePickValue->query("SELECT * FROM $table ORDER BY descr");
                            $i = 0;
                            while ($qTablePickValue->next_record())
                            {
                                $aPickListValues[$i][0] = $qTablePickValue->f("descr");
                                $aPickListValues[$i][1] = $qTablePickValue->f("descr");
                                $i++;
                            }
                            fPrintFormTableSelectBox($qFieldLabel->f("field_label") . ": $required", $sql->f("field_name"), $aPickListValues, $sCurrentValue);
                            break;
                        case "url":
                            $aURL = split("\|", $sql->f("field_values"));
                            fPrintURL($qFieldLabel->f("field_label"), $aURL[0], $aURL[1]);
                            break;
                        case "date":
                            print("<tr>\n<td  class=\"form1\">". $qFieldLabel->f("field_label") .":");
                            print("$required</td>\n");
                            print("<td  class=\"form1\">");
                            print("<input class=\"finput1\" type=\"text\" id=\"" . $sql->f("field_name") . "\" name=\"" . $sql->f("field_name") . "\" size=\"" . $sql->f("field_size") ."\" readonly=\"readonly\" value= \"" .  $sCurrentValue ."\" />");
                            //if(!isset($readonly))
                            //{
print("<script>
 jQuery( \"#" . $sql->f("field_name") ."\" ).datetimepicker({
                        showOn: \"button\",
                        dateFormat: 'yy/mm/dd',
                        showButtonPanel: false,
                        buttonImage: \"templates/" . $default->sButtonStyle . "/ui_icons/calendar_day.png\",
                        buttonImageOnly: true,
                        onClose: function(date) {
                        },
                        beforeShow: function()
                        {
                             setTimeout(function()
                             {
                                 $(\".ui-datepicker\").css(\"z-index\", 11);
                             }, 10);
                        }

                });
</script>");

                            //}
                            print("</td>\n</tr>\n");
                        break;
//****************************************************************************************************
// END ADD Filipe Lima (filipe.aclima@gmail.com) - MArch 2009
//****************************************************************************************************
           case "mcheckbox":
              $aMultipleCheckBox = split("\|",  $sql->f("field_values"));
               if (empty($fileid))
               {
                  $aCurrentValues = array();
               }
               else
               {
                 $aCurrentValues = split("\|",  $sCurrentValue);
               }
              $i = 0;
              $iNumberColumns  = $sql->f("field_size");
              print("<tr><td class=\"browse0\" width=\"100%\" colspan=\"2\">" . $qFieldLabel->f("field_label") ." $required</td></tr>\n");
              print("<tr>\n<td colspan=\"2\">\n<table class=\"form1\" width=\"100%\">\n");
              foreach ($aMultipleCheckBox as $sValues)
              {
                 $iColumnCount = $i % $iNumberColumns;
                 if ($iColumnCount == 0)
                 {
                   print("<tr>\n");
                 }
                 if (in_array($sValues, $aCurrentValues))
                 {
                    $sIsChecked = ' checked="checked"';
                 }
                 else
                 {
                    $sIsChecked = '';
                 }
                 print("<td class=\"form9\" width=\"1%\">");
                 print("<input class=\"fcheckbox1\" type=\"checkbox\" name=\"" . $sql->f("field_name") . "_$i\" value=\"".$sValues."\" $sIsChecked $readonly/>");
                 print("</td>\n");
                 print("<td  class=\"form9\">");
                 print("$sValues");
                 print("</td>\n");
                 if ($iColumnCount == ($iNumberColumns - 1))
                 {
                   print("</tr>\n");
                 }
                 $aMultipleCheckBox[$i]= $sValues;
                 $i++;
              }
              for ($c = 0; $c < $iNumberColumns - $iColumnCount - 1; $c++)
              {
                 print("<td  class=\"form9\">&nbsp;</td>\n");
                 print("<td  class=\"form9\">&nbsp;</td>\n");
              }
              print("</tr>\n</table>\n");
              print("</td>\n</tr>\n");
            break;
            case "radio":
               $aRadioButtonValues = array();
               $aRadioButtons = split("\|",  $sql->f("field_values"));
               $i = 0;
               foreach ($aRadioButtons as $sValues)
               {
                  $aRadioButtonValues[$i]= $sValues;
                  $i++;
               }
               if (empty($fileid))
               {
                     $sCurrentValue = $aRadioButtonValues['0'];
               }
               fPrintFormDoctypeRadio($qFieldLabel->f("field_label") .": $required" , $sql->f("field_name"), $sCurrentValue, $aRadioButtonValues, $readonly);
            break;
            case "textarea":
               fPrintFormTextArea($qFieldLabel->f("field_label"). ": $required", $sql->f("field_name"), $sCurrentValue, $sql->f("field_size"), $readonly);
            break;
   
            case "checkbox":
               //$checked = "";
               //{
                  //$checked = "checked";
               //}
               //if (empty($fileid))
               //{
                     //$checked = "";
               //}
               //fPrintFormCheckBox($qFieldLabel->f("field_label"). ": $required", $sql->f("field_name"), '1', $checked, '', $readonly);
               $checked = "";
               if($sql->f("field_values"))
               {
                  $checked = "checked";
               }
               if($sCurrentValue)
               {
                  $checked = "checked";
               }
               if (empty($fileid))
               {
                     $checked = "";
               }
               fPrintFormCheckBox($qFieldLabel->f("field_label"). ": $required", $sql->f("field_name"), $qFieldLabel->f("field_label"), $checked);
            break;

            break;
   
         }
   
      }
   
      if ($sql->num_rows($sql) > 0)
      {
         print("<tr><td class=\"browse0\" width=\"100%\" colspan=\"2\">&nbsp;</td></tr>\n");
      }
   
      print("</table>\n");
   }
}
function fGetDoctypeFieldValue ($iFileID, $sFieldName, $sPassedValue)
{
   global $default;

   if ($iFileID > 0)
   {
      $qFieldValue = new Owl_DB;
      $qFieldValue->query("SELECT field_value from $default->owl_docfieldvalues_table where file_id = '$iFileID' and field_name='$sFieldName'");
      $qFieldValue->next_record();
      return  $qFieldValue->f('field_value');
   }
   return  $sPassedValue;
}
?>
