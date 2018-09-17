<?php
session_start();
//login.php
if(isset($_POST["user_Name"]))
{
include "../Operations/connect_DB.php";
extract($_POST);
  $sql = "SELECT id,fullname FROM users WHERE user_name = '$user_Name' AND password = md5('$password') ";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
      // output data of each row
$_SESSION["user_ID"] = $row['id'];
$_SESSION["user_Name"] = $row['fullname'];
}
    echo "<script>window.location='http://" . $_SERVER['SERVER_NAME'] ."/PointOfSaleApp/Pages/Sales.php';</script>";


}
   else {
      echo "اسم المستخدم او كلمة المرور خطأ ..";
  }
}else {
header('Location: http://'. $_SERVER["SERVER_NAME"].'/PointOfSaleApp/Pages/404.html');
}

$conn->close();
?>
