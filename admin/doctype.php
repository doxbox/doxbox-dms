<?php

/**
 * doctype.php
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

$searchable = '';
$show_desc = '';
$show_in_list = '';

global $default;

require_once(dirname(dirname(__FILE__)) . "/config/owl.php");
require_once($default->owl_fs_root . "/lib/disp.lib.php");
require_once($default->owl_fs_root . "/lib/xtpl.lib.php");
require_once($default->owl_fs_root . "/lib/owl.lib.php");


if (!fIsAdmin(true))
{
   header("Location: " . $default->owl_root_url . "/index.php?login=1&failure=8&currentdb=$default->owl_current_db");
   exit;
}

//$xtpl = new XTemplate("../templates/$default->sButtonStyle/html/admin/doctype.xtpl");
$xtpl = new XTemplate("html/admin/doctype.xtpl", "../templates/$default->sButtonStyle");
$xtpl->assign('THEME', $default->owl_graphics_url . "/" . $default->sButtonStyle);
$xtpl->assign('ROOT_URL', $default->owl_root_url);
$xtpl->assign('VIEW_WIDTH', $default->table_expand_width);

fSetLogo_MOTD();
fSetPopupHelp();

include_once($default->owl_fs_root . "/lib/header.inc");
include_once($default->owl_fs_root . "/lib/userheader.inc");

$sql = new Owl_DB;


if(isset($btn_add_doctype_x))
{
   $action = "add_doctype";
}
if(isset($btn_del_doctype_x))
{
   $action = "del_doctype";
   
}

if(isset($btn_add_field_x))
{
   $action = "add_field";
}
if(isset($btn_upd_field_x))
{
   $action = "upd_field";
}
if(!isset($nid) or empty($nid) or !is_numeric($nid))
{
   $nid = 0;
}

if (isset($myaction))
{
   if ( $myaction == $owl_lang->cancel_button )
   {
      $action ="";
   }
}
if (!isset($doctype))
{
   $doctype = null;
}
else
{
   if (!is_numeric($doctype))
   {
      $doctype = null;
   }
}

$urlArgs = array();


// *******************************************
// Delete a Document Type From the Database
// *******************************************
//
if ($action == "del_doctype")
{
   $sql = new Owl_DB;
   $sql->query("SELECT count(*) AS doccount FROM $default->owl_files_table WHERE doctype = '$doctype'");
   $sql->next_record();
   if ( $sql->f("doccount") == 0 )
   {
      $del = new Owl_DB;
      $del->query("DELETE FROM $default->owl_doctype_table WHERE doc_type_id = '$doctype'");

      $sql->query("SELECT * FROM $default->owl_docfields_table WHERE doc_type_id = '$doctype'");
      while($sql->next_record())
      {
         $del->query("DELETE FROM $default->owl_docfieldslabel_table WHERE doc_field_id = '" . $sql->f("id") ."'");
      }

      $del->query("DELETE FROM $default->owl_docfields_table WHERE doc_type_id = '$doctype'");
      $nid = 0;
      $doctype = "";
   }
   else
   {
      printError($owl_lang->err_cant_del_doc_type);
   }
   $action = "";
}

// *******************************************
// Add a New Document Type
// *******************************************
//
if ( $action == "add_doctype")
{
   $message = "";

   if ( trim($doctype) == "")
   {
      printError($message);
   }
 
   $add = new Owl_DB;
   $add->query("INSERT INTO $default->owl_doctype_table  (doc_type_name) VALUES  ('$doctype')");
   $action = "";

   $doctype= $add->insert_id($default->owl_doctype_table, 'doc_type_id');
}

// *******************************************
// Delete a Field from a Document  Type 
// *******************************************
//

if ($action == "del_field")
{
   $del = new Owl_DB;
   $del->query("DELETE FROM $default->owl_docfields_table WHERE id = '$nid'");
   $del->query("DELETE FROM $default->owl_docfieldslabel_table WHERE doc_field_id = '$nid'");
   $nid = 0;
}

if ( $action == "upd_field" )
{
   $message = "";
   
   $field_name = ereg_replace(" ","_",$field_name);
   $field_name = ereg_replace("[\(]","",$field_name);
   $field_name = ereg_replace("[\)]","",$field_name);
   $field_name = ereg_replace("[\]]","",$field_name);
   $field_name = ereg_replace("[\[]","",$field_name);

   if ( trim($field_name) == "")
   {
      $message .= $owl_lang->err_field_name_req;
   }
    
   if ( trim($field_size) == "")
   {
      $message .= $owl_lang->err_field_size_req;
   }

   if ( trim($message) <> "" )
   {
      printError($message);
   }

   $field_size = fIntializeCheckBox($field_size);
   $field_position = fIntializeCheckBox($field_position);
   $searchable = fIntializeCheckBox($searchable);
   $required = fIntializeCheckBox($required);
   $show_desc = fIntializeCheckBox($show_desc);
   $show_in_list = fIntializeCheckBox($show_in_list);

   $add = new Owl_DB;
   $add->query("UPDATE $default->owl_docfields_table  set field_name =  '$field_name',  field_position = '$field_position', field_type = '$field_type', field_values = '$field_values', field_size = '$field_size', searchable = '$searchable', show_desc = '$show_desc',required = '$required', show_in_list = '$show_in_list' WHERE id = '$fieldid'");

   $del = new Owl_DB;
   $del->query("DELETE FROM $default->owl_docfieldslabel_table WHERE doc_field_id = '$fieldid'");

   $dir = dir($default->owl_LangDir);
   $dir->rewind();

   while ($file = $dir->read())
   {
      if (is_dir($default->owl_LangDir . DIR_SEP . $file))
      {
         if ($file != "." and $file != ".." and $file != "CVS" and $file != "favicon.ico")
         {
            if (trim($field_label[$file]) == "")
            {
               $field_label[$file] = "Not Set";
            }    
            $add->query("INSERT INTO $default->owl_docfieldslabel_table  (doc_field_id, field_label, locale) values  ('$fieldid', '$field_label[$file]', '$file')");
         }
      }
   }
   $dir->close();

  $sql->query("SELECT id FROm $default->owl_files_table  WHERE doctype = '$doctype'");
   while ($sql->next_record())
   {
      $add->query("INSERT INTO $default->owl_docfieldvalues_table (file_id, field_name) values  ('" . $sql->f("id") ."', '$field_name')");
   }



   $action = "";
}

if ( $action == "add_field" )
{

   $message = "";

   $field_name = ereg_replace(" ","_",$field_name);
   $field_name = ereg_replace("[\(]","",$field_name);
   $field_name = ereg_replace("[\)]","",$field_name);
   $field_name = ereg_replace("[\]]","",$field_name);
   $field_name = ereg_replace("[\[]","",$field_name);

   if (is_array($field_label))
   {
      foreach($field_label as $lang => $label)
      {
         if ( trim($label) == "")
         {
            $message .= "[$lang]: " . $owl_lang->err_field_label_req;
         }
      }
   }
   else
   {
         if ( trim($field_label) == "")
         {
            $message .= $owl_lang->err_field_label_req;
         }
   }

   if ( trim($field_size) == "")
   {
      $message .= $owl_lang->err_field_size_req;
   }

   if ( trim($message) <> "" )
   {
      printError($message);
   }
  
   if (!isset($field_size) or empty($field_size))
   {
      $field_size = 0;
   }

   if (!isset($field_position) or empty($field_position))
   {
      $field_position = 0;
   }

   $searchable = fIntializeCheckBox($searchable);
   $required = fIntializeCheckBox($required);
   //add by maurizio (madal2005) jan 2006
   $show_desc = fIntializeCheckBox($show_desc);
   //end add by maurizio (madal2005) jan 2006
   $show_in_list = fIntializeCheckBox($show_in_list);

   $add = new Owl_DB;
   //modified by maurizio (madal2005) jan 2006
   $add->query("INSERT INTO $default->owl_docfields_table  (doc_type_id, field_name, field_position, field_type, field_values, field_size, searchable, show_desc,required, show_in_list) values  ('$doctype', '$field_name', '$field_position', '$field_type', '$field_values', '$field_size', '$searchable','$show_desc', '$required', '$show_in_list')");
  //end modified by  madal2005
   $fieldid= $add->insert_id($default->owl_docfields_table, 'id');

   $dir = dir($default->owl_LangDir);
   $dir->rewind();

   while ($file = $dir->read())
   {
      if (is_dir($default->owl_LangDir . DIR_SEP . $file))
      {
         if ($file != "." and $file != ".." and $file != "CVS" and $file != "favicon.ico")
         {
            if (trim($field_label[$file]) == "")
            {
               $field_label[$file] = "Not Set";
            }
            $add->query("INSERT INTO $default->owl_docfieldslabel_table  (doc_field_id, field_label, locale) values  ('$fieldid', '$field_label[$file]', '$file')");
         }
      }
   }
   $dir->close();

   $action = "";
}

if ($default->show_prefs == 1 or $default->show_prefs == 3)
{
   fPrintPrefsXTPL('Top');
}

fPrintAdminPanelXTPL("doctypes");


if ( $doctype == "add_doctype" )
{

   $xtpl->assign('FORM', "<form enctype=\"multipart/form-data\" action=\"" . $_SERVER["PHP_SELF"] ."\" method=\"post\">");
   $urlArgs['sess']      = $sess;
   $urlArgs['action']      = 'add_doctype';
   $xtpl->assign('HIDDEN_FIELDS', fGetHiddenFields ($urlArgs));

   $xtpl->assign('DOCTYPE_HEADING', $owl_lang->doc_administration);

   $xtpl->assign('DOCTYPE_NEWNAME_LABEL', $owl_lang->document_type_name );

   $xtpl->assign('DOCTYPE_BTN_CREATE_VALUE', $owl_lang->btn_create);
   $xtpl->assign('DOCTYPE_BTN_CREATE_ALT', $owl_lang->alt_new_doctype);

   $xtpl->assign('DOCTYPE_BTN_CANCEL_VALUE', $owl_lang->cancel_button);
   $xtpl->assign('DOCTYPE_BTN_CANCEL_ALT', $owl_lang->alt_cancel);
   
   $xtpl->parse('main.DocType.New');
}
else
{
   $xtpl->assign('FORM', "<form enctype=\"multipart/form-data\" action=\"" . $_SERVER["PHP_SELF"] ."\" method=\"post\">");
   
   $urlArgs['sess']      = $sess;

   $xtpl->assign('DOCTYPE_HEADING', $owl_lang->doc_administration);

   $sql = new Owl_DB;
   $fieldlabel = new Owl_DB;
   $sql->query("SELECT * FROM $default->owl_doctype_table");

   $xtpl->assign('DOCTYPE_LABEL', $owl_lang->document_type);

   while ($sql->next_record())
   {
      $xtpl->assign('DOCTYPE_LIST_SELECTED', '');
      $xtpl->assign('DOCTYPE_LIST_VALUE', $sql->f("doc_type_id"));
      if ( $sql->f("doc_type_id") == $doctype )
      {
         $xtpl->assign('DOCTYPE_LIST_SELECTED', " selected=\"selected\"");
      }
      $xtpl->assign('DOCTYPE_LIST_LABEL', $sql->f("doc_type_name"));
      $xtpl->parse('main.DocType.List.Values');
   }
   $xtpl->assign('DOCTYPE_ADD_NEW_LABEL', $owl_lang->doc_new_doc_type);
   $xtpl->parse('main.DocType.List');

   if ( $doctype  > 1 )
   {
      if ($action == "edit_field")
      {
         $sql->query("SELECT * FROM $default->owl_docfields_table WHERE id = '$nid'");
         $sql->next_record();
         $urlArgs['fieldid']      = $sql->f("id");;
         $urlArgs['action']      = 'upd_field';
      }

      $xtpl->assign('DOCTYPE_FIELDNAME_LABEL', $owl_lang->doc_field_name);
      $xtpl->assign('DOCTYPE_FIELDNAME_VALUE', $sql->f("field_name"));

      $xtpl->assign('DOCTYPE_FIELDPOS_LABEL', $owl_lang->doc_field_pos);
      $xtpl->assign('DOCTYPE_FIELDPOS_VALUE', $sql->f("field_position"));
      
      $xtpl->assign('DOCTYPE_FIELDLABEL_LABEL', $owl_lang->doc_field_label);

         $dir = dir($default->owl_LangDir);
         $dir->rewind();
         while ($file = $dir->read())
         {
	    if (is_dir($default->owl_LangDir . DIR_SEP . $file))
            {
               if ($file != "." and $file != ".." and $file != "CVS" and $file != "favicon.ico")
               {
                  $fieldlabel->query("SELECT * FROM $default->owl_docfieldslabel_table WHERE doc_field_id ='$nid' and locale = '$file'");
                  $fieldlabel->next_record();
                  $xtpl->assign('DOCTYPE_FIELDLABEL_LOCALE_LABEL', $file);
                  $xtpl->assign('DOCTYPE_FIELDLABEL_LOCALE_VALUE', $fieldlabel->f("field_label"));
                  $xtpl->parse('main.DocType.NewField.Locale');
               }
            }
         }
         $dir->close();

      $xtpl->assign('DOCTYPE_FIELDSIZE_LABEL', $owl_lang->doc_field_size);
      $xtpl->assign('DOCTYPE_FIELDSIZE_VALUE', $sql->f("field_size"));

      
      $xtpl->assign('DOCTYPE_FIELDSEARCHABLE_LABEL', $owl_lang->doc_field_searchable);
      $xtpl->assign('DOCTYPE_FIELDSEARCHABLE_CHECKED', fIsCheckBoxChecked($sql->f("searchable")));
      
      $xtpl->assign('DOCTYPE_FIELDREQ_LABEL', $owl_lang->doc_field_required);
      $xtpl->assign('DOCTYPE_FIELDREQ_CHECKED', fIsCheckBoxChecked($sql->f("required")));

      $xtpl->assign('DOCTYPE_FIELDPOP_LABEL', $owl_lang->doc_field_popup);
      $xtpl->assign('DOCTYPE_FIELDINLIST_LABEL', $owl_lang->doc_field_show_in_list);

      $xtpl->assign('DOCTYPE_FIELDINLISTPOP_CHECKED', fIsCheckBoxChecked($sql->f("show_in_list")));
       
   $xtpl->assign('DOCTYPE_FIELDTYPE_LABEL', $owl_lang->doc_field_type);

   $aFieldType[0][0] = "text";
   $aFieldType[0][1] = $owl_lang->field_type_text; //"Text Field";
   $aFieldType[1][0] = "picklist";
   $aFieldType[1][1] = $owl_lang->field_type_picklist; //"Pick List";
   $aFieldType[2][0] = "textarea";
   $aFieldType[2][1] = $owl_lang->field_type_textarea; //"Text Area";
   $aFieldType[3][0] = "checkbox";
   $aFieldType[3][1] = $owl_lang->field_type_checkbox; //"Check Box";
   $aFieldType[4][0] = "mcheckbox";
   $aFieldType[4][1] = $owl_lang->field_type_mcheckbox; //"Multiple Check Box";
   $aFieldType[5][0] = "radio";
   $aFieldType[5][1] = $owl_lang->field_type_radio; //"Radio Buttons";
   $aFieldType[6][0] = "seperator";
   $aFieldType[6][1] = $owl_lang->field_type_separator; //"Section Seperator";

   $aFieldType[7][0] = "table";
   $aFieldType[7][1] = $owl_lang->field_type_table;
   $aFieldType[8][0] = "url";
   $aFieldType[8][1] = $owl_lang->field_type_URL;
   $aFieldType[9][0] = "date";
   $aFieldType[9][1] = $owl_lang->field_type_Date;

   $rows = array();
   $rows = fPrintFormSelectBoxXTPL("FIELDTYPE" , "field_type", $aFieldType, $sql->f("field_type"));
   $rowsize = count($rows);

   for ($i=1; $i<=$rowsize; $i++)
   {
     $xtpl->assign('SELECT_BOX', $rows[$i]);
     $xtpl->parse('main.DocType.NewField.FieldType');
   }

   $xtpl->assign('DOCTYPE_FIELDVALUES_LABEL', $owl_lang->doc_field_values);
   $xtpl->assign('DOCTYPE_FIELDVALUES_VALUE', $sql->f("field_values"));



      if ($action == "edit_field")
      {
         $xtpl->assign('DOCTYPE_BTN_EDITFIELD_VALUE', $owl_lang->change);
         $xtpl->assign('DOCTYPE_BTN_EDITFIELD_ALT', $owl_lang->alt_upd_field);
         $xtpl->parse('main.DocType.NewField.EditField');
      }
      else
      {
         $xtpl->assign('DOCTYPE_BTN_ADDFIELD_VALUE', $owl_lang->btn_add_field);
         $xtpl->assign('DOCTYPE_BTN_ADDFIELD_ALT', $owl_lang->alt_add_field);
         $xtpl->assign('DOCTYPE_BTN_DELDOCTYP_VALUE', $owl_lang->btn_deldoctype);
         $xtpl->assign('DOCTYPE_BTN_DELDOCTYP_ALT', $owl_lang->alt_deldoctype);
         $xtpl->parse('main.DocType.NewField.AddField');
      }
      $xtpl->assign('DOCTYPE_BTN_RESET_VALUE', $owl_lang->btn_reset);
      $xtpl->assign('DOCTYPE_BTN_RESET_ALT', $owl_lang->alt_reset_form);
      $xtpl->parse('main.DocType.NewField');

   }

   if (!isset($doctype) or empty($doctype))
   {
      $doctype = 0;
   }

   $sql->query("SELECT * FROM $default->owl_docfields_table WHERE doc_type_id = '$doctype' order by field_position");

   if ($sql->num_rows() > 0)
   {
      $xtpl->assign('DOCTYPE_FIELD_NAME_TITLE', $owl_lang->doc_field_name);
      $xtpl->assign('DOCTYPE_FIELD_POS_TITLE', $owl_lang->doc_field_pos);
      $xtpl->assign('DOCTYPE_FIELD_LABEL_TITLE', $owl_lang->doc_field_label);
      $xtpl->assign('DOCTYPE_FIELD_SIZE_TITLE', $owl_lang->doc_field_size);
      $xtpl->assign('DOCTYPE_FIELD_SEARCHABLE_TITLE', $owl_lang->doc_field_searchable);
      $xtpl->assign('DOCTYPE_FIELD_REQUIRED_TITLE', $owl_lang->doc_field_required);
      $xtpl->assign('DOCTYPE_FIELD_POPUP_TITLE', $owl_lang->doc_field_popup);
      $xtpl->assign('DOCTYPE_FIELD_BROWSE_TITLE', $owl_lang->doc_field_show_in_browse);
      $xtpl->assign('DOCTYPE_FIELD_SAMPLE_TITLE', $owl_lang->doc_field_sample);

      $CountLines = 0;
      while ($sql->next_record())
      {
         $CountLines++;
         $PrintLines = $CountLines % 2;
         if ($PrintLines == 0)
         {
            $sTrClass = "file1";
            $sLfList = "lfile1";
         }
         else
         {
            $sTrClass = "file2";
            $sLfList = "lfile1";
         }

         $xtpl->assign('DOCTYPE_TD_STYLE', $sTrClass);
         
         $xtpl->assign('DOCTYPE_EDIT_FIELD_URL', "doctype.php?&amp;sess=" . $sess . "&amp;action=edit_field&amp;doctype=$doctype&amp;nid=" . $sql->f("id"));
         $xtpl->assign('DOCTYPE_EDIT_FIELD_ALT', $owl_lang->alt_edit_field);

         $xtpl->assign('DOCTYPE_DEL_FIELD_URL', "doctype.php?&amp;sess=" . $sess . "&amp;action=del_field&amp;doctype=$doctype&amp;nid=" . $sql->f("id"));
         $xtpl->assign('DOCTYPE_DEL_FIELD_ALT', $owl_lang->alt_del_field);
         $xtpl->assign('DOCTYPE_DEL_FIELD_CONFIRM', $owl_lang->reallydelete . " " .$sql->f("field_name") . " ?");
         
         $xtpl->assign('DOCTYPE_FIELD_NAME_VALUE', $sql->f("field_name"));
         $xtpl->assign('DOCTYPE_FIELD_POS_VALUE', $sql->f("field_position"));

         $fieldlabel->query("SELECT * FROM $default->owl_docfieldslabel_table WHERE doc_field_id ='" . $sql->f("id") ."' ORDER BY locale");

         $SubTableCountLines = 0;
         while ( $fieldlabel->next_record() )
         {
            $SubTableCountLines++;
            $PrintLines = $SubTableCountLines % 2;
            if ($PrintLines == 0)
            {
              $sTrClass1 = "file1";
              $sLfList = "lfile1";
            }
            else
            {
               $sTrClass1 = "file2";
               $sLfList = "lfile1";
            }

            $xtpl->assign('DOCTYPE_LOCALE_TD_STYLE', $sTrClass1);
            $xtpl->assign('DOCTYPE_LOCALE_LABEL', $fieldlabel->f("locale"));
            $xtpl->assign('DOCTYPE_LOCALE_VALUE', $fieldlabel->f("field_label"));
            $xtpl->parse('main.DocType.FieldList.Field.Locale');
         }

         $xtpl->assign('DOCTYPE_FIELD_SIZE_VALUE', $sql->f("field_size"));

         $xtpl->assign('DOCTYPE_FIELD_SEARCHABLE_VALUE', $owl_lang->status_no);
         if ($sql->f("searchable") == 1)
         {
            $xtpl->assign('DOCTYPE_FIELD_SEARCHABLE_VALUE', $owl_lang->status_yes);
         }
      
         $xtpl->assign('DOCTYPE_FIELD_REQUIRED_VALUE', $owl_lang->status_no);
         if ($sql->f("required") == 1)
         {
            $xtpl->assign('DOCTYPE_FIELD_REQUIRED_VALUE', $owl_lang->status_yes);
         }
		 
         $xtpl->assign('DOCTYPE_FIELD_SHOWDESC_VALUE', $owl_lang->status_no);
         if ($sql->f("show_desc") == 1)
         {
            $xtpl->assign('DOCTYPE_FIELD_SHOWDESC_VALUE', $owl_lang->status_yes);
         }
		 
         $xtpl->assign('DOCTYPE_FIELD_REQUIRED', '&nbsp;');
         if ($sql->f("required") == "1")
         {
            $xtpl->assign('DOCTYPE_FIELD_REQUIRED', '*');
         }

         $xtpl->assign('DOCTYPE_FIELD_INLIST_VALUE', $owl_lang->status_no);

         if ($sql->f("show_in_list") == 1)
         {
            $xtpl->assign('DOCTYPE_FIELD_INLIST_VALUE', $owl_lang->status_yes);
         }

         $xtpl->assign('DOCTYPE_FIELD_TYPE_TITLE', $owl_lang->doc_field_disp_label);
         $xtpl->assign('DOCTYPE_FIELD_TYPE_NAME', $sql->f("field_name"));
         $xtpl->assign('DOCTYPE_FIELD_TYPE_SIZE', $sql->f("field_size"));
         switch ($sql->f("field_type"))
         {
            case "text":
               $xtpl->assign('DOCTYPE_FIELD_TYPE_VALUE', $sql->f("field_values"));
               $xtpl->parse('main.DocType.FieldList.Field.Text');
               break;
            case "picklist":
               $aPickList = array();

               $aPickList = split("\|",  $sql->f("field_values"));
               foreach ($aPickList as $sValues)
               {
                    $xtpl->assign('DOCTYPE_FIELD_TYPE_VALUE', $sValues);
                    $xtpl->parse('main.DocType.FieldList.Field.PickList.Value');
               }
               $xtpl->parse('main.DocType.FieldList.Field.PickList');
               break;

               case "table":
                  $table = $sql->f("field_values");

                  $table = 'ut_entities';
                  $qTablePickValue = new Owl_Db;
                  $qTablePickValue->query("SELECT * FROM $table ORDER BY descr");
                  while ($qTablePickValue->next_record())
                  {
                     $xtpl->assign('DOCTYPE_FIELD_TYPE_VALUE', $qTablePickValue->f("descr"));
                     $xtpl->parse('main.DocType.FieldList.Field.Table.Value');
                  }
                  $xtpl->parse('main.DocType.FieldList.Field.Table');
                  break;
               case "url":
                  $aURL = split("\|", $sql->f("field_values"));
                  $xtpl->assign('DOCTYPE_FIELD_TYPE_URL_LOC', $aURL[1]);
                  $xtpl->assign('DOCTYPE_FIELD_TYPE_URL_LABEL', $aURL[0]);
                  $xtpl->parse('main.DocType.FieldList.Field.Url');
                  break;
               case "date":
                  $xtpl->parse('main.DocType.FieldList.Field.Calendar');
                  break;
               case "textarea":
                    $xtpl->assign('DOCTYPE_FIELD_TYPE_VALUE', $sql->f("field_values"));
                    $xtpl->assign('DOCTYPE_FIELD_TYPE_TEXTAREA_ROWS', $sql->f("field_size"));
                    $xtpl->parse('main.DocType.FieldList.Field.TextArea');
                  break;
               case "seperator":
                  $xtpl->assign('DOCTYPE_FIELD_TYPE_VALUE', $owl_lang->doc_field_disp_label);
                  $xtpl->parse('main.DocType.FieldList.Field.Seperator');
                  break;
               case "mcheckbox":
                 $aMultipleCheckBox = split("\|",  $sql->f("field_values"));
                 $i = 0;
                 $iNumberColumns  = $sql->f("field_size");
                 foreach ($aMultipleCheckBox as $sValues)
                 {
                  
                    $iColumnCount = $i % $iNumberColumns;
                    if ($iColumnCount == 0)
                    {
                      $xtpl->parse('main.DocType.FieldList.Field.mCheckBox.NewCol');
                    }

                    $xtpl->assign('DOCTYPE_FIELD_TYPE_VALUE', $sValues);
                    $xtpl->assign('DOCTYPE_FIELD_TYPE_ID', $i);

                    $xtpl->parse('main.DocType.FieldList.Field.mCheckBox.NewCol.Value');
                    $i++;
                 }
                 for ($c = 0; $c < $iNumberColumns - $iColumnCount - 1; $c++)
                 {
                    $xtpl->parse('main.DocType.FieldList.Field.mCheckBox.NewCol.ValueFiller');
                 }

                 $xtpl->parse('main.DocType.FieldList.Field.mCheckBox.NewCol');
                 $xtpl->parse('main.DocType.FieldList.Field.mCheckBox');
                 break;
              case "radio":
                 $aRadioButtons = split("\|",  $sql->f("field_values"));
                 foreach ($aRadioButtons as $sValues)
                 {
                    $xtpl->assign('DOCTYPE_FIELD_TYPE_VALUE', $sValues);
                    $xtpl->parse('main.DocType.FieldList.Field.Radio.Value');
                 }
                 $xtpl->parse('main.DocType.FieldList.Field.Radio');
                 break;
              case "checkbox":
                $xtpl->assign('DOCTYPE_FIELD_TYPE_CHECKED', '');
                if($sql->f("field_values"))
                {
                   $xtpl->assign('DOCTYPE_FIELD_TYPE_CHECKED', 'checked="checked"');
                }
                $xtpl->assign('DOCTYPE_FIELD_TYPE_VALUE', $sValues);
                $xtpl->parse('main.DocType.FieldList.Field.CheckBox');
                break;
         }
      $xtpl->parse('main.DocType.FieldList.Field');
      }
      $xtpl->parse('main.DocType.FieldList');
   }
}


if ($default->show_prefs == 2 or $default->show_prefs == 3)
{
   fPrintPrefsXTPL('Bottom');
}

fSetElapseTime();
fSetOwlVersion();
$xtpl->assign('HIDDEN_FIELDS', fGetHiddenFields ($urlArgs));
$xtpl->parse('main.DocType');
$xtpl->parse('main.Footer');
$xtpl->parse('main');
$xtpl->out('main');

?>
