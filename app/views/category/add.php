<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
    <link rel="stylesheet" href="/path/to/your/style.css"> <!-- Adjust path to your CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            max-width: 500px;
            /* Set a maximum width for the form */
            margin: 0 auto;
            /* Center the form */
        }

        label {
            margin-bottom: 5px;
            /* Space between label and input */
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        input[type="decimal"],
        select {
            padding: 10px;
            /* Add some padding */
            margin-bottom: 20px;
            /* Space between inputs */
            border: 1px solid #ccc;
            /* Add border */
            border-radius: 5px;
            /* Rounded corners */
            width: 100%;
            /* Full width */
        }

        input[type="submit"],
        button {
            padding: 10px;
            background-color: #28a745;
            /* Green color for buttons */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            /* Pointer cursor on hover */
            font-size: 16px;
            /* Increase font size */
        }

        input[type="submit"]:hover,
        button:hover {
            background-color: #218838;
            /* Darker green on hover */
        }

        .warning {
            font-weight: bold;
            color: red;
            margin-bottom: 20px;
            /* Space below warning */
        }
    </style>
</head>
<body>
    <h1>ADD CATEGORY</h1>
    <form action="<?php echo URLROOT; ?>/categories/add" method="post">
        <label for="categoryName">Category Name:</label>
        <input type="text" name="categoryName" required><br>
        
        <input type="submit" value="Add Category">
    </form>
    
    <a href="<?php echo URLROOT; ?>/categories"><button>Go Back</button></a>
</body>
</html>
