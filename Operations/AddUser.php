	<?php
	include "../Operations/connect_libray.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	extract($_POST);
//$time_log = date("Y-m-d h:i:sa");
//getdate()

  $sql = "INSERT INTO users (fullname , user_name ,email , password, status)
  VALUES ('$fullname',
		'$user_Name',
		'$email',
		md5('$password'),
		1
	)";

  if ($conn->query($sql) === TRUE) {
		session_start();
		session_unset();

		// destroy the session
		session_destroy();
  echo "<script>window.location='login.php';</script>";
}else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}
}else {
header('Location: http://'. $_SERVER["SERVER_NAME"].'/LibraryRepApp/Pages/404.html');
}


   ?>
