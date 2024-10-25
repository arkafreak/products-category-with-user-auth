<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="/path/to/your/style.css"> <!-- Adjust path to your CSS -->
</head>
<body>
    <h1>ADD PRODUCT</h1>
    <form action="<?php echo URLROOT; ?>/products/add" method="post">
        <label for="productName">Product Name:</label>
        <input type="text" name="productName" required><br>
        
        <label for="brand">Brand:</label>
        <input type="text" name="brand" required><br>
        
        <label for="originalPrice">Original Price:</label>
        <input type="number" name="originalPrice" required><br>
        
        <label for="sellingPrice">Selling Price:</label>
        <input type="number" name="sellingPrice" required><br>
        
        <!-- Cant add a new product now as the table in the sql database has a new column
         called weight which is yet to be implemented in the code!!! -->
        <label for="weight">Weight:</label>
        <input type="dicimal" name="weight" required><br>
        <span>Enter "0" for Digital products</span>
        <br>

        <input type="submit" value="Add Product">
    </form>
    
    <a href="<?php echo URLROOT; ?>/products"><button>Go Back</button></a>
</body>
</html>
