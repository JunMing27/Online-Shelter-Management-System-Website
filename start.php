<?php
    mysqli_connect("localhost","root","","elderlyhomesclub");

    // check connection
    if(mysqli_connect_error()){
        echo "Please import the database 'elderlyhomesclub' to proceed";
    } else {
        echo "<script>window.location.href = 'assignment2.6/home_pg.php';</script>";
    }
?>