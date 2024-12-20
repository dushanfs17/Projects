<?php

session_start();
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

    <title>Admin Dashboard - Brainster Library</title>

    <!-- Local CSS -->
    <link rel="stylesheet" href="../Assets/css/style.css">
    <!-- Font Awesome Kit -->
    <script src="https://kit.fontawesome.com/b5fa556884.js" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        .adminCard {
            background-color: #ccc;
            padding: 10px;
            margin: 10px;
            border-radius: 5px;
        }

        a {
            text-decoration: none;
        }

        .adminCard:hover {
            background-color: #c7c7c7;
            padding: 15px;
            cursor: pointer;
        }

        .groupOne a,
        .groupTwo a {
            text-decoration: none;
        }

        .groupOne i,
        .groupTwo i {
            font-size: 1.3rem;
            margin-right: 6px;
        }
    </style>
</head>

<body class="bg-dark">

    <!-- Navbar Section -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-light">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand text-secondary" href="../index.php">
                <img src='https://i.postimg.cc/QMwtf1vQ/Designer-2.png' border='0' width=" 90" alt='Brainster-co' />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <!-- Handle Navigation -->
                <div class="navbar-nav ms-auto">
                    <a class="nav-link text-secondary" href="../index.php">Home</a>
                    <span class="text-secondary nav-item mt-2">Welcome, <?= $adminUsername ?> </span>
                    <a class="nav-link text-secondary" href="../Register&Login/logout-user.php">Logout</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- End of Navbar Section -->

    <!-- CARD SECTION -->
    <main class="card-section" style="height: 90vh; background-color: #ccc;">
        <div class="container-fluid background-main mb-5">
            <div class="container opacity-container mb-5 p-4">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <a href="Book/book.php" class="text-dark">
                            <div class="adminCard" style="width: 100%;">
                                <div class="card-body">
                                    <h5 class="card-title">Manage</h5>
                                    <h6 class="card-subtitle mb-2 text-muted"><i class="fa fa-book"></i>&nbsp;Books</h6>
                                    <p class="card-text">In this section, Admin can manage the Books on the platform.</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <a href="Author/author.php" class="text-dark">
                            <div class="adminCard" style="width: 100%;">
                                <div class="card-body">
                                    <h5 class="card-title">Manage</h5>
                                    <h6 class="card-subtitle mb-2 text-muted"><i class="fa fa-user"></i>&nbsp;Authors</h6>
                                    <p class="card-text">In this section, Admin can manage the Authors on the platform.</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <a href="Category/category.php" class="text-dark">
                            <div class="adminCard" style="width: 100%;">
                                <div class="card-body">
                                    <h5 class="card-title">Manage</h5>
                                    <h6 class="card-subtitle mb-2 text-muted"><i class="fa fa-list"></i>&nbsp;Categories</h6>
                                    <p class="card-text">In this section, Admin can manage the Categories on the platform.</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 mb-4">
                        <a href="Comment/comment.php" class="text-dark">
                            <div class="adminCard" style="width: 100%;">
                                <div class="card-body">
                                    <h5 class="card-title">Manage</h5>
                                    <h6 class="card-subtitle mb-2 text-muted"><i class="fa fa-comment"></i>&nbsp;Comments</h6>
                                    <p class="card-text">In this section, Admin can manage the Comments on the platform.</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Components Include -->
    <!-- Footer Section file include -->
    <?php require_once('../Public/components/footer.php'); ?>

    <!-- Bootstrap JS file include -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+2Wm18uC/Jp7rf6if9VTAWu3r4VYI" crossorigin="anonymous"></script>
</body>

</html>