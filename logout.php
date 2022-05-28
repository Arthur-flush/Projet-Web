<?php
session_start();
ini_set("display_errors", "on");
// logout

if (isset($_SESSION['user'])) {
    session_destroy();
}

header('Location: index.php');