<?php
session_start();
include("dbconnect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $newPassword = $_POST['password'];
    $userEmail = $_SESSION['Email'];
    $emailCheckQuery = "SELECT * FROM register WHERE Email = '$email' AND Email != '$userEmail'";
    $emailCheckResult = $conn->query($emailCheckQuery);

    if ($emailCheckResult->num_rows > 0) {
        echo "Email is already in use. Please choose a different email.";
    } else {
        $updateQuery = "UPDATE register SET Name = '$name', Email = '$email', Phone = '$phone'";
        if (!empty($newPassword)) {
            
            $updateQuery .= ", Password = '$newPassword'";
        }

        $updateQuery .= " WHERE Email = '$userEmail'";

        if ($conn->query($updateQuery) === TRUE) {
            echo "Credentials updated successfully";
            header ("location: carrent.php");
        } else {
            echo "Error updating credentials: " . $conn->error;
        }
    }
} else {
    header('Location: edit-credentials.php');
    exit();
}
