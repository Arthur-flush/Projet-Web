<?php
    ini_set("display_errors", "on");
    if (isset($_POST['login'])) {
        $conn = new mysqli("127.0.0.1", "ProjetWeb", "scam.com", "ProjetWeb");
        if(! $conn ) {
            die('Could not connect to db');
            echo "hahahah db goes brrrrr";
        }
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password = hash('sha256', $password);

        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        $result = $conn->query($sql);
        if (!$result) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['user'] = $row['id'];
            header('Location: index.php');
        } else {
            echo "Wrong email or password";
        }

        //echo 'Connected successfully';
        $conn->close();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>SHOP</title>
    <link rel="stylesheet" href="./Style.css">
</head>
<body>
    <form action="login.php" method="post">
        <input type="text" id="email" name="email" placeholder="email">
        <input type="password" id="password" name="password" placeholder="password">
        <button type="submit" name="login">Login</button>
    </form>
</body>
