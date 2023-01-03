<?php
require 'listazas.php';
include 'connect.php';


$result = $mysqli->query("SELECT * FROM hallgatok");
echo "<a href=bevitel.php>Uj hozzaadasa</a>";
listaz($result);
echo "<a href=logout.php>Kilepes</a>";