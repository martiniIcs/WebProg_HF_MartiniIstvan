<?php
require 'connect.php';

session_start();
if (!isset($_SESSION['user'])) {

    header("Location: login.php");
}

if (isset($_POST['submit'])){

    $nev = $_POST['nev'];
    $szak = $_POST['szak'];
    $atlag = $_POST['atlag'];


    $query = $mysqli->prepare("INSERT INTO hallgatok (nev, szak , atlag) VALUES((?),(?),(?))");
    $query->bind_param('ssd',$nev,$szak,$atlag);


    $query->execute();
    header("Location: index.php");
}
?>
<form name="form1" method="post" action="bevitel.php">
    <table>
        <tr>
            <td>Nev</td>
            <td><input type="text" name="nev" required></td>
        </tr>
        <tr>
            <td>Szak</td>
            <td><input type="text" name="szak" required></td>
        </tr>
        <tr>
            <td>Atlag</td>
            <td><input type="text" name="atlag" required></td>
        </tr>
        <tr>
            <td><input type="submit" value="Save" name="submit"></td>
        </tr>
    </table>
</form>