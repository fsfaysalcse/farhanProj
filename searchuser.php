<?php
session_start();
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search'])) {
    $search_query = $_GET['search_query'];

    // Perform a search query against your database
    $sql = "SELECT * FROM books WHERE title LIKE '%$search_query%' OR author LIKE '%$search_query%'";
    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Search Results</title>
</head>

<body>
    <header>
    <link href="https://fonts.googleapis.com/css2?family=Product+Sans&display=swap" rel="stylesheet">
    <link href="styles/search.css" rel="stylesheet" />

        <h1>Library Management System</h1>
        <a href="admin_dashboard.php">Go Back</a>

        <!-- Navigation links if needed -->
    </header>

    <main>
        <h2>Search Results</h2>
        <form method="get" action="search.php">
            <label for="search_query">Search:</label>
            <input type="text" id="search_query" name="search_query" required>
            <input type="submit" value="Search" name="search">
        </form>

        <?php
        if (isset($result) && $result->num_rows > 0) {
            echo "<table border='1'>";
            echo "<tr><th>Title</th><th>Author</th></tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['title'] . "</td>";
                echo "<td>" . $row['author'] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "No results found.";
        }
        ?>
    </main>

    <footer>
        <div>
            <h3>Contact Us</h3>
            <p>Email: example@example.com</p>
            <p>Phone: 123-456-7890</p>
        </div>

        <div>
            <h3>Links</h3>
            <ul>
                <li><a href="user_dashboard.php">Home</a></li>
                <li><a href="about_us.php">About Us</a></li>
                <!-- Other links -->
            </ul>
        </div>
    </footer>
</body>

</html>