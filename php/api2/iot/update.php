<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once '../config/Database.php';
include_once '../class/Iotapi.php';
 
$database = new Database();
$db = $database->getConnection();
 
$items = new Iotapi($db);
 
$data = json_decode(file_get_contents("php://input"));

$items->id = $data->id; 
$items->mon1 = $data->mon1;
$items->mon2 = $data->mon2;
$items->kon1 = $data->kon1;
$items->kon2 = $data->kon2;	
$items->created = date('Y-m-d H:i:s'); 


if($items->update()){     
	http_response_code(200);   
	echo json_encode(array("message" => "Item was updated."));
}else{    
	http_response_code(503);     
	echo json_encode(array("message" => "Unable to update items."));
}
?>