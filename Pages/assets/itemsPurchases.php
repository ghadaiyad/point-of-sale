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
    <?php include "../Operations/connect_DB.php"; ?>
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
                  <h1 class="page-title font-weight-bold">استعلامات فواتير المشتريات </h1>
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
                                  <div class="ibox-title">بحث و عرض فواتير </div>
                                  <div class="ibox-tools">
                                      <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                                  </div>
                              </div>


                              <div class="ibox-body">
                                  <div class="row">
                                  <div class="form-group col-12" id="date_5">
                                      <label class="font-normal">بحث حسب التاريخ</label>
                                      <div class="input-daterange input-group">
                                          <input class="input-sm form-control datepicker" type="text" name="min" value="01/01/2018" id="min">
                                          <span class="input-group-addon p-l-10 p-r-10">الى</span>
                                          <input class="input-sm form-control datepicker" type="text" name="max" value="01/12/2018" id="max" >
                                      </div>
                                  </div>
                                      </div>
                                      <div class="row">
                                        <div class=" col-12">
                                        <div class="table-responsive">
                                  <table class="table table-sm table-striped table-bordered table-hover" id="invoice-table" >
                                      <thead>
                                          <tr>
                                              <th>رقم</th>
                                              <th>المورد</th>
                                              <th>التاريخ</th>
                                              <th>المبلغ الاجمالي</th>
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
                    <div class="page-preloader">يرجى انتظار ....</div>
                </div>
                <!-- END PAGA BACKDROPS-->
                <!-- CORE PLUGINS-->

              <?php require_once('../Parts/script.html'); ?>
                <!-- PAGE LEVEL SCRIPTS-->
                <script type="text/javascript">
                $(document).ready(function () {
                    var table =   $('#invoice-table').DataTable({
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

                              { "data": 'id' },
                              { "data": 'name' },
                              { "data": 'date' },
                                { "data": 'total' },
                                    { "data": '#' }
                            ]
                    });

                    // DataTable
                    function formatDate(date) {
                        var d = new Date(date),
                          day = '' + d.getDate(),
                            month = '' + (d.getMonth() + 1),
                            year = d.getFullYear();
                        if (month.length < 2) month = '0' + month;
                        if (day.length < 2) day = '0' + day;
                        return [month,day,year ].join('/');
                    }
                       var str = $(this).val();
                      var url ="../Operations/GetPurchasesInvoice.php?q=0";
                      $.get(url, function(json) {
                        json = JSON.parse(json);
                        var return_data = new Array();
                        for(var i=0;i< json.length; i++){
                          return_data.push({
                         'id' : json[i].id,
                        'name': json[i].name,
                        'date': formatDate(json[i].purchases_date),
                       'total': json[i].total_ammount,
                         '#':'  <button class="btn btn-default btn-xs" data-toggle="tooltip" data-original-title="Delete"><i class="fa fa-eye font-14"></i></button>'
                            });
                        }
                          console.log(return_data);
                      // table.clear();
                      table.rows.add(return_data);
                        table.draw();
                    });


                    $('#invoice-table thead th').each(function () {
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
                    $.fn.dataTable.ext.search.push(
                    function (settings, data, dataIndex) {
                      var min = $('#min').datepicker("getDate");
                        var max = $('#max').datepicker("getDate");
                        var startDate = new Date(data[2]);
                        console.log(startDate);
                        if (min == null && max == null) { return true; }
                        if (min == null && startDate <= max) { return true; }
                        if (max == null && startDate >= min) { return true; }
                        if (startDate <= max && startDate >= min) { return true; }
                        return false;
                    }
                    );
                    $("#min").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true,changeDay: true, changeYear: true });
                    $("#max").datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeDay: true, changeYear: true });
                    // Event listener to the two range filtering inputs to redraw on input
                    $('#min, #max').change(function () {
                        table.draw();
                    });
                });

                </script>
</body>

</html>
