<?php

function bonus_str(&$bonus) {
	global $item_id;
	$bonus = trim($bonus); // trim whitespace
	if( ($ptr = strpos($bonus, ' ')) < 1 ) {
		// check for whitespace between command and params
		$bonus = '';
		return '';
	}
	$cmd = strtolower(substr($bonus, 0, $ptr)); // grab the command
	$parser = ''; // $parseFunction
	switch($cmd) {
		case 'itemheal':
			$parser = 'parse_itemheal';
			break;
		case 'sc_end':
		case 'sc_start':
			$parser = 'parse_sc';
			break;
		default:
			$mes = "$item_id - Unknown [$bonus]";
			err($mes);
			return;
	}
	$params = line_split( substr($bonus, $ptr+1), 1, 1);
	$ptr = strpos($bonus, ';');
	if( $ptr < 1 ) {
		$bonus = '';
	} else {
		$bonus = substr($bonus, ++$ptr);
		$i = count($params) - 1;
		$params[$i] = substr($params[$i], 0, strpos($params[$i], ';'));
		$params[$i] = const_v($params[$i]);
	}
	return $parser($cmd, $params);
}



# Parser Functions
##################

function parse_itemheal($cmd, $params) {
	#print_r($params);
	if( strpos($params[0], 'rand') !== false ) {
		$ptr = strpos($params[0], '(') + 1;
		$params[0] = substr($params[0], $ptr);
		$ptr = strpos($params[0], ',');
		$min = intval(substr($params[0], 0, $ptr));
		$max = intval(substr($params[0], $ptr + 1));
		$hp = sprintf("%d~%d", $min, $max);
		unset($min);
		unset($max);
		unset($ptr);
	} else {
		$hp = intval($params[0]);
	}
		
	if( strpos($params[1], 'rand') !== false ) {
		$ptr = strpos($params[1], '(') + 1;
		$params[1] = substr($params[1], $ptr);
		$ptr = strpos($params[1], ',');
		$min = intval(substr($params[1], 0, $ptr));
		$max = intval(substr($params[1], $ptr + 1));
		$sp = sprintf("%d~%d", $min, $max);
		unset($min);
		unset($max);
		unset($ptr);
	} else {
		$sp = intval($params[1]);
	}

	if( $hp && $sp )
		return sprintf('Restores %s HP and %s SP.', $hp, $sp);
	elseif( $hp )
		return sprintf('Restores %s HP.', $hp);
	elseif( $sp )
		return sprintf('Restores %s SP.', $sp);
		
	err('itemheal fucked up (both 0)');
}

function parse_sc($cmd, $params){
	$sn = bonus_status_name($params[0]);
  
	if( $cmd == 'sc_end' ) {
		return sprintf('Cures %s.', $sn);
	} else {
		if( $params[2] > 0 ) {
			return sprintf('%s (lv. %d) for %d seconds.', $sn, $params[2], $params[1] / 1000);
		} else {
			return sprintf('%s for %d seconds.', $sn, $params[1] / 1000);
		}
	}
}



?>