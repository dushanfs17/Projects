<?php

session_start();

require_once(__DIR__ . '../../../Database/Connection.php');

use Database\Connection as Connection;

if (($_SESSION['user_type'] !== 'admin')) {
    header("Location: ../index.php");
    die();
}

$adminUsername = $_SESSION['username'];

$id = $_GET['id'];

$connectionObj = new Connection();
$connection = $connectionObj->getConnection();

$statement = $connection->prepare('SELECT * FROM category WHERE id = :id');
$statement->execute(['id' => $id]);
$categoryEdit = $statement->fetch(PDO::FETCH_ASSOC);


$deletedDate = $categoryEdit['deleted_at'];

if ($deletedDate === '0000-00-00 00:00:00') {
    $isDeleted = false;
} else {
    $isDeleted = true;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Brainster Library is an online platform designed to let users share their thoughts on the books they are reading by leaving private or public comments. The platform allows users to revisit their notes anytime, offering a personalized space for reflection and discussion." />
    <meta name="author" content="Dushan Hadji-Vasilev" />

    <title>Edit Category - Brainster Library </title>

    <!-- Local CSS -->
    <link rel="stylesheet" href="../../Assets/css/style.css">
    <!-- Font Awesome Kit -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Sweet Alert Library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

    <!-- Navbar Section -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-light">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand text-secondary" href="../../index.php">
                <img src='https://i.postimg.cc/zyG6QcWF/Brainster-co.png' border='0' width="90" alt='Brainster-co' />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <!-- Handle navigation -->
                <div class="navbar-nav ms-auto">
                    <a class="nav-link text-secondary" href="../../index.php">Home</a>
                    <span class="text-secondary nav-item mt-2">Welcome, <?= $adminUsername ?> </span>
                    <a class="nav-link text-secondary" href="../../Register&Login/logout-user.php">Logout</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- END of Navbar Section -->

    <main class="card-section p-5">
        <div class="container-fluid p-5">

            <h1 class="text-center pt-5">Edit Category</h1>

            <?php

            $message = $_GET['errorMsg'] ?? '';

            echo $message;

            ?>

            <div class="container w-50 p-5">

                <form action="./editCategoryScript.php" method="POST" id="category-form">
                    <input type="hidden" hidden name="category_id" value="<?= $categoryEdit['id'] ?>">

                    <div class="formGroup">
                        <label for="category_input">Desired category</label>
                        <input type="text" class="form-control" id="category_input" name="category_input" placeholder="Enter desired category" value=" <?= $categoryEdit['category_type'] ?>">
                    </div>

                    <div class="formGroup text-center">
                        <button type="submit" name="submit" class="btn btn-primary">Edit Category</button>
                    </div>

                    <?php if ($isDeleted) : ?>
                        <p class="text-danger text-center m-0">This category is deleted!</p>
                        <div class=" justify-content-center text-center mb-3 align-items-center d-flex flex-row">
                            <label class="form-check-label text-danger mx-2" for="delete-check">To undelete <i class="fa fa-arrow-right"></i></label>
                            <input class="form-check-input text-center me-2" type="checkbox" id="undelete-check" name="undelete-category" value="becomeUndeleted">

                        </div>
                    <?php endif; ?>

                </form>
            </div>
            <hr>

            <div class="group text-center p-5">
                <a href="./category.php" class="btn btn-primary">Back to Categories</a>
                <a href="../adminDashboard.php" class="btn btn-warning">Back to Dashboard</a>
            </div>
        </div>
    </main>

    <!-- Components Include -->
    <!-- Footer Section file include -->
    <?php require_once('../../Public/components/footer.php'); ?>

    <!-- JS file for Validation of Category Inputs -->
    <script src="../../Assets/js/categoryInputs.js"></script>

</body>

</html>