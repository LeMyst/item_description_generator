<?php

# Show Errors
#############
date_default_timezone_set('Asia/Seoul');
error_reporting(E_ALL ^ E_STRICT);
ini_set("display_errors", 1); 

# Core Functions
################
require 'core/const.php';
require 'core/db.php';
require 'core/types.php';
require 'core/script.php';
require 'core/bonus.php';

require 'db/pet.php';
//require 'db.skill.php';

# Input Files
#############
$item_db = "data/item_db.txt";
$item_db = fopen($item_db, 'r') or exit("Unable to open $item_db");

# Output Files
##############
$desc_out = "desc_out.txt";
$desc_out = fopen($desc_out, 'w') or exit("Unable to open $desc_out");

$error = "error.txt";
$error = fopen($error, 'w') or exit("Unable to open $error");


# Global Vars
#############
$item_id = 0;
$count = 2000;


# Loop every item in item_db.txt
while (!feof($item_db)) {
//for($i = 0; $i <= $count; $i++){
	#echo "$i\r\n";
	$line = fgets($item_db);
	if(preg_match('/(\d*),(\D*?),(\D*?),(\d*?),(\d*?),(\d*?),(\d*?),(\d*?),(\d*?),(\d*?),(\d*?),(\d*?),(.*?),(\d*?),(\d*?),(\d*?),(\d*?),(\d*?),(\d*?),(\d*?),\{(.*?)\},\{(.*?)\},\{(.*?)\}/', $line, $m)) {
		// ID,AegisName,Name,Type,Buy,Sell,Weight,ATK,MATK,DEF,Range,Slots,Job,Upper,Gender,Loc,wLV,eLV,Refineable,View,{ Script },{ OnEquip_Script },{ OnUnequip_Script }
		// 1  2         3    4    5   6    7      8   9    10  11    12    13  14    15     16  17  18  19         20     21          22                23
		$item_id = $m[1];
		item_script($m[21]);
		#desc($m[2] . " {");
			#item_type($m[4], $m[20], $m[16]);
			#item_weight($m[7]);
			#item_attack($m[8]);
			#item_mattack($m[9]);
			#item_def($m[10]);
			#item_gender($m[15]);
			#item_weaplvl($m[17]);
			#item_reqlvl($m[18]);
			#if( $m[4] == 4 || $m[4] == 5 ) {
			#	item_refinable($m[19]);
			#	item_upper($m[14]);
			#	item_job($m[13]);
			#}
		#desc("}\r\n");
	}
}

function desc($mes) {
	global $desc_out;
	fwrite($desc_out, $mes);
	echo $mes;
}


function item_script($script) {
	global $item_id, $tabs, $nobrace;
	echo "\r\n-=$item_id=-\r\n";
	$tabs = 1;
	$nobrace = false;
	$descript = bonus_str($script);
	
	
}

function item_upper($upper) {
	if($upper === "" || $upper == "7") {
		return;
	}
	global $equipUpper, $item_id;
	$arr = array();
	foreach ($equipUpper as $bit => $name) {
		if ($upper & $bit) {
			$arr[] = $name;
		}
	}
	desc("\tClass :^777777 " . implode(' / ', $arr) . "^000000");
}

function item_refinable($refine) {
	if($refine === "1") {
		desc("\tRefinable :^777777 Yes^000000");
	} else {
		desc("\tRefinable :^777777 No^000000");
	}
}

function item_slots($slots) {
	if($slots > 0) {
		desc("\tSlots :^777777 $slots ^000000");
	}
}


function item_job($job) {
	global $item_id, $equipJobs;
	$jobs = array();

	if($job == 0xFFFFFFFF) {
		desc("\tJob :^777777 All Jobs^000000");
		return;
	} elseif($job === "") {
		desc("\tJob :^777777 All Jobs^000000");
		return;
	} elseif($job == 0xFFFFFFFE) {
		desc("\tJob :^777777 All Jobs except Novice^000000");
		return;
	} else {
		$job = hexdec($job);
		foreach( $equipJobs as $bit => $name ) {
			if ($job & $bit) {
				$jobs[] = $name;
			}
		}
		$jobs_ = implode(' / ', $jobs);
		if( count($jobs) > 20 ) { # refine this value
			foreach ($equipJobs as $bit => $name) {
				if (!($job & $bit)) {
					$jobs[] = $name;
				}
			}
			$jobs_ = "All Jobs except " . implode(' / ', $jobs);
		}
		desc("\tJob :^777777 $jobs_ ^000000");
	}
}

function item_gender($sex) {
	global $item_id;
	if($sex === "2" || $sex === "") {
		return;
	} elseif($sex === "1") {
		desc("\tGender :^777777 Male^000000");
	} elseif($sex === "0") {
		desc("\tGender :^777777 Female^000000");
	} else {
		echo "invalid sex $sex @ $item_id\r\n";
	}
}

function item_mattack($value) {
	if($value) {
		desc("\tMagic Attack :^777777 $value^000000");
	}
}


function item_attack($value) {
	if($value) {
		desc("\tAttack :^777777 $value^000000");
	}
}

function item_weaplvl($lvl) {
	if($lvl) {
		desc("\tWeapon Level :^777777 $lvl^000000");
	}
}

function item_reqlvl($lvl) {
	if($lvl) {
		desc("\tRequired Level :^777777 $lvl^000000");
	}
}

function item_def($def) {
	if($def) {
		desc("\tDefense :^777777 $def^000000");
	}
}

function item_weight($weight) {
	if($weight != "") {
		$weight = $weight / 10;
		desc("\tWeight :^777777 $weight^000000");
	}
}

function item_type($type, $view, $loc) {
	global $types, $weapons, $locations, $ammo;
	$dtype = $types[$type];
	if($dtype) {
		if($type == 4) { // weapon
			$view = $weapons[$view];
			desc("\tType :^777777 $dtype - $view ^000000");
		} elseif($type == 5) { // armor
			$view = $locations[$loc];
			desc("\tType :^777777 $dtype - $view ^000000");
		} elseif($type == 10) { // ammo
			$view = $ammo[$view];
			desc("\tType :^777777 $dtype - $view ^000000");
		} else {
			desc("\tType :^777777 $dtype^000000");
		}
	} else {
		echo "unknown item type $type\r\n";
	}
}


// function to write output files
function err($mes) {
	global $error;
	fwrite($error, $mes . "\r\n");
}



function swap(&$a, &$b) {
	$tmp = $a;
	$b = $a;
	$b = $tmp;
}

?>