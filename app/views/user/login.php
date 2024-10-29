<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

        form {
            display: flex;
            flex-direction: column;
            /* Stack elements vertically */
            align-items: center;
            /* Center align elements */
            max-width: 400px;
            /* Max width for the form */
            margin: 0 auto;
            /* Center the form horizontally */
            background-color: #fff;
            /* White background for the form */
            padding: 20px;
            /* Padding inside the form */
            border-radius: 8px;
            /* Rounded corners for the form */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            /* Shadow effect */
        }

        input[type="email"],
        input[type="password"],
        select {
            width: 100%;
            /* Full width inputs */
            padding: 10px;
            /* Add padding */
            margin-bottom: 15px;
            /* Space below inputs */
            border: 1px solid #ccc;
            /* Border color */
            border-radius: 5px;
            /* Rounded corners */
            font-size: 16px;
            /* Font size */
        }

        button {
            padding: 10px 20px;
            /* Button padding */
            background-color: #007bff;
            /* Blue color for buttons */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            /* Pointer cursor on hover */
            font-size: 16px;
            /* Increase font size */
            transition: background-color 0.3s;
            /* Transition effect */
        }

        button:hover {
            background-color: #0056b3;
            /* Darker blue on hover */
        }

        a {
            color: #007bff;
            /* Link color */
            text-decoration: none;
            /* Remove underline */
            margin-top: 20px;
            /* Space above link */
            display: inline-block;
            /* Make link behave like a block element */
        }

        a:hover {
            text-decoration: underline;
            /* Underline on hover */
        }

        /* Responsive design */
        @media (max-width: 600px) {
            form {
                width: 90%;
                /* Full width on smaller screens */
            }
        }
    </style>
</head>

<body>
    <h1>Login</h1>

    <?php if (!empty($data['loginError'])): ?>
        <p style="color: red;"><?php echo $data['loginError']; ?></p>
    <?php endif; ?>

    <form action="<?php echo URLROOT; ?>/UserController/login" method="POST">
        <input type="email" name="email" placeholder="Enter Email" required value="<?php echo htmlspecialchars($data['email']); ?>"><br><br>
        <input type="password" name="password" placeholder="Enter Password" required><br><br>
        <label for="role">Select Role:</label>
        <select name="role" id="role" required>
            <option value="">--Select Role--</option>
            <option value="admin">Admin</option>
            <option value="customer">Customer</option>
        </select><br><br>
        <br>
        <button type="submit">Login</button>
    </form>

    <br>
    <a href="<?php echo URLROOT; ?>/UserController/register">Don't have an account? Register here</a>
</body>

</html>