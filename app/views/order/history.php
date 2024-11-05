<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Order History</title>
    <link rel="stylesheet" href="path/to/your/style.css">
</head>
<body>
    <h1>Your Order History</h1>
    <?php if (!empty($data['orders'])): ?>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Products</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['orders'] as $order): ?>
                    <tr>
                        <td><?php echo $order->id; ?></td>
                        <td><?php echo $order->totalAmount; ?></td>
                        <td><?php echo $order->orderStatus; ?></td>
                        <td><?php echo $order->createdAt; ?></td>
                        <td>
                            <ul>
                                <?php if (!empty($order->products)): ?>
                                    <?php foreach ($order->products as $product): ?>
                                        <li><?php echo $product->productName; ?> - <?php echo $product->brand; ?> - <?php echo $product->sellingPrice; ?></li>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <li>No products found for this order.</li>
                                <?php endif; ?>
                            </ul>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No orders found.</p>
    <?php endif; ?>
    <a href="<?php echo URLROOT; ?>/Products/index">Back to products page</a>
</body>
</html>
