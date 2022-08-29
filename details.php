<?php
session_start();
if (isset($_SESSION['username'])) {
    header('location: admin/login-admin.php');
    exit();
}
require_once "./includes/layout/header.php";
require_once "./includes/layout/nav.php";
require_once 'connect.php';
require_once 'functions.php';


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
                <h3 class="text-black"><b><?php echo $row['id'] . '-' . $row['name']; ?></b></h3>
                <h2 class="card-title opacity-75"><?php echo $row['Gregorian']; ?></h2>
                <?php echo getPatriarchDetails($row['body']) ?>
                <a class="mt-3 text-primary d-block text-start" style="cursor: pointer;" onclick="window.print()" >طباعة هذه المعلومات...</a>
                <a class="mt-3 text-primary d-block text-start" href="patriarchs.php">إلي صفحة الأباء البطاركة...</a>
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

require_once './includes/layout/footer.php';
