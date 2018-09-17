
<?php include "../Operations/connect_libray.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
extract($_POST);

$sql = "INSERT INTO books (
name, author, cost_price, sale_price, total_qty, note, number_stamp, group_books_id
)
VALUES (
  '$name',
  '$author',
  $cost_price,
  $sale_price,
$total_qty,
  '$note',
  '$number_stamp',
  $group_books
)";

if ($conn->query($sql) === TRUE) {
    echo "تم اضافة مجموعة مواد جديدة .";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

}else {
  header('Location: http://'. $_SERVER["SERVER_NAME"].'/LibraryRepApp/Pages/404.html');
}

 ?>
