<?php 
    include("conn.php");

    if ($_SESSION['position'] = 'staff') {
        if (isset($_SESSION['login_email'])) {

            $sql_userInfo = "SELECT * FROM user WHERE user_id = '$_GET[id]';";
            $sqlQuery = mysqli_query($con, $sql_userInfo);
            $userInfo = mysqli_fetch_array($sqlQuery);

            if(!mysqli_query($con,"DELETE FROM shelterbooking WHERE user_id= '$_GET[id]';")){
                die("delete shelterbooking error" . mysqli_error($con));
            } else{
                if (!mysqli_query($con,"DELETE FROM user WHERE user_id = '$_GET[id]';")){
                    die("delete account error (user table)" . mysqli_error($con));
                } else {
                    if (!mysqli_query($con,"DELETE FROM login WHERE (login_email = '$userInfo[login_email]') AND (login_position = 'user');")){
                        die("delete account error (login table)" . mysqli_error($con));
                    } else {
                        echo "<script>alert('Successfully deleted');
                        window.location.href = 'staffinfo_userInfo.php';
                        </script>";
                    }
                }
            }
        }
    }

    mysqli_close($con);
?>

