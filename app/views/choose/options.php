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
    <title>Home Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
            /* Light background for better contrast */
            text-align: center;
            /* Center align text */
        }

        h1 {
            color: #333;
            /* Darker text for heading */
            margin-bottom: 20px;
            /* Space below heading */
        }

        .message {
            color: green;
            font-size: 1.2em;
            margin: 20px 0;
            padding: 10px;
            background-color: #e7f9e7;
            /* Light green background for message */
            border: 1px solid #c8e6c9;
            /* Green border */
            border-radius: 5px;
            /* Rounded corners */
        }

        .options {
            margin-top: 30px;
            /* Space above user actions */
        }

        button {
            padding: 10px 20px;
            /* Button padding */
            background-color: #28a745;
            /* Green color for buttons */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            /* Pointer cursor on hover */
            font-size: 16px;
            /* Increase font size */
            margin: 0 10px;
            /* Margin between buttons */
            transition: background-color 0.3s;
            /* Transition effect */
        }

        button:hover {
            background-color: #218838;
            /* Darker green on hover */
        }

        /* Responsive design */
        @media (max-width: 600px) {
            button {
                width: 100%;
                /* Full width on smaller screens */
                margin-bottom: 10px;
                /* Space below buttons */
            }
        }
    </style>
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