<?php

$activeHome = $currentPageURL === "http://localhost/patriarch" || $currentPageURL === "http://localhost/patriarch/index.php";
$activeContent = $currentPageURL === "http://localhost/patriarch/patriarchs.php";
$activeSearchPage = $currentPageURL === "http://localhost/patriarch/search.php";

if (isset($_GET["search"])) {
  $activeSearch = $currentPageURL === "http://localhost/patriarch/search.php?search=" . $_GET['search'];
}

?>




<nav class="navbar navbar-expand-lg bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand text-white d-flex align-items-center link-patriarch" href="index.php">
            <img src="http://localhost/patriarch/media/img/logo.png" class="logo-patriarch" alt="logo-patriarch">
            بافلي
        </a>
        <button class="navbar-toggler" type="button" name="toggle-menu" data-bs-toggle="collapse" data-bs-target="#mobileNav">
            <i class="fa-solid fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="mobileNav">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-white <?php echo $activeHome ? 'nav-active-link' : '' ?>" href="index.php">الصفحة الرئيسية</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white <?php echo $activeContent ? 'nav-active-link' : '' ?>" href="patriarchs.php">الآباء البطاركة</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white <?php echo $activeSearchPage || $activeSearch ? 'nav-active-link' : '' ?>" href="search.php">ابحث عن الآباء البطاركة</a>
                </li>
            </ul>
            <form class="d-flex me-auto ms-0 search-form" method="GET" action="search.php">
                <label for="search-input" class="visually-hidden"></label>
                <input id="search-input" class="form-control me-2" value="<?php echo $_GET["search"] ?? '' ?>" type="search" placeholder="بحث عن آباء بطاركة..." name="search">
                <button class="search-btn" type="submit">بحث</button>
            </form>
        </div>
    </div>
</nav>