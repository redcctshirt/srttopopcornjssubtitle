<?php

# URL der srt-Datei (Untertitel-Datei) festlegen
$srt_url = 'http://www.openscreencast.de/archive/ffmpeg_scale_226.srt';

echo 'document.addEventListener( "DOMContentLoaded", function() {
      var popcorn = Popcorn("#video");' . "\n";
 
if($f = file($srt_url,FILE_IGNORE_NEW_LINES)) {
	foreach($f as $nr => $zeile) {
            $zeile = rtrim($zeile);
            if(preg_match('/(\d\d):(\d\d):(\d\d),(\d\d\d) --> (\d\d):(\d\d):(\d\d),(\d\d\d)/', $zeile, $m))
        {
          echo "popcorn.subtitle({";
	  echo "start: ";
	  echo (int)$m[1]*60*60+(int)$m[2]*60+(int)$m[3] . ",";
	  echo "end: ";
	  echo (int)$m[5]*60*60+(int)$m[6]*60+(int)$m[7] . ",";	
          echo 'target: "subtitle",';
	  echo 'text: "' . htmlspecialchars($f[(int)$nr+1],ENT_QUOTES,"UTF-8") . '" });' . "\n"; 
        }  
            
	} //foreach 
} //if file
echo '}, false );';  

?>
