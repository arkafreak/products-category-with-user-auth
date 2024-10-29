<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="/style.css"> <!-- Adjust path to your CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            max-width: 500px;
            /* Set a maximum width for the form */
            margin: 0 auto;
            /* Center the form */
        }

        label {
            margin-bottom: 5px;
            /* Space between label and input */
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        input[type="decimal"],
        select {
            padding: 10px;
            /* Add some padding */
            margin-bottom: 20px;
            /* Space between inputs */
            border: 1px solid #ccc;
            /* Add border */
            border-radius: 5px;
            /* Rounded corners */
            width: 100%;
            /* Full width */
        }

        input[type="submit"],
        button {
            padding: 10px;
            background-color: #28a745;
            /* Green color for buttons */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            /* Pointer cursor on hover */
            font-size: 16px;
            /* Increase font size */
        }

        input[type="submit"]:hover,
        button:hover {
            background-color: #218838;
            /* Darker green on hover */
        }

        .warning {
            font-weight: bold;
            color: red;
            margin-bottom: 20px;
            /* Space below warning */
        }
    </style>
    <script>
        function updateCategoryId() {
            var select = document.getElementById("categoryId");
            var selectedValue = select.options[select.selectedIndex].value;
            document.getElementById("categoryIdValue").value = selectedValue;
        }
    </script>
</head>

<body>
    <h1>ADD PRODUCT</h1>
    <form action="<?php echo URLROOT; ?>/products/add" method="post">&nbsp;
        <label for="productName">Product Name:</label>
        <input type="text" name="productName" required>

        <label for="brand">Brand:</label>
        <input type="text" name="brand" required>

        <label for="originalPrice">Original Price:</label>
        <input type="number" name="originalPrice" required>

        <label for="sellingPrice">Selling Price:</label>
        <input type="number" name="sellingPrice" required>

        <!-- Cant add a new product now as the table in the sql database has a new column
         called weight which is yet to be implemented in the code!!! -->
        <label for="weight">Weight:</label>
        <input type="decimal" name="weight" required>
        <span style="font-weight: bold; color: red;">Enter "0" for Digital products</span>

        <!-- <input type="hidden" name="categoryId" id="categoryIdValue" required> -->

        <label for="categoryId">Category:</label>&nbsp;
        <select name="categoryId" id="categoryId" required>
            <?php foreach ($data['categories'] as $category): ?>
                <option value="<?php echo htmlspecialchars($category->id); ?>"
                    <?php echo (isset($data['categoryId']) && $data['categoryId'] == $category->id) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($category->categoryName); ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>&nbsp;

        <input type="submit" value="Add Product">
    </form>
    &nbsp;
    <a href="<?php echo URLROOT; ?>/products"><button>Go Back</button></a>
</body>

</html>