<?php ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Form</title>
    <link rel="stylesheet" href="/klarity/public2/styles/base.css" />
    <link rel="stylesheet" href="/klarity/public2/styles/auth.css" />


</head>
<body>
<div class="main-wrapper">

    <div class="welcome-label">
        <h1>Welcome to Klarity.</h1>
        <p>Klarity: The Q&A platform built for university learners and aspiring devs to learn, share, and grow together. Get the answers you need, faster.</p>
    </div>

    <div class="container">
        <div class="login-box">
            <h2>Login Form</h2>
            <div class="toggle-btn">
                <button id="loginToggle" class="active">Login</button>
                <button id="signupToggle">Signup</button>
            </div>


            <div id="formContainer">

                <form id="loginForm" class="visible" method="post" action="/klarity/bin/handlers/login_handler.php">
                    <input type = "text"  name="username" placeholder="Enter your username" required />
                    <input type ="password" name ="password" placeholder="Password" required />
                    <a href="#" class="forgot">Forgot password?</a>
                    <button type="submit" class="login-btn">Login</button>
                </form>

                <form id="signupForm" class="hidden" action="/klarity/bin/handlers/register_handler.php" method="post">
                    <input type="text" placeholder="Username" name="username" required />
                    <input type="email" placeholder="Email" name="email" required />
                    <input type="password" placeholder="Password" id="password"  name="password" required />
                    <input type="password" placeholder="Confirm Password" id = "confirm-password" required />
                    <button type="submit" class="login-btn" id="signupSubmit">Signup</button>
                    <div id="signupMessage"></div> </form>
            </div>

        </div>
    </div>
</div>

<script src = '/klarity/public2/scripts/auth.js'></script>
</body>
</html>
