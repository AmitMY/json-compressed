<?php
ini_set('memory_limit', '2048M');

//header('Content-Type: application/x-jsonc');

include "../source/jsonc.php";

/*$test_data = ["status" => true, "data" => []];
for($i=0;$i<50000;$i++) {
	$test_data["data"][$i] = array();
	for($j=0;$j<50;$j++)
		$test_data["data"][$i]["string".$j] = "string";
}*/

$test_data = json_decode(file_get_contents("data.json"), true);
$jsonc = jsonc_encode($test_data, ["data"]);
$json = json_encode($test_data);
$mb = 1024*1024;

echo "Number of rows:<br />";
echo number_format(count($test_data["data"]));
echo "<br />";
echo "<br />";
echo "JSON Compressed size:<br />";
echo round(strlen($jsonc)/$mb, 2)."MB";
echo "<br />";
echo "<br />";
echo "JSON size:<br />";
echo round(strlen($json)/$mb, 2)."MB";
echo "<br />";
echo "<br />";
echo "Compressed size compared to uncompressed size:<br />";
echo round(100*(strlen($jsonc)/strlen($json)), 2)."%";