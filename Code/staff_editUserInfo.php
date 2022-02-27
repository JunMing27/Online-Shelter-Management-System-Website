<?php
    include("conn.php");
    include("sessionverifier.php");
    
    if ($_SESSION['position'] = 'staff') {
        if (isset($_SESSION['login_email'])) {

            $sql_userInfo = "SELECT * FROM user WHERE user_id = '$_GET[id]';";
            $sqlQuery = mysqli_query($con, $sql_userInfo);
            $userInfo = mysqli_fetch_array($sqlQuery);

            $pp = $userInfo['user_pp'];
            $fname = $userInfo['user_fname'];
            $lname = $userInfo['user_lname'];
            $name = $userInfo['user_fname'] . $userInfo['user_lname'];
            $verificationStatus = $userInfo['verification_status'];
            $gender = $userInfo['user_gender'];
            $dob = $userInfo['user_dob'];
            $contactNo = $userInfo['contact_num'];
            $email = $userInfo['login_email'];
            $emerName = $userInfo['emer_name'];
            $emerNo = $userInfo['emer_cont'];
            $emerRel =$userInfo['emer_rel'];

            // havent done yet
            // $sheltername = 
            // $startingDate = 
            // link to more info

            if ($pp == ""){
                if ($gender == 'male'){
                    $ppSource = 'img/5e5356897371bb93979e09cd_peep-42.png';
                } else if ($gender == 'female'){
                    $ppSource = 'img/5e535d897488c25a204b12ff_peep-102.png';
                }
            } else {
                $ppSource = "uploads/" . $pp;
            }

?>
            <!DOCTYPE html>
                <html>
                    <head>
                        <title>Edit profile</title>
                        <link rel="stylesheet" href="css/profileEdit_pg.css">
                        <script src="js/signup_pg.js"></script>
                        <script src="js/profileEdit_pg.js"></script>
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    </head>
                    <body>
                        <?php include("header.php"); ?>
                        <div class="title">Edit profile</div>
                        <div class="editForm">
                            <div>
                                <form method="post" enctype="multipart/form-data">
                                    <div class="profile_PContainer">
                                        <div class="profile_p"><img id="user_ppPreview" src="<?php echo $ppSource;?>" alt="Profile Image"></div>
                                        <!-- have to display original / default image -->
                                        <div><label class="buttons"><input type="file" accept="image/jpg, image/jpeg, image/png" name="user_pp" id="user_pp" onchange="ppPreview()">select</label></div>
                                    </div>
                                    
                                    First name<br> 
                                    <input value="<?php echo $fname; ?>" type="text" placeholder="maximum 50 character" name="user_fname" id="user_fname" pattern="[A-Za-z ]{1,50}" title="only letters are allowed" onkeyup="nameValidation('user_fname')" required></input>
                                    
                                    <br> Last name <br>
                                    <input value="<?php echo $lname; ?>" type="text" placeholder="maximum 50 character" name="user_lname" id="user_lname" pattern="[A-Za-z ]{1,50}" title="only letters are allowed" onkeyup="nameValidation('user_lname')" required></input>
                                    
                                    <br>Gender <br>
                                    <select class="dropdownbox" name="user_gender">
                                        <option <?php if ($gender == 'male'){
                                            ?>selected='selected'<?php
                                            }?> value="male">Male</option>
                                        <option <?php if ($gender == 'female'){
                                            ?>selected='selected'<?php
                                            }?>value="female">Female</option>
                                    </select>
                    
                                    <br>Date of birth<br>
                                    <input value="<?php echo $dob; ?>" type="text" placeholder="select" name="user_dob" onfocus="(this.type='date')" onblur="(this.type='text')" required></input>
                
                                    <br><br>contact number<br>
                                    <input value="<?php echo $contactNo; ?>" type="tel" placeholder="01234567891" name="contact_num" id="contact_num" pattern="0.{9,12}" title="phone number invalid" onkeyup="EM_contactNoValidation('contact_num')"></input>
                                    
                                    <br>Email <span> (read only)</span><br> 
                                    <input value="<?php echo $email; ?>" type="email" placeholder="email@mail.com" name="login_email" id="login_email" onkeyup="emailValidation()" readonly></input>
                                        
                                    <br><br><br>Emergency contact name<br>
                                    <input value="<?php echo $emerName; ?>" type="text" placeholder="maximum 100 character" name="emer_name" id="emer_name" pattern="[A-Za-z ]{1,50}" onkeyup="nameValidation('emer_name', 100)" required></input>
                                    
                                    <br>Emergency contact number<br>
                                    <input value="<?php echo $emerNo; ?>"  type="tel" placeholder="01234567891" name="emer_cont" id="emer_cont" pattern="0.{9,12}" title="phone number invalid" onkeyup="EM_contactNoValidation('emer_cont')" required></input>
                                    
                                    <br>relationship<br>
                                    <select class="dropdownbox" name="emer_rel">
                                        <option <?php if ($emerRel == 'family'){
                                            ?>selected='selected'<?php
                                            }?> value="family">Family</option>
                                        <option <?php if ($emerRel == 'friend'){
                                            ?>selected='selected'<?php
                                            }?> value="friend">Friend</option>
                                        <option <?php if ($emerRel == 'colleague'){
                                            ?>selected='selected'<?php
                                            }?> value="colleague">Colleague</option>
                                        <option <?php if ($emerRel == 'other'){
                                            ?>selected='selected'<?php
                                            }?> value="other">Other</option>
                                    </select>

                                    <br><br>
                                    <div class="buttonsContainer">
                                        <label><input type="submit" name="submit" value="Submit" class="buttons"></label>
                                        <label><input type="button" value="Back" class="buttons" onclick="window.location.href = 'staffinfo_detailUserInfo.php?id= <?php echo $_GET['id']; ?>';"></label>
                                    </div>
                                </form>
                                <br><br><br>
                            </div>
                        </div>
                    </div>
                    <?php include("footer.php"); ?>
                </body>
                </html>

<?php 
    } else {
        echo "<script>alert('Please sign in');
            window.location.href = 'home_pg.php';
            </script>";
    }
    // if(isset...)
    if(isset($_POST['submit'])){

        if (basename($_FILES['user_pp']['name']) != ""){
            $targetImg_dir = "uploads/";
            $targetFile = $targetImg_dir . basename($_FILES['user_pp']['name']);
            if(!move_uploaded_file($_FILES["user_pp"]["tmp_name"], $targetFile)){
                die('profile picture transfering failed');
            } else { $fileLocation = basename($_FILES['user_pp']['name']); }
        } else if ($pp != ""){ $fileLocation = $pp;
        } else {$fileLocation = "";}

        
        $sql_updateUserInfo = "UPDATE user SET 
        user_fname = '$_POST[user_fname]',
        user_lname = '$_POST[user_lname]',
        user_dob = '$_POST[user_dob]',
        user_gender = '$_POST[user_gender]',
        emer_name = '$_POST[emer_name]',
        emer_rel = '$_POST[emer_rel]',
        emer_cont = '$_POST[emer_cont]',
        contact_num = '$_POST[contact_num]',
        user_pp = '$fileLocation'
        
        WHERE user_id = '$_GET[id]';";

        if(!mysqli_query($con, $sql_updateUserInfo)){
            die('error'.mysqli_error($con));
        }else{
            echo "<script>alert('User profile amended');
            window.location.href = 'staffinfo_detailUserInfo.php?id=$_GET[id]';
            </script>";
        }

        mysqli_close($con);
    }
}
?>