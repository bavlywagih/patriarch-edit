<?php

$words = explode(" ", $_SESSION['firstname']);
$acronym = "";
foreach ($words as $w) {
    $acronym .= mb_substr($w, 0, 1);
};
$v = $_SESSION['userid'];





?>
<nav class="navbar navbar-expand-lg bg-light nav-dash">
    <div class="container-fluid">
        <a class="navbar-brand text-black d-flex align-items-center link-patriarch" href="index.php">
            <img src="http://localhost/patriarch/media/img/logo.png" class="logo-patriarch" alt="logo-patriarch">
            بافلي
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa-solid fa-bars" style="color: black;"></i> </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="margin-right: 710px!important;">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="dashboard.php">الصفحه الرئيسية</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">اضافه عضو</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://localhost/patriarch%20edit/admin/member.php?do=show_patriarch">تعديل الاباء البطاركه</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="a-litter-dash" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="d-flex">
                            <div class="div-litter">
                                <div class="div-litter-first">
                                    <i class="fa-solid fa-angle-down" style="font-size: 10px;"></i>
                                    <?php echo $acronym ?>
                                </div>

                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu text-center" style="position: absolute;right: -179px;">
                        <li><a class="dropdown-item" href="member.php?do=show_profile">
                                <i class="fa-solid fa-address-card"></i>
                                رؤيه الملف الشخصي</a></li>
                        <li><a class="dropdown-item" href="member.php?do=edit_profile">
                                <i class="fa-solid fa-edit"></i>
                                تعديل الملف الشخصي</a></li>
                        <li>

                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="logout.php">
                                <i class="fa-solid fa-right-from-bracket"></i>
                                تسجيل الخروج</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>