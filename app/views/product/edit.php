<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="/path/to/your/style.css"> <!-- Adjust path to your CSS -->
</head>

<body>
    <h1>Edit Product</h1>

    <!-- Form to update the product details -->
    <form action="<?php echo URLROOT; ?>/products/edit/<?php echo htmlspecialchars($data['id']); ?>" method="post">

        <label for="productName">Product Name:</label>
        <input type="text" id="productName" name="productName" value="<?php echo htmlspecialchars($data['productName']); ?>" required><br>

        <label for="brand">Brand:</label>
        <input type="text" id="brand" name="brand" value="<?php echo htmlspecialchars($data['brand']); ?>" required><br>

        <label for="originalPrice">Original Price:</label>
        <input type="number" id="originalPrice" name="originalPrice" value="<?php echo htmlspecialchars($data['originalPrice']); ?>" required><br>

        <label for="sellingPrice">Selling Price:</label>
        <input type="number" id="sellingPrice" name="sellingPrice" value="<?php echo htmlspecialchars($data['sellingPrice']); ?>" required><br>

        <input type="submit" value="Update Product">
    </form>

    <!-- Back button to return to the products list -->
    <a href="<?php echo URLROOT; ?>/products"><button>Go Back</button></a>
</body>

</html>