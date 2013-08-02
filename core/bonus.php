<?php

function bonus_sc_end($status) {
	global $const, $item_id;

	$status_arr = array(
		'sc_poison'			=> 'Poison',
		'sc_silence' 		=> 'Silence',
		'sc_curse'			=> 'Curse',
		'sc_confusion'		=> 'Confusion',
		'sc_blind'			=> 'Blind',
		'sc_bleeding'		=> 'Bleeding',
		'sc_dpoison'		=> 'Poison (deadly)',
		'sc_provoke'		=> 'Provoke',
		'sc_endure'			=> 'Endure',
		'sc_hallucination'	=> 'Hallucination',
		'sc_stun'			=> 'Stun',
		'sc_sleep'			=> 'Sleep',
		'sc_freeze'			=> 'Frozen',
		'sc_changeundead'	=> 'Change Undead',
		'sc_orcish'			=> 'Reverse Orcish',
	);
	if(isset($status_arr[$status])){
		return "Cures ^000088". $status_arr[$status] ."^000000 Status";
	}
	err(sprintf('item[%d] - UNKNOWN STATUS[%s] @ \core\bonus.php - bonus_sc_end', $item_id, $status));
	return sprintf('item[%d] - UNKNOWN STATUS[%s] @ \core\bonus.php - bonus_sc_end', $item_id, $status);
}

function bonus_sc_start($status, $param1) {
	global $const, $item_id;

	$status_arr = array(
		'sc_poison'			=> 'Inflicts the ^000088Poison^000000 Status for ##var1##',
		'sc_silence'		=> 'Inflicts the ^000088Silence^000000 Status for ##var1##',
		'sc_curse'			=> 'Inflicts the ^000088Curse^000000 Status for ##var1##',
		'sc_confusion'		=> 'Inflicts the ^000088Confusion^000000 Status for ##var1##',
		'sc_blind'			=> 'Inflicts the ^000088Blind^000000 Status for ##var1##',
		'sc_bleeding'		=> 'Inflicts the ^000088Bleeding^000000 Status for ##var1##',
		'sc_dpoison'		=> 'Inflicts the ^000088Deadly Poison^000000 Status for ##var1##',
		'sc_provoke'		=> 'Inflicts the ^000088Provoke^000000 Status for ##var1##',
		'sc_endure'			=> 'Inflicts the ^000088Endure^000000 Status for ##var1##',
		'sc_hallucination'	=> 'Inflicts the ^000088Hallucination^000000 Status for ##var1##',
		'sc_stun'			=> 'Inflicts the ^000088Stun^000000 Status for ##var1##',
		'sc_sleep'			=> 'Inflicts the ^000088Sleep^000000 Status for ##var1##',
		'sc_freeze'			=> 'Inflicts the ^000088Frozen^000000 Status for ##var1##',
		'sc_changeundead'	=> 'Inflicts the ^000088Change Undead^000000 Status for ##var1##',
		'sc_orcish'			=> 'Inflicts the ^000088Reverse Orcish^000000 Status for ##var1##',
		'sc_slowdown'		=> 'Decreases moving speed for ##var1##',
		'sc_aspdpotion0'	=> 'Increases Attack Speed for ##var1##',
		'sc_aspdpotion1'	=> 'Increases Attack Speed for for ##var1##',
		'sc_aspdpotion2'	=> 'Increases Attack Speed for for ##var1##',
		'sc_speedup0'		=> 'Increases moving speed for ##var1##',
		'sc_speedup1'		=> 'Increases moving speed for ##var1##',
		'sc_wedding'		=> 'Changes user appearance for ##var1##',
		'sc_intravision'	=> 'Enables user to detect Hidden Enemies for ##var1##',
		'sc_bossmapinfo'	=> 'Enables user to detect Boss Monster for ##var1##',
		'sc_xmas'			=> 'Changes user appearance for ##var1##',
		'sc_summer'			=> 'Changes user appearance for ##var1##',
		'sc_lifeinsurance'	=> 'Do not lose EXP for next single death within ##var1##',
		## complete
	);
	
	if(isset($status_arr[$status])){
		return str_replace("##var1##", $param1, $status_arr[$status]);
	}
	err(sprintf('item[%d] - UNKNOWN STATUS[%s] @ \core\bonus.php - bonus_sc_start', $item_id, $status));
	return sprintf('item[%d] - UNKNOWN STATUS[%s] @ \core\bonus.php - bonus_sc_start', $item_id, $status);
}

# sc_start with extra param
function bonus_sc_start2($status, $param1, $param2) {
	global $const, $item_id;

	$status_arr = array(
		'sc_atkpotion'		=> 'Increase ^000088ATK +##var2##^000000 for ##var1##',
		'sc_matkpotion'		=> 'Increase ^000088MATK +##var2##^000000 for ##var1##',
		'sc_stun'			=> 'Inflicts the ^000088Stun^000000 Status for ##var1##',
		'sc_blessing'		=> 'Uses level ##var2## ^000088Blessing^000000 on the user for ##var1##',
		'sc_increaseagi'	=> 'Uses level ##var2## ^000088IncreaseAgi^000000 on the user for ##var1##',
		'sc_benedictio'		=> 'Grants armor attribute for ##var1## Holy attribute to convert',
		'sc_curse'			=> 'Inflicts the ^000088Curse^000000 Status for ##var1##',
		'sc_cp_weapon'		=> 'Uses level ##var2## ^000088Chemical Protection Weapon^000000 on the user for ##var1##',
		'sc_cp_shield'		=> 'Uses level ##var2## ^000088Chemical Protection Shield^000000 on the user for ##var1##',
		'sc_cp_helm'		=> 'Uses level ##var2## ^000088Chemical Protection Helm^000000 on the user for ##var1##',
		'sc_fireweapon'		=> 'Enchant the users weapon with the ^FF0000Fire^000000 property for ##var1##',
		'sc_waterweapon'	=> 'Enchant the users weapon with the ^6996ADWater^000000 property for ##var1##',
		'sc_windweapon'		=> 'Enchant the users weapon with the ^7BCC70Wind^000000 property for ##var1##',
		'sc_earthweapon'	=> 'Enchant the users weapon with the ^A68064Earth^000000 property for ##var1##',
		
	);
	
	if(isset($status_arr[$status])){
		return str_replace(array("##var1##", "##var2##"), array($param1,$param2),$status_arr[$status]);
	}
	err(sprintf('item[%d] - UNKNOWN STATUS[%s] @ \core\bonus.php - bonus_sc_start2', $item_id, $status));
	return sprintf('item[%d] - UNKNOWN STATUS[%s] @ \core\bonus.php - bonus_sc_start2', $item_id, $status);
}


?>