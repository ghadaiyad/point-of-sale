<?php
session_start();
//login.php
if(isset($_GET["q"]))
{
    include "../Operations/connect_DB.php";
  $itemid = $_GET["q"];
  $stmt = $conn->prepare("SELECT * FROM items  where  id = ? ");
  $stmt->bind_param("s", $itemid);
  $stmt->execute();
  $result = $stmt->get_result();
  $outp = $result->fetch_all(MYSQLI_ASSOC);
  echo json_encode($outp);
}
 ?>
