<?php
session_start();
$nonavbar = '';
if (isset($_SESSION['username'])){
    header('location: dashboard.php');
    exit();
}

require_once ('../includes/layout/header.php');
require_once('../connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['user'];
    $password = $_POST['pass'];

    $stmt = $con->prepare("SELECT * FROM admin WHERE username = ?  AND password = ? AND groupid = 1 " );
    $stmt->execute(array($username , $password));
    $row = $stmt->fetch();
    $count = $stmt->rowCount();

    if ($count > 0) {
        $_SESSION['username'] = $username;
        $_SESSION['userid'] = $row['userid'];
        $id = $row['userid'];
        
        $_SESSION['name'] = $row['name'];

        $_SESSION['username'] = $username;
        $_SESSION['firstname'] = $row['firstname'];
        $_SESSION['lastname'] = $row['lastname'];
        $_SESSION['userid'] = $row['userid'];
        header('location: dashboard.php');
        exit();
    }
}


?>
<div class="wrapper">
    <div class="logo">
        <img src="http://localhost/sea/image/logo-sae.png" alt="">
    </div>
    <div class="text-center mt-4 name">
        <br>
        <span>
            تسجيل دخول المشرفين
        </span>
    </div>


    <form class="p-3 mt-3" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">

        <div class="form-field d-flex align-items-center">
            <span class="far fa-user"></span>
            <input type="text" name="user" id="userName" placeholder="Username">
        </div>
        <div class="form-field d-flex align-items-center">
            <span class="fas fa-key"></span>
            <input type="password" name="pass" id="pwd" placeholder="Password">
        </div>
        <button class="btn mt-3">تسجيل دخول</button>
    </form>
    <div class="text-center fs-6">
        <a href="#">تسجيل دخول مشرفين</a>
    </div>
</div>
<?php
require_once('../includes/layout/footer.php');

?>