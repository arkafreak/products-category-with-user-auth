<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="../../public/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .button-container {
            display: flex;
            /* Use flexbox for layout */
            justify-content: space-between;
            /* Space between buttons */
            align-items: center;
            /* Align items vertically */
            margin-bottom: 20px;
            /* Space below button container */
        }

        .button-group {
            display: flex;
            /* Group buttons together */
            align-items: center;
            /* Center align buttons vertically */
        }

        a[href*="delete"] button {
            background-color: #dc3545;
            /* Red color */
            color: white;
            border: none;
        }

        a[href*="delete"] button:hover {
            background-color: #c82333;
            /* Darker red on hover */
        }

        .button-container a {
            text-decoration: none;
            /* Remove underline from links */
        }

        .button-container form button[type="submit"] {
            background-color: #dc3545 !important;
            /* Red color */
            color: white !important;
        }

        .button-container form button[type="submit"]:hover {
            background-color: #c82333 !important;
            /* Darker red on hover */
        }

        button {
            padding: 10px 10px;
            background-color: #28a745;
            /* Green color for buttons */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            /* Pointer cursor on hover */
            font-size: 16px;
            /* Increase font size */
            margin: 0 10px;
            /* Margin between buttons */
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
            margin-top: 10px;
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
    <h1>Products</h1>

    <div class="button-container">
        <div class="button-group">
            <?php if ($_SESSION['role'] === 'admin'): ?>
                <a href="<?php echo URLROOT; ?>/products/add"><button>Add New Product</button></a>
            <?php endif; ?>
            <a href="<?php echo URLROOT; ?>/categories"><button>Go to categories</button></a>
            <a href="<?php echo URLROOT; ?>/choose/options"><button>Home</button></a>
        </div>

        <!-- Logout button aligned to the right -->
        <form action="<?php echo URLROOT; ?>/UserController/logout" method="POST">
            <button type="submit">Logout</button>
        </form>
    </div>

    <table border="1">
        <tr>
            <th style="text-align: center;">Product ID</th>
            <th style="text-align: center;">Product Name</th>
            <th style="text-align: center;">Brand</th>
            <th style="text-align: center;">Original Price</th>
            <th style="text-align: center;">Selling Price</th>
            <th style="text-align: center;">Category</th>
            <th style="text-align: center;">Actions</th>
        </tr>
        <?php if (!empty($data['products'])): ?>
            <?php foreach ($data['products'] as $product): ?>
                <tr>
                    <td style="text-align: center;"><?php echo htmlspecialchars($product->id); ?></td>
                    <td style="text-align: center;"><?php echo htmlspecialchars($product->productName); ?></td>
                    <td style="text-align: center;"><?php echo htmlspecialchars($product->brand); ?></td>
                    <td style="text-align: center;"><?php echo htmlspecialchars($product->originalPrice); ?></td>
                    <td style="text-align: center;"><?php echo htmlspecialchars($product->sellingPrice); ?></td>
                    <td style="text-align: center;"><?php echo htmlspecialchars($product->categoryName); ?></td>
                    <td style="text-align: center;">&nbsp;
                        <?php if ($_SESSION['role'] === 'admin'): ?>
                            <a href="<?php echo URLROOT; ?>/products/edit/<?php echo htmlspecialchars($product->id); ?>" style="text-decoration:none;"><button>Edit</button></a>&nbsp;
                            <a href="<?php echo URLROOT; ?>/products/delete/<?php echo htmlspecialchars($product->id); ?>" style="text-decoration:none;" onclick="return confirm('Are you sure you want to delete this product?');"><button>Delete</button></a>&nbsp;
                        <?php endif; ?>
                        <a href="<?php echo URLROOT; ?>/products/show/<?php echo htmlspecialchars($product->id); ?>" style="text-decoration:none;"><button>View</button></a>&nbsp;
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
</body>

</html>