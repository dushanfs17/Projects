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

$statement = $connection->prepare('SELECT * FROM author');
$statement->execute();
$authors = $statement->fetchAll(PDO::FETCH_ASSOC);


$statement = $connection->prepare('SELECT * FROM category');
$statement->execute();
$categories = $statement->fetchAll(PDO::FETCH_ASSOC);

$bookId = $_GET['id'];

$statement = $connection->prepare('SELECT
    book.id,
    book.book_title,
    book.book_publish_year,
    book.book_pages,
    book.book_image,
    author.id AS author_id,
    author.first_name AS author_first_name,
    author.last_name AS author_last_name,
    category.id AS category_id,
    category.category_type
FROM
    book
JOIN
    author ON book.author_id = author.id
JOIN
    category ON book.category_id = category.id
WHERE
    book.id = :id');
$statement->bindParam(':id', $bookId, PDO::PARAM_INT);
$statement->execute();
$bookEdit = $statement->fetch(PDO::FETCH_ASSOC);

$bookId = $bookEdit['id'];
$bookTitle = $bookEdit['book_title'];
$publishYear = $bookEdit['book_publish_year'];
$numberOfPages = $bookEdit['book_pages'];
$bookImage = $bookEdit['book_image'];
$authorId = $bookEdit['author_id'];
$authorFullName = $bookEdit['author_first_name'] . " " . $bookEdit['author_last_name'];
$categoryId = $bookEdit['category_id'];
$categoryTitle = $bookEdit['category_type'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Brainster Library is an online platform designed to let users share their thoughts on the books they are reading by leaving private or public comments. The platform allows users to revisit their notes anytime, offering a personalized space for reflection and discussion." />
    <meta name="author" content="Dushan Hadji-Vasilev" />

    <title>Edit Book - Brainster Library</title>

    <!-- Local CSS -->
    <link rel="stylesheet" href="../../Assets/css/style.css">
    <!-- Font Awesome Kit -->
    <script src="https://kit.fontawesome.com/b5fa556884.js" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Sweet Alert Library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="bg-dark">

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

            <h1 class="p-5 text-center">Edit Book</h1>

            <?php

            $message = $_GET['errorMsg'] ?? '';

            echo $message;

            ?>

            <div class="container" style="width: 40%">
                <form action="./editBookScript.php" method="POST" id="book-form">
                    <input type="hidden" hidden name="book_id" value="<?= $bookEdit['id'] ?>">

                    <div class="formGroup">
                        <label for="book_title">Book title</label>
                        <input type="text" class="form-control" id="book_title" name="book_title" placeholder="Enter book title" value="<?= $bookEdit['book_title'] ?>">
                    </div>

                    <div class="formGroup">
                        <label for="book_publish_year">Book publish year</label>
                        <input type="text" class="form-control" id="book_publish_year" name="book_publish_year" placeholder="Enter book's publish year" value=" <?= $bookEdit['book_publish_year'] ?> ">

                    </div>

                    <div class="formGroup">
                        <label for="book_pages">Book number of pages</label>
                        <input type="text" class="form-control" id="book_pages" name="book_pages" placeholder="Enter book's number of pages" value="<?= $bookEdit['book_pages'] ?>">
                    </div>

                    <div class="formGroup">
                        <label for="book_image">Book thumbnail</label>
                        <input type="text" class="form-control" id="book_image" name="book_image" placeholder="Enter book's thumbnail" value="<?= $bookEdit['book_image'] ?>">
                    </div>

                    <div class="formGroup">
                        <label for="book_author">Book Author</label>
                        <select class="form-select form-select" id="book_author" name="book_author">
                            <option value="" hidden>Select an author</option>
                            <?php foreach ($authors as $author) : $view = ($author['id'] == $authorId) ? "selected" : ""; ?>

                                <option <?= $view; ?> value="<?= $author['id'] ?>"><?= $author['first_name'] . " " . $author['last_name'] ?></option>

                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="formGroup">
                        <label for="book_category">Book Category</label>
                        <select class="form-select form-select" id="book_category" name="book_category">
                            <option value="" hidden>Select a category</option>
                            <?php foreach ($categories as $category) : $view = ($category['id'] == $categoryId) ? "selected" : ""; ?>

                                <option <?= $view; ?> value="<?= $category['id'] ?>"><?= $category['category_type']; ?></option>

                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="formGroup text-center">
                        <button type="submit" name="submit" class="btn btn-primary">Edit Book</button>
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
    <script src="../../Assets/js/authorInputs.js"></script>

</body>

</html>