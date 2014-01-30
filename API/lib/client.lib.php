<?php

/**
* Function to make a Curl call to the API
* We could probably Turn this into a client Class
*
* @param   array   $aPostFields  
* @throws 
* @return  string  XML or JSON 
*/

  
function fDmsApiClient ($aPostFields, $bReturnHeaders = 0)
{
   global $sUrl;

   //open connection
   $ch = curl_init();
   
   //set the url, number of POST vars, POST data
   curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
   curl_setopt($ch,CURLOPT_URL, $sUrl);
   curl_setopt($ch,CURLOPT_POST, 1);
   curl_setopt($ch,CURLOPT_POSTFIELDS, $aPostFields);
   curl_setopt($ch,CURLOPT_HEADER, true);
   curl_setopt($ch,CURLOPT_VERBOSE, false);
   curl_setopt($ch,CURLOPT_USERAGENT, "Dialogica DMS Client/1.00");
   
   //execute post
   $result = curl_exec($ch);

   //Check the Headers Returned 
   $iHeaderSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);

   //close connection
   curl_close($ch);

   // return remote output
   if ($iHeaderSize == 0)
   {
      $sMsg = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<dms_response><code>00000</code><msg>Curl Call returned empty headers</msg></dms_response>";
      if ($bReturnHeaders)
      {
         $aResult = array();
         $aResult['header'] = null;
         $aResult['body'] = $sMsg;
         return $aResult;
      }
      else
      {
         return $sMsg;
      } 
   }
   else
   {
      if ($bReturnHeaders)
      {
         $aResult = array();
         $aResult['header'] = substr($result, 0, $iHeaderSize);
         $aResult['body'] = substr($result, $iHeaderSize);
         return $aResult;
      }
      else
      {   
         return substr($result, $iHeaderSize);

      }
   }

}

/**
* Function to check if a string is a JSON Object
*
* @param   string   $string  
* @throws 
* @return  bool     
*/

function isJson($string) 
{
   json_decode($string);
   return (json_last_error() == JSON_ERROR_NONE);
}

/**
 * Function to simulate pecl_http function http_parse_headers 
 * If the package is not installed
 */

if (!function_exists('http_parse_headers'))
{
    function http_parse_headers($raw_headers)
    {
        $headers = array();
        $key = '';

        foreach(explode("\n", $raw_headers) as $i => $h)
        {
            $h = explode(':', $h, 2);

            if (isset($h[1]))
            {
                if (!isset($headers[$h[0]]))
                {
                    $headers[$h[0]] = trim($h[1]);
                }
                elseif (is_array($headers[$h[0]]))
                {
                    $headers[$h[0]] = array_merge($headers[$h[0]], array(trim($h[1])));
                }
                else
                {
                    $headers[$h[0]] = array_merge(array($headers[$h[0]]), array(trim($h[1])));
                }

                $key = $h[0];
            }
            else
            {
                if (substr($h[0], 0, 1) == "\t")
                {
                    $headers[$key] .= "\r\n\t".trim($h[0]);
                }
                elseif (!$key)
                {
                    $headers[0] = trim($h[0]);trim($h[0]);
                }
            }
        }
        return $headers;
    }
}
