<?php
require 'connect.php';

session_start();
if (!isset($_SESSION['user'])) {

    header("Location: login.php");
    exit();
}


if (isset($_GET['id'])) {
    $query = $mysqli->prepare("DELETE FROM hallgatok WHERE id=(?)");
    $query->bind_param('d', $_GET['id']);


    $query->execute();
    header("Location: index.php");
}