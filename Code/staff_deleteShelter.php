<?php 
    include("conn.php");
    include("sessionverifier.php");

    if (!mysqli_query($con,"DELETE FROM shelterbooking WHERE shelter_id = '$_GET[id]';")){
        die("delete booking details error" . mysqli_error($con));
    } else {
        if (!mysqli_query($con,"DELETE FROM shelter WHERE shelter_id = '$_GET[id]';")){
            die("delete shelter error" . mysqli_error($con));
        } else {
            echo "<script>alert('Successfully deleted');
            window.location.href = 'staff_shelter.php';
            </script>";
        }
    }

?>