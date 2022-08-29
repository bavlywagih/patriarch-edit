<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location: login-admin.php');
    exit();
}
include '../includes/layout/header.php';
include 'nav-dash.php';
include '../connect.php';
require_once '../functions.php';




if (isset($_SESSION['username'])) {
    $do = isset($_GET['do']) ? $_GET['do'] : 'manage';
    if ($do == 'show_patriarch') { ?>
        <div class="sort-box">
            <form method="GET">
                <button type="submit" name="arrange_asc">ترتيب تصاعدي</button>
            </form method="GET">
            <form>
                <button type="submit" name="arrange_desc">ترتيب تنازلي</button>
            </form>
        </div>

        <?php
        $query = "SELECT * FROM patriarch ORDER BY id desc";

        if (isset($_GET['arrange_desc'])) {
            $query = "SELECT * FROM patriarch ORDER BY id desc";
        } else if (isset($_GET['arrange_asc'])) {
            $query = "SELECT * FROM patriarch ORDER BY id asc";
        }

        $stmt = $pdo->query($query);
        ?>

        <div class="patriarchs-container">
            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                <a href="?do=show_patriarch_detials&patriarchId=<?php echo $row['id'] ?>">
                    <div class="patriarch-box mb-3">
                        <div class="card-header">
                            <h3 class="text-black">
                                <b><?php echo $row['id'] . '-' . $row['name']; ?></b>
                            </h3>
                        </div>
                        <hr style="color: black;">
                        <div class="card-body" style="display: flex; margin-right: 10px;">
                            <h4 class="card-title text-black opacity-75" style="margin-right: 10px;"> <?php echo $row['Gregorian']; ?></h4>
                        </div>

                    </div>
                </a>
            <?php } ?>
        </div>

        <?php require_once '../includes/layout/footer.php';
    } elseif ($do == 'show_patriarch_detials') {

        require_once '../functions.php';


        if (isset($_GET['patriarchId']) && $_GET['patriarchId']) {
            $patriarchId = $_GET['patriarchId'];
            $query = "SELECT * FROM patriarch WHERE id = $patriarchId";
            $stmt = $pdo->query($query);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        ?>
                <div class="patriarch-details-container">


                    <div class="image">
                        <img src="http://localhost/patriarch/media/img/<?php echo $row['image'] ?>" style="" alt="patriarch_<?php echo $patriarchId ?>" />
                    </div>

                    <div class="content">
                        <a href="member.php?do=edit_patriarch&patriarchid=<?php echo $patriarchId ?>">
                            <button type="button" style="margin-bottom: 10px" class="btn btn-success">
                                <i class="fa-solid fa-pen"></i>
                                تعديل
                            </button>
                        </a>
                        <a href="">
                            <button type="button" style="margin-bottom: 10px" class="btn btn-danger">
                                <i class="fa-solid fa-trash-can"></i>
                                حذف
                            </button>
                        </a>

                        <h3 class="text-black"><b><?php echo $row['id'] . '-' . $row['name']; ?></b></h3>
                        <h2 class="card-title opacity-75"><?php echo $row['Gregorian']; ?></h2>
                        <?php echo getPatriarchDetails($row['body']) ?>
                        <a class="mt-3 text-primary d-block text-start" style="cursor: pointer;" onclick="window.print()">طباعة هذه المعلومات...</a>
                        <a class="mt-3 text-primary d-block text-start" href="?do=show_patriarch">إلي صفحة الأباء البطاركة...</a>

                    </div>
                </div>

                <script>
                    document.addEventListener('selectionchange', function() {
                        let selectedText = window.getSelection().toString();
                        selectedText += '\nاقرأ المزيد عن هذا البطرك من ذلك الرابط: <?php echo $currentPageURL; ?>';
                        navigator.clipboard.writeText(selectedText).then(function() {
                            console.log('Async: Copying to clipboard was successful!');
                        }, function(err) {
                            console.error('Async: Could not copy text: ', err);
                        });
                    });

                    window.onload = () => {
                        console.log('Loaded');
                    }
                </script>
            <?php
            }
        } else {
            header('Location: http://localhost/');
        }

        require_once '../includes/layout/footer.php';
    } elseif ($do == 'edit_profile') {

        $userid = $_SESSION['userid'];
        $stmt = $con->prepare("SELECT * FROM admin WHERE userid = ?");
        $stmt->execute(array($userid));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();
        if ($stmt->rowCount() > 0) {
            ?>
            <form class="form-edit-dash" action="?do=update_profile" method="POST">
                <div class="form-group  text-center">
                    <h1>تعديل الملف الشخصي </h1>
                    <h2><?php echo $row['firstname'] . ' ' . $row['lastname'] ?></h2>
                </div>
                <input type="hidden" name="userid" value="<?php echo $userid ?>">
                <!-- username -->
                <div class="form-group div-edit-dash">
                    <label class="label-edit-dash" for="exampleInputusername"> الاسم</label>
                    <input type="text" name="username" value="<?php echo $row['username'] ?>" class="form-control input-value-color" id="exampleInputusername" placeholder=" الاسم ">
                    <label class="label-edit-dash"> الاسم يجب ان يكون باللغه الانجليزيه</label>
                </div>
                <!-- password -->
                <div class="form-group div-edit-dash">
                    <label class="label-edit-dash" for="exampleInputpassword">كلمه المرور</label>
                    <input type="hidden" name="oldpassword" value="<?php echo $row['password'] ?>">
                    <input type="password" name="newpassword" class="form-control input-value-color" autocomplete="new-password" id="exampleInputpassword" placeholder="كلمه المرور">
                    <label class="label-edit-dash"> كلمه المرور يجب ان تكون باللغه الانجليزيه</label>
                </div>
                <!-- firstname -->
                <div class="form-group div-edit-dash">
                    <label class="label-edit-dash" for="exampleInputfirstname">الاسم الاول</label>
                    <input type="text" name="firstname" value="<?php echo $row['firstname'] ?>" class="form-control input-value-color" id="exampleInputfirstname" placeholder="الاسم الاول">
                    <label class="label-edit-dash"> الاسم الاول يجب ان تكون باللغه العربية</label>
                </div>
                <!-- lastname -->
                <div class="form-group div-edit-dash">
                    <label class="label-edit-dash" for="exampleInputlastname">الاسم الاخير</label>
                    <input type="text" name="lastname" value="<?php echo $row['lastname'] ?>" class="form-control input-value-color" id="exampleInputlastname" placeholder="الاسم الاخير">
                    <label class="label-edit-dash"> الاسم الاخير يجب ان تكون باللغه العربية</label>
                </div>
                <div class="form-group div-edit-dash">
                    <input type="submit" class="form-control">
                </div>
            <?php
        } else {
            echo 'Sorry ! there is no such id';
        }
    } elseif ($do == 'update_profile') {
            ?>
            <div class="form-group  text-center">
                <h1>تحديث الملف الشخصي </h1>
            </div>
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $id    = $_POST['userid'];
                $user  = $_POST['username'];
                $first = $_POST['firstname'];
                $last  = $_POST['lastname'];
                $pass  = empty($_POST['newpassword']) ? $pass = $_POST['oldpassword'] : $_POST['newpassword'];

                $formerror = array();

                if (strlen($user) <  4 ) {
                    $formerror[] =  '  لا يمكن ان يكون اسم المستخدم اقل من اربع حروف';
                }
                if (strlen($first) <  4) {
                    $formerror[] =  '  لا يمكن ان يكون الاسم الاول اقل من اربع حروف';
                }
                if (strlen($last) <  4) {
                    $formerror[] =  '  لا يمكن ان يكون الاسم الاخير اقل من اربع حروف';
                }
                if (empty($user)) { 
                    $formerror[] =  '    لا يمكن ترك حقل الاسم فارغ ';
                }

                if (empty($first)) {
                    $formerror[] =  '    لا يمكن ترك حقل الاسم الاول';
                }

                if (empty($last)) {
                    $formerror[] =  '    لا يمكن ترك حقل الاسم الاخير';
                }

                foreach ($formerror as $error){
                    echo
                    '<div class="alert alert-dismissible alert-danger">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong>عذراً!</strong> <a href="#" class="alert-link">.' .  $error  .'</div>';
                }


                $stmt = $con->prepare("UPDATE admin SET username = ? , firstname = ? , lastname = ? , password = ? WHERE userid = ?  ");
                $stmt->execute(array($user, $first, $last, $pass, $id));
                echo $stmt->rowCount() . ' تم تحديثه';
            } else {
                echo 'هناك خطا !! لا يمكن الدخول الي هذة الصفحه مباشرةً';
            }
        } elseif ($do == 'edit_patriarch') {
            $patriarchid = isset($_GET['patriarchid']) && is_numeric($_GET['patriarchid']) ? intval($_GET['patriarchid']) : 0;
            $stmt = $con->prepare("SELECT * FROM patriarch WHERE id = ?");
            $stmt->execute(array($patriarchid));
            $row = $stmt->fetch();
            $count = $stmt->rowCount();

            if ($stmt->rowCount() > 0) { ?>
                <form class="form-edit-dash" action="?do=update_patriarch" method="POST">

                    <div class="form-group  text-center">
                        <h1>تعديل الاب البطريرك </h1>
                        <h2></h2>
                    </div>

                    <!-- id -->
                    <input type="hidden" style="text-align: end;" name="id" value="<?php echo $row['id'] ?>" class="form-control  input-value-color" id="exampleInputid" autocomplete="off" placeholder="مثال البابا رقم 100" />


                    <!-- name -->
                    <div class="form-group div-edit-dash">
                        <label class="label-edit-dash" for="exampleInputname"> اسم الاب البطرك</label>
                        <input type="text" name="name" value="<?php echo $row['name'] ?>" class="form-control input-value-color" id="exampleInputname" placeholder=" الاسم ">
                    </div>

                    <!-- Gregorian -->
                    <div class="form-group div-edit-dash">
                        <label class="label-edit-dash" for="exampleInputGregorian">مدة حبريته</label>
                        <input type="text" name="Gregorian" value="<?php echo $row['Gregorian'] ?>" class="form-control input-value-color" id="exampleInputGregorian" placeholder=" مدة حبريته">
                    </div>

                    <!-- body -->
                    <div class="form-group div-edit-dash">
                        <label class="label-edit-dash" for="exampleInputbody">قصه الاب البطريرك</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="body" rows="3"><?php echo $row['body'] ?></textarea>
                    </div>






                    <div class="form-group div-edit-dash">
                        <input type="submit" class="form-control">
                    </div>

                <?php  } else {
                echo 'there is no such is';
            }
        } elseif ($do == 'update_patriarch') { ?>

                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') { ?>
                    <div class="form-group  text-center">
                        <h1>تحديث البابا <?php echo $_POST['name'] ?> </h1>
                    </div>
        <?php
                    $id    = $_POST['id'];
                    $name  = $_POST['name'];
                    $grego = $_POST['Gregorian'];
                    $body  = $_POST['body'];

                    $stmt = $con->prepare("UPDATE patriarch SET name = ? , Gregorian = ? , body = ? WHERE id = ?");
                    $stmt->execute(array($name, $grego, $body, $id));
                    echo $stmt->rowCount() . ' تم تحديثه';
                } else {
                    echo 'هناك خطا !! لا يمكن الدخول الي هذة الصفحه مباشرةً';
                }
            }
        }




        ?>

        <?php
        $nofooter = '';
        require_once('../includes/layout/footer.php');
        ?>