<?php
    $fileName = 'http://www.ucalendar.uwaterloo.ca/1516/COURSE/course-MATH.html';
    if ( file_exists($fileName) && ($fp = fopen($fileName, "r"))!==false ) {

      $str = stream_get_contents($fp);
      fclose($fp);

      echo "not borked";
    }
    else
    {
      echo "broke pls send the emone";
    }
?>