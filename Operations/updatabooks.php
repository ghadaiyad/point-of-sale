
<?php include "../Operations/connect_libray.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
extract($_POST);
$sql = "UPDATE books SET
 name='$name' ,
author='$author',
cost_price=$cost_price,
sale_price=$sale_price,
note='$note',
number_stamp='$number_stamp',
group_books_id=$group_books
 WHERE id=$book_id";

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
