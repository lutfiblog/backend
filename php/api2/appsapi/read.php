<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/Database.php';
include_once '../class/Appsapi.php';

$database = new Database();
$db = $database->getConnection();
 
$items = new Appsapi($db);

$items->id = (isset($_GET['id']) && $_GET['id']) ? $_GET['id'] : '0';

$result = $items->read();

if($result->num_rows > 0){    
    $itemRecords=array();
    $itemRecords["appsapi"]=array(); 
	while ($item = $result->fetch_assoc()) { 	
        extract($item); 
        $itemDetails=array(
            "id" => $id,
            "kode" => $kode,
            "plastic_collector_id" => $plastic_collector_id,
			"total_plastic" => $total_plastic,
			"total_point" => $total_point,
            "status" => $status,            
			"created" => $created,
            "modified" => $modified			
        ); 
       array_push($itemRecords["appsapi"], $itemDetails);
    }    
    http_response_code(200);     
    echo json_encode($itemRecords);
}else{     
    http_response_code(404);     
    echo json_encode(
        array("message" => "No item found.")
    );
} 