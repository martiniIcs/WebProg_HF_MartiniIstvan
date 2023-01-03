<?php

function listaz($rows){
    echo '<table border="1">';
    foreach ($rows as $row){
        echo "<tr>";
        foreach ($row as $column){
            echo "<td>" . $column . "</td>";
        }
        echo "<td>";
        echo "<a href='update.php?id=". $row["id"]  . "'>Update</a>";
        echo "</td>";

        echo "<td>";
        echo "<a href='delete.php?id=" . $row["id"] . "'>Delete</a>";

        echo "</td>";
        echo "<tr>";

    }

    echo "</table>";
}