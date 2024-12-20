<?php

session_start();

require_once(__DIR__ . '../../../Database/Connection.php');

use Database\Connection as Connection;

if (($_SESSION['user_type'] !== 'admin')) {
    header("Location: ../index.php");
    die();
}

$adminUsername = $_SESSION['username'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Brainster Library is an online platform designed to let users share their thoughts on the books they are reading by leaving private or public comments. The platform allows users to revisit their notes anytime, offering a personalized space for reflection and discussion." />
    <meta name="author" content="Dushan Hadji-Vasilev" />
    <title>Authors - Brainster Library</title>

    <!-- Local CSS -->
    <link rel="stylesheet" href="../../Assets/css/style.css">
    <!-- Font Awesome Kit -->
    <script src="https://kit.fontawesome.com/b5fa556884.js" crossorigin="anonymous"></script>rel="stylesheet">
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
                <img src='https://i.postimg.cc/QMwtf1vQ/Designer-2.png' border='0' width="90" alt='Brainster-co' />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link text-secondary" href="../../index.php">Home</a>
                    <span class="text-secondary nav-item mt-2">Welcome, <?= $adminUsername ?> </span>
                    <a class="nav-link text-secondary" href="../../Register&Login/logout-user.php">Logout</a>
                </div>
            </div>
        </div>
    </nav>


    <main class="card-section p-5">
        <div class="container-fluid text-center p-5">

            <h1 class="pb-5">Add Author</h1>

            <?php

            $message = $_GET['errorMsg'] ?? '';

            echo $message;

            ?>

            <div class="container">
                <form action="./add-authorScript.php" method="POST" id="author-form">

                    <div class="formGroup">
                        <label for="author_first_name">Author first name</label>
                        <input type="text" class="form-control" id="author_first_name" name="author_first_name" placeholder="Enter authors first name">
                    </div>

                    <div class="formGroup">
                        <label for="author_last_name">Author last name</label>
                        <input type="text" class="form-control" id="author_last_name" name="author_last_name" placeholder="Enter authors last name">

                    </div>

                    <div class="formGroup">
                        <label for="author_biography">Short biography</label>
                        <textarea class="form-control w-100 m-0 fs-6" id="author_biography"
                            name="author_biography" placeholder="Enter short biography" rows="2"></textarea>
                    </div>

                    <div class="formGroup text-center">
                        <button type="submit" name="submit" class="btn btn-primary">Add Author</button>
                    </div>

                </form>
            </div>

            <hr>

            <div class="group text-center">
                <a href="./author.php" class="btn btn-primary">Back to Authors</a>
                <a href="../adminDashboard.php" class="btn btn-warning">Back to Dashboard</a>
            </div>


        </div>
    </main>

    <!-- Components Include -->
    <!-- Footer Section file include -->
    <?php require_once('../../Public/components/footer.php'); ?>

    <!-- JS file for Validation of Inputs -->
    <script src="../../Assets/js/authorInputs.js"></script>


</body>

</html>