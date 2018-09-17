<header class="header">
    <div class="page-brand">
        <a class="link" href="../pages/dashborad.php">
            <span class="brand">Sh
                <span class="brand-tip">DOW</span>
            </span>
            <span class="brand-mini">w</span>
        </a>
    </div>
    <div class="flexbox flex-1">
        <!-- START TOP-LEFT TOOLBAR-->
        <ul class="nav navbar-toolbar">
            <li>
                <a class="nav-link sidebar-toggler js-sidebar-toggler"><i class="ti-menu"></i></a>
            </li>
            <li>
        
            </li>
        </ul>
        <!-- END TOP-LEFT TOOLBAR-->
        <!-- START TOP-RIGHT TOOLBAR-->
        <ul class="nav navbar-toolbar">


            <li class="dropdown dropdown-user">
                <a class="nav-link dropdown-toggle link" data-toggle="dropdown">
                    <img src="assets/img/admin-avatar.png" />
                    <span></span><?= $_SESSION['user_Name']; ?><i class="fa fa-angle-down m-l-5"></i></a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="profile.html"><i class="fa fa-user"></i>معلومات</a>

                    <a class="dropdown-item" href="../Operations/logout.php"><i class="fa fa-power-off"></i>تسجيل خروج</a>
                </ul>
            </li>
        </ul>
        <!-- END TOP-RIGHT TOOLBAR-->
    </div>
</header>
