<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login";

// Step 1: Connect to Database
$mysqli = new mysqli($servername, $username, $password, $dbname);

// Check Connection
if ($mysqli->connect_error) {
die("Connection failed: " . $mysqli->connect_error);
}

if(isset($_POST['updateBtn']))
{
    $userID = $_POST['edit_id'];
    $username = $_POST['edit_username'];
    $password = password_hash($_POST['edit_password'], PASSWORD_DEFAULT);
    $email = $_POST['edit_email'];
    $user_type = $_POST['user_type'];

    $update_account_sql = "UPDATE accounts SET password = '$password' WHERE username = '$username'";
    mysqli_query($mysqli, $update_account_sql);

    if (mysqli_query($mysqli, $update_account_sql)) {
            // Update the password in the user table
            $update_user_sql = "UPDATE user SET password = '$password' WHERE userID = '$userID'";
            mysqli_query($mysqli, $update_user_sql);
            header("location:manage_users.php");
    }
    else {header("location:manage_users.php"); }
}

?>