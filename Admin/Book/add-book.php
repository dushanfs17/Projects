<?php

session_start();

require_once(__DIR__ . '../../../Database/Connection.php');

use Database\Connection as Connection;

if (($_SESSION['user_type'] !== 'admin')) {
    header("Location: ../index.php");
    die();
}

$adminUsername = $_SESSION['username'];

$connectionObj = new Connection();
$connection = $connectionObj->getConnection();

$statement = $connection->prepare('SELECT * FROM author WHERE deleted_at IS NULL');
$statement->execute();
$authors = $statement->fetchAll(PDO::FETCH_ASSOC);


$statement = $connection->prepare('SELECT * FROM category WHERE deleted_at IS NULL');
$statement->execute();
$categories = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Brainster Library is an online platform designed to let users share their thoughts on the books they are reading by leaving private or public comments. The platform allows users to revisit their notes anytime, offering a personalized space for reflection and discussion." />
    <meta name="author" content="Dushan Hadji-Vasilev" />
    <title>Add Book - Brainster Library</title>

    <!-- Local CSS -->
    <link rel="stylesheet" href="../../Assets/css/style.css">
    <!-- Font Awesome Kit -->
    <script src="https://kit.fontawesome.com/b5fa556884.js" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Sweet Alert Library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <!-- Navbar Section -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-light">
        <div class="container-fluid">
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

    <main class="card-section">
        <div class="container-fluid">

            <h1 class="p-5 text-center">Add Book</h1>

            <?php

            $message = $_GET['errorMsg'] ?? '';

            echo $message;

            ?>

            <div class="container w-50">
                <form action="./add-bookScript.php" method="POST" id="book-form">

                    <div class="formGroup">
                        <label for="book_title">Book title</label>
                        <input type="text" class="form-control" id="book_title" name="book_title" placeholder="Enter book title">
                    </div>

                    <div class="formGroup">
                        <label for="book_publish_year">Book publish year</label>
                        <input type="text" class="form-control" id="book_publish_year" name="book_publish_year" placeholder="Enter book's publish year">

                    </div>

                    <div class="formGroup">
                        <label for="book_pages">Book number of pages</label>
                        <input type="text" class="form-control" id="book_pages" name="book_pages" placeholder="Enter book's number of pages">
                    </div>

                    <div class="formGroup">
                        <label for="book_image">Book thumbnail</label>
                        <input type="text" class="form-control" id="book_image" name="book_image" placeholder="Enter book's thumbnail">
                    </div>

                    <div class="formGroup">
                        <label for="book_author">Book Author</label>
                        <select class="form-select form-select" id="book_author" name="book_author">
                            <option value="" hidden>Select an author</option>
                            <?php foreach ($authors as $author) : ?>

                                <option value="<?= $author['id'] ?>"><?= $author['first_name'] . " " . $author['last_name'] ?></option>

                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="formGroup">
                        <label for="book_category">Book Category</label>
                        <select class="form-select form-select" id="book_category" name="book_category">
                            <option value="" hidden>Select a category</option>
                            <?php foreach ($categories as $category) : ?>

                                <option value="<?= $category['id'] ?>"><?= $category['category_type'] ?></option>

                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="formGroup text-center">
                        <button type="submit" name="submit" class="btn btn-primary">Add Book</button>
                    </div>

                </form>
            </div>
            <hr>
            <div class="group text-center mb-5">
                <a href="./book.php" class="btn btn-primary">Back to Books</a>
                <a href="../adminDashboard.php" class="btn btn-warning">Back to Dashboard</a>
            </div>


        </div>
    </main>

    <!-- Components Include -->
    <!-- Footer Section file include -->
    <?php require_once('../../Public/components/footer.php'); ?>

    <!-- JS file for Validation of Inputs -->
    <script src="../../Assets/js/bookInputs.js"></script>
    <script src="../../Assets/js/authorInputs.js"></script>
</body>

</html>