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
		'SC_WEDDING'		=> '',
		'SC_INTRAVISION'	=> 'Enables user to detect Hidden Enemies for ##var1##',
		'SC_BOSSMAPINFO'	=> 'Enables user to detect Boss Monster for ##var1##',
		'SC_XMAS'			=> 'Changes user appearance for ##var1##',
		'SC_SUMMER'			=> '',
		'SC_LIFEINSURANCE'	=> 'Inflicts the ^000088Reverse Orcish^000000 Status for ##var1##',
	);
	foreach($statuss as $status => $desc) {
		if( $const[strtolower($status)] == $status_id ) {
			return str_replace("##var1##", $param1, $desc);
		}
	}
	err(sprintf('item[%d] - UNKNOWN STATUS_ID[%s] @ \core\bonus.php - bonus_sc_start', $item_id, $status_id));
	return "ERR";
}

function bonus_sc_start2($status_id, $param1, $param2) {
	global $const, $item_id;

	$statuss = array(
		'SC_POISON'	=> 'Poison Status',
		'SC_SILENCE' => 'Silence Status',
		'SC_CURSE'	=> 'Curse Status',
		'SC_CONFUSION'	=> 'Confusion Status',
		'SC_BLIND'	=> 'Blind Status',
		'SC_BLEEDING'	=> 'Bleeding Status',
		'SC_DPOISON'	=> 'Poison (deadly) Status',
		'SC_PROVOKE'	=> 'Provoke Status',
		'SC_ENDURE'	=> 'Endure Status',
		'SC_HALLUCINATION'	=> 'Hallucination Status',
		'SC_STUN'	=> 'Stun Status',
		'SC_SLEEP'	=> 'Sleep Status',
		'SC_FREEZE'	=> 'Frozen Status',
		'SC_CHANGEUNDEAD'	=> 'Change Undead Status',
		'SC_ORCISH'	=> 'Reverse Orcish Status',
	);
	foreach($statuss as $status => $desc) {
		if( $const[strtolower($status)] == $status_id ) {
			return str_replace(array("##var1##", "##var2##"), array($param1,$param2),$desc);
		}
	}
	//err(sprintf('item[%d] - UNKNOWN STATUS_ID[%s] @ \core\bonus.php - bonus_sc_start2', $item_id, $status_id));
	//return "ERR";
}


?>