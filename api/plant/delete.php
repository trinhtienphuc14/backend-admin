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

    if($plant->delete()){
        echo json_encode(["status"=>true,"message"=>"Deleted successfully"]);
    }else{
        echo json_encode(["status"=>false,"message"=>"Delete failed"]);
    }

}else{
    echo json_encode(["status"=>false,"message"=>"Missing ID"]);
}
?>