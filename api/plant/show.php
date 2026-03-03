<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/db.php';
include_once '../../model/plant.php';

$db = new DB();
$conn = $db->connect();

$plant = new Plant($conn);

if(isset($_GET['product_id'])){

    $plant->product_id = $_GET['product_id'];
    $plant->show();

    echo json_encode([
        "status"=>true,
        "data"=>[
            "product_id"=>$plant->product_id,
            "name"=>$plant->name,
            "price"=>$plant->price,
            "image_url"=>$plant->image_url,
            "quantity"=>$plant->quantity,
            "category_id"=>$plant->category_id
        ]
    ]);

}else{
    echo json_encode(["status"=>false,"message"=>"Missing ID"]);
}
?>