<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Admin Dashboard</h1>
    <h2>Purchased Products by Date</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Brand</th>
                <th>Quantity Purchased</th>
                <th>Purchase Date & Time</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data['purchasedProducts'] as $product): ?>
                <tr>
                    <td><?php echo htmlspecialchars($product->id); ?></td>
                    <td><?php echo htmlspecialchars($product->productName); ?></td>
                    <td><?php echo htmlspecialchars($product->brand); ?></td>
                    <td><?php echo htmlspecialchars($product->quantity); ?></td>
                    <td><?php echo htmlspecialchars($product->purchase_date); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <br>
    <a href="<?php echo URLROOT; ?>/Products/index"><button>Go back</button></a>
</body>
</html>
