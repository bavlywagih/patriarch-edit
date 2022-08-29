<?php
session_start();
include '../includes/layout/head.php';
include 'function.php';
include 'nav-dash.php';

if (!isset($_SESSION['username'])) {
    header('location: login-admin.php');
    exit();
}

$do = isset($_GET['do']) ? $_GET['do'] : 'manage';

if ($do == 'manage'){?>
    <h1>
        welcome to manage
    </h1>
    <a href="page.php?do=add">add new user +</a>
    
<?php }

elseif ($do == 'add'){
    echo 'you are in page add';
}

elseif($do == 'insert'){
    echo 'welcome you are in page insert';
}

else{
    echo 'Error There\'s No Page Whith This Name';
}

?>