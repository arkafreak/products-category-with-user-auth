<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Red button styles */
        .red-button {
            background-color: #dc3545;
            /* Red color */
            color: white;
            border: none;
        }

        .red-button:hover {
            background-color: #c82333;
            /* Darker red on hover */
        }

        /* General body styling */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #007bff;
            margin-bottom: 20px;
        }

        /* Cart Icon Styling */
        .cart-icon {
            margin-left: auto;
        }

        .cart-icon a {
            display: inline-block;
            padding: 10px;
            background-color: #007bff;
            border-radius: 5px;
            color: white;
            font-size: 20px;
            /* Increased font size for cart icon */
            transition: background-color 0.3s;
        }

        .cart-icon a:hover {
            background-color: #0056b3;
        }

        /* Button container */
        .button-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        /* Button styles */
        button {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin: 0 10px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #218838;
        }

        a {
            text-decoration: none;
        }

        /* Table styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
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

        /* Warning message styling */
        .warning {
            font-weight: bold;
            color: red;
            margin-bottom: 20px;
            text-align: center;
        }

        /* Responsive design */
        @media (max-width: 600px) {
            .button-container {
                flex-direction: column;
                align-items: flex-start;
            }

            .cart-icon {
                margin-bottom: 10px;
            }

            button {
                width: 100%;
                margin-bottom: 10px;
            }

            table {
                font-size: 14px;
            }
        }

        /* Styling for Add to Cart button */
        .add-to-cart-button {
            background-color: #007bff;
            font-size: 16px;
        }

        .add-to-cart-button:hover {
            background-color: #0056b3;
        }
    </style>

</head>

<body>
    <h1>Products</h1>

    <div class="button-container">
        <div class="button-group">
            <?php if ($_SESSION['role'] === 'admin'): ?>
                <a href="<?php echo URLROOT; ?>/products/add"><button>Add New Product</button></a>
            <?php endif; ?>
            <a href="<?php echo URLROOT; ?>/categories"><button>Go to categories</button></a>
            <a href="<?php echo URLROOT; ?>/choose/options"><button>Home</button></a>
        </div>

        <!-- Cart icon and aligned to the right -->
        <?php if ($_SESSION['role'] === 'customer'): ?>
            <div class="cart-icon">
                <a href="<?php echo URLROOT; ?>/CartController/index"><i class="fa fa-shopping-cart"></i></a>
            </div>
        <?php endif; ?>

        <!-- Logout button aligned to the right -->
        <form action="<?php echo URLROOT; ?>/UserController/logout" method="POST" style="display: inline;">
            <button type="submit" class="red-button">Logout</button>
        </form>

        <!-- Order History page -->
        <form action="<?php echo URLROOT; ?>/OrderController/history" method="POST" style="display: inline;">
            <button type="submit" class="red-button">Your Order History</button>
        </form>
    </div>
    <?php
    // Initialize the variable at the top of your view
    $displayMessage = false;

    // Check if the session message and its timestamp are set
    if (isset($_SESSION['message']) && isset($_SESSION['message_time'])) {
        // Check if 3 seconds have passed
        if (time() - $_SESSION['message_time'] <= 3) {
            $displayMessage = true; // Message should be displayed
        } else {
            unset($_SESSION['message']); // Clear message after 3 seconds
            unset($_SESSION['message_time']); // Clear timestamp
        }
    }
    ?>

    <div id="success-message" style="display: <?php echo $displayMessage ? 'block' : 'none'; ?>; color: green; text-align: center; margin-bottom: 20px;">
        <?php
        if ($displayMessage) {
            echo $_SESSION['message'];
            unset($_SESSION['message']); // Clear message after displaying
        }
        ?>
    </div>

    <table border="1">
        <tr>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Brand</th>
            <th>Original Price</th>
            <th>Selling Price</th>
            <th>Category</th>
            <th>Actions</th>
        </tr>
        <?php if (!empty($data['products'])): ?>
            <?php foreach ($data['products'] as $product): ?>
                <tr>
                    <td><?php echo htmlspecialchars($product->id); ?></td>
                    <td><?php echo htmlspecialchars($product->productName); ?></td>
                    <td><?php echo htmlspecialchars($product->brand); ?></td>
                    <td><?php echo htmlspecialchars($product->originalPrice); ?></td>
                    <td><?php echo htmlspecialchars($product->sellingPrice); ?></td>
                    <td><?php echo htmlspecialchars($product->categoryName); ?></td>
                    <td><?php if ($_SESSION['role'] === 'admin'): ?>
                            <a href="<?php echo URLROOT; ?>/products/edit/<?php echo htmlspecialchars($product->id); ?>" style="text-decoration:none;"><button>Edit</button></a>&nbsp;
                            <a href="<?php echo URLROOT; ?>/products/delete/<?php echo htmlspecialchars($product->id); ?>" style="text-decoration:none;" onclick="return confirm('Are you sure you want to delete this product?');"><button class="red-button">Delete</button></a>&nbsp;
                        <?php endif; ?>
                        <a href="<?php echo URLROOT; ?>/products/show/<?php echo htmlspecialchars($product->id); ?>" style="text-decoration:none;"><button>View</button></a>&nbsp;
                        <?php if ($_SESSION['role'] === 'customer'): ?>
                            <div style="display: inline-flex; align-items: center;">
                                <form action="<?php echo URLROOT; ?>/CartController/addToCart" method="POST" style="margin: 0;">
                                    <input type="hidden" name="productId" value="<?php echo $product->id; ?>">
                                    <form action="<?php echo URLROOT; ?>/CartController/addToCart" method="POST" style="margin: 0;" class="add-to-cart-form" onsubmit="addToCart(event)">
                                        <input type="hidden" name="productId" value="<?php echo $product->id; ?>">
                                        <button type="submit" class="add-to-cart-button" aria-label="Add to cart">
                                            Add to Cart
                                        </button>
                                    </form>
                                </form>
                            </div>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7">No products found.</td>
            </tr>
        <?php endif; ?>
    </table>
    <br>
    <a href="<?php echo URLROOT; ?>/digital"><button>Digital Products</button></a>&nbsp;
    <a href="<?php echo URLROOT; ?>/physical"><button>Physical Products</button></a>&nbsp;

    <script>
        function addToCart(event) {
            event.preventDefault(); // Prevent the form from submitting the default way

            const form = event.target;
            const formData = new FormData(form);

            fetch(form.action, {
                    method: 'POST',
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    // Assuming your server returns a JSON object with a success message
                    if (data.success) {
                        const successMessage = document.getElementById('success-message');
                        successMessage.innerText = data.message;
                        successMessage.style.display = 'block';

                        // Dim and disable the button, and change the text
                        const button = form.querySelector('.add-to-cart-button');
                        button.innerText = 'Already Added';
                        button.style.backgroundColor = 'grey';
                        button.disabled = true;

                        // Hide the message after 3 seconds
                        setTimeout(function() {
                            successMessage.style.display = 'none';
                        }, 3000);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    </script>

</body>

</html>