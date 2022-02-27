<?php
    $con = mysqli_connect("localhost","root","","elderlyhomesclub");

    // check connection
    if(mysqli_connect_error()){
        echo "database 'tesing' conenction failed".mysqli_connect_error();
    }
?>