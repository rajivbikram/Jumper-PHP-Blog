<?php
require 'connection.php';
session_start();
$commentId = $_GET['id'];

$selectQuery = "SELECT id,user_id FROM comments WHERE id='$commentId'";
$result = mysqli_query($conn, $selectQuery);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    if ($_SESSION['userId'] == $row['user_id']) {
        header("Location: index.php");
        exit;
    } else {
        $deleteQuery = "DELETE FROM comments WHERE id = '$commentId'";
        if (mysqli_query($conn, $deleteQuery) === TRUE) {
            echo "Comment Deleted Successfully.";
            // header("Location: blog.php");
        }
    }
} else {
    echo "Comment not found.";
}

// Close DB connection
$conn->close();
