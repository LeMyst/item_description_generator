<?php

$pet_db = array();

$lines = file('data/pet_db.txt');
$count = 0;
foreach( $lines as $line ) {
	
	if (preg_match('/(\d*),(\D*?),(\D*?),(\d*),(\d*),(\d*),(\d*),(\d*),(\d*),(\d*),(\d*),(\d*),(\d*),(\d*),(\d*),(\d*),(\d*),(\d*),(\d*),(\d*),\{(.*?)\},\{(.*?)\}/s', $line, $pet)) {
		$pet_db[$pet[1]] = $pet;
	} else {
		continue;
	}
	$count++;
}

printf("Done reading %d entries in pet_db.txt.\n", $count);
//print_r($pet_db);
?>