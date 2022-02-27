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

            $sql_shelterDetials = "SELECT shelter_name, shelter_id FROM shelter WHERE shelter_id = '$bookingShelterInfo[shelter_id]';";
            $sql_shelterDetialsQuery = mysqli_query($con, $sql_shelterDetials);
            $shelterDetials = mysqli_fetch_array($sql_shelterDetialsQuery);
            
            $sheltername = $shelterDetials['shelter_name'];
            $startingDate = $bookingShelterInfo['start_date'];

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
<html lang="en">
    <head>
        <title>user profile</title>
        <link rel="stylesheet" href="css/profile_pg.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <!-- #region profile -->
        <div class="containerhehe">
            <div class="portion1">
                <div class="portion1_1"><img src="<?php echo $ppSource;?>" alt="profile picture"></div>
                <div class="portion1_2 maintitleFontFamily">
                    <?php echo $name; ?><br>
                    <?php echo $verificationStatus; ?><br><br>
                    <span class="editbuttonn"><a class="aStyle" href="staff_shelterUserInfo.php?id=<?php echo $shelterDetials['shelter_id']; ?>">Back</a></span>
                </div>
            </div>
            <div class="portion2">
                <div class="portion2_1">Personal Data</div>
                <div class="portion2_2">
                <ul>
                    <li>id : <?php echo $_GET['id']; ?></li>
                    <li><?php echo $name; ?></li>
                    <li><?php echo $gender; ?></li>
                    <li><?php echo $dob; ?></li>
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
                
                <div class="portion3">
                <div class="portion3_1">Emergency contact</div>
                <div class="portion2_2">
                    <ul>
                        <li>Contact name   : <?php echo $emerName; ?></li>
                        <li>contact number : <?php echo $emerNo; ?></li>
                        <li>relationship   : <?php echo $emerRel; ?></li>
                    </ul>
                </div>
                </div>
                <?php 
                    if ($sheltername != "") { ?>
                        <div class="portion2_1">Booking details</div>
                        <div class="portion2_2">
                            <ul>
                                <li>Shelter name : <?php echo $sheltername; ?></li>
                                <li>Starting From : <?php echo $startingDate; ?></li>
                            </ul>
                        </div>
                <?php } ?>
                <br><br>
            </div>
        </div>
        <!-- #endregion -->
    </body>
</html>

<?php
        } // if (isset($_SESSION['login_email']))
    } // if ($_SESSION['position'] = 'staff')
?>