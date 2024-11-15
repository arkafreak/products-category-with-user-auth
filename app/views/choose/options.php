<?php

// Check if the user is logged in
if (!isset($_SESSION['role'])) {
    // Redirect to login if not logged in
    header('Location: ' . URLROOT . '/login');
    exit;
}
// Define the user's name
$userName = isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : 'User';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/choose_style.css">
    <title>Home Page</title>
</head>

<body>
    <h1>Hey <?php echo $userName; ?>, Welcome to the Shop</h1>

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
        }, 10000);
    </script>
</body>

</html>