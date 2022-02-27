<?php 
    include("conn.php");
    include("sessionverifier.php");
    
    //retrieve information from database
    if (isset($_SESSION['login_email'])){
        // to determine user or staff
        $userType = $_SESSION['position'];
        $sql_UserInfo = "SELECT * FROM $userType WHERE login_email = '$_SESSION[login_email]';";
        $sql_UserInfoQuery = mysqli_query($con, $sql_UserInfo);

        $userInfo = mysqli_fetch_array($sql_UserInfoQuery);

        if ($userType == 'user'){
            $pp = $userInfo['user_pp'];
            $fname = $userInfo['user_fname'];
            $lname = $userInfo['user_lname'];
            $name = $userInfo['user_fname'] . " " . $userInfo['user_lname'];
            $verificationStatus = $userInfo['verification_status'];
            $gender = $userInfo['user_gender'];
            $dob = $userInfo['user_dob'];
            $contactNo = $userInfo['contact_num'];
            $email = $userInfo['login_email'];
            $emerName = $userInfo['emer_name'];
            $emerNo = $userInfo['emer_cont'];
            $emerRel =$userInfo['emer_rel'];

            $sql_bookingShelterInfo = "SELECT * FROM shelterbooking WHERE user_id = '$userInfo[user_id]';";
            $sql_bookingshelterInfoQuery = mysqli_query($con, $sql_bookingShelterInfo);
            $bookingShelterInfo = mysqli_fetch_array($sql_bookingshelterInfoQuery);

            $sql_shelterDetials = "SELECT shelter_name FROM shelter WHERE shelter_id = '$bookingShelterInfo[shelter_id]';";
            $sql_shelterDetialsQuery = mysqli_query($con, $sql_shelterDetials);
            $shelterDetials = mysqli_fetch_array($sql_shelterDetialsQuery);
            
            $sheltername = $shelterDetials['shelter_name'];
            $startingDate = $bookingShelterInfo['start_date'];

        } else if ($userType == 'staff'){
            $pp = $userInfo['staff_pp'];
            $fname = $userInfo['staff_fname'];
            $lname = $userInfo['staff_lname'];
            $position = "staff"; // instead of the varification status 
            $name = $userInfo['staff_fname'] . " " . $userInfo['staff_lname'];
            $gender = $userInfo['staff_gender'];
            $age = $userInfo['staff_age'];
            $contactNo = $userInfo['staff_contact'];
            $email = $userInfo['login_email'];

            $sql_responsibleShelter = "SELECT shelter_id, shelter_name FROM shelter WHERE staff_id = '$userInfo[staff_id]';";
            $sql_responsibleShelterQuery = mysqli_query($con, $sql_responsibleShelter);
            $sql_responsibleShelterQuery_copy = mysqli_query($con, $sql_responsibleShelter);

            $checking = mysqli_fetch_array($sql_responsibleShelterQuery_copy);

            // havent complete yet (responsible shelter)
            // $shelterName = 
            // link to shelter page (jun mings part)
        }

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
                <title>profile</title>
                <link rel="stylesheet" href="css/profile_pg.css">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
            </head>
            <body>
            <?php include("header.php"); ?>
                <!-- #region profile -->
                <div class="containerhehe">
                    <div class="portion1">
                        <div class="portion1_1"><img src="<?php echo $ppSource;?>" alt="profile picture"></div>
                        <div class="portion1_2 maintitleFontFamily">
                            <?php echo $name; ?><br>
                            <?php
                            if ($userType == 'user') { 
                                if ($verificationStatus == 'unverified') {?>
                                    <a style="text-decoration: none;" href="user_verification.php?id=<?php echo $userInfo['user_id']; ?>"><?php echo $verificationStatus; ?></a>
                                <?php } else if ($verificationStatus == 'pending' || $verificationStatus == 'verified') {
                                    echo $verificationStatus . "<br>";
                                    }
                                } else if ($userType == 'staff'){
                                    echo $position . "<br>";
                                }
                            ?><br>
                            <span class="editbuttonn"><a class="aStyle" href="profileEdit_pg.php">edit</a></span>
                        </div>
                    </div>
                    <div class="portion2">
                        <div class="portion2_1 maintitleFontFamily">Personal Data</div>
                        <div class="portion2_2">
                        <ul>
                            <li><?php echo $name; ?></li>
                            <li><?php echo $gender; ?></li>
                            <li><?php
                            if ($userType == 'user') {
                                echo $dob;
                            } else if ($userType == 'staff'){
                                echo $age . " years old";
                            }
                            ?></li>
                            <li id="userPhoneNo" >
                                <?php 
                                    if ($contactNo == ""){
                                        echo "<script>document.getElementById('userPhoneNo').style.display = 'none';</script>";
                                    } else {
                                        echo $contactNo;
                                    }
                                ?>
                            </li>
                            <li><?php echo $email; ?></li>
                        </ul>
                        </div>
                        
                        <?php 
                            if ($userType == 'user') { ?>
                        <div class="portion3">
                        <div class="portion3_1 maintitleFontFamily">Emergency contact</div>
                        <div class="portion2_2">
                            <ul>
                                <li>Contact name   : <?php echo $emerName; ?></li>
                                <li>contact number : <?php echo $emerNo; ?></li>
                                <li>relationship   : <?php echo $emerRel; ?></li>
                            </ul>
                        </div>
                        </div>
                        <?php
                            }
                        ?>
                        
                        <?php 
                            if ($userType == 'user') { 
                                if ($sheltername != "") { ?>
                                    <div class="portion2_1 maintitleFontFamily">Booking details</div>
                                    <div class="portion2_2">
                                        <ul>
                                            <li>Shelter name : <?php echo $sheltername; ?></li>
                                            <li>Starting From : <?php echo $startingDate; ?></li>
                                            <a class="moreInfo" href="shelterbooking.php?id=<?php echo $bookingShelterInfo['shelter_id']; ?>">more details</a>
                                        </ul>
                                    </div>
                        <?php   }
                            } else if ($userType == 'staff') {
                                if ($checking['shelter_name'] != "") {?>
                                    <div class="portion2_1 maintitleFontFamily">Responsible shelter</div>
                                    <div class="portion2_2">
                                        <ul>
                                            <?php while ($bookingShelterInfo = mysqli_fetch_array($sql_responsibleShelterQuery)) { ?>
                                                <div class="someMargin">
                                                    <li>shelter name : <?php echo $bookingShelterInfo['shelter_name']; ?></li>
                                                    <a class="moreInfo" href="staff_shelterInfo.php?id=<?php echo $bookingShelterInfo['shelter_id']; ?>">more details</a><br>
                                                </div>
                                            <?php } ?>
                                        </ul>
                                    </div>
                        <?php
                                } 
                            }?>

                        <br>
                        <div class="portion3">
                            <a class="aStyle" href="changePw_pg.php"><div class="removeAct">change password</div></a>
                            <?php if ($userType == 'user') { ?>
                                <a class="aStyle" href="removeAccount.php?id=<?php echo $userInfo['user_id']; ?>" onClick="return confirm('Confirm to delete ?')"><div class="removeAct">Remove account</div></a>
                            <?php } ?>
                        </div>
                        <br><br>
                    </div>
                </div>
                <!-- #endregion -->
                <?php include("footer.php"); ?>
            </body>
        </html>
<?php

    } else {
        echo "<script>alert('Please sign in');
            window.location.href = 'home_pg.php';
            </script>";
    }
?>