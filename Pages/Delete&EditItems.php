
    <?php
     include "../Operations/connect_DB.php";
     ///// delete group
/// delete items
$script="";
if($_SERVER["REQUEST_METHOD"] == "GET"){
  if (isset($_GET['itemIdDeleted'])) {
  $item_id = $_GET["itemIdDeleted"];
  $sql = "DELETE FROM items WHERE id =$item_id ";

  if ($conn->query($sql) === TRUE) {

   $script="
   $('.alert-success').removeClass( 'hidden' ).addClass( 'show' );
   $('.alert-success').fadeTo(2000, 500).slideUp(500, function(){
       $('.alert-success').slideUp(500);
   });";
  }else {
   $script="
   $('.alert-warning').removeClass( 'hidden' ).addClass( 'show' );
   $('.alert-warning').fadeTo(2000, 500).slideUp(500, function(){
       $('.alert-success').slideUp(500);
   });";
  }
  }

  if (isset($_GET['GroupitemIdDeleted'])) {
    $group_items_id = $_GET["GroupitemIdDeleted"];
    $sql = "DELETE FROM group_items WHERE id =$group_items_id ";
    if ($conn->query($sql) === TRUE) {
      $script="
      $('.alert-success').removeClass( 'hidden' ).addClass( 'show' );
      $('.alert-success').fadeTo(2000, 500).slideUp(500, function(){
          $('.alert-success').slideUp(500);
      });";
    }else {
        $script="
        $('.alert-warning').removeClass( 'hidden' ).addClass( 'show' );
        $('.alert-warning').fadeTo(2000, 500).slideUp(500, function(){
            $('.alert-success').slideUp(500);
        });";
    }
  }

}

     ?>
     <!DOCTYPE html>
     <?php
     session_start();
     if (!isset($_SESSION['user_ID'])){
         header('Location: http://'.$_SERVER["SERVER_NAME"].'/LibraryRepApp/pages/login.php');
             }
     ?>
     <html lang="en">

     <head>
     <?php require_once('../Parts/head.html'); ?>
     </head>

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
                     <h1 class="page-title font-weight-bold">حذف وتعديل بيانات اصناف و المجموعات</h1>
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
                                         <div class="col-md-12">

                                           <div class="ibox">
                                               <div class="ibox-head">
                                                   <div class="ibox-title">تعديل و حذف بيانات اصناف</div>
                                                 <div class="ibox-tools">
                                                     <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                                                 </div>
                                               </div>
                                          <div class="ibox-body">
                                            <div class="form-group row">
                                              <label class="col-2 col-form-label">المجموعات</label>
                                              <select class="form-control select2_demo_2 col-3 " name="group_items" id="group_items">
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
                                              <table class="table table-striped table-bordered table-hover" id="items-table" cellspacing="0" width="100%">
                                                  <thead>
                                                      <tr>
                                                        <th>رقم</th>
                                                        <th>اسم الصنف </th>
                                                        <th>رقم المصنعية</th>
                                                        <th>المنشأ</th>
                                                        <th>سعر الشراء</th>
                                                        <th>سعر البيع</th>
                                                        <th>المتوفر</th>
                                                        <th>الحد الادنى</th>
                                                        <th>السعر الضربي</th>
                                                        <th>ملاحظات</th>
                                                        <th>###</th>
                                                      </tr>
                                                  </thead>
                                                  <tbody>
                                                  </tbody>
                                              </table>
                                          </div>
                                      </div>
                                    </div>

                        </div>
                                <div class="row">
                                    <div class="col-md-12">

                                      <div class="ibox">
                                          <div class="ibox-head">
                                              <div class="ibox-title">تعديل وحذف بيانات المجموعة</div>
                                            <div class="ibox-tools">
                                                <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                                            </div>
                                          </div>


                                     <div class="ibox-body">
                                         <table class="table table-striped table-bordered table-hover" id="Groupitems-table" cellspacing="0" width="100%">
                                             <thead>
                                                 <tr>
                                                   <th>رقم المجموعة</th>
                                                   <th>اسم المجموعة</th>
                                                   <th>ملاحظات</th>
                                                  <th>#</th>
                                                 </tr>
                                             </thead>
                                             <tfoot>
                                                 <tr>
                                                   <th>رقم المجموعة</th>
                                                   <th>اسم المجموعة</th>
                                                   <th>ملاحظات</th>
                                                  <th>#</th>
                                                 </tr>
                                             </tfoot>
                                             <tbody>

                                               <?php
                                               $sql = "SELECT id , name , note
                                                FROM group_items ";
                                                $result = $conn->query($sql);
                                                if (!$result) {
                                       printf("Errormessage: %s\n", $mysqli->error);
                                    }

                                 while($row = mysqli_fetch_assoc($result)) {
                               ?>
                               <tr>
                                 <td><?= $row["id"]; ?></td>
                                 <td><?= $row["name"]; ?></td>
                                 <td><?= $row["note"]; ?></td>

                                 <td>
               <button type="button" id="editgroupitemsbutton" class="btn btn-default btn-xs m-r-5" data-toggle="modal" data-target="#EditGroupModal" data-whatever=""><i class="fa fa-pencil font-14"></i></button>
                                   <a href="?GroupitemIdDeleted=<?= $row['id'];?>">
                                     <button class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash font-14"></i></button>
                                   </a>
                                 </td>
                               </tr>
                               <?php
                             }
                       //  $conn->close();
                         ?>


                                             </tbody>
                                         </table>
                                     </div>
                                 </div>
                               </div>

                           </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="text-align: -webkit-right;">
                            <div class="modal-dialog" role="document"style="direction: rtl;">
                            		    <div class="modal-content">
                            		      <div class="modal-header">

                            						  <h5 class="modal-title" id="exampleModalLabel">تعديل كتاب رقم : </h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                            		      </div>
                            		      <div class="modal-body">
                                        <form class="form-horizontal" id="form-updataitemss"  novalidate="novalidate">
                                          <input type="hidden" name="items_id" id="items_id">
                                          <div class="form-group row">
                                              <label class="col-sm-2 col-form-label">القسم او المجموعة</label>
                                              <div class="col-sm-10">
                                              <select class="form-control" name="group_itemss" id="group_itemss">
                                                  <optgroup label="اصناف">
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

                                                  </optgroup>

                                              </select>
                                            </div>
                                          </div>

                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label"> الاسم الكتاب : </label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="text " id="name" name="name">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">المؤلف : </label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="text" id="author" name="author">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                  <label class="col-sm-2 col-form-label">سعر التكلفة :  </label>
                                                <div class="col-sm-8">
                                                  <div class="input-group">
                                                      <div class="input-group-addon bg-white">$</div>
                                                      <input class="form-control" type="text" placeholder="سعر الشراء" id="cost_price" name="cost_price">

                                                      </div>

                                                </div>
                                                </div>
                                                <div class="form-group row">
                                                  <label class="col-sm-2 col-form-label">سعر البيع :  </label>
                                                <div class="col-sm-8">

                                                  <div class="input-group">
                                      <div class="input-group-addon bg-white">$</div>
                                      <input class="form-control" type="text" placeholder="سعر البيع" id="sale_price" name="sale_price">

                                  </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">رقم الطبع :  </label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="text" id="number_stamp" name="number_stamp">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">ملاحظات :  </label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="text" id="note" name="note">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-sm-12 ml-sm-auto">
                                                    <button class="btn btn-primary btn-block" type="submit">تعديل</button>
                                                </div>
                                            </div>

                                        </form>
                            					</div>
                            					</div>
                                 </div>
                               </div>
       <div class="modal fade" id="EditGroupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="text-align: -webkit-right;">
                           <div class="modal-dialog" role="document"style="direction: rtl;">
                                  <div class="modal-content">
                                    <div class="modal-header">

                                        <h5 class="modal-title" id="EditGroupModal-label">تعديل مجموعة رقم : </h5>
                                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                           <span aria-hidden="true">&times;</span>
                                         </button>
                                    </div>
                                    <div class="modal-body">
                                       <form class="form-horizontal" id="form-updatagroupitemss"  novalidate="novalidate">
                                         <input type="hidden" name="Group_items_id" id="Group_items_id">


                                           <div class="form-group row">
                                               <label class="col-sm-3 col-form-label">الاسم المجموعة</label>
                                               <div class="col-sm-8">
                                                   <input class="form-control" type="text" id="groupname" name="groupname">
                                               </div>
                                           </div>

                                           <div class="form-group row">
                                               <label class="col-sm-3 col-form-label">ملاحظات :  </label>
                                               <div class="col-sm-8">
                                                   <input class="form-control" type="text" id="groupnote" name="groupnote">
                                               </div>
                                           </div>

                                           <div class="form-group row">
                                               <div class="col-sm-12 ml-sm-auto">
                                                   <button class="btn btn-primary btn-block" type="submit">تعديل</button>
                                               </div>
                                           </div>

                                       </form>
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
    <?= $script ?>

        $('#Groupitems-table').DataTable({
          pageLength: 20,
          "language": {
    "search": "بحث عن مجموعة",
    "lengthMenu": "عرض  _MENU_ صفوف",
      "zeroRecords": "لا يوجد بيانات ",
      "info": "النتائج _PAGE_ في _PAGES_",
      "infoEmpty": "لا يوجد بيانات لعرضها",
      "infoFiltered": "(تم البحث  _MAX_ من جميع البيانات)"
    }

        });

    var table = $('#Groupitems-table').DataTable();

    $('#Groupitems-table tbody').on( 'click', '#editgroupitemsbutton', function () {
    var group_id = $(this).closest('tr').find('td:eq(0)').html();
    var group_name = $(this).closest('tr').find('td:eq(1)').html();
    var group_note = $(this).closest('tr').find('td:eq(2)').html();

      $("#EditGroupModal-label").html("تعديل مجموعة رقم :"+group_id);
    $("input[name=Group_items_id]").val(group_id);
    $("input[name=groupname]").val(group_name);
    $("input[name=groupnote]").val(group_note);
    } );
        </script>

        <script type="text/javascript">
        $("#form-updatagroupitemss").validate({
            rules: {
                groupname: {
                    minlength: 3,
                    required: !0
                }
            },
            errorClass: "help-block error",
            highlight: function(e) {
                $(e).closest(".form-group.row").addClass("has-error")
            },
            unhighlight: function(e) {
                $(e).closest(".form-group.row").removeClass("has-error")
            }
        });
         $("#form-updatagroupitemss").on("submit", function (event) {
    if (event.isDefaultPrevented()) {
       // handle the invalid form...
    } else {
       // everything looks good!
       event.preventDefault();
       $.ajax({
           type: 'POST',
           url: '../Operations/updatagroupitems.php',
           data: $(this).serialize()
       })
       .done(function(data){
    $('#response').append(data);
    $('#EditGroupModal').removeClass( "show" );
    $('.alert-success').removeClass( "hidden" ).addClass( "show" );
    $(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
        $(".alert-success").slideUp(500);
    });

    $("#form-updataitemss")[0].reset();
    document.location.reload(true);
       })
       .fail(function() {

           // just in case posting your form failed
           alert( "حصل خطأ ما الرجاء اعادة المحاولة ! ..." );

       });

       // to prevent refreshing the whole page page
       return false;
    }
    });
    </script>
