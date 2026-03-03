<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

include_once '../../config/db.php';
include_once '../../model/plant.php';

$db = new DB();
$conn = $db->connect();

$plant = new Plant($conn);

$data = json_decode(file_get_contents("php://input"));

if(
    !empty($data->name) &&
    !empty($data->price)
){
    $plant->name = $data->name;
    $plant->price = $data->price;
    $plant->image_url = $data->image_url ?? "";
    $plant->quantity = $data->quantity ?? 0;
    $plant->category_id = $data->category_id ?? 1;

    if($plant->create()){
        echo json_encode(["status"=>true,"message"=>"Created successfully"]);
    }else{
        echo json_encode(["status"=>false,"message"=>"Create failed"]);
    }

}else{
    echo json_encode(["status"=>false,"message"=>"Missing required fields"]);
}
?>