<?php include('headeradmin.php'); ?>
<?php
session_start();
include('db.php');

if ($_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Function to sanitize input
function sanitize($conn, $data)
{
    return mysqli_real_escape_string($conn, htmlspecialchars($data));
}

// Add Book functionality
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_book'])) {
    $title = sanitize($conn, $_POST['title']);
    $author = sanitize($conn, $_POST['author']);
    $quantity = (int)$_POST['quantity'];

    $sql = "INSERT INTO books (title, author, quantity) VALUES ('$title', '$author', $quantity)";
    if ($conn->query($sql) === TRUE) {
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Delete Book functionality
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    $sql = "DELETE FROM books WHERE id = $delete_id";

    if ($conn->query($sql) === TRUE) {
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "Error deleting book: " . $conn->error;
    }
}

// Fetching books from the database
$sql = "SELECT * FROM books";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
</head>

<body>
    <h1>Welcome, <?php echo $_SESSION['username']; ?> (Admin)!</h1>

    <h2>Add Book</h2>
    <form method="post" action="">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required><br><br>

        <label for="author">Author:</label>
        <input type="text" id="author" name="author" required><br><br>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" required><br><br>

        <input type="submit" value="Add Book" name="add_book">
    </form>

    <h2>Book List:</h2>
    <table border="1">
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Quantity</th>
            <th>Actions</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['title'] . "</td>";
                echo "<td>" . $row['author'] . "</td>";
                echo "<td>" . $row['quantity'] . "</td>";
                echo "<td>";
                echo "<a href='edit_book.php?id=" . $row['id'] . "'>Edit</a> | ";
                echo "<a href='admin_dashboard.php?delete_id=" . $row['id'] . "' onclick=\"return confirm('Are you sure you want to delete this book?')\">Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No books available</td></tr>";
        }
        ?>
    </table>

    <br>
    <a href="logout.php">Logout</a>
</body>

</html>