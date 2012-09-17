<?php

/**
 * indexing.lib.php
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
 * $Id: indexing.lib.php,v 1.5 2006/11/16 16:02:40 b0zz Exp $
 */

defined( 'OWL_INCLUDE' ) or die( 'Access Denied' );

function DoesFileIDContainKeyword($fileid, $query)
{
   global $default ,$cCommonDBConnection;

   $sql = $cCommonDBConnection;

   if (empty($sql))
   {
      $sql = new Owl_DB;
   }

   if (empty($query))
   {
      $query = "1=1";
   }

   $sql->query("SELECT owlfileid from $default->owl_searchidx where ($query) and owlfileid = '$fileid'");

   return $sql->num_rows();
}

function MTE_validUTF8($string)
{
    $sample = @iconv('utf-8', 'utf-8', $string);
    if (md5($sample) == md5($string))
    {
        return true;
    }
    else
    {
        return false;
    }
}


function IndexATextFile($filename, $owlfileid)
{
   global $default, $owl_lang;

   $fileidnum = $owlfileid;

   $sql = new Owl_DB;
   $sql->query("SELECT * from $default->owl_wordidx"); //Import all words and indexes
   $nextwordindex = 0;
   $wordindex = array();
   while ($sql->next_record()) // this may get ugly, we could have 100K words and indexes, they gotta go into memory.
   {
      $wordindex[$sql->f("word")] = $sql->f("wordid");
      if ($sql->f("wordid") > $nextwordindex)
      {
         $nextwordindex = $sql->f("wordid"); //get largest word index in table
      } 
   } 
   $nextwordindex++;

   // Note: again, here we've just read in the big wordidx, we should index as many
   // files as possible while we have this index in memory, here we
   // only index a single filename, but if someone wants to greatly improve performance,
   // index an array of filenames here...
   if (file_exists($filename))
   {
      $fp = fopen($filename, "rb");
      while (!feof($fp))
      {
         $line = fgetss($fp, 4096);
         if (!MTE_validUTF8($line))
         {
            // Lets see if this text file is a Windows File and converted it to UTF8
            $line = iconv('windows-1252', 'utf-8', $line);
         }
         $line = strtolower($line);
         // this line added to deal with WORD Tables
         //$line = str_replace("|", " ",$line);
         //$line = str_replace("/", " ",$line);
         //$line = str_replace("\\", " ",$line);
         // remove long _____________________________  lines
         //$line = preg_replace('*__*', '', $line);
         $line = preg_replace( '/[^[:print:]]/', ' ',$line);
         $line = preg_replace( '/[[:punct:]]/', ' ',$line);
         $line = preg_replace( '/[[:digit:]]/', ' ',$line);

         //$wordtemp = preg_split("/\W/", $line); //split line into words a word is any # of A-Za-z's separated by somethign not a-zA-Z
         $wordtemp = preg_split("/\s+/", $line); //split line into words a word is any # of A-Za-z's separated by somethign not a-zA-Z

         if (!isset($wordtemp)) continue;
   
         foreach($wordtemp as $wd)
         {
            if ( MTE_validUTF8($wd) )
            {
               $wd = trim($wd);
               $wd = stripslashes(fOwl_ereg_replace("[$default->list_of_chars_to_remove_from_wordidx]","",$wd));
               $wd = fReplaceSpecial($wd);
               if (!is_numeric($wd) and strlen(trim($wd)) < 3)
               {   
                  continue;
               }

               //$wd = preg_replace( '/[^[:print:]]/', '',$wd);
               //$wd = preg_replace( '/[[:punct:]]/', '',$wd);
               //$wd = preg_replace( '/[[:digit:]]/', '',$wd);
               if (strlen(trim($wd)) > 0 and strlen(trim($wd))  < 128) 
               {
                  if(isset($words[$wd]))
                  {
                     $words[$wd]++; //keep a count of how often each word is seen
                  }
                  else
                  {
                     $words[$wd] = 1;
                  }
                  //print("WORDS: $words[$wd] ---- ");
                  if ($words[$wd] == 1) // if this is the first time we've seen this word in this document...
                  {
                     if (isset($wordindex[$wd])) // if this word was already in the wordidx table...
                     {
                        $sql->query("INSERT INTO $default->owl_searchidx VALUES('$wordindex[$wd]','$fileidnum')"); //add a searchidx table entry for this fileidnum (owlidnum)
                     } 
                     else // if word not in word index, add to both wordidx and searchidx
                     {
                         if (!empty($default->words_to_exclude_from_wordidx))
                         {
                            $WordList = array();
                            $WordList = $default->words_to_exclude_from_wordidx;
   
                            $checkword = $wd;

                            if (!(preg_grep("/$checkword/", $WordList)))
                            {
                               $wordindex[$wd] = $nextwordindex; //first remember this word as being in the wordindex
                               $sql->query("INSERT into $default->owl_searchidx values('$wordindex[$wd]', '$fileidnum')"); //add pointer to owlidnum for this wordindexnum
   
                               $wd = addslashes($wd);
                               $sql->query("SELECT wordid from $default->owl_wordidx where word = '$wd'");
                               $numrows = $sql->num_rows($sql);
                               if ( $numrows == 0 )
                               {
                                  $sql->query("INSERT IGNORE into $default->owl_wordidx values('$nextwordindex', '$wd')");
                                  $nextwordindex++;
                               }
                            }
                         }
                         else
                         {
                            $wordindex[$wd] = $nextwordindex; //first remember this word as being in the wordindex
                            $sql->query("INSERT into $default->owl_searchidx values('$wordindex[$wd]', '$fileidnum')"); //add pointer to owlidnum for this wordindexnum
   
                            $wd = addslashes($wd);
                            $sql->query("SELECT wordid from $default->owl_wordidx where word = '$wd'");
                            $numrows = $sql->num_rows($sql);
                            if ( $numrows == 0 )
                            {
                               $sql->query("INSERT IGNORE into $default->owl_wordidx values('$nextwordindex', '$wd')");
                               $nextwordindex++;
                            }
                         }
                     } 
                  } //if first instance of this word...
               }
            } // Check if UTF-8
         } //for each word
      } //while!feof
   } 
   else
   {
      if ($default->debug == true)
      {
         printError("DEBUG: $owl_lang->err_file_indexing");
      } 
   }
}

