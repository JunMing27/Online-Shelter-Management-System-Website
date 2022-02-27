<?php
    include("conn.php");
    include("sessionverifier.php");

    if ($_SESSION['position'] = 'staff') {
        if (isset($_SESSION['login_email'])) {
            
            $sql_userInfo = "SELECT * FROM user ;";
            $sqlQuery = mysqli_query($con, $sql_userInfo);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>shelter</title>
        <link rel="stylesheet" href="css/staffinfo_shelter.css">
        <script src="js/staffInfo_shelter.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <?php include("header.php"); ?>
        <div class="title">User Information</div>
        
        <div class="main_box">
            <div class="searchbarContainer">
                <form>
                    <input type="text" name="userName" id="userName" onkeyup="displayinfo(this.value)" placeholder="search">
                </form>
            </div>
            <div id="searchUser" class="main_box">
            <?php 
            $noinfo_box='<div class="main_box "><img src="img/nodata.png" alt="no data found" width="700px" height="400px"> </div>';
            $rowamount = mysqli_num_rows($sqlQuery);
            if ($rowamount ==0){
                echo $noinfo_box;
            } else {
                while ($userInfo = mysqli_fetch_array($sqlQuery)) { 

                $id = $userInfo['user_id'];
                $pp = $userInfo['user_pp'];
                $gender = $userInfo['user_gender'];
                $fname = $userInfo['user_fname'];
                $lname = $userInfo['user_lname'];
                $name = $userInfo['user_fname'] . $userInfo['user_lname'];
                $verificationStatus = $userInfo['verification_status'];


                if ($pp == ''){
                    if ($gender == 'male'){
                        $ppSource ='img/5e5356897371bb93979e09cd_peep-42.png';
                    } else if ($gender == 'female'){
                        $ppSource = 'img/5e535d897488c25a204b12ff_peep-102.png';
                    }
                } else {
                    $ppSource = "uploads/" . $pp;
                }?>

            <div class='info'>
                <a class='singleInfo' href='staffinfo_detailUserInfo.php?id= <?php echo $id; ?>'>
                    <div class='singleInfo_pp'><img src='<?php echo $ppSource;?>' alt='profile picture'></div>
                    <div class='singleInfo_info'>
                        <div class='singleInfo_info_inner'><?php echo $name; ?><br><br>id :<?php echo $id; ?></div>
                    </div>
                    <div class='singleInfo_availability'>
                        <?php if ($verificationStatus == 'unverified') { ?>
                            <div class='singleInfo_availability_inner' style='color: red;'><?php echo $verificationStatus; ?></div>
                        <?php } else if ($verificationStatus == 'verified') { ?>
                            <div class='singleInfo_availability_inner' style='color: greenyellow;'><?php echo $verificationStatus; ?></div>
                        <?php } else if ($verificationStatus == 'pending') {?>
                            <div class='singleInfo_availability_inner' style='color: grey;'><?php echo $verificationStatus; ?></div>
                        <?php }?>
                    </div>
                </a>
            </div>
        <?php }
        } ?>
                <br><br><br>
            </div>
        </div>
        <?php include("footer.php"); ?>
    </body>
</html>

<?php
        } // if (isset($_SESSION['login_email']))
    } // if ($_SESSION['position'] = 'staff')
?>