<?php
include '../includes/layout/header.php';
session_start();
if (isset($_SESSION['username'])) {
    include 'nav-dash.php'; ?>
    <div class="p-5 text-black cover-back-img text-center">
        <h1>مرحبا <span class="admin-name-span-dash"><?php echo $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] ?></span></h1>
        <p class="text-center">مرحباً مشرف</p>
    </div>


    <?php } else { 
        $nofooter = '';
        ?>
    <div style="display: flex; align-items: center; justify-content: center;">
        <div class="slide-container swiper">

            <div class="slide-content">
                <div class="card-wrapper swiper-wrapper">
                    <div class="card swiper-slide">
                        <div class="image-content">
                            <span class="overlay"></span>

                            <div class="card-image">
                                <div class="dash-user-icon">

                                    <i class="fa-solid fa-user"></i>
                                </div>
                                <!--<img src="images/profile1.jpg" alt="" class="card-img">-->
                            </div>
                        </div>

                        <div class="card-content">
                            <h2 class="name">User Not Found</h2>
                            <p class="description">You Are Not Authorized To View This Page </p>
                            <a href="login-admin.php">
                                <button class="button"> Go Back </button>
                            </a>
                        </div>
                    </div>
                </div>
                
                <?php
             }  
             include '../includes/layout/footer.php';
