<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Product</title>
    <link rel="stylesheet" href="/path/to/your/style.css"> <!-- Adjust path to your CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
            /* Light background for better contrast */
        }

        h1 {
            text-align: center;
            color: #333;
            /* Darker text for heading */
        }

        .button-container {
            display: flex;
            /* Use flexbox for layout */
            justify-content: flex-start;
            /* Align items to the left */
            margin-top: 20px;
            /* Space above the button container */
        }

        .button-container a {
            text-decoration: none;
            /* Remove underline from links */
        }

        button {
            padding: 10px 20px;
            /* Adjust padding for buttons */
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

        button:hover {
            background-color: #218838;
            /* Darker green on hover */
        }

        table {
            width: 100%;
            /* Full width */
            border-collapse: collapse;
            /* Remove space between borders */
            margin-top: 20px;
            /* Space above the table */
        }

        th,
        td {
            padding: 5px;
            /* Padding for cells */
            text-align: center;
            /* Center align text in cells */
            border: 1px solid #ccc;
            /* Border for cells */
        }

        th {
            background-color: #f2f2f2;
            /* Light gray background for headers */
            color: #333;
            /* Darker text for headers */
        }

        .warning {
            font-weight: bold;
            color: red;
            margin-bottom: 20px;
            /* Space below warning */
            text-align: center;
            /* Center align warning text */
        }

        /* Responsive design */
        @media (max-width: 600px) {
            button {
                width: 100%;
                /* Full width on smaller screens */
                margin-bottom: 10px;
                /* Space below buttons */
            }

            table {
                font-size: 14px;
                /* Smaller font size for smaller screens */
            }
        }
    </style>
</head>

<body>
    <h1>View Product</h1>

    <table border="1">
        <tr>
            <th>Name</th>
            <th>Brand</th>
            <th>Original Price</th>
            <th>Selling Price</th>
            <th>Weight</th>
            <th>Category</th>
        </tr>
        <tr>
            <td><?php echo htmlspecialchars($data['productName']); ?></td>
            <td><?php echo htmlspecialchars($data['brand']); ?></td>
            <td><?php echo htmlspecialchars($data['originalPrice']); ?></td>
            <td><?php echo htmlspecialchars($data['sellingPrice']); ?></td>
            <td><?php echo htmlspecialchars($data['weight']); ?></td>
            <td><?php echo htmlspecialchars($data['categoryName']); ?></td>

        </tr>
    </table>

    <div class="button-container">
        <a href="<?php echo URLROOT; ?>/products"><button>Go Back</button></a>
    </div>
</body>

</html>