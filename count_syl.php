<?php
$word = "refrigerators";

echo count_syl($word);

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

?>