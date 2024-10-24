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
    <a href="<?php echo URLROOT; ?>/products/add"><button>Add New Product</button></a>
    <a href="<?php echo URLROOT; ?>"><button>Home</button></a>
    <br>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Product Name</th>
            <th>Brand</th>
            <th>Original Price</th>
            <th>Selling Price</th>
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
                    <td>
                        <a href="<?php echo URLROOT; ?>/products/edit/<?php echo htmlspecialchars($product->id); ?>" style="text-decoration:none;"><button>Edit</button></a>
                        <a href="<?php echo URLROOT; ?>/products/delete/<?php echo htmlspecialchars($product->id); ?>" style="text-decoration:none;" onclick="return confirm('Are you sure you want to delete this product?');"><button>Delete</button></a>
                        <a href="<?php echo URLROOT; ?>/products/show/<?php echo htmlspecialchars($product->id); ?>" style="text-decoration:none;"><button>View</button></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">No products found.</td>
            </tr>
        <?php endif; ?>
    </table>
    <a href="<?php echo URLROOT; ?>/digital"><button>Digital Products</button></a>
    <a href="<?php echo URLROOT ?>/products/physicalIndex/<?php echo htmlspecialchars($product->id); ?>" style="text-decoration:none;"><button>Physical Product</button></a>
</body>

</html>