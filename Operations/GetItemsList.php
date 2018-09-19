<?php
session_start();
//login.php

if(isset($_GET["q"]))
{
    include "../Operations/connect_DB.php";

  $groupid = $_GET["q"];
  $stmt = $conn->prepare("SELECT id ,name ,total_qty FROM items  where  group_items_id = ? ");
  $stmt->bind_param("s", $groupid);
  $stmt->execute();
  $result = $stmt->get_result();
  $outp = $result->fetch_all(MYSQLI_ASSOC);

  echo json_encode($outp);


}
 ?>
