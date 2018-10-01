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
<style type="text/css">
.form-group{
margin-bottom: 15px;
margin-top: 15px;
}
.image-preview-input {
    position: relative;
  overflow: hidden;
  margin: 0px;
    color: #333;
    background-color: #fff;
    border-color: #ccc;
}
.image-preview-input input[type=file] {
  position: absolute;
  top: 0;
  right: 0;
  margin: 0;
  padding: 0;
  font-size: 20px;
  cursor: pointer;
  opacity: 0;
  filter: alpha(opacity=0);
}
.image-preview-input-title {
    margin-left:2px;
}
</style>
</head>
    <?php include "../Operations/connect_DB.php";
    $sql = "SELECT MAX(id) as new_Id_Invoice FROM purchases_invoice";
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
                <h1 class="page-title font-weight-bold">تسجيل مشتريات</h1>

                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="dashborad.php"><i class="la la-home font-20"></i> الرئيسية </a>
                    </li>
                    <li class="breadcrumb-item"> التاريخ :<?=date("Y-m-d ");?></li>
                </ol>
            </div>
            <div class="page-content fade-in-up" id="response">
                  </div>
                      <div class="row">
              <div class="col-4">
                  <div class="ibox">

                      <div class="ibox-body">
                        <div class="form-group row">
                          <label class="col-2 col-form-label">المجموع الاجمالي : </label>
                        <div class="col-4">
                          <div class="input-group">
                              <input class="form-control" type="text" id="total_discount_ammount" name="total_discount_ammount" readonly>
                                <div class="input-group-addon bg-white">$</div>
                              </div>
                        </div>
                        <label class="col-2 col-form-label">الضريبة المبيعات</label>
                      <div class="col-4">
                        <div class="input-group">
                            <input class="form-control" value=0 type="text" id="rate_ammount" name="rate_ammount" readonly>
                              <div class="input-group-addon bg-white">$</div>
                            </div>
                      </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-2 col-form-label">ملاحظات :  </label>
                            <div class="col-10">
                                <input class="form-control" type="text" id="invoice_note" name="invoice_note">
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <!-- image-preview-filename input [CUT FROM HERE]-->
                            <div class="input-group image-preview">
                                <input type="text" class="form-control image-preview-filename" disabled="disabled"> <!-- don't give a name === doesn't send on POST/GET -->
                                <span class="input-group-btn">
                                    <!-- image-preview-clear button -->
                                    <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                        <span class="glyphicon glyphicon-remove"></span> مسح
                                    </button>
                                    <!-- image-preview-input -->
                                    <div class="btn btn-default image-preview-input">
                                        <span class="glyphicon glyphicon-folder-open"></span>
                                        <span class="image-preview-input-title">صورة</span>
                                        <input  type="file"  accept="image/png, image/jpeg, image/gif" name="img_blog" id="img_blog" /> <!-- rename it -->
                                    </div>
                                </span>
                            </div><!-- /input-group image-preview [TO HERE]-->
                        </div>
                        </div>
              </div>
                </div>
              <div class="col-8">
                <div class="ibox ibox-primary">
                          <div class="ibox-head">
                              <div class="ibox-title">فاتورة رقم : <?= $new_Id_Invoice ?></div>
                          </div>
                    <div class="ibox-body">
                      <div class="form-group row">
                          <label class="col-1 col-form-label">المورد</label>
                          <div class="col-3">
                          <select class="form-control select2_demo_2" name="tid" id="tid" >
                            <option></option>
                                <?php
                                $sql = "SELECT * FROM t_accounts";
                          $result = $conn->query($sql);

                          if ($result->num_rows > 0) {
                          // output data of each row
                          while($row = $result->fetch_assoc()) {
                          ?>
                          <option value=<?= $row["id"]; ?>>
                          <?= $row["name"]; ?>
                          </option>
                          <?php
                          }

                          } else {
                          echo "لا يوجد شيئ لعرض ........ <i class='mdi mdi-heart text-red'></i>";
                          }
                          ?>
                          </select>
                        </div>
                        <label class="col-form-label">طريقة الدفع</label>
                  <div class="col-2">
                        <select class="form-control input-sm" id="payment_method" name="payment_method">
                            <option value ="0">ذمم </option>
                            <option value ="1">نقدي </option>
                        </select>
                    </div>
                    <label class="col-form-label">الضريبة</label>
                    <div class="col-2">
                        <select class="form-control input-sm" id="rate" name="rate">
                              <option value ="0">بدون ضريبة </option>
                              <option value ="1">مع ضريبة </option>
                          </select>
                      </div>
                <label class="col-1 col-form-label">قيمة الخصم </label>
                <div class="col-2">
                  <div class="input-group">
                      <input class="form-control" type="text" id="discount" name="discount" value="0">
                        <div class="input-group-addon bg-white">$</div>
                      </div>
                </div>
                      </div>
                      <div class="form-group row">
                          <label class="col-1 col-form-label">فاتورة رقم :</label>
                              <div class="col-3">
                                <input class="form-control" type="text" name="purchases_id" id="purchases_id" placeholder="رقم فاتورة المورد ">
                      </div>
                      <div class="col-3" id="date_1">
                          <label class="col-form-label">تاريخ</label>
                          <div class="input-group date" >
                              <span class="input-group-addon bg-white"><i class="fa fa-calendar"></i></span>
                              <input class="form-control" type="text" data-provide="datepicker" id="purchase_date" name="purchase_date" value="<?=date("d/m/Y ");?>">
                          </div>
                      </div>
                        <div class="col-3 ml-auto">
                            <button id="submit" class="btn btn-info btn-block" type="submit">ترحيل</button>
                        </div>
                    </div>
                </div>
                  </div>
