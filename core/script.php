<?php
$desc = array();
$tabs = 1;
$tmp = false;
$nobrace = false;

function bonus_str($bonus) {
	global $item_id, $desc, $tabs, $nobrace;
	$bonus = trim($bonus); // trim whitespace
	
	while($bonus != ""){
		if(substr($bonus, 0, 1) == ";"){
			$bonus = substr($bonus, 1);
			$bonus = trim($bonus);
			if(!strlen($bonus)) {
				return;
			}
		}
		if(substr($bonus, 0, 2) == "if" || substr($bonus, 0, 7) == "else if"){
			if(substr($bonus, 0, 7) == "else if"){
				$elsie = true;
			} else {
				$elsie = false;
			}
			$in_brace = 0;
			$len = strlen($bonus);
			$start = strpos($bonus, "(") + 1;
			for($ptr = $start; $ptr <= $len; $ptr++){
				if($bonus{$ptr} == '('){
					$in_brace++;	
				} elseif($bonus{$ptr} == ')' && $in_brace) {
					$in_brace--;
				} elseif($bonus{$ptr} == ')' && !$in_brace){
					$end = $ptr - $start;
					break;
				}
			}
			$condition = substr($bonus, $start, $end);
			$bonus = trim(substr($bonus, $ptr+1));
			if(substr($bonus, 0, 1) == "{"){
				$in_brace = 0;
				$len = strlen($bonus);
				$start = strpos($bonus, "{") + 1;
				for($ptr = $start; $ptr <= $len; $ptr++){
					if($bonus{$ptr} == '{'){
						$in_brace++;	
					} elseif($bonus{$ptr} == '}' && $in_brace) {
						$in_brace--;
					} elseif($bonus{$ptr} == '}' && !$in_brace){
						$end = $ptr - $start;
						break;
					}
				}
				$statements = trim(substr($bonus, $start, $end));
				$bonus = trim(substr($bonus, $ptr + 1));
			} else {
				$nobrace = true;
				$statements = $bonus;
				$bonus = "";
			}
			# todo - parse the condition
			if($elsie){
				desc("\r\n".str_repeat("\t", $tabs)."} elseif($condition) {");
			} else {
				desc("\r\n".str_repeat("\t", $tabs)."if($condition) {");
			}
			$tabs++;
			bonus_str($statements);
			$tabs--;
			desc("\r\n".str_repeat("\t", $tabs)."}");
			
		} elseif(substr($bonus, 0, 4) == "else"){
			$bonus = trim(substr($bonus,4));
			if(substr($bonus, 0, 1) == "{"){
				$in_brace = 0;
				$len = strlen($bonus);
				$start = strpos($bonus, "{") + 1;
				for($ptr = $start; $ptr <= $len; $ptr++){
					if($bonus{$ptr} == '{'){
						$in_brace++;	
					} elseif($bonus{$ptr} == '}' && $in_brace) {
						$in_brace--;
					} elseif($bonus{$ptr} == '}' && !$in_brace){
						$end = $ptr - $start;
						break;
					}
				}
				$statements = trim(substr($bonus, $start, $end));
				$bonus = trim(substr($bonus, $ptr + 1));
			} else {
				$statements = $bonus;
				$bonus = "";
			}
			if($nobrace) {
				$tabs--;
				desc("\r\n".str_repeat("\t", $tabs)."} else {");
			} else {
				desc(" else {");
			}
			$tabs++;
			bonus_str($statements);
			if(!$nobrace){
				$tabs--;
				desc("\r\n".str_repeat("\t", $tabs)."}");
			}
		} else {
			$len = strlen($bonus);
			$in_brace = 0;
			for($ptr = 0; $ptr <= $len; $ptr++){
				if($bonus{$ptr} == '{'){
					$in_brace++;	
				} elseif($bonus{$ptr} == '}') {
					$in_brace--;
				} elseif($bonus{$ptr} == ';' && !$in_brace){
					break;
				}
			}
			if( $ptr < 1 ) {
				err(" $bonus missing statement");
				$bonus = '';
			}
			$statement = trim(substr($bonus, 0, $ptr+1));
			$bonus = trim(substr($bonus, $ptr+1));
			# Todo - Fix nested else tabs
			desc(str_repeat("\t", $tabs));
			desc("\r\n".str_repeat("\t", $tabs) . statement_parser($statement));
		}
	}
}


function statement_parser($statement){
	global $item_id;
	// locate whitespace between command and params
	if( ($ptr = strpos($statement, ' ')) < 1 ) {
		err("$item_id $statement missing whitespace");
		return;
	}
	
	$cmd = strtolower(substr($statement, 0, $ptr)); // grab the command
	$parser = ''; // $parseFunction
	switch($cmd) {
		case 'itemheal':
			$parser = 'parse_itemheal';
			break;
		case 'sc_end':
		case 'sc_start':
			$parser = 'parse_sc';
			break;
		case 'pet':
			$parser = 'parse_pet';
			break;
		//case 'bonus':
			//$parser = 'parse_bonus';
		//	break;
		default:
			return $statement;
			break;
	}
	$params = param_split( substr($statement, $ptr+1), 1);
	$i = count($params) - 1;
	//print_r($params);
	$params[$i] = substr($params[$i], 0, strpos($params[$i], ';'));
	$params[$i] = const_v($params[$i]);
	
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
		return sprintf('Restores ^000088%s HP and %s SP^000000.', $hp, $sp);
	elseif( $hp )
		return sprintf('Restores ^000088%s HP^000000.', $hp);
	elseif( $sp )
		return sprintf('Restores ^000088%s SP^000000.', $sp);
		
	err('itemheal fucked up (both 0)');
}

function parse_sc($cmd, $params) {
	if( $cmd == 'sc_end' ) {
		return bonus_sc_end($params[0]);
	} else {
		$params[1] = secondsToTime($params[1]/1000);
		if( $params[2] !== "0" ) {
			return bonus_sc_start2($params[0], $params[1], $params[2]);
		} else {
			return bonus_sc_start($params[0], $params[1]);
		}
	}
}

function parse_pet($cmd, $params) {
	global $pet_db;
	$pet = $pet_db[$params[0]][3];
	return sprintf('Pet taming item for ^000088%s^000000.', $pet);
}

?>