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
                <h1 class="page-title font-weight-bold">تسجيل مستخدم جديد</h1>
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

                                                    <div class="ibox-title">بيانات المستخدم </div>
                                                    <div class="ibox-tools">
                                                        <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                                                        <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                                                    </div>
                                                </div>

                                          <div class="ibox-body" >
                                            <form method="post" class="form-horizontal" id="register-form"   style="direction: rtl;">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <input class="form-control" type="text" name="fullname" placeholder="الاسم كامل">
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <input class="form-control" type="text" name="user_Name" placeholder="اسم المستخدم">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <input class="form-control" type="email" name="email" placeholder="ايميل" autocomplete="off">
                                                </div>
                                                <div class="form-group">
                                                    <input class="form-control" id="password" type="password" name="password" placeholder="كلمة السر">
                                                </div>
                                                <div class="form-group">
                                                    <input class="form-control" type="password" name="password_confirmation" placeholder="كلمة السر مرة اخرى">
                                                </div>

                                                <div class="form-group">
                                                    <button class="btn btn-info btn-block" type="submit">تسجيل و حفظ</button>
                                                </div>

                                                <div class="form-group" id="response">

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
    <script src="assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
    <script src="assets/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
    <script src="assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/vendors/metisMenu/dist/metisMenu.min.js" type="text/javascript"></script>
    <script src="assets/vendors/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- PAGE LEVEL PLUGINS-->
    <script src="assets/vendors/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
    <!-- CORE SCRIPTS-->
    <script src="assets/js/app.min.js" type="text/javascript"></script>
    <!-- PAGE LEVEL SCRIPTS-->
    <script type="text/javascript">
            $('#register-form').validate({
              errorClass: "help-block",
                rules: {
                    fullname: {
                        required: true,
                        minlength: 6
                    },
                    user_Name: {
                        required: true,
                        minlength: 3
                    },
                    password: {
                        required: true,
                        confirmed: false
                    },
                    password_confirmation: {
                        equalTo: password
                    }
                },
                highlight: function(e) {
                    $(e).closest(".form-group").addClass("has-error")
                },
                unhighlight: function(e) {
                    $(e).closest(".form-group").removeClass("has-error")
                },
            });
        $("#register-form").on("submit", function (event) {
  if (event.isDefaultPrevented()) {
  ///alert( "حصل خطأ ما الرجاء اعادة المحاولة ! ..." );
      // handle the invalid form...
  } else {
      // everything looks good!
      event.preventDefault();
      $.ajax({
          type: 'POST',
          url: '../Operations/AddUser.php',
          data: $(this).serialize()
      })
      .done(function(data){
$('#response').append(data);
//   alert( "done" );

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
