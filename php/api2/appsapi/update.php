<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../config/Database.php';
include_once '../class/Appsapi.php';
 
$database = new Database();
$db = $database->getConnection();
 
$items = new Appsapi($db);
 
$data = json_decode(file_get_contents("php://input"));

	$items->id = $data->id; 
	$items->kode = $data->kode;
    $items->plastic_collector_id = $data->plastic_collector_id;
    $items->total_plastic = $data->total_plastic;	
    $items->total_point = $data->total_point;
    $items->status = $data->status;	
    $items->created = date('Y-m-d H:i:s'); 
	
	
	if($items->update()){     
		http_response_code(200);   
		echo json_encode(array("message" => "Item was updated."));
	}else{    
		http_response_code(503);     
		echo json_encode(array("message" => "Unable to update items."));
	}
?>