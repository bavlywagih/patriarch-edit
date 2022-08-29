<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('location: login-admin.php');
    exit();
}
if (isset($_SESSION['username'])) {
    header('location: login-admin.php');
    exit();
}

include '../includes/layout/header.php';
?>
<div style="display: flex; align-items: center; justify-content: center;">
    <div class="slide-container swiper">

        <div class="slide-content">
            <div class="card-wrapper swiper-wrapper">
                <div class="card swiper-slide">
                    <div class="image-content">
                        <span class="overlay"></span>

                        <!-- <div class="card-image"> -->
                        <!-- <div class="dash-user-icon"> -->

                        <!-- <i class="fa-solid fa-user"></i> -->
                        <!-- </div> -->
                        <!--<img src="images/profile1.jpg" alt="" class="card-img">-->
                        <!-- </div> -->
                    </div>

                    <div class="card-content">
                        <h2 class="name"><span style="font-size: xx-large;">EROR 404</span></h2>
                        <p class="description"> <span style="font-size: x-large;">NOT</span> Found This Page</p>
                        <a href="dashboard.php">
                            <button class="button"> Go Back </button>
                        </a>
                    </div>
                </div>
            </div>
            <?php
            $nofooter='';
            include '../includes/layout/footer.php';
            ?>