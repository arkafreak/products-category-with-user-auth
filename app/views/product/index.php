<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="/path/to/your/style.css"> <!-- Adjust path to your CSS -->
</head>

<body>
    <h1>Products</h1>
    <a href="<?php echo URLROOT; ?>/products/add"><button>Add New Product</button></a>&nbsp;
    <a href="<?php echo URLROOT; ?>/categories"><button>Go to categories</button></a>&nbsp;
    <a href="<?php echo URLROOT; ?>/choose/options"><button>Home</button></a><br>&nbsp;
    <br>

    <table border="1">
        <tr>
            <th style="text-align: center;">Product ID</th>
            <th style="text-align: center;">Product Name</th>
            <th style="text-align: center;">Brand</th>
            <th style="text-align: center;">Original Price</th>
            <th style="text-align: center;">Selling Price</th>
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
                    <td style="text-align: center;">
                        <a href="<?php echo URLROOT; ?>/products/edit/<?php echo htmlspecialchars($product->id); ?>" style="text-decoration:none;"><button>Edit</button></a>&nbsp;
                        <a href="<?php echo URLROOT; ?>/products/delete/<?php echo htmlspecialchars($product->id); ?>" style="text-decoration:none;" onclick="return confirm('Are you sure you want to delete this product?');"><button>Delete</button></a>&nbsp;
                        <a href="<?php echo URLROOT; ?>/products/show/<?php echo htmlspecialchars($product->id); ?>" style="text-decoration:none;"><button>View</button></a>&nbsp;
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">No products found.</td>
            </tr>
        <?php endif; ?>
    </table>
    <br>
    <a href="<?php echo URLROOT; ?>/digital"><button>Digital Products</button></a>&nbsp;
    <a href="<?php echo URLROOT ?>/products/physicalIndex/<?php echo htmlspecialchars($product->id); ?>" style="text-decoration:none;"><button>Physical Product</button></a>
</body>

</html>