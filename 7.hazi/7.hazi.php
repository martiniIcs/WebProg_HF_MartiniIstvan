<?php

if (isset($_POST['elkuldott'])){
    if (isset($_SESSION['gszam'])){
        logika($_POST['talalgatas'],$_SESSION['gszam']);
    }else{
        $gszam = rand(1,10);
        setcookie('gszam', $gszam,time()+3600);
        logika($_POST['talalgatas'],$gszam);
    }
}

function logika($szam,$gszam){
    if ($szam > $gszam){
        echo "<h3>A szam kisebb </h3>";
        echo "<br>";
    }else if ($szam < $gszam){
        echo "<h3>A szam nagyobb </h3>";
        echo "<br>";
    }else{
        echo "<h3>Talalt </h3>";
        setcookie('gszam','',time()-3600);
    }


}


?>
<form method="POST" action="<?php $_SERVER['PHP_SELF']?>">
    <input type="hidden" name="elkuldott" value="true">
    Melyik számra gondoltam 1 és 10 között?
    <input name="talalgatas" type="text">
    <br>
    <br>
    <input type="submit" value="Elküld">
</form>
Footer
