<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Address and Payment</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2>Address and Payment</h2>

    <?php if ($flash = Helper::getFlashMessage()): ?>
        <div class="alert alert-<?php echo htmlspecialchars($flash['type']); ?>">
            <?php echo htmlspecialchars($flash['message']); ?>
        </div>
    <?php endif; ?>

    <h4>Order Details</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Brand</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($cartItems)): ?>
                <?php foreach ($cartItems as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item->productName); ?></td>
                        <td><?php echo htmlspecialchars($item->brand); ?></td>
                        <td><?php echo htmlspecialchars($item->sellingPrice); ?></td>
                        <td><?php echo htmlspecialchars($item->quantity); ?></td>
                        <td><?php echo htmlspecialchars($item->sellingPrice * $item->quantity); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No items in cart.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <h5>Total Amount: ₹<?php echo htmlspecialchars($totalAmount); ?></h5>

    <form action="<?php echo URLROOT; ?>/order/confirm" method="POST">
        <div class="form-group">
            <label for="address">Enter your address:</label>
            <textarea name="address" id="address" class="form-control" required></textarea>
        </div>

        <div class="form-group">
            <label for="paymentMethod">Select a payment method:</label>
            <select name="paymentMethod" id="paymentMethod" class="form-control" required>
                <option value="">--Choose a payment method--</option>
                <option value="credit_card">Credit Card</option>
                <option value="paypal">PayPal</option>
                <option value="bank_transfer">Bank Transfer</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Place Order</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
