<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}
include_once '../../config/db.php';
include_once '../../model/plant.php';

$db = new DB();
$conn = $db->connect();

$plant = new Plant($conn);
$stmt = $plant->read();

$plants = [];

while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    $plants[] = $row;
}

echo json_encode([
    "status"=>true,
    "data"=>$plants
]);
?>