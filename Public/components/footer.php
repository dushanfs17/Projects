<!-- PHP Logic for Dynamically in accordance to current route -->
<?php

$currentRoute = $_SERVER['REQUEST_URI'];

if (
    strpos($currentRoute, 'login-user.php') !== false ||
    strpos($currentRoute, 'register-user.php') !== false ||
    strpos($currentRoute, 'adminDashboard.php') !== false
) {
    $scriptSrc = '../Assets/js/fetchQuote.js';
} elseif (
    strpos($currentRoute, 'add-author.php') !== false ||
    strpos($currentRoute, 'author.php') !== false ||
    strpos($currentRoute, 'adminEditAuthor.php') !== false ||
    strpos($currentRoute, 'add-book.php') !== false ||
    strpos($currentRoute, 'book.php') !== false ||
    strpos($currentRoute, 'adminEditBook.php') !== false ||
    strpos($currentRoute, 'category.php') !== false ||
    strpos($currentRoute, 'add-category.php') !== false ||
    strpos($currentRoute, 'adminEditCategory.php') !== false ||
    strpos($currentRoute, 'comment.php') !== false
) {
    $scriptSrc = '../../Assets/js/fetchQuote.js';
} else {
    $scriptSrc = './Assets/js/fetchQuote.js';
}

?>
<script src="<?= $scriptSrc ?>" defer></script>


<!-- Footer Section UI -->
<footer>
    <div class="quote text-center p-2 m-0 h6 text-secondary bg-light">
        <small class="text-end">
            <cite id="quote" class="mb-3"></cite>
        </small>
        <p>Made with ❤️ by Dushan Hadji-Vasilev</p>
        <p>&copy; <?= date('Y') ?> Brainster &#128213 Library</p>
    </div>
</footer>