<?php
session_start();
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role'];

        if ($row['role'] === 'admin') {
            header("Location: admin_dashboard.php");
        } else {
            header("Location: user_dashboard.php");
        }
    } else {
        $error = "Invalid username or password";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Product+Sans&display=swap" rel="stylesheet">
    <link href="styles/login.css" rel="stylesheet"/>
</head>
<body>
    <div class="login-form">
        <h2>Login</h2>
        <form method="post" action="authenticate.php">
            <label for="username">Username: </label>
            <input type="text" id="username" name="username" required><br><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>

            <input type="submit" value="Login">
        </form>
        <p>Don't have an account?<a href="registration.php">Click Here!</a></p>
    </div>
</body>
</html>
