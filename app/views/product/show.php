<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Product</title>
    <link rel="stylesheet" href="/path/to/your/style.css"> <!-- Adjust path to your CSS -->
</head>
<body>
    <h1>View Product</h1>
    <a href="<?php echo URLROOT; ?>/products"><button>Go Back</button></a>

    <table border="1">
        <tr>
            <th>Name</th>
            <th>Brand</th>
            <th>Original Price</th>
            <th>Selling Price</th>
        </tr>
        <tr>
            <td><?php echo htmlspecialchars($data['products']->productName); ?></td>
            <td><?php echo htmlspecialchars($data['products']->brand); ?></td>
            <td><?php echo htmlspecialchars($data['products']->originalPrice); ?></td>
            <td><?php echo htmlspecialchars($data['products']->sellingPrice); ?></td>
        </tr>
    </table>
</body>
</html>