function IndexABigString($bigstring, $owlfileid)
{
   global $default;

   $fileidnum = $owlfileid;

   $sql = new Owl_DB;
   $sql->query("SELECT * from $default->owl_wordidx"); //Import all words and indexes
   $nextwordindex = 0;
   $wordindex = array();
   while ($sql->next_record()) // this may get ugly, we could have 100K words and indexes, they gotta go into memory.
   {
      $wordindex[$sql->f("word")] = $sql->f("wordid");
      if ($sql->f("wordid") > $nextwordindex)
      {
         $nextwordindex = $sql->f("wordid"); //get largest word index in table
      } 
   } 
   $nextwordindex++;

  $bigstring = preg_replace( '/[^[:print:]]/', ' ',$bigstring);
  $bigstring = preg_replace( '/[[:punct:]]/', ' ',$bigstring);
  $bigstring = preg_replace( '/[[:digit:]]/', ' ',$bigstring);
   // Note: again, here we've just read in the big wordidx, we should index as many
   // files as possible while we have this index in memory, here we
   // only index a single filename, but if someone wants to greatly improve performance,
   // index an array of filenames here...
   $wordtemp = preg_split("/\s+/", strtolower($bigstring)); //split line into words a word is any # of A-Za-z's separated by somethign not a-zA-Z
   if (!isset($wordtemp)) return;
   $words = array(); 
   foreach($wordtemp as $wd)
   {
      if ( MTE_validUTF8($wd) )
      {
          $wd = trim($wd);
          $wd = fReplaceSpecial($wd);
          $wd = stripslashes(fOwl_ereg_replace("[$default->list_of_chars_to_remove_from_wordidx]","",$wd));
          if (!is_numeric($wd) and strlen(trim($wd)) < 3)
          {
             continue;
          }
          //$wd = preg_replace( '/[^[:print:]]/', '',$wd);
          //$wd = preg_replace( '/[[:punct:]]/', '',$wd);
          //$wd = preg_replace( '/[[:digit:]]/', ' ',$wd);

         if (strlen(trim($wd)) > 0 and strlen(trim($wd))  < 128) 
         {
            if (!isset($words[$wd]))
            {
               $words[$wd] = 1; //keep a count of how often each word is seen
            }
            else
            {
               $words[$wd]++; //keep a count of how often each word is seen
            }
            //print("WORDS: $words[$wd] ---- ");
            if ($words[$wd] == 1) // if this is the first time we've seen this word in this document...
            {
               if ($wordindex[$wd]) // if this word was already in the wordidx table...
               {
                  $sql->query("INSERT into $default->owl_searchidx values('$wordindex[$wd]','$fileidnum')"); //add a searchidx table entry for this fileidnum (owlidnum)
               } 
               else // if word not in word index, add to both wordidx and searchidx
               {
                  $wordindex[$wd] = $nextwordindex; //first remember this word as being in the wordindex
                  $sql->query("INSERT into $default->owl_searchidx values('$wordindex[$wd]', '$fileidnum')"); //add pointer to owlidnum for this wordindexnum
   
                  $wd = addslashes($wd);
                  $sql->query("SELECT wordid from $default->owl_wordidx where word = '$wd'");
                  $numrows = $sql->num_rows($sql);
                  if ( $numrows == 0 )
                  {
                     $sql->query("INSERT IGNORE into $default->owl_wordidx values('$nextwordindex', '$wd')");
                     $nextwordindex++;
                  }
               } 
            } //if first instance of this word...
         }
      } // Valid UTF8
   } //for each word
}

   // When a file gets delete/removed, this should be called to update the indexing
   // tables
   function fDeleteFileIndexID($fidtoremove)
   {
      global $default;
      $sql = new Owl_DB;

      $sql->query("DELETE FROM $default->owl_searchidx WHERE owlfileid = '$fidtoremove'");
      // Note, I'm leaving the wordidx table alone, it can only grow so large as
      // there are only so many words in the language, will make indexing future items a bit faster methinks
   } 

   /**
   * Indexes a file, if we know how
   * 
   * @param mixed $new_name
   * @param mixed $newpath
   * @param mixed $id
   * 
   * @return null if the path hasn't changed, or otherwise the new temporary file. This should be cleaned after copying.
   */
