<?php
session_start();
include "../Operations/connect_DB.php";
header('Content-Type: text/plain');
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $time_log = date("Y-m-d h:i:sa");
   $id_user=$_SESSION['user_ID'];
   $invoice_data = utf8_encode($_POST['invoice_data']);
   $invoice_data = json_decode($invoice_data);
   $inventory_data = $invoice_data->inventory;
   $date = date_create($invoice_data->purchase_date);
  $date=  date_format($date,"Y-m-d");
 $sql = "INSERT INTO purchases_invoice
 (purchases_id,total_ammount, total_qty, rate, payment_method, discount,purchases_date ,  posting_datatime, total_items, note,t_account_id, img ,User_id )
  VALUES (
      $invoice_data->purchases_id,
    $invoice_data->total_ammount,
    $invoice_data->total_qty,
    $invoice_data->rate,
    $invoice_data->payment_method,
    $invoice_data->discount,
    '$date',
    '$time_log',
    $invoice_data->total_items,
    '$invoice_data->note',
    $invoice_data->t_account_id,
    '$invoice_data->img',
    $id_user

  )";
$note ="فاتورة رقم : ".$invoice_data->id;
 if ($conn->query($sql) === TRUE) {
  foreach ($inventory_data as &$value) {

                   $item_id = mysqli_real_escape_string($conn, $value->id);
                   $qty = mysqli_real_escape_string($conn, $value->qty);
                   $total_qty_we_have =mysqli_real_escape_string($conn, $value->total_qty_we_have);
                   $new_totalqty= $total_qty_we_have- $qty;
                   /// update store
                   $sql = "UPDATE items SET total_qty =$new_totalqty WHERE id = $item_id";
                   if ($conn->query($sql) === TRUE) {
                       echo "Record updated successfully";
                   } else {
                       echo "Error updating record: " . $conn->error;
                   }

                   $sql = "INSERT INTO repository_move(
                  items_id, type_M, qty_move, note,  purchase_invoice, posting_datatime, user_id
                   ) VALUES (
                      $item_id,
                      1,
                      $qty,
                    '$note',
                      $invoice_data->id,
                      '$time_log',
                      $id_user
                    )";

                  if ($conn->query($sql) === TRUE) {
                    echo "في اشي غلط ";
                  }else {
                       echo "Error: " . $sql . "<br>" . $conn->error;
                  }
              }

     echo "تم اضافة مجموعة مواد جديدة .";
 } else {
     echo "Error: " . $sql . "<br>" . $conn->error;
 }

 $conn->close();

 }else {
   header('Location: http://'. $_SERVER["SERVER_NAME"].'/PointOfSaleApp/Pages/404.html');
 }




?>
