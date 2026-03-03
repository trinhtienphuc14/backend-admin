<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/db.php';
include_once '../../model/plant.php';

$db = new DB();
$conn = $db->connect();

$plant = new Plant($conn);

$data = json_decode(file_get_contents("php://input"));

if(!empty($data->product_id)){

    $plant->product_id = $data->product_id;
    $plant->name = $data->name;
    $plant->price = $data->price;
    $plant->image_url = $data->image_url;
    $plant->quantity = $data->quantity;
    $plant->category_id = $data->category_id;

    if($plant->update()){
        echo json_encode(["status"=>true,"message"=>"Updated successfully"]);
    }else{
        echo json_encode(["status"=>false,"message"=>"Update failed"]);
    }

}else{
    echo json_encode(["status"=>false,"message"=>"Missing ID"]);
}
?>