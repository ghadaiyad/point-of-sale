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
    <?php include "../Operations/connect_libray.php"; ?>
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
                <h1 class="page-title font-weight-bold">تعريف كتاب و اقسام جديدة </h1>
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
                                              <div class="ibox-title">تعريف كتاب جديد</div>
                                            <div class="ibox-tools">
                                                <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                                            </div>
                                          </div>
                                          <div class="ibox-body" >
                                              <form class="form-horizontal" id="form-addbook"  novalidate="novalidate">
                                                <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label">القسم او المجموعة</label>
                                                    <div class="col-sm-6">
                                                    <select class="form-control select2_demo_1" name="group_books" id="group_books">
                                                        <optgroup label="الكتب">
                                                          <?php
                                                          $sql = "SELECT * FROM group_books";
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
                                                          <input class="form-control" type="text" name="name">
                                                      </div>
                                                  </div>
                                                  <div class="form-group row">
                                                      <label class="col-sm-2 col-form-label">المؤلف : </label>
                                                      <div class="col-sm-9">
                                                          <input class="form-control" type="text" name="author">
                                                      </div>
                                                  </div>

                                                  <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">الاسعار :  </label>
                                                      <div class="col-sm-4">
                                                        <div class="input-group">
                                                            <div class="input-group-addon bg-white">$</div>
                                                            <input class="form-control" type="text" placeholder="سعر الشراء" name="cost_price">
                                                            <div class="input-group-addon bg-white">.00</div>
                                                            </div>

                                                      </div>

                                                      <div class="col-sm-4">
                                                        <div class="input-group">
                                            <div class="input-group-addon bg-white">$</div>
                                            <input class="form-control" type="text" placeholder="سعر البيع" name="sale_price">
                                            <div class="input-group-addon bg-white">.00</div>
                                        </div>
                                                      </div>
                                                  </div>
                                                  <div class="form-group row">
                                                      <label class="col-sm-2 col-form-label">رقم الطبع :  </label>
                                                      <div class="col-sm-9">
                                                          <input class="form-control" type="text" name="number_stamp">
                                                      </div>
                                                  </div>
                                                  <div class="form-group row">
                                                      <label class="col-sm-2 col-form-label">ملاحظات :  </label>
                                                      <div class="col-sm-9">
                                                          <input class="form-control" type="text" name="note">
                                                      </div>
                                                  </div>
                                                  <div class="form-group row">
                                                      <label class="col-sm-2 col-form-label">بضافة اول المدة :  </label>
                                                      <div class="col-sm-9">
                                                          <input class="form-control" type="number" value="0" name="total_qty">
                                                      </div>
                                                  </div>
                                                  <div class="form-group row">
                                                      <div class="col-sm-12 ml-sm-auto">
                                                          <button class="btn btn-info btn-block" type="submit">اضافة</button>
                                                      </div>
                                                  </div>

                                              </form>
                                          </div>
                                      </div>




                                          </div>
                                      </div>

                                <div class="row">
                                    <div class="col-md-12">

                                      <div class="ibox">

                                                <div class="ibox-head">
                                                    <div class="ibox-title">تعريف قسم جديد</div>
                                                  <div class="ibox-tools">
                                                      <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                                                      <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                                                  </div>
                                                </div>
                                                      <div class="ibox-body" >
                                              <form class="form-horizontal" id="form-addgroup"  novalidate="novalidate">


                                                  <div class="form-group row">
                                                      <label class="col-sm-2 col-form-label"> اسم القسم </label>
                                                      <div class="col-sm-9">
                                                          <input class="form-control" type="text" name="name_Group">
                                                      </div>
                                                  </div>
                                                  <div class="form-group row">
                                                      <label class="col-sm-2 col-form-label">ملاحظات :  </label>
                                                      <div class="col-sm-9">
                                                          <input class="form-control" type="text" name="note_Group">
                                                      </div>
                                                  </div>

                                                  <div class="form-group row">
                                                      <div class="col-sm-12 ml-sm-auto">
                                                          <button class="btn btn-info btn-block" type="submit">اضافة</button>
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
    $("#form-addgroup").validate({
        rules: {
            name_Group: {
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
     $("#form-addgroup").on("submit", function (event) {
if (event.isDefaultPrevented()) {
   // handle the invalid form...
} else {
   // everything looks good!
   event.preventDefault();
   $.ajax({
       type: 'POST',
       url: '../Operations/Addgroup.php',
       data: $(this).serialize()
   })
   .done(function(data){
$('#group_books').append(data);
$('.alert-success').removeClass( "hidden" ).addClass( "show" );
$("#form-addgroup")[0].reset();

   })
   .fail(function() {

       // just in case posting your form failed
       alert( "حصل خطأ ما الرجاء اعادة المحاولة ! ..." );

   });

   // to prevent refreshing the whole page page
   return false;
}
});
         $("#form-addbook").validate({
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
          $("#form-addbook").on("submit", function (event) {
    if (event.isDefaultPrevented()) {
        // handle the invalid form...
    } else {
        // everything looks good!
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: '../Operations/Addbook.php',
            data: $(this).serialize()
        })
        .done(function(data){
//$('#response').append(data);
$('.alert-success').removeClass( "hidden" ).addClass( "show" );
$("#form-addbook")[0].reset();

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
