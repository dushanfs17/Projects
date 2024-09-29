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

$statement = $connection->prepare('SELECT * FROM author WHERE id = :id');
$statement->execute(['id' => $id]);
$authorEdit = $statement->fetch(PDO::FETCH_ASSOC);

// var_dump($authorEdit);

$deletedDate = $authorEdit['deleted_at'];


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
    <title>Edit Author - Brainster Library</title>

    <!-- Local CSS -->
    <link rel="stylesheet" href="../../Assets/css/style.css">
    <!-- Font Awesome Kit -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Sweet Alert Library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="bg-dark">

    <!-- Navbar Section -->
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand text-secondary" href="../../index.php">
                <img src='https://i.postimg.cc/zyG6QcWF/Brainster-co.png' border='0' width="90" alt='Brainster-co' />
            </a>
            <button class="navbar-toggler bg-secondary
            " type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">

                    <a class="nav-link text-secondary" href="../../index.php">Home</a>
                    <span class="text-secondary mt-2">Welcome, <?= $adminUsername ?> </span>
                    <a class="nav-link text-secondary" href="../../Register&Login/logout-user.php">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="card-section" style="background-color: #ccc; height: 90vh;">
        <div class="container-fluid">

            <h1 class="p-5 text-center">Edit Author</h1>
            <?php

            $message = $_GET['errorMsg'] ?? '';

            echo $message;

            ?>

            <div class="container" style="width: 40%">
                <form action="./editAuthorScript.php" method="POST" id="author-form">
                    <input type="hidden" hidden name="author_id" value="<?= $authorEdit['id'] ?>">

                    <div class="formGroup">
                        <label for="author_first_name">Author first name</label>
                        <input type="text" class="form-control" id="author_first_name" name="author_first_name" placeholder="Enter authors first name" value=" <?= $authorEdit['first_name'] ?> ">
                    </div>

                    <div class="formGroup">
                        <label for="author_last_name">Author last name</label>
                        <input type="text" class="form-control" id="author_last_name" name="author_last_name" placeholder="Enter authors last name" value=" <?= $authorEdit['last_name'] ?> ">

                    </div>

                    <div class="formGroup">
                        <label for="author_biography">Short biography</label>
                        <textarea class="form-control w-100 m-0 text-center fs-5" id="author_biography" name="author_biography" rows="2" placeholder=" <?= $authorEdit['short_bio'] ?> "> <?= $authorEdit['short_bio'] ?> </textarea>
                    </div>

                    <?php if ($isDeleted) : ?>
                        <p class="text-danger text-center m-0">This author is deleted!</p>
                        <div class=" justify-content-center text-center mb-3 align-items-center d-flex flex-row">
                            <label class="form-check-label text-danger mx-2" for="delete-check">To undelete <i class="fa fa-arrow-right"></i></label>
                            <input class="form-check-input text-center me-2" type="checkbox" id="undelete-check" name="undelete-author" value="becomeUndeleted">
                        </div>
                    <?php endif; ?>

                    <div class="formGroup text-center">
                        <button type="submit" name="submit" class="btn btn-primary">Edit Author</button>
                    </div>

                </form>
            </div>
            <hr>
            <div class="group text-center ">
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