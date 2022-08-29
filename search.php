<?php

require_once "./includes/layout/header.php";
require_once "./includes/layout/nav.php";
require_once 'connect.php';
require_once 'functions.php';


if (isset($_GET["search"]) && trim($_GET["search"]) != null) {
    $searchTerm = trim($_GET['search']);
    $stmt = $pdo->query("SELECT * FROM patriarch WHERE name LIKE '%$searchTerm%' OR id LIKE '%$searchTerm%' OR Gregorian LIKE '%$searchTerm%'");
    $count = $stmt->rowCount();

    if ($count) { ?>
        <p class="result-count">وٌجِد <?php echo $count ?> نتيجة بحث</p>
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
            <div class="patriarch-details-container search">
                <div class="image">
                    <img src="http://localhost/patriarch/media/img/<?php echo $row['image'] ?>" style="" alt="patriarch_<?php echo $patriarchId ?>" />
                </div>
                <div class="content">
                    <h3 class="text-black"><b><?php echo $row['id'] . '-' . $row['name']; ?></b></h3>
                    <h2 class="card-title opacity-75"><?php echo $row['Gregorian']; ?></h2>
                    <?php echo getPatriarchDetails($row['body']) ?>
                </div>
            </div>
            <hr>
        <?php }
    } else { ?>
        <div class="data-not-found">
            <img src="http://localhost/patriarch/media/img/not-found.jpeg" alt="not_found">
            <p>عفواً لا يوجد بيانات</p>
        </div>
    <?php }
} else if (isset($_GET["search"])) { ?>
    <div class="data-not-found">
        <img src="http://localhost/patriarch/media/img/no-data.jpeg" alt="no_data_found">
        <p>ادخل اسم أو رقم أو تاريخ بطرك في خانة البحث</p>
    </div>
<?php } else { ?>
    <h2 class="text-center my-5 fw-bold">اكتب اسم الأب البطرك في صندوق البحث الأعلي.</h2>
    <img src="./media/img/search.jpg" alt="search_image" class="d-block w-50 ms-auto me-auto" />
<?php }  ?>

<?php require_once './includes/layout/footer.php'; ?>

<!-- Full screen modal -->
