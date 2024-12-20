<?php

require_once(__DIR__ . '../../../Database/Connection.php');

use Database\Connection as Connection;

session_start();
if (($_SESSION['user_type'] !== 'admin')) {
    header("Location: ../index.php");
    die();
}

$adminUsername = $_SESSION['username'];

$connectionObj = new Connection();
$connection = $connectionObj->getConnection();

$statement = $connection->prepare("SELECT
      comments.id,
      comments.text,
      comments.user_id AS comment_user_id,
      comments.book_id AS comment_book_id,
      comments.admin_verified,
      comments.in_queue,
      registered_users.username,
      book.book_title
    FROM
      comments
    JOIN
      book ON comments.book_id = book.id
    JOIN
      registered_users ON comments.user_id = registered_users.id
    ORDER BY
      comments.id");
$statement->execute();
$comments = $statement->fetchAll(PDO::FETCH_ASSOC);

$counter = 1;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Brainster Library is an online platform designed to let users share their thoughts on the books they are reading by leaving private or public comments. The platform allows users to revisit their notes anytime, offering a personalized space for reflection and discussion." />
    <meta name="author" content="Dushan Hadji-Vasilev" />
    <title>Comments - Brainster Library</title>

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
            <!-- Logo -->
            <a class="navbar-brand text-secondary" href="../../index.php">
                <img src='https://i.postimg.cc/QMwtf1vQ/Designer-2.png' border='0' width="90" alt='Brainster-co' />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <!-- Handle Navigation -->
                <div class="navbar-nav ms-auto">
                    <a class="nav-link text-secondary" href="../../index.php">Home</a>
                    <span class="text-secondary nav-item mt-2">Welcome, <?= $adminUsername ?> </span>
                    <a class="nav-link text-secondary" href="../../Register&Login/logout-user.php">Logout</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- END of Navbar Section -->

    <!-- Main Section for Book Comments -->
    <main class="card-section">
        <div class="container-fluid background-main text-center">
            <h1 class="p-5">Book Comments</h1>
            <?php
            $message = $_GET['msg'] ?? '';
            ?>
            <span class="text-danger"><?= $message ?></span>

            <?php $counter = 1; ?>

            <h5>Queued Comments</h5>
            <div class="table-responsive">
                <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Text</th>
                            <th scope="col">User</th>
                            <th scope="col">Book Title</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($comments as $comment) : $status = $comment['admin_verified'];
                            $inQueue = $comment['in_queue']; ?>
                            <?php if (!$status && $inQueue) : ?>
                                <tr>
                                    <th scope="row"><?php echo $counter;
                                                    $counter++; ?></th>
                                    <td><?= $comment['text']; ?></td>
                                    <td><?= $comment['username']; ?></td>
                                    <td><?= $comment['book_title']; ?></td>
                                    <td class="text-warning"><?php if ($status) {
                                                                    echo 'Approved';
                                                                } else {
                                                                    echo 'In queue';
                                                                } ?></td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <form action="./adminApproveComment.php" method="POST" class="mb-2 d-flex justify-content-center">
                                                <input type="hidden" value="<?= $comment['comment_user_id']; ?>" name="user_id">
                                                <input type="hidden" value="<?= $comment['comment_book_id']; ?>" name="book_id">
                                                <button class="btn btn-success w-75">Approve</button>
                                            </form>
                                            <form action="./adminRejectComment.php" method="POST" class="d-flex justify-content-center" onsubmit="return confirmDelete(event);">
                                                <input type="hidden" value="<?= $comment['comment_user_id']; ?>" name="user_id">
                                                <input type="hidden" value="<?= $comment['comment_book_id']; ?>" name="book_id">
                                                <button class="btn btn-danger w-75">Reject</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <hr>

            <h5>Approved Comments by Admin</h5>
            <div class="table-responsive">
                <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Text</th>
                            <th scope="col">User</th>
                            <th scope="col">Book Title</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($comments as $comment) : $status = $comment['admin_verified'];
                            $inQueue = $comment['in_queue']; ?>
                            <?php if ($status && !$inQueue) : ?>
                                <tr>
                                    <th scope="row"><?php echo $counter;
                                                    $counter++; ?></th>
                                    <td><?= $comment['text']; ?></td>
                                    <td><?= $comment['username']; ?></td>
                                    <td><?= $comment['book_title']; ?></td>
                                    <td class="text-success"><?php if ($status) {
                                                                    echo 'Approved';
                                                                } else {
                                                                    echo 'Not approved';
                                                                } ?></td>
                                    <td>
                                        <form action="./adminRejectComment.php" method="POST" class="d-flex justify-content-center" onsubmit="return confirmDelete(event);">
                                            <input type="hidden" value="<?= $comment['comment_user_id']; ?>" name="user_id">
                                            <input type="hidden" value="<?= $comment['comment_book_id']; ?>" name="book_id">
                                            <button class="btn btn-danger w-75">Reject</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <hr>
            <?php $counter = 1; ?>

            <h5>Rejected Comments by Admin</h5>
            <div class="table-responsive">
                <table class="table table-striped text-center">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Text</th>
                            <th scope="col">User</th>
                            <th scope="col">Book Title</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($comments as $comment) : $status = $comment['admin_verified'];
                            $inQueue = $comment['in_queue']; ?>
                            <?php if (!$status && !$inQueue) : ?>
                                <tr>
                                    <th scope="row"><?php echo $counter;
                                                    $counter++; ?></th>
                                    <td><?= $comment['text']; ?></td>
                                    <td><?= $comment['username']; ?></td>
                                    <td><?= $comment['book_title']; ?></td>
                                    <td class="text-danger"><?php if ($status) {
                                                                echo 'Approved';
                                                            } else {
                                                                echo 'Not approved';
                                                            } ?></td>
                                    <td>
                                        <form action="./adminApproveComment.php" method="POST" class="d-flex justify-content-center">
                                            <input type="hidden" value="<?= $comment['comment_user_id']; ?>" name="user_id">
                                            <input type="hidden" value="<?= $comment['comment_book_id']; ?>" name="book_id">
                                            <button class="btn btn-success w-75">Approve</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <a href="../adminDashboard.php" class="btn btn-warning">Back to Dashboard</a>
        </div>
    </main>
    <!-- END of Main Section -->

    <!-- Components Include -->
    <!-- Footer Section file include -->
    <?php require_once('../../Public/components/footer.php'); ?>

    <!-- JS file for Confirmation of Delete -->
    <script src="../../confirmDelete.js"></script>
</body>

</html>