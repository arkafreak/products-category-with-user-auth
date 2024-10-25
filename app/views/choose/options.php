<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
</head>

<body>
    <h1>Welcome to the Shop</h1>
    <!-- Navigation Buttons -->
    <div class="options">
        <h2>Choose:</h2>
        <a href="<?php echo URLROOT; ?>/products"><button>Products</button></a>
        <a href="<?php echo URLROOT; ?>/categories"><button>Categories</button></a>
    </div>

    <!-- Logout button -->
    <form action="<?php echo URLROOT; ?>" method="POST" style="margin-top: 20px;">
        <button type="submit">Logout</button>
    </form>

</body>

</html>