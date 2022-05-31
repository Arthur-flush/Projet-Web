<?php
session_start();
ini_set("display_errors", "on");
$conn = new mysqli("localhost", "ProjetWeb", "Password", "ProjetWeb");
if(! $conn ) {
    die('Could not connect to db');
}

if (isset($_POST["Delete"])) {
    $id = $_POST["id"];
    $sql = "DELETE FROM users WHERE id = '$id'";
    $result = $conn->query($sql);
    if (!$result) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    else {
        echo "User deleted";
    }
}

//header("Location: index.php");