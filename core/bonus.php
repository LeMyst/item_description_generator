<?php

function bonus_sc_end($status_id) {
	global $const, $item_id;

	$statuss = array(
		'SC_POISON'			=> 'Poison',
		'SC_SILENCE' 		=> 'Silence',
		'SC_CURSE'			=> 'Curse',
		'SC_CONFUSION'		=> 'Confusion',
		'SC_BLIND'			=> 'Blind',
		'SC_BLEEDING'		=> 'Bleeding',
		'SC_DPOISON'		=> 'Poison (deadly)',
		'SC_PROVOKE'		=> 'Provoke',
		'SC_ENDURE'			=> 'Endure',
		'SC_HALLUCINATION'	=> 'Hallucination',
		'SC_STUN'			=> 'Stun',
		'SC_SLEEP'			=> 'Sleep',
		'SC_FREEZE'			=> 'Frozen',
		'SC_CHANGEUNDEAD'	=> 'Change Undead',
		'SC_ORCISH'			=> 'Reverse Orcish',
	);
	foreach($statuss as $status => $name) {
		if( $const[strtolower($status)] == $status_id ) {
			return "Cures ^000088$name^000000 Status";
		}
	}
	err(sprintf('item[%d] - UNKNOWN STATUS_ID [%s] @ \core\bonus.php - bonus_sc_end', $item_id, $status_id));
	return "ERR";
}

function bonus_sc_start($status_id, $param1) {
	global $const, $item_id;

	$statuss = array(
		'SC_POISON'			=> 'Inflicts the ^000088Poison^000000 Status for ##var1##',
		'SC_SILENCE'		=> 'Inflicts the ^000088Silence^000000 Status for ##var1##',
		'SC_CURSE'			=> 'Inflicts the ^000088Curse^000000 Status for ##var1##',
		'SC_CONFUSION'		=> 'Inflicts the ^000088Confusion^000000 Status for ##var1##',
		'SC_BLIND'			=> 'Inflicts the ^000088Blind^000000 Status for ##var1##',
		'SC_BLEEDING'		=> 'Inflicts the ^000088Bleeding^000000 Status for ##var1##',
		'SC_DPOISON'		=> 'Inflicts the ^000088Deadly Poison^000000 Status for ##var1##',
		'SC_PROVOKE'		=> 'Inflicts the ^000088Provoke^000000 Status for ##var1##',
		'SC_ENDURE'			=> 'Inflicts the ^000088Endure^000000 Status for ##var1##',
		'SC_HALLUCINATION'	=> 'Inflicts the ^000088Hallucination^000000 Status for ##var1##',
		'SC_STUN'			=> 'Inflicts the ^000088Stun^000000 Status for ##var1##',
		'SC_SLEEP'			=> 'Inflicts the ^000088Sleep^000000 Status for ##var1##',
		'SC_FREEZE'			=> 'Inflicts the ^000088Frozen^000000 Status for ##var1##',
		'SC_CHANGEUNDEAD'	=> 'Inflicts the ^000088Change Undead^000000 Status for ##var1##',
		'SC_ORCISH'			=> 'Inflicts the ^000088Reverse Orcish^000000 Status for ##var1##',
		'SC_SLOWDOWN'		=> 'Decreases moving speed for ##var1##',
		'SC_ASPDPOTION0'	=> 'Increases Attack Speed for ##var1##',
		'SC_ASPDPOTION1'	=> 'Increases Attack Speed for for ##var1##',
		'SC_ASPDPOTION2'	=> 'Increases Attack Speed for for ##var1##',
		'SC_SPEEDUP0'		=> 'Increases moving speed for ##var1##',
		'SC_SPEEDUP1'		=> 'Increases moving speed for ##var1##',
		'SC_WEDDING'		=> 'Changes user appearance for ##var1##',
		'SC_INTRAVISION'	=> 'Enables user to detect Hidden Enemies for ##var1##',
		'SC_BOSSMAPINFO'	=> 'Enables user to detect Boss Monster for ##var1##',
		'SC_XMAS'			=> 'Changes user appearance for ##var1##',
		'SC_SUMMER'			=> 'Changes user appearance for ##var1##',
		'SC_LIFEINSURANCE'	=> 'Do not lose EXP for next single death within ##var1##',
		## complete
	);
	foreach($statuss as $status => $desc) {
		if( $const[strtolower($status)] == $status_id ) {
			return str_replace("##var1##", $param1, $desc);
		}
	}
	err(sprintf('item[%d] - UNKNOWN STATUS_ID[%s] @ \core\bonus.php - bonus_sc_start', $item_id, $status_id));
	return "ERR";
}
# sc_start with extra param
function bonus_sc_start2($status_id, $param1, $param2) {
	global $const, $item_id;

	$statuss = array(
		'SC_ATKPOTION'		=> 'Increase ^000088ATK +##var2##^000000 for ##var1##',
		'SC_MATKPOTION'		=> 'Increase ^000088MATK +##var2##^000000 for ##var1##',
		'SC_STUN'			=> 'Inflicts the ^000088Stun^000000 Status for ##var1##',
		'SC_BLESSING'		=> 'Uses level ##var2## ^000088Blessing^000000 on the user for ##var1##',
		'SC_INCREASEAGI'	=> 'Uses level ##var2## ^000088IncreaseAgi^000000 on the user for ##var1##',
		'SC_BENEDICTIO'		=> 'Grants armor attribute for ##var1## Holy attribute to convert',
		'SC_CURSE'			=> 'Inflicts the ^000088Curse^000000 Status for ##var1##',
		'SC_CP_WEAPON'		=> 'Uses level ##var2## ^000088Chemical Protection Weapon^000000 on the user for ##var1##',
		'SC_CP_SHIELD'		=> 'Uses level ##var2## ^000088Chemical Protection Shield^000000 on the user for ##var1##',
		'SC_CP_HELM'		=> 'Uses level ##var2## ^000088Chemical Protection Helm^000000 on the user for ##var1##',
		'SC_FIREWEAPON'		=> 'Enchant the users weapon with the ^FF0000Fire^000000 property for ##var1##',
		'SC_WATERWEAPON'	=> 'Enchant the users weapon with the ^6996ADWater^000000 property for ##var1##',
		'SC_WINDWEAPON'		=> 'Enchant the users weapon with the ^7BCC70Wind^000000 property for ##var1##',
		'SC_EARTHWEAPON'	=> 'Enchant the users weapon with the ^A68064Earth^000000 property for ##var1##',
		
	);
	foreach($statuss as $status => $desc) {
		if( $const[strtolower($status)] == $status_id ) {
			return str_replace(array("##var1##", "##var2##"), array($param1,$param2),$desc);
		}
	}
	err(sprintf('item[%d] - UNKNOWN STATUS_ID[%s] @ \core\bonus.php - bonus_sc_start2', $item_id, $status_id));
	return "ERR";
}


?>