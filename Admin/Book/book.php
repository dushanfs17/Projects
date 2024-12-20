<?php

session_start();
if (($_SESSION['user_type'] !== 'admin')) {
    header("Location: ../index.php");
    die();
}

$adminUsername = $_SESSION['username'];

require_once(__DIR__ . '../../../Database/Connection.php');

use Database\Connection as Connection;

$connectionObj = new Connection();
$connection = $connectionObj->getConnection();

$statement = $connection->prepare('SELECT
      book.id,
      book.book_title,
      book.book_publish_year,
      book.book_pages,
      book.book_image,
      author.first_name AS author_first_name,
      author.last_name AS author_last_name,
      category.category_type
    FROM
      book
    JOIN
      author ON book.author_id = author.id
    JOIN
      category ON book.category_id = category.id');
$statement->execute();
$books = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Brainster Library is an online platform designed to let users share their thoughts on the books they are reading by leaving private or public comments. The platform allows users to revisit their notes anytime, offering a personalized space for reflection and discussion." />
    <meta name="author" content="Dushan Hadji-Vasilev" />
    <title>Book - Brainster Library</title>

    <!-- Local CSS -->
    <link rel="stylesheet" href="../../Assets/css/style.css">
    <!-- Font Awesome Kit -->
    <script src="https://kit.fontawesome.com/b5fa556884.js" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified CSS -->
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

    <!-- Main Section for Books Actions -->
    <main class="card-section p-5">
        <div class="container-fluid text-center p-5">

            <h1 class="pb-5">Books</h1>

            <?php $message = $_GET['msg'] ?? ''; ?>

            <span class="text-danger"><?= $message ?></span>

            <div class="table-responsive">
                <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Book Title</th>
                            <th scope="col">Book Publish Year</th>
                            <th scope="col">Book Pages</th>
                            <th scope="col">Book Thumbnail</th>
                            <th scope="col">Book Author</th>
                            <th scope="col">Book Category</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($books as $book) : ?>
                            <tr>
                                <th scope="row"><?= $book['id'] ?></th>
                                <td><?= htmlspecialchars($book['book_title']) ?></td>
                                <td><?= htmlspecialchars($book['book_publish_year']) ?></td>
                                <td><?= htmlspecialchars($book['book_pages']) ?></td>
                                <td><?= htmlspecialchars($book['book_image']) ?></td>
                                <td><?= htmlspecialchars($book['author_first_name'] . ' ' . $book['author_last_name']) ?></td>
                                <td><?= htmlspecialchars($book['category_type']) ?></td>
                                <td class="d-flex justify-content-center">
                                    <form action="./adminDeleteBook.php" method="POST" class="p-2 delete-form" data-book-id="<?= $book['id'] ?>">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="book_id" value="<?= $book['id'] ?>">
                                        <input type="hidden" value="<?= $book['book_title']; ?>" name="book_title">
                                        <button type="submit" class="btn btn-danger mx-1 delete-button">Delete</button>
                                    </form>
                                    <a href="./adminEditBook.php?id=<?= $book['id'] ?>" class="btn btn-warning m-0">Edit</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Buttons for handling Books -->
            <a href="./add-book.php" class="btn btn-primary">Add book</a>
            <a href="../adminDashboard.php" class="btn btn-warning">Back to Dashboard</a>
        </div>
    </main>
    <!-- END of Main Section -->

    <!-- Components Include -->
    <!-- Footer Section file include -->
    <?php require_once('../../Public/components/footer.php'); ?>

    <!-- Internal JS file included -->
    <!-- Confirm Delete JS file -->
    <script src="../../Assets/js/confirmDelete.js"></script>

</body>

</html>