<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ccc;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tbody tr:hover {
            background-color: #eaeaea;
        }

        h3 {
            text-align: right;
            color: #333;
            margin-top: 20px;
        }

        button {
            padding: 5px 10px;
            border: none;
            background-color: #007bff;
            color: white;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        .quantity-buttons {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .quantity-buttons form {
            display: inline;
            margin: 0 2px;
        }

        p {
            text-align: center;
            color: #666;
        }

        .empty-cart-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        /* New style for the Place Order button container */
        .place-order-container {
            display: flex;
            justify-content: center;
            /* Center the button horizontally */
            margin-top: 20px;
            /* Add some gap from the table */
        }
    </style>

</head>

<body>
    <h1>Your Cart</h1>
    <?php if (!empty($data['cartItems'])): ?>
        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Brand</th>
                    <th>Quantity</th>
                    <th>Selling Price</th>
                    <th>Total Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $totalAmount = 0;
                foreach ($data['cartItems'] as $item):
                    $itemTotal = $item->quantity * $item->sellingPrice;
                    $totalAmount += $itemTotal;
                ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item->productName); ?></td>
                        <td><?php echo htmlspecialchars($item->brand); ?></td>
                        <td><?php echo htmlspecialchars($item->quantity); ?></td>
                        <td><?php echo htmlspecialchars($item->sellingPrice); ?></td>
                        <td><?php echo htmlspecialchars($itemTotal); ?></td>
                        <td class="quantity-buttons">
                            <!-- Minus button to decrease quantity -->
                            <form action="<?php echo URLROOT; ?>/CartController/update" method="POST">
                                <input type="hidden" name="productId" value="<?php echo $item->id; ?>">
                                <input type="hidden" name="action" value="decrease">
                                <button type="submit">-</button>
                            </form>
                            <!-- Plus button to increase quantity -->
                            <form action="<?php echo URLROOT; ?>/CartController/update" method="POST">
                                <input type="hidden" name="productId" value="<?php echo $item->id; ?>">
                                <input type="hidden" name="action" value="increase">
                                <button type="submit">+</button>
                            </form>&nbsp; &nbsp;
                            <form action="<?php echo URLROOT; ?>/CartController/removeItem" method="POST">
                                <input type="hidden" name="productId" value="<?php echo $item->id; ?>">
                                <input type="hidden" name="action" value="remove">
                                <button type="submit">remove</button>
                            </form>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h3>Total Amount: <?php echo htmlspecialchars($totalAmount); ?></h3>
        <br>
        <div class="place-order-container">
            <form action="<?php echo URLROOT; ?>/OrderController/placeOrder" method="POST">
                <button type="submit" class="btn btn-primary">Place Order</button>
            </form>
        </div>
        <br>
        <a href="<?php echo URLROOT; ?>/products"><button>Back to Products</button></a>
    <?php else: ?>
        <div class="empty-cart-container">
            <p>Your cart is empty.</p>
            <a href="<?php echo URLROOT; ?>/products"><button>Continue Shopping</button></a>
        </div>
    <?php endif; ?>
</body>

</html>