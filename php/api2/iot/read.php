<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/Database.php';
include_once '../class/Iotapi.php';

$database = new Database();
$db = $database->getConnection();
 
$items = new Iotapi($db);

$items->id = (isset($_GET['id']) && $_GET['id']) ? $_GET['id'] : '0';

$result = $items->read();

if($result->num_rows > 0){    
    $itemRecords=array();
    $itemRecords["iotapi"]=array(); 
	while ($item = $result->fetch_assoc()) { 	
        extract($item); 
        $itemDetails=array(
            "id" => $id,
            "mon1" => $mon1,
            "mon2" => $mon2,
			"kon1" => $kon1,
            "kon2" => $kon2,            
			"created" => $created,
            "modified" => $modified			
        ); 
       array_push($itemRecords["iotapi"], $itemDetails);
    }    
    http_response_code(200);     
    echo json_encode($itemRecords);
}else{     
    http_response_code(404);     
    echo json_encode(
        array("message" => "No item found.")
    );
} 