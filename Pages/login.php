<!DOCTYPE html>
<?php
session_start();
if (isset($_SESSION['user_ID']) && !empty($_SESSION['user_Name'])){
header('Location: http://'. $_SERVER["SERVER_NAME"].'/PointOfSaleApp/Pages/dashborad.php');
        }
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Shadow| Login</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="assets/css/main.css" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->
    <link href="assets/css/pages/auth-light.css" rel="stylesheet" />
</head>

<body class="bg-silver-300">
    <div class="content">
        <div class="brand">
            <a class="link" href="#">نظام مكتبات</a>
        </div>
        <form id="login-form" action="javascript:;" method="post" style="direction: rtl;">
            <h2 class="login-title">تسجيل دخول</h2>
            <div class="form-group">
                <div class="input-group-icon right">

                    <input class="form-control" type="text" name="user_Name" placeholder="اسم المستخدم" autocomplete="off">
                      <div class="input-icon"><i class="ti-user"></i></div>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group-icon right">

                    <input class="form-control" type="password" name="password" placeholder="كلمة المرور">
                      <div class="input-icon"><i class="fa fa-lock font-16"></i></div>
                </div>
            </div>

            <div class="form-group">
                <button class="btn btn-info btn-block" type="submit">دخول</button>
            </div>
            <div class="form-group" id="response" style="    color: red;">

            </div>


        </form>
    </div>
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    <!-- END PAGA BACKDROPS-->
    <!-- CORE PLUGINS -->
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

            $('#login-form').validate({
                errorClass: "help-block",
                rules: {
                    user_Name: {
                        required: true,
                      minlength: 3,
                    },
                    password: {
                        required: true
                    }
                },
                highlight: function(e) {
                    $(e).closest(".form-group").addClass("has-error")
                },
                unhighlight: function(e) {
                    $(e).closest(".form-group").removeClass("has-error")
                }
            });

        $("#login-form").on("submit", function (event) {
  if (event.isDefaultPrevented()) {
      // handle the invalid form...
  } else {
      // everything looks good!
      event.preventDefault();
      $.ajax({
          type: 'POST',
          url: '../Operations/loginCheck.php',
          data: $(this).serialize()
      }).done(function(data){
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
