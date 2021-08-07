<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/Database.php';
include_once '../class/Appsapi.php';

$database = new Database();
$db = $database->getConnection();
 
$items = new Appsapi($db);

$items->id = (isset($_GET['id']) && $_GET['id']) ? $_GET['id'] : '0';

$result = $items->readOne();

if($result->num_rows > 0){    
    $itemRecords=array();
    $itemRecords["appsapi2"]=array(); 
	while ($item = $result->fetch_assoc()) { 	
        extract($item); 
        $itemDetails=array(
            "kode" => $kode,
            "plastic_collector_id" => $plastic_collector_id,
			"total_plastic" => $total_plastic,
			"convert_plastic" => $convert_plastic,
			"total_point" => $total_point,
            "status" => $status,    		
        ); 
       array_push($itemRecords["appsapi2"], $itemDetails);
    }    
    http_response_code(200);     
    echo json_encode($itemRecords);
}else{     
    http_response_code(404);     
    echo json_encode(
        array("message" => "No item found.")
    );
} 