function fIndexAFile($new_name, $newpath, $id)
{
     global $default, $sess, $index_file; 

     //fOwlWebDavLog ("OWL -> fIndexAFile", "Indexed FILE: $new_name path: $newpath index: $index_file");
     $iContentFileIndex = null;

     if ($default->turn_file_index_off == 1)
     {
        return true;
     }

     if ($index_file != "1")
     {
       return null;
     }

     $return_value_for_function = null;

     // IF the file was inserted in the database now INDEX it for SEARCH.
     $sSearchExtension = fFindFileExtension($new_name);

     switch( strtolower($sSearchExtension) )
     {
//**********************************************************************************
//**********************************************************************************
// PDF Files with Images
//
// Images in PDF file could be extracted with pdfimage (Standard with Fedora Core 4 xpdf package)
// and then use GOCR to OCR the images.
// 
// nightmare::/mnt has the rpm for gocr
//
//**********************************************************************************
//**********************************************************************************
        case 'pdf':
        {
           if( !file_exists($default->pdftotext_path) )
		   {
             break;
		   }
           //$command = escapeshellarg($default->pdftotext_path) . '  "' . $newpath . '" "' .  $default->owl_tmpdir . DIR_SEP . $new_name . '.text"';
           $command = escapeshellcmd($default->pdftotext_path) . '  ' . escapeshellarg($newpath) . ' ' .  escapeshellarg($default->owl_tmpdir . DIR_SEP . $new_name . '.text');

           $last_line = system($command, $retval);
           if ($retval > 0)
           {
              if ($default->debug == true)
              {
                 switch ($retval)
                 {
                    case "1": 
                       $sPdfError = "Error opening a PDF file. (Not A PDF File?)";
                       break;
                    case "2": 
                       $sPdfError = "Error opening an ouput file. ($default->owl_tmpdir Writeable by the webserver?)";
                       break;
                 }
                 printError('DEBUG: Indexing PDF File \'' . $newpath . '\' Failed:' , $sPdfError. "<br />COMMAND: $command");
              }
           }
           IndexATextFile($default->owl_tmpdir . DIR_SEP . $new_name . '.text', $id);
           unlink($default->owl_tmpdir . DIR_SEP . $new_name . '.text');
        } 
        break;

        case 'doc':
        {
           if ( !file_exists($default->wordtotext_path) )
		   {
              break;
		   }

           //$command = escapeshellarg($default->wordtotext_path) . ' ' . $default->wordtotext_switches . ' "' . escapeshellcmd($newpath) . '" > "' .  escapeshellcmd($default->owl_tmpdir) . DIR_SEP . $new_name . '.text"';
		    $command = escapeshellcmd($default->wordtotext_path) . ' ' . $default->wordtotext_switches . ' ' . escapeshellarg($newpath) . ' > ' .  escapeshellarg($default->owl_tmpdir . DIR_SEP . $new_name . '.text');


                $last_line = system($command, $retval);
                if ($retval > 0)
                {
                   // If it failed maybe this is a RTF file lets try it:
                   if (file_exists($default->rtftotext_path))
                   {
                      $command1 = escapeshellarg($default->rtftotext_path) . " --text " . '  "' . $newpath . '" > "' .  $default->owl_tmpdir . DIR_SEP . $new_name . '.text"';
                      $last_line1 = system($command1, $retval1);
                      if ($retval1 > 0)
                      {
                         if ($default->debug == true)
                         {
                            $sPdfError1 = "Return: $retval1 $last_line1";
                            printError('DEBUG: Indexing MS WORD File \'' . $newpath . '\' Failed:' , $sPdfError. "<br />COMMAND: $command<br /><br />" . 'DEBUG: Indexing RTFFile \'' . $newpath1 . '\' Failed:' , $sPdfError1 . "<br />COMMAND: $command1");
                         }
                      }
                   }
                   else
                   {
                      if ($default->debug == true)
                      {
                         $sPdfError = "Return: $retval $last_line";
                         printError('DEBUG: Indexing MS WORD File \'' . $newpath . '\' Failed:' , $sPdfError. "<br />COMMAND: $command");
                      }
                   }
                }

                IndexATextFile($default->owl_tmpdir . DIR_SEP . $new_name . '.text', $id);
                unlink($default->owl_tmpdir . DIR_SEP . $new_name . '.text');
             }
      break;

     case 'rtf':
      {
        if ( !file_exists($default->rtftotext_path) )
		{
          break;
		}

                $command = escapeshellarg($default->rtftotext_path) . " --text " . '  "' . $newpath . '" > "' .  $default->owl_tmpdir . DIR_SEP . $new_name . '.text"';
                $last_line = system($command, $retval);
                if ($retval > 0)
                {
                   if ($default->debug == true)
                   {
                      $sPdfError = "Return: $retval $last_line";
                      printError('DEBUG: Indexing RTFFile \'' . $newpath . '\' Failed:' , $sPdfError . "<br />COMMAND: $command");
                   }
                }

                IndexATextFile($default->owl_tmpdir . DIR_SEP . $new_name . '.text', $id);
                unlink($default->owl_tmpdir . DIR_SEP . $new_name . '.text');
             }
      break;

    case 'xlsx':
      {
        $tmpDir = $default->owl_tmpdir . "/owltmp.$sess";
        if (file_exists($tmpDir))
        {
          myDelete($tmpDir);
        }

        mkdir($tmpDir,$default->directory_mask);

        $archive = new PclZip($newpath);
        $aListOfFiles = $archive->listContent();
        while ($aFileDetails = current($aListOfFiles))
        {
          if($aFileDetails["filename"] == "xl/sharedStrings.xml")
          {
            $iContentFileIndex = $aFileDetails["index"]; 
            break;
          }
          next($aListOfFiles);
        }

        if ($archive->extractByIndex($iContentFileIndex, $tmpDir) == 0 and $default->debug == true)
        {
          printError("DEBUG: " .$archive->errorInfo(true), "N: $newpath P: $tmpDir");
        }
        else
        {
          $text = file_get_contents("$tmpDir/xl/sharedStrings.xml");

          $text = fOwl_ereg_replace('</t>', "</t>\n", $text);

          $fp = fopen($tmpDir ."/document.xml.text", "w");
          fwrite($fp, strip_tags($text));
          fclose($fp);
          IndexATextFile($tmpDir ."/document.xml.text", $id);
        }

        myDelete($tmpDir);
       }
       break;

      case 'ppt':
      {
        if ( !file_exists($default->ppttotext_path) )
        {
          break;
        }

                $command = escapeshellarg($default->ppttotext_path) . " " . '  "' . $newpath . '" > "' .  $default->owl_tmpdir . DIR_SEP . $new_name . '.text"';
                $last_line = system($command, $retval);
                if ($retval > 0)
                {
                   if ($default->debug == true)
                   {
                      $sPdfError = "Return: $retval $last_line";
                      printError('DEBUG: Indexing PPT File \'' . $newpath . '\' Failed:' , $sPdfError . "<br />COMMAND: $command");
                   }
                }

                IndexATextFile($default->owl_tmpdir . DIR_SEP . $new_name . '.text', $id);
                unlink($default->owl_tmpdir . DIR_SEP . $new_name . '.text');
             }
      break;

     case 'pptx':
      {
        $tmpDir = $default->owl_tmpdir . "/owltmp.$sess";
        if (file_exists($tmpDir))
        {
          myDelete($tmpDir);
        }

        mkdir($tmpDir,$default->directory_mask);

        $archive = new PclZip($newpath);
        $aListOfFiles = $archive->listContent();
        //print("<pre>");
        //print_r($afileDetails);
        //print("LIST OF FILES");
        //print_r($aListOfFiles);
        $fp = fopen($tmpDir ."/document.xml.text", "w");
        while ($aFileDetails = current($aListOfFiles))
        {
          if( (    preg_match('/^ppt\/slides\//', $aFileDetails["filename"])
             and   preg_match('/xml?/', $aFileDetails["filename"])
             and ! preg_match('/^ppt\/slides\/_/', $aFileDetails["filename"])) OR
              (    preg_match('/^ppt\/notesSlides\//', $aFileDetails["filename"])
             and   preg_match('/xml?/', $aFileDetails["filename"])
             and ! preg_match('/^ppt\/notesSlides\/_/', $aFileDetails["filename"]))
            )
          {
            //print("FILE: " . $aFileDetails["filename"]);
            //print("[ EXTRACTED ]");
            $iContentFileIndex = $aFileDetails["index"];
            if ($archive->extractByIndex($iContentFileIndex, $tmpDir) == 0 and $default->debug == true)
            {
              printError("DEBUG: " .$archive->errorInfo(true), "N: $newpath P: $tmpDir");
            }
            else
            {
              $text = file_get_contents($tmpDir . DIR_SEP  . $aFileDetails["filename"]);
              fwrite($fp, strip_tags($text));
            }
          }
          next($aListOfFiles);
        }
        fclose($fp);

        IndexATextFile($tmpDir ."/document.xml.text", $id);
        myDelete($tmpDir);
      }
      break;

    case 'epub':
      {
        $tmpDir = $default->owl_tmpdir . "/owltmp.$sess";
        if (file_exists($tmpDir))
        {
          myDelete($tmpDir);
        }

        mkdir($tmpDir,$default->directory_mask);
        $archive = new PclZip($newpath);
        $aListOfFiles = $archive->listContent();
        if ($aListOfFiles == 1 and $default->debug == true)
        {
          printError("DEBUG: Invalid epub file format");
        }
        $cListSeparator = '';
        while ($aFileDetails = current($aListOfFiles))
        {
          if( preg_match('/html?/', $aFileDetails["filename"]) or preg_match('/xml/', $aFileDetails["filename"]))
          {
            $iContentFileIndex .=  $cListSeparator . $aFileDetails["index"];
            $cListSeparator = ',';
          }
          next($aListOfFiles);
        }

        if ($archive->extractByIndex($iContentFileIndex, $tmpDir) == 0 and $default->debug == true)
        {
          printError("DEBUG(1): " .$archive->errorInfo(true), "N: $newpath P: $tmpDir");
        }
        else
        {
           $text = '';
           if (file_exists($tmpDir . DIR_SEP . 'OEBPS'))
           {
             $sDir = $tmpDir . DIR_SEP . 'OEBPS';
           }
           else
           {
             $sDir = $tmpDir . DIR_SEP . 'content';
           }
           if ($handle = opendir($sDir)) 
           {
               $fp = fopen($tmpDir ."/document.xml.text", "a");
               while (false !== ($file = readdir($handle))) 
               {
                   if ($file != "." && $file != "..") 
                   {
                       $text = file_get_contents($sDir .DIR_SEP . $file);
                       fwrite($fp, strip_tags($text));
                   }
               }
               closedir($handle);
               fclose($fp);
           }
          IndexATextFile($tmpDir ."/document.xml.text", $id);
        }
        myDelete($tmpDir);
      }
      break;

    case 'docx':
      {
        $tmpDir = $default->owl_tmpdir . "/owltmp.$sess";
        if (file_exists($tmpDir))
        {
          myDelete($tmpDir);
        }

        mkdir($tmpDir,$default->directory_mask);

        $archive = new PclZip($newpath);
        $aListOfFiles = $archive->listContent();
        while ($aFileDetails = current($aListOfFiles))
        {
          if($aFileDetails["filename"] == "word/document.xml")
          {
            $iContentFileIndex = $aFileDetails["index"];
            break;
          }
          next($aListOfFiles);
        }

        if ($archive->extractByIndex($iContentFileIndex, $tmpDir) == 0 and $default->debug == true)
        {
          printError("DEBUG: " .$archive->errorInfo(true), "N: $newpath P: $tmpDir");
        }
        else
        {
          $text = file_get_contents("$tmpDir/word/document.xml");
          $fp = fopen($tmpDir ."/document.xml.text", "w");
          fwrite($fp, strip_tags($text));
          fclose($fp);
          IndexATextFile($tmpDir ."/document.xml.text", $id);
        }
        myDelete($tmpDir);
      }
      break;

     case 'sxw':
     case 'odt':
      {
        $tmpDir = $default->owl_tmpdir . "/owltmp.$sess";
        if (file_exists($tmpDir))
        {
          myDelete($tmpDir);
        }

        mkdir($tmpDir,$default->directory_mask);
                                                                                                                           
        $archive = new PclZip($newpath);
        $aListOfFiles = $archive->listContent();
        while ($aFileDetails = current($aListOfFiles)) {
          if($aFileDetails["filename"] == "content.xml")
          {
            $iContentFileIndex = $aFileDetails["index"]; 
            break;
          }
          next($aListOfFiles);
        }

        if ($archive->extractByIndex($iContentFileIndex, $tmpDir) == 0 and $default->debug == true)
        {
          printError("DEBUG: " .$archive->errorInfo(true), "N: $newpath P: $tmpDir");
        }
        else
        {
          $text = file_get_contents("$tmpDir/content.xml");
          $fp = fopen($tmpDir ."/content.xml.text", "w");
          fwrite($fp, strip_tags($text));
          fclose($fp);
          IndexATextFile($tmpDir ."/content.xml.text", $id);
        }
        myDelete($tmpDir);
      }
      break;

     case 'xls':
             {
                $xlwords = '';
                require_once($default->owl_fs_root . '/scripts/Excel/reader.php');
                $xl = new Spreadsheet_Excel_Reader();
                $xl->read($newpath);
                for ($k = count($xl->sheets)-1; $k>=0; $k--)
                {
                   for ($i = 1; $i <= $xl->sheets[$k]['numRows']; $i++)
                   {
                      for ($j = 1; $j <= $xl->sheets[$k]['numCols']; $j++)
                      {
                         $xlwords .= $xl->sheets[$k]['cells'][$i][$j] . ' ';
                      }
                   }
                }
                $xlwords = preg_replace('# +#si',' ',$xlwords);
                $xlwords = preg_replace('# $#si','',$xlwords);
                //$xlwords = utf8_encode($xlwords); 
                IndexABigString($xlwords, $id);
             }
      break;

     case 'jpg':
     case 'jpeg':
     case 'gif':
     case 'png':
     case 'ppm':
     case 'psd':
     case 'bmp':
     case 'tiff':
     case 'tif':
     case 'swf':
     case 'tga':
     case 'xpm':
      {
         if (!file_exists($default->ocr_path) )
         {
            break;
         }

        $cleanup = array();
        $temp_file = $newpath;
        if ( file_exists($default->thumbnails_tool_path) )
        {
          // Convert to non-compressed, greyscale bmp:
          $temp_file = tempnam($default->owl_tmpdir, 'TESSERACT');
          $cleanup[] = $temp_file;
          $temp_file .= '.tif';
          $cleanup[] = $temp_file;

          $command = $default->thumbnails_tool_path . " \"{$newpath}\" -colorspace gray \"{$temp_file}\" 2>&1";
          $last_line = system($command, $retval);
          if ( $retval > 0 )
          {
            if ( $default->debug == true )
            {
              printError('DEBUG: Indexing picture \'' . $newpath . '\' Failed:' , $last_line. "<br />COMMAND: $command");
            }

            $temp_file = $newpath; // reset...
          }
        }

        // Now OCR it...
        $tesseract_result = "{$default->owl_tmpdir}/{$new_name}";
        $command = $default->ocr_path . " \"{$temp_file}\" \"{$tesseract_result}\" 2>&1";
        $tesseract_result .= '.txt';

        $cleanup[] = $tesseract_result;

        @shell_exec($command);
        if ( !file_exists($tesseract_result) )
        {
          if ( $default->debug == true )
          {
            printError('DEBUG: (tesseract) Indexing picture \'' . $newpath . '\' Failed:' , $last_line. "<br />COMMAND: $command");
          }
        }
        else
        {
          IndexATextFile($tesseract_result, $id);
        }

        foreach( $cleanup as $file )
        {
          @unlink($file);
        }
      }
      break;

     # C/C++ sources
     case 'idl': case 'odl': case 'odh':
     case 'tlh': case 'tli':
     case 'vsz': case 'vsprops':
     case 'i': case 'cod': case 'def': case 'inl': case 'mak': case 'mk': case 'snippet':
     case 'c': case 'cpp': case 'cxx': case 'cc':
     case 'h': case 'hpp': case 'hxx':
     # Assembler sources
     case 'asm': case 'lst': case 's':
     # HTML
     case 'html': case 'htm': case 'js': case 'css': case 'plg': case 'shtml':
     case 'xht': case 'xhtml':
     # PHP
     case 'php': case 'inc': case 'php3': case 'php4': case 'php5': case 'tpl':
     # Perl
     case 'pl':
     # XML
     case 'xml': case 'rels': case 'xslt': case 'wsdl':
     # General purpose files
     case 'txt': case 'text':
     case 'csv':
     case 'diff': case 'patch':
     case 'dic': case 'exc':
     case 'log':
     case 'eml': case 'msg': case 'ics': case 'vcs':
     case 'ini':
     case 'inf':
     case 'ins': case 'isp':
     case 'lic':
     case 'nfo':
     case 'pls':
     case 'scp':
     case 'sct':
     case 'vbs': case 'wsc': case 'wsf': case 'wsh':
     case 'wri':
     case 'wtx':
      {
        IndexATextFile($newpath, $id);
      }
      break;
     } // End switch extension

      return $return_value_for_function;
   }


