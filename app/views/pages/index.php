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
            background-color: #f9f9f9; /* Light background for better contrast */
            text-align: center; /* Center align text */
        }

        h1 {
            color: #333; /* Darker text for heading */
        }

        .message {
            color: green;
            font-size: 1.2em;
            margin: 20px 0;
            padding: 10px;
            background-color: #e7f9e7; /* Light green background for message */
            border: 1px solid #c8e6c9; /* Green border */
            border-radius: 5px; /* Rounded corners */
        }

        .options {
            margin-top: 30px; /* Space above user actions */
        }

        button {
            padding: 10px 20px; /* Button padding */
            background-color: #28a745; /* Green color for buttons */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer; /* Pointer cursor on hover */
            font-size: 16px; /* Increase font size */
            margin: 0 10px; /* Margin between buttons */
            transition: background-color 0.3s; /* Transition effect */
        }

        button:hover {
            background-color: #218838; /* Darker green on hover */
        }

        /* Responsive design */
        @media (max-width: 600px) {
            button {
                width: 100%; /* Full width on smaller screens */
                margin-bottom: 10px; /* Space below buttons */
            }
        }
    </style>
</head>
<body>
    <h1>Welcome to the Shop Sign Up Page</h1>

    <!-- Logout Message -->
    <?php if (!empty($_SESSION['logoutMessage'])): ?>
        <p class="message" id="logoutMessage"><?php echo $_SESSION['logoutMessage']; ?></p>
        <?php unset($_SESSION['logoutMessage']); ?>
    <?php endif; ?>

    <!-- Navigation Buttons -->
    <div class="options">
        <h2>User Actions:</h2>
        <a href="<?php echo URLROOT; ?>/UserController/register"><button>Register</button></a>
        <a href="<?php echo URLROOT; ?>/UserController/login"><button>Login</button></a>
    </div>

    <script>
        // Hide the logout message after 3 seconds
        setTimeout(() => {
            const message = document.getElementById('logoutMessage');
            if (message) message.style.display = 'none';
        }, 3000);
    </script>

</body>

</html>