<?php
include 'connect.php';
session_start();

echo 'login';

if (isset($_SESSION['user'])){


    $query = $mysqli->prepare("SELECT * FROM users WHERE id = (?)");
    $query->bind_param('d',$_SESSION['user']);
    $query->execute();

    $results = $query->get_result();
    $result_array = $results->fetch_array();
    if ($result_array != null){
        header("Location: index.php");
        exit();
    }
    else{
        $_SESSION = array();
    }
}

if (isset($_POST['submit'])){
    if (isset($_POST['password']) && isset($_POST['username'])){

        $query = $mysqli->prepare("SELECT * FROM users WHERE username = (?) AND password = (?)");
        $query->bind_param('ss',$_POST['username'],$_POST['password']);
        $query->execute();

        $results = $query->get_result();
        $result_array = $results->fetch_array();

        if ($result_array != null){
            $_SESSION['user'] = $result_array['id'];
            header("Location: index.php");
        }

    }
}
?>
    <form name="form1" method="post" action="login.php">
        <table>
            <tr>
                <td>Username</td>
                <td><input type="text" name="username"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="password"></td>
            </tr>
            <tr>
                <td><input type="submit" value="Sign In" name="submit"></td>
            </tr>
        </table>
    </form>
<?php
