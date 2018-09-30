<?php
header("Content-Type: application/json; charset=UTF-8");
include "../Operations/connect_DB.php";

$obj ;

$stmt = $conn->prepare("SELECT id ,name ,total_qty FROM items  where  group_items_id = 1 ");
$stmt->execute();
$result = $stmt->get_result();
$outp = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($outp),"\N";



?>
