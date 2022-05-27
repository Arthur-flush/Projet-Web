<?php
session_start();
ini_set("display_errors", "on");

if (isset($_POST['login'])) {
    $conn = new mysqli("127.0.0.1", "ProjetWeb", "scam.com", "ProjetWeb");
    if(! $conn ) {
        die('Could not connect to db');
        echo "hahahah db goes brrrrr";
    }
    $email = $_POST['email'];
    if (!preg_match("/^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z]{2,6}$/", $email)) {
        echo "Wrong email";
    }
    $password = $_POST['password'];

    /*
    // check if password at least 8 characters long
    if (strlen($password) < 8) {
        echo "Password must be at least 8 characters long";
        die();
    }
    */

    $password = hash('sha256', $password);
    $handle = $_POST['handle'];
    $handle = strtolower($handle);
    if (!ctype_alnum($handle)) {
        echo "handle must be alphanumeric";
        die();
    }
    // check if handle in db
    $sql = "SELECT * FROM users WHERE handle = '$handle'";
    $result = $conn->query($sql);
    if (!$result) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    if ($result->num_rows > 0) {
        echo "handle already taken";
        die();
    }
    // check if email in db
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);
    if (!$result) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    if ($result->num_rows > 0) {
        echo "email already taken";
        die();
    }
    // insert into db
    $sql = "INSERT INTO users (email, password, handle) VALUES ('$email', '$password', '$handle')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        header('Location: login.php');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
    
?>

<!DOCTYPE html>
<html>
<head>
    <title>create account</title>
    <link rel="stylesheet" href="./Style.css">
</head>
<body>
    <form action="register.php" method="post">
        @<input type="text" id="handle" name="handle" placeholder="handle">
        <input type="text" id="email" name="email" placeholder="email">
        <input type="password" id="password" name="password" placeholder="password">
        <button type="submit" name="login">Login</button>
    </form>
</body>
</html>
