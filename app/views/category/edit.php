<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
    <link rel="stylesheet" href="/path/to/your/style.css"> <!-- Adjust path to your CSS -->
</head>

<body>
    <h1>Edit Category</h1>

    <!-- Form to update the category details -->
    <form action="<?php echo URLROOT; ?>/categories/edit/<?php echo htmlspecialchars($data['id']); ?>" method="post">

        <label for="categoryName">Category Name:</label>
        <input type="text" id="categoryName" name="categoryName" value="<?php echo htmlspecialchars($data['categoryName']); ?>" required><br>

        <input type="submit" value="Update Category">
    </form>

    <!-- Back button to return to the categories list -->
    <a href="<?php echo URLROOT; ?>/categories"><button>Go Back</button></a>
</body>

</html>
