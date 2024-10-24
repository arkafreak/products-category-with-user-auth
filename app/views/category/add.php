<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
    <link rel="stylesheet" href="/path/to/your/style.css"> <!-- Adjust path to your CSS -->
</head>
<body>
    <h1>ADD CATEGORY</h1>
    <form action="<?php echo URLROOT; ?>/categories/add" method="post">
        <label for="categoryName">Category Name:</label>
        <input type="text" name="categoryName" required><br>
        
        <input type="submit" value="Add Category">
    </form>
    
    <a href="<?php echo URLROOT; ?>/categories"><button>Go Back</button></a>
</body>
</html>
