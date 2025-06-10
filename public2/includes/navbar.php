<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const navLinks = document.querySelector('.nav-links');
        const hamburger = document.querySelector('.hamburger');

        hamburger.addEventListener('click', (e) => {
            e.stopPropagation();
            navLinks.classList.toggle('show-links');
        });
    });
</script>


<nav class="navbar">
    <div class="logo">K</div>
    <div class = "hamburger">
        <img src="/klarity/public2/assets/menu.svg" width="40px" height="40px">

    </div>
    <ul class="nav-links">
        <li> <a href="/klarity/bin/feed.php"> Feed </a> </li>
        <li><a href="/klarity/bin/views/posts/create_post.php"> Questions</a> </li>
    </ul>

    <div class="search-container">
        <form action="/klarity/bin/feed.php" method="get" style="display:inline;">
            <input type="text" name="search" placeholder="Search posts...">
            <button type="submit">SEARCH</button>
        </form>
    </div>


    <div class="account-icon">
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="/klarity/bin/handlers/logout_handler.php" class="logout-button">Logout</a>
        <?php else: ?>
            <a href="/klarity/login.php" class="login-link">Login</a>
            <a href="/klarity/register.php" class="register-link">Register</a>
        <?php endif; ?>
    </div>
</nav>