<?php
session_start();
ini_set("display_errors", "on");
$conn = new mysqli("127.0.0.1", "ProjetWeb", "Password", "ProjetWeb");
if(! $conn ) {
    die('Could not connect to db');
}

// check if user is admin or owner
$id = $_SESSION['user'];
$sql = "SELECT * FROM users WHERE id = '$id'";
$result = $conn->query($sql);
if (!$result) {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        if ($row['admin'] == 1) {
            $admin = true;
        }
        else {
            $admin = false;
        }
        // get if stock owner is current user
        if (isset($_POST['stockid'])) {
            $stockid = $_POST['stockid'];
            $sql = "SELECT * FROM stock WHERE id = '$stockid'";
            $result = $conn->query($sql);
            if (!$result) {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    if ($row['owner'] == $id) {
                        $owner = true;
                    }
                    else {
                        $owner = false;
                    }
                }
            }
        }
    }
}

if ($admin || $owner) {
    if (isset($_POST['stockid'])) {
        $id = $_POST['stockid'];
        // getfilename 
        $sql = "SELECT * FROM stock WHERE id = '$id'";
        $result = $conn->query($sql);
        if (!$result) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $filename = $row['image'];
            }
        }
        $sql = "DELETE FROM stock WHERE id = '$id'";
        echo $sql;
        $result = $conn->query($sql);
        if (!$result) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        else {
            // delete file
            unlink("./images/".$filename);
            header("Location: index.php");
        }
    }
}