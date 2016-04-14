<?php
function jsonc_encode($array, $keys) {
	function map($array) {
		return array_values($array);
	}
	
	foreach($keys as $key) {
		if(!isset($array[$key]))
			throw new Exception("Key '".$key."' does not exist");
		$data_keys = (isset($array[$key][0]))? array_keys($array[$key][0]): [];
		$data_values = array_map("map", $array[$key]);
		$array[$key] = array("keys" => $data_keys, "data" => $data_values);
	}

	return json_encode(array("keys" => $keys, "response" => $array));
}

function jsonc_decode($string) {
	$array = json_decode($string, true);
	unset($string);
	$keys = $array["keys"];
	$array = $array["response"];
	foreach($keys as $key) {
		if(!isset($array[$key]))
			throw new Exception("Key '".$key."' does not exist");
				
		$data_keys = $array[$key]["keys"];
		$data_values = $array[$key]["data"];
		
		$array[$key] = [];
		foreach($data_values as $k => $row) {
			$array[$key][$k] = array();
			foreach($row as $k2 => $val)
				$array[$key][$k][$data_keys[$k2]] = $val;
		}
	}

	return $array;
}