function fReplaceSpecial($sString)
{
   $sString = fOwl_ereg_replace("À", "a", $sString);
   $sString = fOwl_ereg_replace("à", "a", $sString);
   $sString = fOwl_ereg_replace("Á", "a", $sString);
   $sString = fOwl_ereg_replace("á", "a", $sString);
   $sString = fOwl_ereg_replace("Â", "a", $sString);
   $sString = fOwl_ereg_replace("â", "a", $sString);
   $sString = fOwl_ereg_replace("Ã", "a", $sString);
   $sString = fOwl_ereg_replace("ã", "a", $sString);
   $sString = fOwl_ereg_replace("Ä", "a", $sString);
   $sString = fOwl_ereg_replace("ä", "a", $sString);
   $sString = fOwl_ereg_replace("Å", "a", $sString);
   $sString = fOwl_ereg_replace("å", "a", $sString);
   $sString = fOwl_ereg_replace("Æ", "a", $sString);
   $sString = fOwl_ereg_replace("æ", "a", $sString);
   // $sString = fOwl_ereg_replace("[Çç]", "c", $wd);
   $sString = fOwl_ereg_replace("Ç", "c", $sString);
   $sString = fOwl_ereg_replace("ç", "c", $sString);
   //$sString = fOwl_ereg_replace("[ÈèÉéÊêËë]", "e", $sString);
   $sString = fOwl_ereg_replace("È", "e", $sString);
   $sString = fOwl_ereg_replace("è", "e", $sString);
   $sString = fOwl_ereg_replace("É", "e", $sString);
   $sString = fOwl_ereg_replace("é", "e", $sString);
   $sString = fOwl_ereg_replace("Ê", "e", $sString);
   $sString = fOwl_ereg_replace("ê", "e", $sString);
   $sString = fOwl_ereg_replace("Ë", "e", $sString);
   $sString = fOwl_ereg_replace("ë", "e", $sString);
   // $sString = fOwl_ereg_replace("[ÌìÍíÎîÏï]", "i", $sString);
   $sString = fOwl_ereg_replace("Ì", "i", $sString);
   $sString = fOwl_ereg_replace("ì", "i", $sString);
   $sString = fOwl_ereg_replace("Í", "i", $sString);
   $sString = fOwl_ereg_replace("í", "i", $sString);
   $sString = fOwl_ereg_replace("Î", "i", $sString);
   $sString = fOwl_ereg_replace("î", "i", $sString);
   $sString = fOwl_ereg_replace("Ï", "i", $sString);
   $sString = fOwl_ereg_replace("ï", "i", $sString);
   // $sString = fOwl_ereg_replace("[Ññ]", "n", $sString);
   $sString = fOwl_ereg_replace("Ñ", "n", $sString);
   $sString = fOwl_ereg_replace("ñ", "n", $sString);
   // $sString = fOwl_ereg_replace("[ÒòÓóÔôÕõÖöØø]", "o",$sString);
   $sString = fOwl_ereg_replace("Ò", "o",$sString);
   $sString = fOwl_ereg_replace("ò", "o",$sString);
   $sString = fOwl_ereg_replace("Ó", "o",$sString);
   $sString = fOwl_ereg_replace("ó", "o",$sString);
   $sString = fOwl_ereg_replace("Ô", "o",$sString);
   $sString = fOwl_ereg_replace("ô", "o",$sString);
   $sString = fOwl_ereg_replace("Õ", "o",$sString);
   $sString = fOwl_ereg_replace("õ", "o",$sString);
   $sString = fOwl_ereg_replace("Ö", "o",$sString);
   $sString = fOwl_ereg_replace("ö", "o",$sString);
   $sString = fOwl_ereg_replace("Ø", "o",$sString);
   $sString = fOwl_ereg_replace("ø", "o",$sString);
   // $sString = fOwl_ereg_replace("[ÙùÚúÛûÜü]", "u", $sString);
   $sString = fOwl_ereg_replace("Ù", "u", $sString);
   $sString = fOwl_ereg_replace("ù", "u", $sString);
   $sString = fOwl_ereg_replace("Ú", "u", $sString);
   $sString = fOwl_ereg_replace("ú", "u", $sString);
   $sString = fOwl_ereg_replace("Û", "u", $sString);
   $sString = fOwl_ereg_replace("û", "u", $sString);
   $sString = fOwl_ereg_replace("Ü", "u", $sString);
   $sString = fOwl_ereg_replace("ü", "u", $sString);
   // $sString = fOwl_ereg_replace("[Ýýÿ]", "y", $sString);
   $sString = fOwl_ereg_replace("Ý", "y", $sString);
   $sString = fOwl_ereg_replace("ý", "y", $sString);
   $sString = fOwl_ereg_replace("ÿ", "y", $sString);
   $sString = fOwl_ereg_replace("l'", "", $sString);
   $sString = fOwl_ereg_replace("l´", "", $sString);
   $sString = fOwl_ereg_replace("l’", "", $sString);
   $sString = fOwl_ereg_replace("m'", "", $sString);
   $sString = fOwl_ereg_replace("m´", "", $sString);
   $sString = fOwl_ereg_replace("m’", "", $sString);
   $sString = fOwl_ereg_replace("c'", "", $sString);
   $sString = fOwl_ereg_replace("c´", "", $sString);
   $sString = fOwl_ereg_replace("c’", "", $sString);
   $sString = fOwl_ereg_replace("s'", "", $sString);
   $sString = fOwl_ereg_replace("s´", "", $sString);
   $sString = fOwl_ereg_replace("s’", "", $sString);
   $sString = fOwl_ereg_replace("d'", "", $sString);
   $sString = fOwl_ereg_replace("d´", "", $sString);
   $sString = fOwl_ereg_replace("d’", "", $sString);
   
   return $sString;
}
?>
