<?php
require 'connect.php';


session_start();
if (!isset($_SESSION['user'])) {

    header("Location: login.php");
    exit();
}

if (isset($_POST["submit"])){
    $nev = $_POST['nev'];
    $szak = $_POST['szak'];
    $atlag = $_POST['atlag'];
    $id = $_POST['id'];

    $query = $mysqli->stmt_init();
    $query = $mysqli->prepare("UPDATE hallgatok SET nev=(?), szak=(?), atlag=(?) WHERE id=(?)");
    $query->bind_param('ssdd',$nev,$szak,$atlag,$id);

    $query->execute();
    header("Location: index.php");
}else{

    if (isset($_GET['id'])){
        $query = $mysqli->prepare("SELECT * FROM hallgatok WHERE id=(?)");
        $query->bind_param('d',$_GET['id']);
        $query->execute();
        $row = $query->get_result()->fetch_array();
    }

}

?>
<form name="form1" method="post" action="update.php">
    <table>
        <tr>
            <td>Nev</td>
            <td><input type="text" name="nev" value='<?php echo $row["nev"];?>' required></td>
        </tr>
        <tr>
            <td>Szak</td>
            <td><input type="text" name="szak" value='<?php echo $row["szak"];?>' required></td>
        </tr>
        <tr>
            <td>Atlag</td>
            <td><input type="text" name="atlag" value='<?php echo $row["atlag"];?>' required></td>
            <td><input type="hidden" name="id" value='<?php echo $row["id"];?>' required></td>
        </tr>
        <tr>
            <td><input type="submit" value="Save" name="submit"></td>
        </tr>
    </table>
</form>