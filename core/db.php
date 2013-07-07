<?php

function param_split($line, $parse_bracket = 1) {
	$line = strip_comment($line);
	$len = strlen($line);
	$params = array();
	if( !$len )
		return $params;
	$start = 0;
	$in_bracket = 0;
	$in_string = 0;
	for($ptr = 0; $ptr < $len; $ptr++) {
		if( $parse_bracket && $line{$ptr} == '{' ) {
			$in_bracket++;
		} else if( $parse_bracket && $line{$ptr} == '}' ) {
			$in_bracket--;
		} else if( $parse_bracket && $line{$ptr} == '(' ) {
			$in_bracket++;
		} else if( $parse_bracket && $line{$ptr} == ')' ) {
			$in_bracket--;
		} else if( $line{$ptr} == '"' ) {
			$in_string = !$in_string;
		} else if( $line{$ptr} == ',' && !$in_bracket && !$in_string) {
			$value = trim(substr($line, $start, $ptr-$start));
			$value = const_v($value);
			$params[] = $value;
			$start = $ptr + 1;
		} else if( $line{$ptr} == ';' && !$in_bracket && !$in_string ) {
			break;
		}
	}
	if( ($len-$start) > 0 ) {
		$value = substr($line, $start);
		$value = const_v($value);
		$params[] = $value;
	}
	return $params;
}

function strip_comment($line) {
	$line = trim($line);
	$start = strpos($line, '//');
	if( $start !== false )
		$line = substr($line, 0, $start);
	return $line;
}

?>