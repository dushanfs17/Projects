<?php

// Start session
session_start();

// Check if user is logged in
if (($_SESSION['user_type'] !== 'admin')) {
    header("Location: ../index.php");
    die();
}

// Get admin username
$adminUsername = $_SESSION['username'];

// Database connection
require_once(__DIR__ . '../../../Database/Connection.php');

// Include database connection
use Database\Connection as Connection;

// Get authors
$connectionObj = new Connection();
$connection = $connectionObj->getConnection();

$statement = $connection->prepare('SELECT * FROM author');
$statement->execute();
$authors = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Brainster Library is an online platform designed to let users share their thoughts on the books they are reading by leaving private or public comments. The platform allows users to revisit their notes anytime, offering a personalized space for reflection and discussion." />
    <meta name="author" content="Dushan Hadji-Vasilev" />
    <title>Authors - Brainster Library</title>

    <!-- Local CSS Imported -->
    <link rel="stylesheet" href="../../Assets/css/style.css">
    <!-- Font Awesome Kit Imported -->
    <script src="https://kit.fontawesome.com/b5fa556884.js" crossorigin="anonymous"></script>
    <!-- Latest and minified Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- SweetAlert Library Imported -->
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

    <!-- Main Section for Handling Authors -->
    <main class="card-section">
        <div class=" container-fluid text-center">
            <h1 class="p-5">Authors</h1>
            <?php
            $message = $_GET['msg'] ?? '';
            ?>
            <span class="text-danger"><?= $message ?></span>

            <div class="table-responsive">
                <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Short Biography</th>
                            <th scope="col">Deleted at</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($authors as $author) : ?>
                            <tr>
                                <th scope="row"><?= $author['id'] ?></th>
                                <td><?= htmlspecialchars($author['first_name']) ?></td>
                                <td><?= htmlspecialchars($author['last_name']) ?></td>
                                <td><?= htmlspecialchars($author['short_bio']) ?></td>
                                <td><?= htmlspecialchars($author['deleted_at']) ?></td>
                                <td class="d-flex justify-content-center">
                                    <form action="./adminDeleteAuthor.php" method="POST" class="p-2 delete-form" data-author-id="<?= $author['id'] ?>">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="author_id" value="<?= $author['id'] ?>">
                                        <button type="submit" class="btn btn-danger mx-1 delete-button">Delete</button>
                                    </form>
                                    <a href="./adminEditAuthor.php?id=<?= $author['id'] ?>" class="btn btn-warning mx-1">Edit</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- End of Main Section -->

            <!-- Buttons for handling authors and to Go Back to Dashboard -->
            <a href="./add-author.php" class="btn btn-primary mb-5">Add author</a>
            <a href="../adminDashboard.php" class="btn btn-warning mb-5">Back to Dashboard</a>

        </div>
    </main>

    <!-- Components Include -->
    <!-- Footer Section file include -->
    <?php require_once('../../Public/components/footer.php'); ?>

    <!-- Included JS file for Confirm Delete -->
    <script src="../../Assets/js/confirmDelete.js"></script>

</body>

</html>