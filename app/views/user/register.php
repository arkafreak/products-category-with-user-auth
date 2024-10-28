<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>

<body>
    <h1>Register</h1>

    <?php if (!empty($data['successMessage'])): ?>
        <p style="color: green;"><?php echo $data['successMessage']; ?></p>
    <?php elseif (!empty($data['errorMessage'])): ?>
        <p style="color: red;"><?php echo $data['errorMessage']; ?></p>
    <?php endif; ?>

    <form action="<?php echo URLROOT; ?>/UserController/register" method="POST">
        <input type="text" name="name" placeholder="Enter Name" required value="<?php echo htmlspecialchars($data['name']); ?>"><br><br>
        <input type="email" name="email" placeholder="Enter Email" required value="<?php echo htmlspecialchars($data['email']); ?>"><br><br>
        <input type="password" name="password" placeholder="Enter Password" required><br><br>
        <label for="role">Choose Role:</label>
        <select name="role" id="role" required>
            <option value="">--Select Role--</option>
            <option value="admin">Admin</option>
            <option value="customer">Customer</option>
        </select><br><br>
        <button type="submit">Register</button>
    </form>

    <br>
    <a href="<?php echo URLROOT; ?>/UserController/login">Already have an account? Login here</a>
</body>

</html>