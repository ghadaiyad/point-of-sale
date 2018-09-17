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
                <h1 class="page-title font-weight-bold">استعلامات مبيعات الكتب</h1>
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
                                                    <div class="ibox-title">الحركات الصادرة من المستودع</div>
                                                  <div class="ibox-tools">
                                                      <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                                                      <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                                                  </div>


                                                </div>
                                          <div class="ibox-body">


                                              <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                                                  <thead>
                                                      <tr>
                                                        <th>الرقم</th>
                                                        <th>الكتاب</th>
                                                        <th>المؤلف</th>
                                                        <th>نوع الحركة</th>
                                                        <th>العدد</th>
                                                        <th>سعر الواحدة</th>
                                                          <th>المجموع</th>
                                                        <th>ملاحظات</th>
                                                                <th>الوقت و التاريخ</th>
                                                                <th>اسم المدخل</th>
                                                      </tr>
                                                  </thead>
                                                  <tfoot>
                                                      <tr>
                                                        <th>الرقم</th>
                                                        <th>الكتاب</th>
                                                        <th>المؤلف</th>
                                                        <th>نوع الحركة</th>
                                                        <th>العدد</th>
                                                        <th>سعر الواحدة</th>
                                                          <th>المجموع</th>
                                                        <th>ملاحظات</th>
                                                                <th>الوقت و التاريخ</th>
                                                                <th>اسم المدخل</th>
                                                      </tr>
                                                  </tfoot>
                                                  <tbody>
                                                    <?php
                              			$sql = "SELECT B.name ,B.sale_price, B.author , GB.name as Group_name , RM.type_M , RM.qty_move ,RM.id as MID , RM.note , RM.posting_datatime , U.fullname as User_name
                                                     FROM  repository_move RM , books B , group_books GB , users U
                                                      WHERE  B.id = RM.book_id
                                                      AND Gb.id = RM.book_id
                                                        AND U.id = RM.user_id
                                                        AND RM.type_M = 0;
                                                    ";
                                                    $result = $conn->query($sql);
                                                    if (!$result) {
                                           printf("Errormessage: %s\n", $mysqli->error);
                                        }

                                                          while($row = mysqli_fetch_assoc($result)) {
                                                        //    date_default_timezone_set("America/New_York");
                                                            $total_move=$row["sale_price"]*$row["qty_move"];
                                                         $type = ($row["type_M"] == 1 ? "مشتريات" :"مبيعات ");
                                                            $typeColor = ($row["type_M"] == 1 ? "color-view bg-primary":"color-view bg-silver");
                              			?>
                              			<tr>
                                      <td><?= $row["MID"]; ?></td>
                                      <td><?= $row["name"]; ?></td>
                                      <td><?= $row["author"]; ?></td>
                                      <td class="<?= $typeColor ?>"><?= $type ?></td>
                                        <td class="color-view bg-teal"><?= $row["qty_move"]; ?></td>
                                    <td class="color-view bg-teal"> <?= number_format($row["sale_price"],3); ?> $</td>
                                      <td class="color-view bg-teal"> <?= number_format($total_move, 3); ?> $</td>
                                            	<td><?= $row["note"]; ?></td>

                                    <td><?= date("Y-m-d",strtotime($row["posting_datatime"])); ?></td>
                                        <td><?= $row["User_name"]; ?></td>
                                    </tr>
                              			<?php
                                  }
                              $conn->close();
                              ?>


                                                  </tbody>
                                              </table>
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
                $(function() {
                    $('#example-table').DataTable({
                      initComplete: function () {
    this.api().columns().every( function () {
        var column = this;
        var select = $('<select ><option value=""></option></select>')
            .appendTo( $(column.header()) )
            .on( 'change', function () {
                var val = $.fn.dataTable.util.escapeRegex(
                    $(this).val()
                );

                column
                    .search( val ? '^'+val+'$' : '', true, false )
                    .draw();
            } );

        column.data().unique().sort().each( function ( d, j ) {
            select.append( '<option value="'+d+'">'+d+'</option>' )
        } );
    } );
},
                      select: true ,
                        pageLength: 10,
                        "language": {
               "search": "بحث عن الكتب :",
               "lengthMenu": "عرض  _MENU_ صفوف",
                    "zeroRecords": "لا يوجد بيانات ",
                    "info": "النتائج _PAGE_ في _PAGES_",
                    "infoEmpty": "لا يوجد بيانات لعرضها",
                    "infoFiltered": "(تم البحث  _MAX_ من جميع البيانات)"
             },

                        //"ajax": './assets/demo/data/table_data.json',
                        /*"columns": [
                            { "data": "name" },
                            { "data": "office" },
                            { "data": "extn" },
                            { "data": "start_date" },
                            { "data": "salary" }
                        ]*/
                    });
                });
                </script>
</body>

</html>
