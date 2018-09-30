<?php
session_start();
//login.php
if(isset($_GET["q"]))
{
  include "../Operations/connect_DB.php";
$groupid = $_GET["q"];
$stmt = $conn->prepare("SELECT PI.*, TA.name , u.user_name FROM purchases_invoice PI , t_accounts TA ,users U  where  TA.ID = PI.t_account_id AND PI.status = ? ");
$stmt->bind_param("s", $groupid);
$stmt->execute();
$result = $stmt->get_result();
$outp = $result->fetch_all(MYSQLI_ASSOC);
echo json_encode($outp);
}
?>
