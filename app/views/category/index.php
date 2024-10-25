<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <link rel="stylesheet" href="/path/to/your/style.css"> <!-- Adjust path to your CSS -->
</head>

<body>
    <h1>Categories</h1>
    <a href="<?php echo URLROOT; ?>/categories/add"><button>Add New Category</button></a>&nbsp;
    <a href="<?php echo URLROOT; ?>/products"><button>Go to products</button></a>&nbsp;
    <a href="<?php echo URLROOT; ?>/choose/options"><button>Home</button></a><br>&nbsp;
    <br>

    <table border="1">
        <tr>
            <th>Category ID</th>
            <th>Category Name</th>
            <th>Actions</th>
        </tr>
        <?php if (!empty($data['categories'])): ?>
            <?php foreach ($data['categories'] as $category): ?>
                <tr>
                    <td style="text-align: center;"><?php echo htmlspecialchars($category->id); ?></td>
                    <td style="text-align: center;"><?php echo htmlspecialchars($category->categoryName); ?></td>
                    <td style="text-align: center;">
                        <a href="<?php echo URLROOT; ?>/categories/edit/<?php echo htmlspecialchars($category->id); ?>" style="text-decoration:none;"><button>Edit</button></a>&nbsp;
                        <a href="<?php echo URLROOT; ?>/categories/delete/<?php echo htmlspecialchars($category->id); ?>" style="text-decoration:none;" onclick="return confirm('Are you sure you want to delete this category?');"><button>Delete</button></a>&nbsp;
                        <a href="<?php echo URLROOT; ?>/categories/show/<?php echo htmlspecialchars($category->id); ?>" style="text-decoration:none;"><button>View</button></a>&nbsp;
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="3">No categories found.</td>
            </tr>
        <?php endif; ?>
    </table>
</body>

</html>
