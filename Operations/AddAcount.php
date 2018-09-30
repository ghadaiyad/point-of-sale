
<?php include "../Operations/connect_DB.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
extract($_POST);

$sql = "INSERT INTO t_accounts(
 name, address, email, number_Phone_1, number_Phone_2, fax, note
)
VALUES (
  '$name',
  '$address',
  '$email',
  '$phone_1',
  '$phone_2',
  '$fax',
  '$note'
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
