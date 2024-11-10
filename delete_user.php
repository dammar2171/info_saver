<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'testdb');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user ID is set in the URL
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // SQL query to delete the user
    $sql = "DELETE FROM user WHERE id = $user_id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('User deleted successfully!'); window.location.href='user_list.php';</script>";
    } else {
        echo "Error deleting user: " . $conn->error;
    }
} else {
    echo "No user ID specified.";
}

$conn->close();
?>
