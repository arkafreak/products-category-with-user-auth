<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="/path/to/your/style.css"> <!-- Adjust path to your CSS -->
    <style>
        h1 {
            text-align: center;
            margin: 0; /* Remove margin to align with the button */
        }

        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            position: relative; /* Allows absolute positioning of the button */
        }

        .button-container {
            display: flex; /* Use flexbox for layout */
            justify-content: flex-start; /* Align items to the left */
            margin-top: 1px; /* Space above the button container */
        }

        .button-container a {
            text-decoration: none; /* Remove underline from links */
        }

        button {
            padding: 10px;
            background-color: #28a745; /* Green color for buttons */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer; /* Pointer cursor on hover */
            font-size: 16px; /* Increase font size */
        }

        button:hover {
            background-color: #218838; /* Darker green on hover */
        }

        form {
            display: flex;
            flex-direction: column;
            max-width: 500px; /* Set a maximum width for the form */
            margin: 0 auto; /* Center the form */
        }

        label {
            margin-bottom: 5px; /* Space between label and input */
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        input[type="decimal"],
        select {
            padding: 10px; /* Add some padding */
            margin-bottom: 20px; /* Space between inputs */
            border: 1px solid #ccc; /* Add border */
            border-radius: 5px; /* Rounded corners */
            width: 100%; /* Full width */
        }

        input[type="submit"] {
            padding: 10px;
            background-color: #28a745; /* Green color for buttons */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer; /* Pointer cursor on hover */
            font-size: 16px; /* Increase font size */
        }

        input[type="submit"]:hover {
            background-color: #218838; /* Darker green on hover */
        }

        .warning {
            font-weight: bold;
            color: red;
            margin-bottom: 20px; /* Space below warning */
        }
    </style>
</head>

<body>
    <h1>Edit Product</h1>

    <!-- Form to update the product details -->
    <form action="<?php echo URLROOT; ?>/products/edit/<?php echo htmlspecialchars($data['id']); ?>" method="post">
        <label for="productName">Product Name:</label>
        <input type="text" id="productName" name="productName" value="<?php echo htmlspecialchars($data['productName']); ?>" required>

        <label for="brand">Brand:</label>
        <input type="text" id="brand" name="brand" value="<?php echo htmlspecialchars($data['brand']); ?>" required>

        <label for="originalPrice">Original Price:</label>
        <input type="number" id="originalPrice" name="originalPrice" value="<?php echo htmlspecialchars($data['originalPrice']); ?>" required>

        <label for="sellingPrice">Selling Price:</label>
        <input type="number" id="sellingPrice" name="sellingPrice" value="<?php echo htmlspecialchars($data['sellingPrice']); ?>" required>

        <label for="weight">Weight:</label>
        <input type="number" id="weight" name="weight" value="<?php echo htmlspecialchars($data['weight']); ?>" required>
        <span>Enter "0" for Digital products</span>

        <label for="categoryId">Category:</label>
        <select name="categoryId" id="categoryId" required>
            <?php foreach ($data['categories'] as $category): ?>
                <option value="<?php echo htmlspecialchars($category->id); ?>"
                    <?php echo ($data['categoryId'] == $category->id) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($category->categoryName); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <input type="submit" value="Update Product">
    </form>

    <div class="button-container">
        <a href="<?php echo URLROOT; ?>/products"><button>Go Back</button></a>
    </div>
</body>

</html>
