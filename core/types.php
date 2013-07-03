<?php

$equipJobs = array(
	pow(2,  0) => 'Novice',
	pow(2,  1) => 'Swordman',
	pow(2,  2) => 'Mage',
	pow(2,  3) => 'Archer',
	pow(2,  4) => 'Acolyte',
	pow(2,  5) => 'Merchant',
	pow(2,  6) => 'Thief',
	pow(2,  7) => 'Knight',
	pow(2,  8) => 'Priest',
	pow(2,  9) => 'Wizard',
	pow(2, 10) => 'Blacksmith',
	pow(2, 11) => 'Hunter',
	pow(2, 12) => 'Assassin',
	//pow(2, 13) => 'Unused',
	pow(2, 14) => 'Crusader',
	pow(2, 15) => 'Monk',
	pow(2, 16) => 'Sage',
	pow(2, 17) => 'Rogue',
	pow(2, 18) => 'Alchemist',
	pow(2, 19) => 'Bard/Dancer',
	//pow(2, 20) => 'Unused',
	pow(2, 21) => 'Taekwon',
	pow(2, 22) => 'Star Gladiator',
	pow(2, 23) => 'Soul Linker',
	pow(2, 24) => 'Gunslinger',
	pow(2, 25) => 'Ninja'
);

$equipUpper = array(
	1 => 'Normal',
	2 => 'Trans and Third Classes',
	4 => 'Baby Classes',
	8 => 'Third Classes',
);

$weapons = array(
	0 => 'Bare Fist',
	1 => 'Dagger',
	2 => 'One-Handed Sword',
	3 => 'Two-Handed Sword',
	4 => 'One-Handed Spear',
	5 => 'Two-Handed Spear',
	6 => 'One-Handed Axe',
	7 => 'Two-Handed Axe',
	8 => 'Mace',
	//9 => 'Unused',
	10 => 'Staff',
	11 => 'Bow',
	12 => 'Knuckle',
	13 => 'Musical Instrument',
	14 => 'Whip',
	15 => 'Book',
	16 => 'Katar',
	17 => 'Revolver',
	18 => 'Rifle',
	19 => 'Gatling Gun',
	20 => 'Shotgun',
	21 => 'Grenade Launcher',
	22 => 'Fuuma Shuriken',
	23 => 'Two-Handed Staff',
);

$ammo = array(
	1 => 'Arrow',
	2 => 'Throwing Dagger',
	3 => 'Bullet',
	4 => 'Shell',
	5 => 'Grenade',
	6 => 'Shuriken',
	7 => 'Kunai'
);

$locations = array(
	    0 => 'None',
	  256 => 'Upper Headgear',
	  512 => 'Middle Headgear',
	    1 => 'Lower Headgear',
	  769 => 'Upper/Mid/Lower Headgear',
	  768 => 'Upper/Mid Headgear',
	  //257 => 'Upper/Lower Headgear',
	  513 => 'Mid/Lower Headgear',
	   16 => 'Armor',
	    2 => 'Weapon',
	   32 => 'Shield',
	   34 => 'Two-Handed',
	   50 => 'Armor/Hands',
	    4 => 'Garment',
	   64 => 'Footgear',
	  136 => 'Accessories',
	32768 => 'Arrow'
);

$types = array(
	0 => 'Usable : Healing',
	//1 => 'Unknown',
	2 => 'Usable : Other',
	3 => 'Etc',
	4 => 'Weapon',
	5 => 'Armor',
	6 => 'Card',
	7 => 'Pet Egg',
	8 => 'Pet Equipment',
	//9 => 'Unknown2',
	10 => 'Ammo',
	11 => 'Usable : Delay Consumption',
	17 => 'Throw Weapon', 
	18 => 'Cash Shop Reward',
	19 => 'Cannon Ball',
);

function equippableJobs($equipJob) {
	global $equipJobs;
	$jobs      = array();
	$equipJob  = (int)$equipJob;
	
	foreach ($equipJobs as $bit => $name) {
		if ($equipJob & $bit) {
			$jobs[] = $name;
		}
	}
	
	if (count($jobs) === count($equipJobs)) {
		return array('All Jobs');
	} else if (count($jobs) === count($equipJobs) - 1 && !in_array($equipJobs[0], $jobs)) {
		return array('All Jobs Except Novice');
	} else {
		return implode(' / ', $jobs);
	}
}

?>