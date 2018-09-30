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
    <?php include "../Operations/connect_DB.php";?>
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
                <h1 class="page-title font-weight-bold">تسجيل حساب جديد</h1>

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
                                <div class="ibox-title">معلومات حساب </div>
                              <div class="ibox-tools">
                                  <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                              </div>
                            </div>
                            <div class="ibox-body" >
                                <form class="form-horizontal" id="form-AddAcount"  novalidate="novalidate">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"> اسم الحساب كامل : </label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" name="name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">العنوان</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" name="address">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">رقم الهاتف (1) :</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" name="phone_1" id="phone_1" type="text">
                                        </div>
                                        <label class="col-sm-1 col-form-label">رقم الهاتف (2) :</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" name="phone_2" id="phone_2" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                      <label class="col-sm-2 col-form-label">فاكس : </label>
                                      <div class="col-sm-4">
                                          <input class="form-control" type="text" name="fax" placeholder="فاكس" autocomplete="off">
                                      </div>
                                        <label class="col-sm-1 col-form-label">البريد الالكتروني : </label>
                                        <div class="col-sm-4">
                                            <input class="form-control" type="email" name="email" placeholder="ايميل" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">ملاحظات :  </label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" name="note">
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
            name: {
                 message: 'يجب ان يكون اسم اكثر من 3 احرف',
                minlength: 3,
                required: !0
            },
            phone_1: {
              number: true,
                  minlength: 10,
                required: !0
            },
            phone_2: {
                number: true,
                  minlength: 10,
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
         $("#form-AddAcount").validate({
             rules: {
                 name: {
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
          $("#form-AddAcount").on("submit", function (event) {
    if (event.isDefaultPrevented()) {
        // handle the invalid form...
    } else {
        // everything looks good!
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: '../Operations/AddAcount.php',
            data: $(this).serialize()
        })
        .done(function(data){
$('#response').append(data);
$('.alert-success').removeClass( "hidden" ).addClass( "show" );
$("#form-AddAcount")[0].reset();

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
