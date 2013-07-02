<?php

function line_split($line, $ignore_script = 1, $parse_bracket = 0) {
	$line = strip_comment($line);
	$len = strlen($line);
	$a = array();
	if( !$len )
		return $a;
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
			$v = trim(substr($line, $start, $ptr-$start));
			$v = const_v($v);
			$a[] = $v;
			$start = $ptr + 1;
		} else if( $line{$ptr} == ';' && !$in_script && !$in_string ) {
			break;
		}
	}
	if( ($len-$start) > 0 ) {
		$v = substr($line, $start);
		$v = const_v($v);
		$a[] = $v;
	}
	return $a;
}

function strip_comment($line) {
	$line = trim($line);
	$start = strpos($line, '//');
	if( $start !== false )
		$line = substr($line, 0, $start);
	return $line;
}

?>