<?php 
    include("conn.php");

    $userType = $_SESSION['position'];
    $user_id = $_GET['id'];
    if(!mysqli_query($con,"DELETE FROM shelterbooking WHERE user_id= '$user_id';")){
        die("delete shelterbooking error" . mysqli_error($con));
    } else{
        if (!mysqli_query($con,"DELETE FROM $userType WHERE login_email= '$_SESSION[login_email]';")){
            die("delete account error (user table)" . mysqli_error($con));
        } else {
                if (!mysqli_query($con,"DELETE FROM login WHERE (login_email = '$_SESSION[login_email]') AND (login_position = '$userType');")){
                    die("delete account error (login table)" . mysqli_error($con));
                } else {
                    echo "<script>alert('Successfully deleted');
                    window.location.href = 'home_pg.php';
                    </script>";
                    session_destroy();
                }
        }
    }
    mysqli_close($con);
?>

