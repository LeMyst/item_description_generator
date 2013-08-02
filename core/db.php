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
	for($ptr = 0; $ptr <= $len; $ptr++) {
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
			$value = strtolower(trim(substr($line, $start, $ptr-$start)));
			#$value = const_v($value);
			$params[] = $value;
			$start = $ptr + 1;
		} else if( $line{$ptr} == ';' && !$in_bracket && !$in_string ) {
			if( ($len-$start) > 0 ) {
				$value = strtolower(trim(substr($line, $start, $ptr-$start)));
				#$value = const_v($value);
				$params[] = $value;
			}
			break;
		}
	}
	#print_r($params);
	#echo "line = $line\n";
	#echo "len = $len , ptr = $ptr , start = $start , remain = " . substr($line, $start);
	#die();
	return $params;
}

function strip_comment($line) {
	$line = trim($line);
	$start = strpos($line, '//');
	if( $start !== false )
		$line = substr($line, 0, $start);
	return $line;
}


function secondsToTime($seconds) {
	$orig = $seconds;
	// extract days
	$days = floor($seconds / 3600 / 24);

	// extract hours
	$hours = floor($seconds / 3600) - $days*24;

	// extract minutes
	$divisor_for_minutes = $seconds % 3600;
	$minutes = floor($divisor_for_minutes / 60);

	// extract the remaining seconds
	$divisor_for_seconds = $divisor_for_minutes % 60;
	$seconds = ceil($divisor_for_seconds);

	// return the final array
	$obj = array(
		"d" => (int) $days,
		"h" => (int) $hours,
		"m" => (int) $minutes,
		"s" => (int) $seconds,
	);

	if (!$obj["d"] && !$obj["h"] && !$obj["m"]) {
		if($obj["s"] > 1) {
			return $obj["s"] . " Seconds";
		} else {
			return $obj["s"] . " Second";
		}
	}
	if (!$obj["d"] && !$obj["h"] && !$obj["s"]) {
		if($obj["m"] > 1) {
			return $obj["m"] . " Minutes";
		} else {
			return $obj["m"] . " Minute";
		}
	}
	if (!$obj["d"] && !$obj["m"] && !$obj["s"]) {
		if($obj["h"] > 1) {
			return $obj["h"] . " Hours";
		} else {
			return $obj["h"] . " Hour";
		}
	}
	if (!$obj["d"] && !$obj["h"]) {
		if($obj["m"] > 1) {
			return $obj["m"] . " Mins " . $obj["s"] . " Seconds";
		} else {
			return $obj["m"] . " Min " . $obj["s"] . " Seconds";
		}
	}
	die("HERE");
}
?>