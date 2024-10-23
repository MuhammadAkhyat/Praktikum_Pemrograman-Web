<?php
session_start();
require_once 'koneksi.php';  
require_once 'include/auth_function.php';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        
        if (empty($username) || empty($email) || empty($password)) {
            throw new Exception("All fields are required");
        }

        if (registerUser($conn, $username, $email, $password)) {  
            $_SESSION['success'] = "Registration successful! Please login.";
            header("Location: login.php");
            exit();
        }
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>

    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <title>Register</title>
        <link rel="stylesheet" href="styles/style.css">
    </head>
    <body>
        <div class="auth-container">
            <h2>Register</h2>
            <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
            <form method="POST" action="">
                <input type="text" name="username" placeholder="Username" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Register</button>
            </form>
            <p>Already have an account? <a href="login.php">Login</a></p>
        </div>
    </body>
    </html>