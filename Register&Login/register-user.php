<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Brainster Library is an online platform designed to let users share their thoughts on the books they are reading by leaving private or public comments. The platform allows users to revisit their notes anytime, offering a personalized space for reflection and discussion." />
    <meta name="author" content="Dushan Hadji-Vasilev" />

    <title>Register - Brainster Library</title>

    <!-- Local CSS -->
    <link rel="stylesheet" href="../Assets/css/style.css">
    <!-- Font Awesome Kit -->
    <script src="https://kit.fontawesome.com/b5fa556884.js" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Sweet Alert Library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <!-- Navbar Section -->
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand text-secondary" href="../index.php">
                <img src='https://i.postimg.cc/zyG6QcWF/Brainster-co.png' border='0' width="90" alt='Brainster-co' />
            </a>
            <button class="navbar-toggler bg-secondary
            " type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarNavAltMarkup">
                <!-- Handle Navigation -->
                <div class="navbar-nav text-end">
                    <a class="nav-link text-secondary" href="../index.php">Home</a>
                    <a class="nav-link text-secondary" href="./login-user.php">Login</a>
                    <a class="nav-link text-secondary" href="./register-user.php" hidden>Register</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- REGISTER SECTION -->

    <main class="register-section" style="background-color: #ccc; height: 90vh;">
        <div class="container-fluid">
            <div class="container opacity-container mb-5" style="width: 40%">

                <form action="./registerScript.php" method="POST">
                    <h2 class="text-center">Register</h2>

                    <?php

                    $errorMsg = $_GET['errorMsg'] ?? '';

                    ?>

                    <span class="text-danger text-center">
                        <?= $errorMsg ?>
                    </span>

                    <div class="formGroup">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username">
                        <div class="error-message" id="username-error"></div>
                    </div>

                    <div class="formGroup">
                        <label for="email">Your Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email">
                        <div class="error-message" id="email-error"></div>

                    </div>

                    <div class="formGroup">
                        <label for="password">Your password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                        <div class="error-message" id="password-error"></div>
                    </div>

                    <div class="formGroup text-center">
                        <button id="register-btn" type="submit" class="btn btn-primary">Submit</button>

                    </div>

                </form>
                <div class="formGroup text-center mt-5">
                    <h6>Already a user?</h6>
                    <a href="./login-user.php" class="btn btn-success">Log In!</a>

                </div>
            </div>

        </div>
    </main>

    <!-- FOOTER -->
    <?php require_once('../Public/components/footer.php'); ?>

    <script src="../Assets/js/register-user.js"></script>

</body>

</html>