<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

if(!isset($_REQUEST['num'])){
	echo "why you do this";
}else{
	$subject = $_REQUEST['subject'];
	$num = $_REQUEST['num'];

	$link = "http://www.ucalendar.uwaterloo.ca/1516/COURSE/course-" . $subject . ".html";

	echo $link;

	$fp = fopen($link, 'r');

	while(!feof($fp)){
		$line = fgetss($fp);
		$parts = explode(' ', $line);

		if ((count($parts) > 1) && ($parts[1] == $num) && ($parts[0] == $subject)){
			var_dump($parts);
			unset($parts[2]);
			unset($parts[3]);
			unset($parts[4]);
			for($i=0;$i<strlen($parts[5]);$i++){
				if(ctype_alpha(substr($parts[5],$i,($i+1)))){
					$parts[5] = substr($parts[5],$i);
					break;
				}
			}
			$parts = array_values($parts);
			$check = 0;
			$looptimes = count($parts);
			for($i=0;$i<$looptimes;$i++){
				if(($check == 1) || (substr($parts[$i],0,1) == '[')){
					if($check == 0)
						$check = 1;
					unset($parts[$i]);
				}
				echo $check;
			}
			var_dump($check);
			var_dump($parts);
			break;
		}
	}
	fclose($fp);
	
	// HAIKU GENERATOR
	function count_syl($str){
		$str = strtolower($str);
		if(strlen($str) <= 3){
			return 1;
		}
		$str = preg_replace('/(?:[^laeiouy]es|ed|[^laeiouy]e)$/','',$str);
		var_dump($str);
		$str = preg_replace('/^y/','',$str);
		var_dump($str);
		preg_match_all('/[aeiouy]{1,2}/',$str,$matches);
		var_dump($matches);
		return count($matches[0]);
	}
		
	function fill_a_line($syl){
		$total_syl = 0;
		$new_line = "";

		while(true){
			$test_word = $parts[rand(0, count($parts))];
			if (count_syl($test_word) + $total_Syl <= $syl){
				$new_line .= $test_word;
				$total_Syl += count_syl($test_word);
			}
			if ($total_Syl >= $syl){
				break;
			}
		}
		return $new_line;
	}
	echo "<pre>" . fill_a_line(5) . "/n" . fill_a_line(7) . "/n" . fill_a_line(5) . "</pre>"
}
?>