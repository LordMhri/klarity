<style rel="stylesheet" href = "../styles/navbar.css"></style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const navLinks  = document.querySelector('.nav-links');
        const hamburger = document.querySelector('.hamburger');

        hamburger.addEventListener('click', () => {
            navLinks.classList.toggle('show-links');
        });
    });
</script>


<nav class="navbar">
    <div class="logo">K</div>
    <div class = "hamburger">
        &#9660;
    </div>
    <ul class="nav-links">
        <li><a href="#">Feed</a></li>
        <li><a href="#">Questions</a></li>
        <li><a href="#">Ideas</a></li>
        <li><a href="#">Tags</a></li>
        <li><a href="#">Users</a></li>
    </ul>
    <div class="search-container">
        <input type="text">
        <button type="submit">SEARCH </button>
    </div>
    <div class = 'account-icon'>
        ICON
    </div>
</nav>