<script type="text/javascript">
<?= $script ?>
var table =   $('#items-table').DataTable({
  "ordering": false,
    "language" :
        {
            "decimal": "1",
            "emptyTable": "لا يوجد بيانات في نتائج البحث",
            "info": "عرض _START_ الى _END_ من _TOTAL_ مدخلات",
            "infoEmpty": "تم عرض 0 الى 0 من 0 مدخلات",
            "infoFiltered": "(تصنيف من _MAX_ جميع المدخلات)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "عرض _MENU_ البيانات",
            "loadingRecords": "الرجاء انتظار...",
            "processing": "جاري البحث...",
            "search": "بحث",
            "zeroRecords": "لا يطابق البحث اي نتائج",
            "paginate": {
                "first": "الاول",
                "last": "الاخير",
                "next": "التالي",
                "previous": "السابق"
            },
            "aria": {
                "sortAscending": ": activate to sort column ascending",
                "sortDescending": ": activate to sort column descending"
            }
        },
        columns: [
      {    'data' : 'id' },
      {   'data': 'name'},
      {   'data': 'number_items'},
      {  'data': 'origin'},
      {  'data': 'cost_price'},
      {   'data': 'sale_price'},
      { 'data': 'total_qty'},
      {'data': 'low_order'},
      { 'data': 'rate'},
      { 'data': 'note'},
      {  'data': '#'}
        ]
});
$( "#group_items" ).change(function() {
                       var str = $(this).val();
                      var url ="../Operations/GetItemsList.php?q="+str+"";
                      $.get(url, function(json) {
                        json = JSON.parse(json);
                        var return_data = new Array();
                        for(var i=0;i< json.length; i++){
                          return_data.push({
                         'id' : json[i].id,
                        'name': json[i].name,
                        'number_items': json[i].number_items,
                       'origin': json[i].origin,
                       'cost_price': json[i].cost_price.toFixed(3),
                      'sale_price': json[i].sale_price.toFixed(3),
                      'total_qty': json[i].total_qty,
                     'low_order': json[i].low_order,
                      'rate': 0.007*(json[i].rate.toFixed(3)),
                      'note': json[i].note,
                      '#' : '<button type="button" id="editbutton" class="btn btn-default btn-xs m-r-5" data-toggle="modal" data-target="#exampleModal" data-whatever=""><i class="fa fa-pencil font-14"></i></button>  <a href=?itemIdDeleted='+json[i].id+'><button class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-trash font-14"></i></button></a>'
                            });
                        }
                          console.log(return_data);
                      table.clear();
                      table.rows.add(return_data);
                        table.draw();
                    });
  });
                    $('#items-table thead th').each(function () {
                        var title = $(this).text();
                        $(this).html('<input type="text" class="form-control input-sm col-10 " placeholder="' + title + '" />');
                    });

                    // Apply the search
                    table.columns().every(function () {
                        var that = this;

                        $('input', this.header()).on('keyup change', function () {
                            if (that.search() !== this.value) {
                                that
                                    .search(this.value)
                                    .draw();
                            }
                        });
                    });

