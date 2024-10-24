<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Category</title>
    <link rel="stylesheet" href="/path/to/your/style.css"> <!-- Adjust path to your CSS -->
</head>
<body>
    <h1>View Category</h1>
    <a href="<?php echo URLROOT; ?>/categories"><button>Go Back</button></a>

    <table border="1">
        <tr>
            <th>Category Name</th>
        </tr>
        <tr>
            <td><?php echo htmlspecialchars($data['category']->categoryName); ?></td>
        </tr>
    </table>
</body>
</html>
