<?php

    $db = mysqli_connect("localhost", "root", "", "cse299_db");

    if(!$db)
    {
        die("Connection failed: " . mysqli_connect_error());
    }
?>