$('#example-table tbody').on( 'click', '#editbutton', function () {
var items_id = $(this).closest('tr').find('td:eq(0)').html();
$("#exampleModalLabel").html("تعديل كتب رقم : "+items_id);
var items_name = $(this).closest('tr').find('td:eq(1)').html();
var author = $(this).closest('tr').find('td:eq(2)').html();
var group_itemss = $(this).closest('tr').find('td:eq(3)').html();
var number_stamp = $(this).closest('tr').find('td:eq(4)').html();
var cost_price = $(this).closest('tr').find('td:eq(5)').html();
cost_price = parseInt(cost_price);
var sale_price = $(this).closest('tr').find('td:eq(6)').html();
sale_price =parseInt(sale_price);
var note = $(this).closest('tr').find('td:eq(7)').html();
$("input[name=items_id]").val(items_id);
$("input[name=name]").val(items_name);
$("input[name=author]").val(author);
$("input[name=group_itemss]").val(group_itemss);
$("input[name=number_stamp]").val(number_stamp);
$("input[name=cost_price]").val(cost_price);
$("input[name=sale_price]").val(sale_price);
$("input[name=note]").val(note);
} );
    </script>
    <script type="text/javascript">
    $("#form-updataitemss").validate({
        rules: {
          totalqty: {

              minlength: 4,
              number: !0
          },
            name: {
                minlength: 3,
                required: !0

            },
            author: {
                required: !0,
                 minlength: 3
            },

            cost_price: {
                number: !0
            },
            sale_price: {
                required: !0,
               number: !0
            }
        },
        errorClass: "help-block error",
        highlight: function(e) {
            $(e).closest(".form-group.row").addClass("has-error")
        },
        unhighlight: function(e) {
            $(e).closest(".form-group.row").removeClass("has-error")
        }
    });
     $("#form-updataitemss").on("submit", function (event) {
if (event.isDefaultPrevented()) {
   // handle the invalid form...
} else {
   // everything looks good!
   event.preventDefault();
   $.ajax({
       type: 'POST',
       url: '../Operations/updataitemss.php',
       data: $(this).serialize()
   })
   .done(function(data){
//$('#response').append(data);
$('#exampleModal').removeClass( "show" );
$('.alert-success').removeClass( "hidden" ).addClass( "show" );
$(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
    $(".alert-success").slideUp(500);
});

$("#form-updataitemss")[0].reset();
document.location.reload(true);
   })
   .fail(function() {

       // just in case posting your form failed
       alert( "حصل خطأ ما الرجاء اعادة المحاولة ! ..." );

   });

   // to prevent refreshing the whole page page
   return false;
}
});
</script>
</body>

</html>
