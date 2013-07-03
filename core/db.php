<?php

function line_split($line, $ignore_script = 1, $parse_bracket = 0) {
	$line = strip_comment($line);
	$len = strlen($line);
	$params = array();
	if( !$len )
		return $params;
	$start = 0;
	$in_script = 0;
	$in_string = 0;
	for($ptr = 0; $ptr < $len; $ptr++) {
		if( $line{$ptr} == '{' && !$ignore_script ) {
			$in_script++;
		} else if( $line{$ptr} == '}' && !$ignore_script ) {
			$in_script--;
		} else if( $parse_bracket && $line{$ptr} == '(' ) {
			$in_script++;
		} else if( $parse_bracket && $line{$ptr} == ')' ) {
			$in_script--;
		} else if( $line{$ptr} == '"' ) {
			$in_string = !$in_string;
		} else if( $line{$ptr} == ',' && !$in_script && !$in_string) {
			$value = trim(substr($line, $start, $ptr-$start));
			$value = const_v($value);
			$params[] = $value;
			$start = $ptr + 1;
		} else if( $line{$ptr} == ';' && !$in_script && !$in_string ) {
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