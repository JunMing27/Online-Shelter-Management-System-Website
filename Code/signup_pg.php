<?php 
    include("conn.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Sign up</title>
        <link rel="stylesheet" href="css/signup_pg.css">
        <script src="js/signup_pg.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <?php include("header.php"); ?>
        <div class="portion1">
            <div class="portion1_1"><img src="img/77905e93-a0d6-430e-8634-41ed9e5e4abb.jpg" alt=""></div>
            <div class="portion1_2">
                <!-- <div class="errorMessage" id="errorMessage">error</div> -->
                <div class="title">
                    Sign up
                    <div style="font-size: 15px; color: rgb(54, 54, 54);">* please enter the required information</div>
                </div>
                
                <form method="post">
                    First name <span style="display: none;" id="FnameID">*Please enter on alphabets only</span><br>
                    <input type="text" placeholder="maximum 50 character" name="user_fname" id="user_fname" pattern="[A-Za-z ]{1,50}" oninvalid="invalidMessage('FnameID')" onkeyup="nameValidation('user_fname')" required></input>
                    <br> Last name <span style="display: none;" id="LnameID">* Please enter on alphabets only</span><br>
                    <input type="text" placeholder="maximum 50 character" name="user_lname" id="user_lname" pattern="[A-Za-z ]{1,50}" oninvalid="invalidMessage('LnameID')" title="should be less than 50 characters" onkeyup="nameValidation('user_lname')" required></input>
                    <br>Gender<br>
                    <select class="dropdownbox" name="user_gender">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                    <br>Date of birth<br>
                    <input type="text" placeholder="select" name="user_dob" onfocus="(this.type='date')" onblur="(this.type='text')" required></input>
                    <br>Email <span id="emailError">*email used</span><span style="display: none;" id="emailID"> * Please follow the format</span><br> 
                    <input type="email" placeholder="email@mail.com" name="login_email" id="login_email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" oninvalid="invalidMessage('emailID')" onkeyup="emailValidation()" required></input>
                    <br>Password<span id="passdwordError" style="display: none; color: red;"> *password should not contain '</span><br>
                    <input type="password" placeholder="minimum 8 character" name="login_pw" id="login_pw" pattern=".{8,}" title="at least 8 characters" onkeyup="passwordValidation('login_pw')" required></input>
                    <br>Confirm password<br>
                    <input type="password" placeholder="Confirm password" name="confirmPw" id="confirmPw" pattern=".{8,}" title="at least 8 characters" onkeyup="confirmPasswordValidation('login_pw', 'confirmPw')" required></input>           
                    <br><br><br>Emergency contact name <span style="display: none;" id="emernameID">* Please enter on alphabets only</span><br>
                    <input type="text" placeholder="maximum 100 character" name="emer_name" id="emer_name" pattern="[A-Za-z ]{1,100}" oninvalid="invalidMessage('emernameID')" onkeyup="nameValidation('emer_name', 100)" required></input>
                    <br>Emergency contact number<br>
                    <input type="tel" placeholder="01234567891" name="emer_cont" id="emer_cont" pattern="0.{9,12}" title="phone number invalid" onkeyup="EM_contactNoValidation('emer_cont')" required></input>
                    <br>relationship<br>
                    <select class="dropdownbox" name="emer_rel">
                        <option value="family">Family</option>
                        <option value="friend">Friend</option>
                        <option value="colleague">Colleague</option>
                        <option value="other">Other</option>
                    </select>
                    <br><br>
                    <div>
                        <input type="submit" name="submit" value="Submit">
                        <input type="submit" value="back" onclick="window.location.href = 'user_index.php'">
                    </div>
                </form>
                <br><br><br>
            </div>
        </div>
        <?php include("footer.php"); ?>
    </body>
</html>

<?php
    if(isset($_POST['submit'])){

        // email validation
        // true - success
        // false - failed
        $Emailvalidation = true;
        $sqlEmail = mysqli_query($con, "SELECT login_email FROM login;");
        while($usedEmail = mysqli_fetch_array($sqlEmail)){
            if ($usedEmail['login_email'] == $_POST['login_email']){
                echo "<script>document.getElementById('emailError').style.display = 'inline-block';
                alert('Email used');</script>";
                $Emailvalidation = false;
                break;
            }
        }

        // password confirmation
        $passw =  htmlspecialchars($_POST['login_pw']);
        $conPassw =  htmlspecialchars($_POST['confirmPw']);

        if($passw != $conPassw){
            $confirmPwValidation = false;
        } else if ($passw == $conPassw){
            $PWvldt = str_replace("'","",$passw);
            if ($PWvldt === $passw) {
                $confirmPwValidation = true;
            } else {
                echo "<script>document.getElementById('passdwordError').style.display = 'inline-block';</script>";
                $confirmPwValidation = false;
            }
        }

        $sqlAppend1 = "INSERT INTO login (login_email, login_pw) VALUES ('$_POST[login_email]', '$passw');";
        $sqlAppend2 = "INSERT INTO user (user_fname, user_lname, user_dob, user_gender, login_email, emer_name, emer_rel, emer_cont) 
        VALUES ('$_POST[user_fname]', '$_POST[user_lname]', '$_POST[user_dob]', '$_POST[user_gender]', '$_POST[login_email]', '$_POST[emer_name]', '$_POST[emer_rel]', '$_POST[emer_cont]');";


        if (($confirmPwValidation === true) && ($Emailvalidation === true)) {
            if(!mysqli_query($con, $sqlAppend1)){
                die('error'.mysqli_error($con));
            }else{
                if(!mysqli_query($con, $sqlAppend2)){
                    die('error'.mysqli_error($con));
                }else {
                $_SESSION['login_email'] = $_POST['login_email'];
                $_SESSION['position'] = "user";
                
                $sql_forID = "SELECT user_id FROM user WHERE login_email = '$_SESSION[login_email]';";
                $userID = mysqli_fetch_array(mysqli_query($con, $sql_forID));

                $_SESSION["user_id"] = $userID['user_id'];

                echo "<script>alert('Successfully Signed up');
                window.location.href = 'signup_secretQuestion.php';
                </script>";
                }
            }
        }
        mysqli_close($con);
    }
?>