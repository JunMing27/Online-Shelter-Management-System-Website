<?php
    include("conn.php");
    include("sessionverifier.php");

    //retrieve information from database
    if (isset($_SESSION['login_email'])){
        $userType = $_SESSION['position'];
        $sql_UserLoginInfo = "SELECT * FROM login WHERE (login_email = '$_SESSION[login_email]') AND (login_position = '$userType');";
        $sql_UserLoginInfoQuery = mysqli_query($con, $sql_UserLoginInfo);

        while ($user_loginInfo = mysqli_fetch_array($sql_UserLoginInfoQuery)){
            $oldPw = $user_loginInfo['login_pw'];
?>
            <!DOCTYPE html>
                <html>
                    <head>
                        <title>Change Password</title>
                        <link rel="stylesheet" href="css/profileEdit_pg.css">
                        <script src="js/signup_pg.js"></script>
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    </head>
                    <body>
                        <?php include("header.php"); ?>
                        <div class="title">Change Password</div>
                        <div class="editForm">
                            <div>
                                <form method="post">
                                    <br>Current password<br>
                                    <input type="password" name="oldPw" id="oldPw" pattern=".{8,}" title="at least 8 characters" onkeyup="passwordValidation('oldPw')" required></input>
                                    <br>New password <span id="pwvalidation" style="display: none; color: red;" >*password should not contain '</span><br>
                                    <input type="password" placeholder="minimum 8 character" name="newPw" id="newPw" pattern=".{8,}" title="at least 8 characters" onkeyup="passwordValidation('newPw')" required></input>
                                    <br>Confirm new password<br>
                                    <input type="password" placeholder="Confirm password" name="confirmPw" id="confirmPw" pattern=".{8,}" title="at least 8 characters" onkeyup="confirmPasswordValidation('newPw', 'confirmPw')" required></input>
                                    <br><br>
                                    <!-- <input type="submit" name="submit" value="Submit"> -->
                                    <!-- <a href="#register" class="others register">Register</a> -->
                                    <div class="buttonsContainer">
                                        <label><input type="submit" name="submit" value="Submit" class="buttons"></label>
                                        <label><input type="submit" value="Back" class="buttons" onclick="window.location.href = 'profile_pg.php';"></label>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <?php include("footer.php"); ?>
                    </body>
                </html>

<?php
        } //while loop
    } // if(isset...)

    if(isset($_POST['submit'])){
        $vldt = str_replace("'","",$_POST['newPw']);

                if ($vldt === $_POST['newPw']) {
                    $validations = true;
                } else {
                    echo "<script>document.getElementById('pwvalidation').style.display = 'inline-block';</script>";
                    $validations = false;
                }
        if ($validations === true) {
            echo $oldPw;
            // original password confirmation
            if ($oldPw != $_POST['oldPw']){
                echo "<script>alert('Original Password invalid');</script>";
                $originalPwValidation = false;
            } else {
                $originalPwValidation = true;
            }

            // password confirmation
            if($_POST['newPw'] != $_POST['confirmPw']){
                echo "<script>alert('Wrong confirm password');</script>";
                $confirmPwValidation = false;
            } else if ($_POST['newPw'] == $_POST['confirmPw']){
                $confirmPwValidation = true;
            }

            if ($confirmPwValidation === true && $originalPwValidation && true) {
                $sql_changePw = "UPDATE login SET 
                login_pw = '$_POST[newPw]'
                WHERE (login_email = '$_SESSION[login_email]') AND (login_position = '$userType');";

                if(!mysqli_query($con, $sql_changePw)){
                    die('error'.mysqli_error($con));
                }else{
                    echo "<script>alert('Password amended');
                    window.location.href = 'profile_pg.php';
                    </script>";
                }
            }
            mysqli_close($con);
        }
    }
?>