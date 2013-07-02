<?php

$const = array();
$lines = file('data/const.txt');

foreach($lines as $line) {
	$line = trim($line);
	if( strlen($line) < 2 || substr($line, 0, 2) == '//' ) {
		continue;
	}
	$line = explode("\t", $line);
	if( count($line) != 2 ) {
		continue;
	}
	$const[strtolower($line[0])] = intval($line[1]);
}
#print_r($const);
function const_v($value) {
	global $const;
	if( isset($const[strtolower($value)]) ) {
		return $const[strtolower($value)];
	}
	$value = trim($value);
	if( substr_count($value, '"') % 2 )
		err('Odd number of quote signs: %s', $value);
	if( substr($value, 0, 2) == '0x' )
		$value = intval(substr($value,2), 16);
	return $value;
}

?>