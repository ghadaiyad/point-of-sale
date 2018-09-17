<nav class="page-sidebar" id="sidebar">
    <div id="sidebar-collapse">
        <div class="admin-block d-flex">
            <div>
                <img src="assets/img/admin-avatar.png" width="45px" />
            </div>
            <div class="admin-info">
                <div class="font-strong"><?= $_SESSION['user_Name']; ?></div><small>مستخدم</small></div>
        </div>
        <ul class="side-menu metismenu">
            <li>
                <a class="active" href="../pages/dashborad.php"><i class="sidebar-item-icon fa fa-th-large"></i>
                    <span class="nav-label">الرئيسية</span>
                </a>
            </li>
            <li class="heading">المبيعات</li>
            <li>
                <a href="../Pages/Sales.php"><i class="sidebar-item-icon ti-export"></i>
                    <span class="nav-label">صفحة المبيعات<span>
                </a>
            </li>
            <li>
                <a href="../Pages/salesbooks.php"><i class="sidebar-item-icon ti-pie-chart"></i>
                    <span class="nav-label">إستعلامات مبيعات الكتب<span>
                </a>
            </li>
              <li class="heading">المستودعات</li>
            <li>
                <a href="../Pages/addbook&group.php"><i class="sidebar-item-icon ti-book"></i>
                    <span class="nav-label">تعريف كتاب و قسم جديد<span>
                </a>
            </li>

            <li>
                <a href="../Pages/Delete&EditBooks.php"><i class="sidebar-item-icon ti-trash"></i>
                    <span class="nav-label">تعديل وحذف كتاب و قسم <span>
                </a>
            </li>
            <li>
                <a href="../Pages/purchases.php"><i class="sidebar-item-icon ti-import"></i>
                    <span class="nav-label">صفحة المشتريات<span>
                </a>
            </li>
            <li>
                <a href="MovementRep.php"><i class="sidebar-item-icon ti-exchange-vertical"></i>
                    <span class="nav-label">إستعلامات مشتريات الكتب<span>
                </a>
            </li>
            <li class="heading">--------</li>
            <li>
                <a href="../Pages/register.php"><i class="sidebar-item-icon ti-stamp"></i>
                    <span class="nav-label">تعريف مستتخدم جديد</span>
                </a>
            </li>


        </ul>
    </div>
</nav>
