<?php

// Check if the user is logged in
if (!isset($_SESSION['role'])) {
    // Redirect to login if not logged in
    header('Location: ' . URLROOT . '/login');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <style>
        .message {
            color: green;
            font-size: 1.2em;
            margin: 20px 0;
        }
    </style>
</head>

<body>
    <h1>Welcome to the Shop</h1>

    <!-- Login Success Message -->
    <?php if (!empty($_SESSION['loginMessage'])): ?>
        <p class="message" id="loginMessage"><?php echo $_SESSION['loginMessage']; ?></p>
        <?php unset($_SESSION['loginMessage']); ?>
    <?php endif; ?>

    <!-- Navigation Buttons -->
    <div class="options">
        <h2>Choose:</h2>
        <a href="<?php echo URLROOT; ?>/products"><button>Products</button></a>
        <a href="<?php echo URLROOT; ?>/categories"><button>Categories</button></a>
    </div>

    <!-- Logout button -->
    <form action="<?php echo URLROOT; ?>/UserController/logout" method="POST" style="margin-top: 20px;">
        <button type="submit">Logout</button>
    </form>

    <script>
        // Hide the login message after 3 seconds
        setTimeout(() => {
            const message = document.getElementById('loginMessage');
            if (message) message.style.display = 'none';
        }, 3000);
    </script>
</body>

</html>