</div>
      </div>
                                <div class="row">
                                  <div class="col-6">
                                    <div class="ibox ibox-primary">
                                        <div class="ibox-body">
                                          <table class="table table-hover table-responsive"  id="items_invoice" cellspacing="0" width="100%" >
                                                          <thead>
                                                              <tr>
                                                                  <th>رقم الصنف</th>
                                                                  <th>اسم الصنف</th>
                                                                  <th>الكمية</th>
                                                                  <th>السعر بوحدة</th>
                                                                    <th>المجموع</th>
                                                                      <th>#</th>
                                                              </tr>
                                                          </thead>
                                                          <tbody>
                                                          </tbody>
                                                      </table>
                                                                                                                                                                                                            <hr>
                                                      <div class="form-group row">
                                                        <label class="col-1 col-form-label">المجموع</label>
                                                      <div class="col-3">
                                                        <div class="input-group">

                                                            <input class="form-control" type="text" id="total_ammount" name="total_ammount" readonly>
                                                            <div class="input-group-addon bg-white">$</div>
                                                            </div>
                                                      </div>
                                                          <label class="col-2 col-form-label">عدد الاصناف</label>
                                                          <div class="col-2">
                                                              <input class="form-control" type="text" id ="total_items" name="total_items" readonly>
                                                          </div>
                                                          <label class="col-2 col-form-label">العدد الكلي</label>
                                                          <div class="col-2">
                                                              <input class="form-control" type="text" id="total_qty" name="total_qty" readonly>
                                                          </div>
                                                      </div>
                                        </div>
                                    </div>
                                      </div>
                                  <div class="col-6">
                                    <div class="ibox ibox-success">
                                              <div class="ibox-head">
                                                        <label class="col-2 col-form-label">القسم او المجموعة: </label>
                                                        <select class="form-control select2_demo_2" name="group_items" id="group_items" >
                                                          <option></option>
                                                              <?php
                                                              $sql = "SELECT * FROM group_items";
                                                        $result = $conn->query($sql);

                                                        if ($result->num_rows > 0) {
                                                        // output data of each row
                                                        while($row = $result->fetch_assoc()) {
                                                        ?>
                                                        <option value=<?= $row["id"]; ?>>
                                                        <?= $row["name"]; ?>
                                                        </option>
                                                        <?php
                                                        }

                                                        } else {
                                                        echo "لا يوجد شيئ لعرض ........ <i class='mdi mdi-heart text-red'></i>";
                                                        }
                                                        ?>
                                                        </select>
                                              </div>
                                        <div class="ibox-body">
                                          <div class="table-wrapper-scroll-y">
                                          <table class="table table-striped table-bordered table-hover  table-sm table-striped" id="items-table" cellspacing="0" width="100%">
                                              <thead>
                                                  <tr>
                                                    <th>رقم الصنف</th>
                                                  <th>اسم الصنف</th>
                                                  <th>الكمية المتبقية</th>
                                                      <th>#</th>
                                                  </tr>
                                              </thead>
                                              <tbody>

                                              </tbody>
                                          </table>
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
var total_discount_ammount;
    var purchase_invoice =
      {
        "id" :<?= $new_Id_Invoice ?>,
        "purchases_id" :"",
        "t_account_id" :0,
        "total_ammount" :0,
        "total_qty" :0,
        "total_items":0,
        "rate" :0,
        "payment_method" :0,
        "discount" :0,
        "note" :"",
        "img" :"",
        "inventory" : [],
        "purchase_date" :""
      };
  $(document).ready(function() {
    $('#items-table').dataTable({
      "paging":   false,
   "ordering": false,
   "info":     false,
    columns: [
      { "data": 'id' },
      { "data": 'name' },
      { "data": 'total_qty' },
        { "data": 'buttonAdd' }
    ]
  });
$('#items_invoice').dataTable( {
"searching": false,
"paging":   false,
    "ordering": false,
    "info":     false
} );
var datatable = $('#items-table').dataTable().api();
var t = $('#items_invoice').dataTable().api();
$( "#group_items" ).change(function() {
   var str = $(this).val();
  var url ="../Operations/GetItemsList.php?q="+str+"";
  $.get(url, function(json) {
    json = JSON.parse(json);
    var return_data = new Array();
        for(var i=0;i< json.length; i++){
          return_data.push({
            'id': json[i].id,
            'name'  :  json[i].name ,
            'total_qty' : json[i].total_qty,
            'buttonAdd'  : '<button type="button" class="btn btn-success" id="addRow"><span class="ti-plus"></span></button>'
          });
        }
        //console.log(return_data);
      datatable.clear();
    datatable.rows.add(return_data);
    datatable.draw();
});
});

$('#items-table tbody').on( 'click', '#addRow', function () {
    var this_itemsid= $(this).closest('tr').find('td:eq(0)').html();
        check_items( this_itemsid);
});
$('#items_invoice tbody').on( 'click', '#deleteRow', function () {
  var index = t.row( $(this).parents('tr')).index();
purchase_invoice.total_qty -=purchase_invoice.inventory[index].qty;
purchase_invoice.total_items--;
purchase_invoice.total_ammount -= purchase_invoice.inventory[index].amount;
purchase_invoice.inventory.splice(index, 1);
t.row( $(this).parents('tr') ).remove().draw();
setvalueinput();
});
$( "#discount" ).keyup(function() {
  if($(this).val()=="") $(this).val(0)
setvalueinput();
});
$('#items_invoice tbody').on( 'change', '#items_price', function () {
  if($(this).val()=="") $(this).val(purchase_invoice.inventory[index].cost_price.toFixed(3))
      var index = t.row( $(this).parents('tr')).index();
  purchase_invoice.inventory[index].cost_price =parseFloat($(this).val());
  purchase_invoice.inventory[index].amount = purchase_invoice.inventory[index].cost_price * purchase_invoice.inventory[index].qty ;
    t.row(index).data([
           purchase_invoice.inventory[index].id,
          purchase_invoice.inventory[index].name,
        purchase_invoice.inventory[index].qty,
          "<input class='col-6 form-control' value='"+purchase_invoice.inventory[index].cost_price.toFixed(3)+"' type='text' id='items_price' name='items_price'>",
          "$"+purchase_invoice.inventory[index].amount.toFixed(3),
          '<button type="button" class="btn btn-danger" id="deleteRow" ><span class="ti-close"></span></button>'
    ]);
    if($(this).val()=="") $(this).val(purchase_invoice.inventory[index].cost_price.toFixed(3))
  setvalueinput();
});
function calucuatinvoice(){
  purchase_invoice.payment_method= parseInt($("#payment_method").val());
  purchase_invoice.purchases_id= $("#purchases_id").val();
  purchase_invoice.rate=parseInt($("#rate").val());
  //alert(purchase_invoice.payment_method);
purchase_invoice.t_account_id= $("#tid").val();
purchase_invoice.note= $("#invoice_note").val();
  purchase_invoice.total_ammount= 0;
    purchase_invoice.total_qty= 0;
    purchase_invoice.total_items = 0;
    for (var i = 0 ; i <= purchase_invoice.inventory.length-1 ; i++){
          purchase_invoice.total_qty = purchase_invoice.inventory[i].qty;
    purchase_invoice.inventory[i].amount = purchase_invoice.inventory[i].cost_price * purchase_invoice.inventory[i].qty;
    purchase_invoice.total_ammount += purchase_invoice.inventory[i].amount;
    purchase_invoice.total_items ++;
    }
      purchase_invoice.discount = parseInt($("#discount").val());
     total_discount_ammount = purchase_invoice.total_ammount - purchase_invoice.discount;
}
function setvalueinput(){
  calucuatinvoice();
  $("#total_items").val(purchase_invoice.total_items.toFixed(3));
  $("#total_qty").val(purchase_invoice.total_qty);
  $("#total_ammount").val(purchase_invoice.total_ammount.toFixed(3));
  $("#total_discount_ammount").val(total_discount_ammount.toFixed(3));
}
function check_items (id)  {
  var find= false;
  for (var i = 0 ; i <= purchase_invoice.inventory.length-1 ; i++){
  if (purchase_invoice.inventory[i].id == id){
    find=true;
purchase_invoice.inventory[i].qty++;
purchase_invoice.total_qty++;
purchase_invoice.inventory[i].amount = purchase_invoice.inventory[i].cost_price * purchase_invoice.inventory[i].qty ;
purchase_invoice.total_ammount +=purchase_invoice.inventory[i].cost_price;
setvalueinput();
 t.row(i).data([
        purchase_invoice.inventory[i].id,
       purchase_invoice.inventory[i].name,
     purchase_invoice.inventory[i].qty,
       "<input class='col-6 form-control' value='"+purchase_invoice.inventory[i].cost_price.toFixed(3)+"' type='text' id='items_price' name='items_price'>",
       "$"+purchase_invoice.inventory[i].amount.toFixed(3),
       '<button type="button" class="btn btn-danger" id="deleteRow" ><span class="ti-close"></span></button>'
 ]);
 continue;
  }
}
if(!find){
  var url ="../Operations/GetItemsInfo.php?q="+id+"";
  $.get(url, function(json) {
    json = JSON.parse(json);
    json=json[0];
  //  var return_data = new Array();
            purchase_invoice.inventory.push({
          'id': json.id  ,
          'name' : json.name  ,
          'qty': 1,
          'cost_price' : json.cost_price  ,
          'amount' : json.cost_price,
          'total_qty_we_have' : json.total_qty
          });
        console.log(json);
        t.row.add([
         json.id,
         json.name,
          1,
        "<input class='col-6 form-control' value='"+json.cost_price.toFixed(3)+"' type='text' id='items_price' name='items_price'>",
         "$"+json.cost_price.toFixed(3),
         '<button type="button" class="btn btn-danger" id="deleteRow" ><span class="ti-close"></span></button>'
      ]).draw(false);
      purchase_invoice.total_ammount += json.cost_price;
  purchase_invoice.total_items++;
  purchase_invoice.total_qty++;
setvalueinput();
        });
}
}
});
    </script>
      <script type="text/javascript">
    $(document).ready(function() {
       $("#submit").on("click", function (event) {
         $("#ammount_cach").html("$"+total_discount_ammount.toFixed(3));
         $('#exampleModalCenter').modal('show');

  if (event.isDefaultPrevented()) {
     // handle the invalid form...
  } else {
     // everything looks good!
     event.preventDefault();
     $('#exampleModalCenter').on( 'click', '#submit_invoice', function () {
     $.ajax({
type: "POST",
url: "../Operations/AddPurchasesInvoice.php",
dataType: "text",
data: { invoice_data : JSON.stringify(purchase_invoice)  },
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
    <script type="text/javascript">
    $(document).on('click', '#close-preview', function(){
        $('.image-preview').popover('hide');
        // Hover befor close the preview
        $('.image-preview').hover(
            function () {
               $('.image-preview').popover('show');
            },
             function () {
               $('.image-preview').popover('hide');
            }
        );
    });

    $(function() {
        // Create the close button
        var closebtn = $('<button/>', {
            type:"button",
            text: 'x',
            id: 'close-preview',
            style: 'font-size: initial;',
        });
        closebtn.attr("class","close pull-right");
        // Set the popover default content
        $('.image-preview').popover({
            trigger:'manual',
            html:true,
            title: "<strong>Preview</strong>"+$(closebtn)[0].outerHTML,
            content: "There's no image",
            placement:'bottom'
        });
        // Clear event
        $('.image-preview-clear').click(function(){
            $('.image-preview').attr("data-content","").popover('hide');
            $('.image-preview-filename').val("");
            $('.image-preview-clear').hide();
            $('.image-preview-input input:file').val("");
            $(".image-preview-input-title").text("Browse");
        });
        // Create the preview image
        $(".image-preview-input input:file").change(function (){
            var img = $('<img/>', {
                id: 'dynamic',
                width:250,
                height:200
            });
            var file = this.files[0];
            var reader = new FileReader();
            // Set preview image into the popover data-content
            reader.onload = function (e) {
                $(".image-preview-input-title").text("Change");
                $(".image-preview-clear").show();
                $(".image-preview-filename").val(file.name);
                img.attr('src', e.target.result);
                $(".image-preview").attr("data-content",$(img)[0].outerHTML).popover("show");
            }
            reader.readAsDataURL(file);
        });
    });
    </script>
</body>

</html>
