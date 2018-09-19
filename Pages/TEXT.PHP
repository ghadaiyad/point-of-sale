<?php
header("Content-Type: application/json; charset=UTF-8");
class ITEM
{
  public $ID;
  public $NAME;
  public $TOTAL_QTY;
}


$obj = json_decode($_GET["x"], false);

$stmt = $conn->prepare("SELECT name FROM ? LIMIT ?");
$stmt->bind_param("ss", $obj->table, $obj->limit);
$stmt->execute();
$result = $stmt->get_result();
$outp = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($outp);

$ITEMS = array();
include "../Operations/connect_DB.php";
$sql = "SELECT I.id ,I.name , I.number_items ,I.cost_price, I.sale_price ,I.total_qty ,I.note , GI.name as GroupItems
FROM items I , group_items GI where  GI.id = 1 ";
$result = $conn->query($sql);
if (!$result) {
printf("Errormessage: %s\n", $mysqli->error);
}
while($row = mysqli_fetch_assoc($result)) {
$THIS_ITEMS = new ITEM();
$THIS_ITEMS->ID =$row['id'];
$THIS_ITEMS->NAME =$row['name'];
$THIS_ITEMS->TOTAL_QTY =$row['total_qty'];
array_push($ITEMS,$THIS_ITEMS );
}

$myJSON = json_encode($ITEMS);
//ECHO $myJSON;

?>
