<?php
include "conn.php";

if (isset($_POST['uemail']) && isset($_POST['upass'])) {

    function validate ($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $uemail = validate ($_POST['uemail']);
    $upass = validate ($_POST['upass']);

    if (empty($uemail)) {
        header("Location: user_index.php?error=Email is Required");
        exit();
    }
    else if (empty($upass)) {
        header("Location: user_index.php?error=Password is Required");
        exit();
    }else{
        $sql ="SELECT * FROM login WHERE login_email ='$uemail' AND  login_pw ='$upass'";
        $result =mysqli_query($con, $sql);

        if (mysqli_num_rows($result)) {
            $row = mysqli_fetch_array($result);
            if($row['login_email'] == $uemail && $row ['login_pw'] == $upass){
                $_SESSION['login_email'] = $row['login_email'];
                // SET Position SESSION
                $sql ="SELECT login_position FROM login WHERE login_email ='$uemail'";
                $result =mysqli_query($con, $sql);
                if (mysqli_num_rows($result)) {
                    $row = mysqli_fetch_array($result);
                $_SESSION['position'] = $row['login_position'];}
                // SET User ID SESSION
                if ($_SESSION['position'] == "user"){
                    $sql ="SELECT user_id FROM user WHERE login_email ='$uemail'";
                    $result =mysqli_query($con, $sql);
                    if (mysqli_num_rows($result)) {
                        $row = mysqli_fetch_array($result);
                        $_SESSION['user_id'] = $row['user_id'];}
                }
                // SET Staff ID SESSION
                if ($_SESSION['position'] =="staff") {
                    $sql ="SELECT staff_id FROM staff WHERE login_email ='$uemail'";
                    $result =mysqli_query($con, $sql);
                    if (mysqli_num_rows($result)) {
                        $row = mysqli_fetch_array($result);
                        $_SESSION['staff_id'] = $row['staff_id'];}
                }
                if(!empty($_POST["remember"])){
                    setcookie("cookieemail", $_POST['uemail'], time() + (86400 * 30), "/");
                }
                mysqli_close($con);
                header("Location: home_pg.php");
                exit();
            }else{
                header("Location: user_index.php?error=Incorrect Email or Password");
                exit();

            }
            
        }else{ 
            header("Location: user_index.php?error=Incorrect Email or Password");
            exit();
        }
    }

}else{
    header("Location: user_index.php");
    exit();
}

    