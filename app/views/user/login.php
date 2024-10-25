<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <h1>Login</h1>
    <form action="<?php echo URLROOT; ?>/UserController/login" method="POST">
        <input type="email" name="email" placeholder="Enter Email" required><br><br>
        <input type="password" name="password" placeholder="Enter Password" required><br>
        <br>
        <button type="submit">Login</button>
    </form>
    <br>
    <a href="<?php echo URLROOT; ?>/UserController/register">Don't have an account? Register here</a>
</body>

</html>
