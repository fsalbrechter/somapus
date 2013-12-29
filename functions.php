<?php
$db = mysql_connect("localhost", "root", "password");
mysql_select_db ("somapus", $db); 

function get_user_id() {
    if(!isset($_COOKIE['user_id'])) {
        $user_id = uniqid();
        setcookie("user_id", $user_id, time()+60*60*24*7*365);
        $_COOKIE['user_id'] = $user_id;
    }
    echo $_COOKIE['user_id'];
} 
 
   function f($hvad) {  
        #return mb_convert_case($hvad, MB_CASE_TITLE);  
        return $hvad;
     }
  
  function h($hvad) {  
      #return utf8_encode($hvad);
      return $hvad;
    }

   function format_time ($t) { 
      $tid=strtotime($t);
      return date("G:i", $tid." ");
          
     }
     
     function snippet($text,$length=64,$tail="...") {
        $text = trim($text);
        $txtl = strlen($text);
        if($txtl > $length) {
            for($i=1;$text[$length-$i]!=" ";$i++) {
                if($i == $length) {
                    return substr($text,0,$length) . $tail;
                }
            }
            $text = substr($text,0,$length-$i+1) . $tail;
        }
        return $text;
     }




     function u($hvad) {  
       return $hvad;
       }
  
     function split_url ($url) {
       preg_match('`<a\s+href=\"([^"]*)\">(?!<img[^>]*>)(.*)</a>`i',$url, $matches);     
       return $matches; # 0 er originalen i html, 1 er url, 2 er linktekst
        }   
        
      function close_db($which){    
        mysql_close($which);
      } 


	 function ConvertMinutes2Hours($Minutes)
	{
	    if ($Minutes < 0)
	    {
	        $Min = Abs($Minutes);
	    }
	    else
	    {
	        $Min = $Minutes;
	    }
	    $iHours = Floor($Min / 60);
	    $Minutes = ($Min - ($iHours * 60)) / 100;
	    $tHours = $iHours + $Minutes;
	    if ($Minutes < 0)
	    {
	        $tHours = $tHours * (-1);
	    }
	    $aHours = explode(".", $tHours);
	    $iHours = $aHours[0];
	    if (empty($aHours[1]))
	    {
	        $aHours[1] = "00";
	    }
	    $Minutes = $aHours[1];
	    if (strlen($Minutes) < 2)
	    {
	        $Minutes = $Minutes ."0";
	    }
	    $tHours = $iHours ." time ". $Minutes. " minutter";
	    return $tHours;
	}
    
  ?>