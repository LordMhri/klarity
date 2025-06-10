<!--<link rel="stylesheet" href="/public2/styles/navbar.css">-->

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
        <li><a href="/klarity/bin/create_post.php"> Questions</a> </li>
    </ul>
    <div class="search-container">
        <input type="text">
        <button type="submit">SEARCH </button>
    </div>
    <div class = 'account-icon'>
        <img src="/klarity/public2/assets/account.svg" height="40px" width="40px">
    </div>
</nav>