<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION['user_ID'])){
    header('Location: http://'.$_SERVER["SERVER_NAME"].'/PointOfSaleApp/pages/login.php');
        }

?>
<html lang="en">

<head>
<?php require_once('../Parts/head.html'); ?>
</head>
    <?php include "../Operations/connect_DB.php";
    $sql = "SELECT MAX(id) as new_Id_Invoice FROM sales_invoice";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
$new_Id_Invoice = $row['new_Id_Invoice'] + 1;

}
}
     ?>
<body class="fixed-navbar">
    <div class="page-wrapper">
        <!-- START HEADER-->
<?php require_once('../Parts/header.php'); ?>
        <!-- END HEADER-->
        <!-- START SIDEBAR-->
<?php require_once('../Parts/sidebar.php'); ?>
        <!-- END SIDEBAR-->
        <div class="content-wrapper" >
            <!-- START PAGE CONTENT-->
            <div class="col-11 alert alert-success alert-dismissable fade hidden" style="text-align: center;">
           <button class="close" data-dismiss="alert" aria-label="Close">×</button> <strong>تهانينا !</strong> تم العملية بنجاح
              </div>
              <div class="col-11 alert alert-warning alert-dismissable fade hidden " style="text-align: center;">
                <button class="close" data-dismiss="alert" aria-label="Close">×</button><strong>تحذير!</strong> لا يمكنك حذف العنصر لوجود حركات مرتبطة به
              </div>


            <div class="page-heading">
                <h1 class="page-title font-weight-bold">تسجيل مبيعات  </h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="dashborad.php"><i class="la la-home font-20"></i> الرئيسية </a>
                    </li>
                    <li class="breadcrumb-item"> التاريخ :<?=date("Y-m-d ");?></li>
                </ol>
            </div>
            <div class="page-content fade-in-up" id="response">
                                </div>
                                <div class="col-12">

                                  <div class="ibox ibox-success">

                                            <div class="ibox-head">

                                                <div class="ibox-title">فاتورة رقم : <?= $new_Id_Invoice ?></div>
                                                <div class="ibox-tools">
                                                    <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                                                    <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                                                </div>
                                            </div>
                                      <div class="ibox-body">

                                <div class="row">
                                  <div class="col-8">

                                    <div class="ibox ibox-primary">

                                              <div class="ibox-head">

                                                  <div class="ibox-title"> الكتب المباعة</div>

                                              </div>
                                        <div class="ibox-body">
                                          <table class="table table-hover table-responsive"  id="items_invoice" cellspacing="0" width="100%" >
                                                          <caption>Optional table caption.</caption>
                                                          <thead>
                                                              <tr>
                                                                  <th>#</th>
                                                                  <th>اسم الكتاب</th>
                                                                  <th>الكمية</th>
                                                                  <th>السعر بوحدة</th>
                                                                    <th>المجموع</th>
                                                                      <th>#</th>
                                                              </tr>
                                                          </thead>
                                                          <tbody>


                                                          </tbody>
                                                      </table>
                                        </div>
                                    </div>
                                      </div>
                                  <div class="col-4">

                                    <div class="ibox ibox-success">

                                              <div class="ibox-head">

                                                  <div class="ibox-title">فاتورة رقم : <?= $new_Id_Invoice ?></div>
                                                  <div class="ibox-tools">
                                                      <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                                                      <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                                                  </div>
                                              </div>
                                        <div class="ibox-body">
                                          <form class="form-horizontal" id="form-invoice">
                                              <div class="form-group row">
                                                  <label class="col-2 col-form-label">الاصناف</label>
                                                  <div class="col-3">
                                                      <input class="form-control" type="text" id ="total_items" name="total_items" readonly>
                                                  </div>
                                                  <label class="col-4 col-form-label">العدد الكلي</label>
                                                  <div class="col-3">
                                                      <input class="form-control" type="text" id="total_qty" name="total_qty" readonly>
                                                  </div>
                                              </div>
                                              <div class="form-group row">
                                                    <label class="col-4 col-form-label">مجموع المبلغ :</label>
                                                  <div class="col-8">
                                                    <div class="input-group">
                                                        <div class="input-group-addon bg-white">$</div>
                                                        <input class="form-control" type="text" id="total_ammount" name="total_ammount" readonly>
                                                        <div class="input-group-addon bg-white">.00</div>
                                                        </div>

                                                  </div>
                                              </div>
                                              <div class="form-group row">
                                                  <label class="col-4 col-form-label">اسم الزبون : </label>
                                                  <div class="col-8">
                                                      <input class="form-control" type="text" id="customer_name" name="customer_name">
                                                  </div>
                                              </div>
                                              <div class="form-group row">
                                                  <label class="col-4 col-form-label">ملاحظات :  </label>
                                                  <div class="col-8">
                                                      <input class="form-control" type="text" id="invoice_note" name="invoice_note">
                                                  </div>
                                              </div>

                                              <div class="form-group row">
                                                  <div class="col-12 ml-auto">
                                                      <button class="btn btn-info btn-block" type="submit">ترحيل</button>
                                                  </div>
                                              </div>

                                          </form>
                                        </div>
                                    </div>
                                      </div>


                                </div>
                                <div class="row">
                                    <div class="col-12">

                                      <div class="ibox ibox-grey">

                                                <div class="ibox-head">

                                                    <div class="ibox-title">الكتب </div>
                                                    <div class="ibox-tools">
                                                        <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                                                        <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                                                    </div>
                                                </div>
                                          <div class="ibox-body">
                                              <table class="table table-striped table-bordered table-hover table-responsive" id="example-table" cellspacing="0" width="100%">
                                                  <thead>
                                                      <tr>
                                                        <th>رقم </th>
                                                      <th>اسم</th>
                                                      <th>المجموعة</th>
                                                      <th>رقم القطعة</th>
                                                      <th>سعر التكلفة</th>
                                                      <th>سعر البيع</th>
                                                      <th>ملاحظات</th>
                                                      <th>الكمية المتوفرة</th>

                                                          <th>#</th>
                                                      </tr>
                                                  </thead>
                                                  <tfoot>
                                                      <tr>
                                                        <th>رقم </th>
                                                      <th>اسم</th>
                                                      <th>المجموعة</th>
                                                      <th>رقم القطعة</th>
                                                      <th>سعر التكلفة</th>
                                                      <th>سعر البيع</th>
                                                      <th>ملاحظات</th>
                                                      <th>الكمية المتوفرة</th>

                                                          <th>#</th>
                                                      </tr>
                                                  </tfoot>
                                                  <tbody>

                                                    <?php
                                                    $sql = "SELECT I.id ,I.name , I.number_items ,I.cost_price, I.sale_price ,I.total_qty ,I.note , GI.name as GroupItems
                                                     FROM items I , group_items GI where  GI.id = i.group_items_id ";
                                                     $result = $conn->query($sql);
                                                     if (!$result) {
                                            printf("Errormessage: %s\n", $mysqli->error);
                                         }

                                      while($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                          <td><?= $row["id"]; ?></td>
                                      <td><?= $row["name"]; ?></td>
                                      <td><?= $row["GroupItems"]; ?></td>
                                      <td><?= $row["number_items"]; ?></td>
                                            <td><?= number_format($row["cost_price"],3); ?> $</td>
                                              <td><?= number_format($row["sale_price"],3); ?> $</td>
                                              <td><?= $row["note"]; ?></td>
                                                <td class="bg-success color-white widget-stat"><?= $row["total_qty"]; ?></td>
                                        <td>
                                      <button type="button" class="btn btn-success" id="addRow" ><span class="ti-plus"></span></button>
                                        </td>
                                    </tr>
                                    <?php } ?>


                                                  </tbody>
                                              </table>
                                          </div>
                                      </div>
                                        </div>

                                </div>
                              </div>
                        </div>
                        </div>


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="direction : rtl;">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">المبلغ المطلوب لفاتورة رقم :  <?= $new_Id_Invoice ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="text-align: center;">
        <h1 id="ammount_cach" class="display-1"></h1>
      </div>
      <div class="modal-footer">
        <div class="col-5 ml-auto">
        <button id="submit_invoice" type="button" class="btn btn-primary btn-block">تاكيد</button>
        </div>
          <div class="col-5 ml-auto">
          <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">الغاء</button>
          </div>
      </div>
    </div>
  </div>
