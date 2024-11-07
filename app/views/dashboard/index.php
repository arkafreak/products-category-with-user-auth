<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <style>
        /* Global Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 0;
            color: #333;
        }

        h1,
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        h3 {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            text-align: center;
            margin: 10px 0;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Table Header and Cells Styling */
        table th,
        table td {
            padding: 12px 15px;
            text-align: left;
            border: 1px solid #ddd;
            /* Adds both column and row lines */
        }

        /* Table Header */
        table th {
            background-color: #4CAF50;
            color: white;
        }

        /* Alternating Row Colors */
        table tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        /* Hover Effect for Rows */
        table tbody tr:hover {
            background-color: #f1f1f1;
        }

        /* Button Styles */
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        /* Link Styling */
        a {
            text-decoration: none;
        }

        /* Responsive Design */
        @media screen and (max-width: 768px) {
            table {
                width: 100%;
                margin: 10px;
            }

            button {
                width: 100%;
                font-size: 18px;
            }
        }
    </style>
</head>

<body>
    <h1>Admin Dashboard</h1>
    <h2>Purchased Products Grouped by Date & Time</h2>

    <?php foreach ($data['groupedProducts'] as $dateTime => $products): ?>
        <h3><?php echo htmlspecialchars($dateTime); ?></h3>
        <table>
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Brand</th>
                    <th>Quantity Purchased</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($product->id); ?></td>
                        <td><?php echo htmlspecialchars($product->productName); ?></td>
                        <td><?php echo htmlspecialchars($product->brand); ?></td>
                        <td><?php echo htmlspecialchars($product->quantity); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endforeach; ?>

    <br>
    <a href="<?php echo URLROOT; ?>/Products/index">
        <button>Go back</button>
    </a>
</body>

</html>