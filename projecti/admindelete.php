<?php
include("dbconnect.php");

// Check if the ID parameter is set in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the row with the specified ID
    $deleteQuery = "DELETE FROM register WHERE id = '$id'";
    $result = mysqli_query($conn, $deleteQuery);
    $dquery="DELETE FROM cars WHERE cid = '$id'";
    $result1 = mysqli_query($conn, $dquery);

    if ($result || $result1) {
        // Deletion successful
        header('Location: admin.php?message=Deletion successful!');
        exit();
    } 
    else {
        // Deletion failed
        $errorMessage = mysqli_error($conn);  // Get the specific MySQL error
        header('Location: admin.php?message=Deletion failed. Error: ' . $errorMessage);
        exit();
    }
} else {
    // Redirect if the ID parameter is not set
    header('Location: admin.php?message=Invalid request.');
    exit();
}
?>
