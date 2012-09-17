var xmlHttp

   function parseScript(_source) {
                var source = _source;
                var scripts = new Array();
                
                // Strip out tags
                while(source.indexOf("<script") > -1 || source.indexOf("</script") > -1) {
                        var s = source.indexOf("<script");
                        var s_e = source.indexOf(">", s);
                        var e = source.indexOf("</script", s);
                        var e_e = source.indexOf(">", e);
                        
                        // Add to scripts array
                        scripts.push(source.substring(s_e+1, e));
                        // Strip from source
                        source = source.substring(0, s) + source.substring(e_e+1);
                }
                
                // Loop through every script collected and eval it
                for(var i=0; i<scripts.length; i++) {
                        try {
                                eval(scripts[i]);
                        }
                        catch(ex) {
                                // do what you want here when a script fails
                        }
                }
                
                // Return the cleaned source
                return source;
        }

function AjaxGethtml(str, divid, img)
{ 
 xmlHttp=GetXmlHttpObject()
 if (xmlHttp==null)
 {
  alert ("Browser does not support HTTP Request")
  return
 
}
 var url=str+"&amp;timestamp=" + new Date().getTime();

 xmlHttp.onreadystatechange=function (divid,img)
 {
    return function ()
    {
       if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
       { 
        document.getElementById(divid).innerHTML=xmlHttp.responseText;
        parseScript(xmlHttp.responseText);
       } 
       else
       {
        //document.getElementById(divid).innerHTML='<div class="form1">Loading....</div>';
        document.getElementById(divid).innerHTML='<img class="form1" src="' + img + '"></img>';
       }
    };
 }(divid,img);


 xmlHttp.open("GET",url,true);
 xmlHttp.send(null);
 }

function GetXmlHttpObject()
{
  var xmlHttp=null;
  try
  {
   // Firefox, Opera 8.0+, Safari
   xmlHttp=new XMLHttpRequest();
  }
  catch (e)
  {
   // Internet Explorer
   try
   {
    xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
   }
   catch (e)
   {
    xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
   }
  }
  return xmlHttp;
}
