<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

function count_numbers($num){
	$sum = 0;
	for ($i = 0; $i < strlen($num); ++$i){
		if (substr($num, $i, 1) == 7){
			$sum += 2;
		}else{
			$sum += 1;
		}
	}
}

// HAIKU GENERATOR
function count_syl($str){
	if (is_numeric($str)){
		return count_numbers($str);
	}
	if (ctype_upper($str)){
		return strlen($str);
	}
	$str = strtolower($str);
	if(strlen($str) <= 3){
		return 1;
	}
	$str = preg_replace('/(?:[^laeiouy]es|ed|[^laeiouy]e)$/','',$str);
	// var_dump($str);
	$str = preg_replace('/^y/','',$str);
	// var_dump($str);
	preg_match_all('/[aeiouy]{1,2}/',$str,$matches);
	// var_dump($matches);
	return count($matches[0]);
}
	
function fill_a_line($parts, $syl){
	$total_Syl = 0;
	$new_line = "";

	while(true){
		$test_word = $parts[rand(0, count($parts)-1)];
		if (count_syl($test_word) + $total_Syl <= $syl){
			$new_line .= $test_word /*. "[" . count_syl($test_word). "]" /**/ .  " ";
			$total_Syl += count_syl($test_word);
		}
		if ($total_Syl >= $syl){
			break;
		}
	}
	return $new_line;
}

if(!isset($_REQUEST['num'])){
	echo "why you do this";
}else{
	$subject = $_REQUEST['subject'];
	$num = $_REQUEST['num'];

	$link = "http://www.ucalendar.uwaterloo.ca/1516/COURSE/course-" . $subject . ".html";

	// echo $link;

	$fp = fopen($link, 'r');

	while(!feof($fp)){
		$line = preg_replace("/[^a-zA-Z 0-9]+/", "", fgetss($fp));
		$parts = explode(' ', $line);

		if ((count($parts) > 1) && ($parts[1] == $num) && ($parts[0] == $subject)){
			// var_dump($parts);
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
				}else{
					if (!is_numeric($parts[$i])){
						$parts[$i] = preg_replace("/[^a-zA-Z]+/", "", $parts[$i]);
					}
				}
				// echo $check;
			}
			// var_dump($check);
			// var_dump($parts);
			break;
		}
	}
	var_dump($parts);
	if (empty($parts)){
		echo "<a href='../'>NO COURSES</a>";
	}
	fclose($fp);
	
	echo "<pre>" . fill_a_line($parts, 5) . "\n" . fill_a_line($parts, 7) . "\n" . fill_a_line($parts, 5) . "</pre>";
	echo "<pre>" . fill_a_line($parts, 5) . "\n" . fill_a_line($parts, 7) . "\n" . fill_a_line($parts, 5) . "</pre>";
	echo "<pre>" . fill_a_line($parts, 5) . "\n" . fill_a_line($parts, 7) . "\n" . fill_a_line($parts, 5) . "</pre>";
	echo "<pre>" . fill_a_line($parts, 5) . "\n" . fill_a_line($parts, 7) . "\n" . fill_a_line($parts, 5) . "</pre>";
	echo "<pre>" . fill_a_line($parts, 5) . "\n" . fill_a_line($parts, 7) . "\n" . fill_a_line($parts, 5) . "</pre>";
	echo "<pre>" . fill_a_line($parts, 5) . "\n" . fill_a_line($parts, 7) . "\n" . fill_a_line($parts, 5) . "</pre>";
	echo "<pre>" . fill_a_line($parts, 5) . "\n" . fill_a_line($parts, 7) . "\n" . fill_a_line($parts, 5) . "</pre>";
	echo "<pre>" . fill_a_line($parts, 5) . "\n" . fill_a_line($parts, 7) . "\n" . fill_a_line($parts, 5) . "</pre>";
	echo "<pre>" . fill_a_line($parts, 5) . "\n" . fill_a_line($parts, 7) . "\n" . fill_a_line($parts, 5) . "</pre>";
	echo "<pre>" . fill_a_line($parts, 5) . "\n" . fill_a_line($parts, 7) . "\n" . fill_a_line($parts, 5) . "</pre>";
}
?>