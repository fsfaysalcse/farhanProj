<?php
session_start();
include('db.php');

if ($_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $book_id = $_GET['id'];

    // Fetch book details based on the ID
    $sql = "SELECT * FROM books WHERE id = $book_id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
    } else {
        echo "Book not found!";
        exit();
    }
} else {
    echo "Invalid request!";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $quantity = (int)$_POST['quantity'];

    $sql = "UPDATE books SET title='$title', author='$author', quantity=$quantity WHERE id=$book_id";

    if ($conn->query($sql) === TRUE) {
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "Error updating book: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Book</title>
</head>

<body>
    <h2>Edit Book</h2>
    <form method="post" action="">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?php echo $row['title']; ?>" required><br><br>

        <label for="author">Author:</label>
        <input type="text" id="author" name="author" value="<?php echo $row['author']; ?>" required><br><br>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" value="<?php echo $row['quantity']; ?>" required><br><br>

        <input type="submit" value="Update Book">
    </form>
</body>

</html>