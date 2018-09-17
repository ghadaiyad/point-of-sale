
<?php include "../Operations/connect_libray.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
extract($_POST);
$sql = "UPDATE group_books SET
 name='$groupname' ,
note='$groupnote'
 WHERE id=$Group_book_id";

 if (mysqli_query($conn, $sql)) {
     echo "Record updated successfully";
 } else {
     echo "Error updating record: " . mysqli_error($conn);
 }

$conn->close();

}else {
  header('Location: http://'. $_SERVER["SERVER_NAME"].'/LibraryRepApp/Pages/404.html');
}

 ?>
