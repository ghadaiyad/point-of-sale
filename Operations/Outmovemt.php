
<?php
include "../Operations/connect_libray.php";
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
extract($_POST);
$time_log = date("Y-m-d h:i:sa");
$id_user=$_SESSION['user_ID'];
$sql = "INSERT INTO repository_move (
book_id, type_M, qty_move,note,  posting_datatime, user_id
)
VALUES (
  $book_id,
  0,
  $number,
  '$note',
'$time_log',
  $id_user
)";
if ($conn->query($sql) === TRUE) {
echo $new_totalqty;
  $sql = "UPDATE books SET total_qty =$new_totalqty WHERE id = $book_id";
  if ($conn->query($sql) === TRUE) {
      echo "Record updated successfully";
  } else {
      echo "Error updating record: " . $conn->error;
  }

    echo "تم اضافة مجموعة مواد جديدة .";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

}else {
  header('Location: http://'. $_SERVER["SERVER_NAME"].'/LibraryRepApp/Pages/404.html');
}

 ?>
