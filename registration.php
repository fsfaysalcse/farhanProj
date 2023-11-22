<?php
session_start();
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role']; // Added role field in registration

    $check_query = "SELECT * FROM users WHERE username='$username'";
    $check_result = $conn->query($check_query);

    if ($check_result->num_rows > 0) {
        echo "Username already exists. Please choose a different username.";
    } else {
        $insert_query = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";

        if ($conn->query($insert_query) === TRUE) {
            echo "Registration successful! Redirecting to login page...";
            header("refresh:3;url=login.php");
            exit();
        } else {
            echo "Error: " . $insert_query . "<br>" . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>User Registration</title>
    <link href="https://fonts.googleapis.com/css2?family=Product+Sans&display=swap" rel="stylesheet">
    <link href="styles/registration.css" rel="stylesheet"/>
</head>

<body>
    <div class="registration-form">
        <h2>Registration</h2>
        <form method="post" action="">
            <label for="reg_username">Username:</label>
            <input type="text" id="reg_username" name="username" required>

            <label for="reg_password">Password:</label>
            <input type="password" id="reg_password" name="password" required>

            <label for="reg_role">Role:</label>
            <select id="reg_role" name="role">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>

            <input type="submit" value="Register" name="register" class="regi_btn">
        </form>
    </div>
</body>

</html>
