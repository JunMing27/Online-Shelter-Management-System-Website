<?php
    include("conn.php");
    include("sessionverifier.php");

    $sql_alluser = "SELECT * FROM shelterbooking WHERE shelter_id = '$_GET[id]';";
    $sqlQuery = mysqli_query($con, $sql_alluser);

?>

<!DOCTYPE html>
<html>
    <head>
        <title>shelter</title>
        <link rel="stylesheet" href="css/staff_shelterUserInfo.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

    </head>
    <body>
        <div class="theMainContainer stickySearchbar">
            <div class="searchbarContainer">
                <form class="searchbar">
                    <input type="text" placeholder="search" name="userName" id="userName" style="text-align: center;" onkeyup="displauUserInfo(this.value)">
                </form>
            </div>
        </div>
        <div class="theMainContainer" id="allUser">
            <?php
                $noinfo_box='<div class="main_box "><img class="imagecenter" src="img/nodata.png" alt="no data found" width="700px" height="400px"> </div>';
                $rowamount = mysqli_num_rows($sqlQuery);
                if ($rowamount ==0){
                    echo $noinfo_box;
                }
                while ($alluser = mysqli_fetch_array($sqlQuery)) {

                    $sql_userInfo = "SELECT user_fname, user_lname, user_pp, user_gender FROM user WHERE user_id = '$alluser[user_id]';";
                    $sql_userInfoquery = mysqli_query($con, $sql_userInfo);
                    $userInfo = mysqli_fetch_array($sql_userInfoquery);

                    if ($userInfo['user_pp'] == ''){
                        if ($userInfo['user_gender'] == 'male'){
                            $ppSource ='img/5e5356897371bb93979e09cd_peep-42.png';
                        } else if ($userInfo['user_gender'] == 'female'){
                            $ppSource = 'img/5e535d897488c25a204b12ff_peep-102.png';
                        }
                    } else {
                        $ppSource = "uploads/" . $userInfo['user_pp'];
                    }

                    $username = $userInfo['user_fname'] . ' ' . $userInfo['user_lname'];
                    ?>
                    
                    <div class="MainUserContainer">
                        <div class="profileP"><a href="staff_shelterCurrentLivingUserInfo.php?id=<?php echo $alluser['user_id']; ?>"><img src="<?php echo $ppSource; ?>" alt="profile picture"></a></div>
                        <div class="userDetail"><a href="staff_shelterCurrentLivingUserInfo.php?id=<?php echo $alluser['user_id']; ?>">
                            <div>name : <?php echo $username; ?></div><br>
                            <div>start from : <?php echo $alluser['start_date']; ?></div>
                        </a></div>
                        <div class="removeButton">
                            <form method="POST" class="cancelbutton">
                                <input type="text" name="userID" style="display: none;" value="<?php echo $alluser['user_id']; ?>">
                                <input type="submit" name="removeUser" value="" onclick="return confirm('Confirm to remove user ?')">
                            </form>
                        </div>
                    </div>
            <?php }?>
        </div>
        <script>
            function displauUserInfo(username) {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("allUser").innerHTML = this.responseText;
                }
                };
                xmlhttp.open("GET", "staff_searchAllusershelter.php?username=" + username + "&id=<?php echo $_GET['id']; ?>", true);
                xmlhttp.send();
            }
        </script>
    </body>
</html>

<?php
    if (isset($_POST['removeUser'])) {
        
        $sql_shelterInfo = "SELECT occupied_space FROM shelter WHERE shelter_id = '$_GET[id]'";
        $sql_shelterInfoQuery = mysqli_query($con, $sql_shelterInfo);
        $shelterInfo = mysqli_fetch_array($sql_shelterInfoQuery);

        $sql_deleteBookingContract = "DELETE FROM shelterbooking WHERE (shelter_id = '$_GET[id]') AND (user_id = '$_POST[userID]');";
        $minusos = intval($shelterInfo['occupied_space']) - 1;
        $sql_minusOccupied_space = "UPDATE shelter SET
        occupied_space = '$minusos'
        WHERE shelter_id = '$_GET[id]'";
    
        if (!mysqli_query($con,$sql_deleteBookingContract)){
            die("cancel error" . mysqli_error($con));
        } else {
            if (!mysqli_query($con,$sql_minusOccupied_space)){
                die("minus occupied_space error" . mysqli_error($con));
            } else {
                echo "<script>alert('Successfully remove');
                window.location.href = 'staff_shelterUserInfo.php?id=".$_GET['id']."';
                </script>";
            }
        }

    }
?>