</div>



            <!-- END PAGE CONTENT-->
<?php require_once('../Parts/footer.php'); ?>
        </div>
    </div>
    <!-- BEGIN THEME CONFIG PANEL-->
    <?php require_once('../Parts/config.php'); ?>
    <!-- END THEME CONFIG PANEL-->
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    <!-- END PAGA BACKDROPS-->
    <!-- CORE PLUGINS-->
  <?php require_once('../Parts/script.html'); ?>
    <!-- PAGE LEVEL SCRIPTS-->
    <script type="text/javascript">
  var inventory = [];
  var invoice =
    {
      "id" : <?= $new_Id_Invoice ?>,
      "customer" : "",
      "note" : "",
      "total_items" : 0,
      "total_qty" : 0 ,
      "total_ammount" : 0
    };
        $('#example-table').DataTable({
            pageLength: 10,
            "language": {
   "search": "بحث عن الكتب :",
   "lengthMenu": "عرض  _MENU_ صفوف",
        "zeroRecords": "لا يوجد بيانات ",
        "info": "النتائج _PAGE_ في _PAGES_",
        "infoEmpty": "لا يوجد بيانات لعرضها",
        "infoFiltered": "(تم البحث  _MAX_ من جميع البيانات)"
 }
        });
  $('#items_invoice').dataTable( {
    "searching": false,
    "paging":   false,
        "ordering": false,
        "info":     false
  } );
    var t = $('#items_invoice').DataTable();
    $(document).ready(function() {
function check_items (id ,data)  {
  var find= false;
  for (var i = 0 ; i <= inventory.length-1 ; i++){
  if (inventory[i].id === id){
    find=true;
inventory[i].quantity++;
invoice.total_qty++;
inventory[i].amount = inventory[i].price * inventory[i].quantity ;
invoice.total_ammount +=inventory[i].price;
 t.row(i).data([
        inventory[i].id,
       inventory[i].name,
     inventory[i].quantity,
       "$"+inventory[i].price.toFixed(3),
       "$"+inventory[i].amount.toFixed(3),
       '<button type="button" class="btn btn-danger" id="deleteRow" ><span class="ti-close"></span></button>'
 ]);
  }
}
if(!find){
    inventory.push(data);
      last = inventory.length-1;
  invoice.total_items++;
  invoice.total_qty++;
  invoice.total_ammount += inventory[last].price;
  t.row.add( [
      inventory[last].id,
      inventory[last].name,
    inventory[last].quantity,
       "$"+inventory[last].price.toFixed(3),
       "$"+inventory[last].amount.toFixed(3),
      '<button type="button" class="btn btn-danger" id="deleteRow" ><span class="ti-close"></span></button>'
  ] ).draw( false );
}
$("#total_items").val(invoice.total_items);
$("#total_qty").val(invoice.total_qty);
$("#total_ammount").val(invoice.total_ammount.toFixed(3));
}
$('#example-table tbody').on( 'click', '#addRow', function () {
//  $(this).closest('tr').addClass("color-view bg-info");
    var book_id= $(this).closest('tr').find('td:eq(0)').html();
    book_id = parseInt(book_id);
      var book_name= $(this).closest('tr').find('td:eq(1)').html();
        var sale_price= $(this).closest('tr').find('td:eq(5)').html();
        sale_price = parseInt(sale_price);
        var total_qty = $(this).closest('tr').find('td:eq(7)').html();
          total_qty = parseInt(total_qty);
        data_items = { "id" : book_id, "name":book_name , "price" :sale_price , "quantity":1 ,"amount" :sale_price ,"total_qty_we_have" :total_qty  };
        check_items( book_id, data_items);
});
$('#items_invoice tbody').on( 'click', '#deleteRow', function () {
  var index = t.row( $(this).parents('tr')).index();
  invoice.total_qty -=inventory[index].quantity;
  invoice.total_items--;
  invoice.total_ammount -= inventory[index].quantity*inventory[index].price;
  $("#total_items").val(invoice.total_items.toFixed(3));
  $("#total_qty").val(invoice.total_qty.toFixed(3));
  $("#total_ammount").val(invoice.total_ammount.toFixed(3));
inventory.splice(index, 1);
t.row( $(this).parents('tr') ).remove().draw();
});
});
    </script>
      <script type="text/javascript">
    $(document).ready(function() {
       $("#form-invoice").on("submit", function (event) {
         $("#ammount_cach").html("$"+invoice.total_ammount.toFixed(3));
         $('#exampleModalCenter').modal('show');
    invoice.customer= $("#customer_name").val();
    invoice.note= $("#invoice_note").val();
  if (event.isDefaultPrevented()) {
     // handle the invalid form...
  } else {
     // everything looks good!
     event.preventDefault();
     $('#exampleModalCenter').on( 'click', '#submit_invoice', function () {
     $.ajax({
type: "POST",
url: "../Operations/AddInvoice.php",
dataType: "text",
data: { invoice_data : JSON.stringify(invoice) , movment_inventory_invoce : JSON.stringify(inventory)  },
success: function(data){


    $('#response').html( data );
   console.log(data);
   return true;
},
complete: function() {},
error: function(xhr, textStatus, errorThrown) {
    $('#response').html( data );
  console.log('ajax loading error...');
  return false;
}
});
document.location.reload(true);
   });
  }
  });

    });
    </script>
</body>

</html>
