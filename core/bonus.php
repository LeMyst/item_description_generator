<?php

function bonus_status_name($a)
{
  global $const, $item_id;
  
  $ts = array(
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
    'SC_ASPDPOTION0' => 'Increases Attack Speed',
    'SC_ASPDPOTION1' => 'Increases Attack Speed',
    'SC_ASPDPOTION2' => 'Increases Attack Speed',
    'SC_ASPDPOTION3' => 'Increases Attack Speed',
    'SC_SPEEDUP0' => 'Increases Movement Speed',
    'SC_ATKPOTION' => 'Increases Attack Strength',
    'SC_MATKPOTION' => 'Increases Magic Attack Strength',

  );
  
  foreach($ts as $k => $e)
  {
    if( $const[strtolower($k)] == $a )
      return $e;
  }
  
  return sprintf('item[%d] - UNKNOWN STATUS [%d]', $item_id, $a);
}


?>